<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        if ($action === 'save') {
            handleSaveConcert($pdo);
        } elseif ($action === 'delete') {
            handleDeleteConcert($pdo);
        } else {
            throw new Exception("Invalid action");
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Server error: ' . $e->getMessage()
        ]);
        exit;
    }
} else {
    header('Content-Type: application/json');
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

function handleSaveConcert($pdo) {
    $concertId = !empty($_POST['all-id']) ? (int)$_POST['all-id'] : null;
    
    // Get existing image if in edit mode
    $oldImage = '';
    if ($concertId) {
        $stmt = $pdo->prepare("SELECT ImageURL FROM concerts WHERE ConcertID = ?");
        $stmt->execute([$concertId]);
        $oldImage = $stmt->fetchColumn();
    }

    $imagePath = $oldImage; // Default to existing image

    // Handle file upload
    if (!empty($_FILES['all-image-input']['name'])) {
        $targetDir = "../assets/image_concert/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['all-image-input']['name']);
        $targetFile = $targetDir . $fileName;
        
        if (move_uploaded_file($_FILES['all-image-input']['tmp_name'], $targetFile)) {
            $imagePath = '../assets/image_concert/' . $fileName;
        }
    } else if (!$concertId) {
        // For new concert, image is required
        throw new Exception("Image is required for new concert");
    }

    // Prepare concert data
    $concertData = [
        'title' => $_POST['all-title'] ?? '',
        'venue' => $_POST['all-venue'] ?? '',
        'city' => $_POST['all-city'] ?? '',
        'date' => $_POST['all-date'] ?? '',
        'time' => $_POST['all-time'] ?? '',
        'description' => $_POST['all-description'] ?? '',
        'about' => $_POST['all-about'] ?? '',
        'image_path' => $imagePath,
        'address' => $_POST['all-address'] ?? '',
        'map_link' => $_POST['all-map-link'] ?? '',
        'facilities' => $_POST['all-facilities'] ?? '',
        'artist_name' => $_POST['artist-name'][0] ?? '',
        'artist_image' => $_POST['artist-image'][0] ?? ''
    ];

    // Validate required fields
    $required = ['title', 'venue', 'city', 'date', 'time', 'description', 'about', 'address', 'artist_name'];
    foreach ($required as $field) {
        if (empty($concertData[$field])) {
            throw new Exception("Field $field is required");
        }
    }

    // Convert time format
    $time = date('H:i:s', strtotime($concertData['time']));
    if (!$time) {
        throw new Exception("Invalid time format: " . $concertData['time']);
    }

    // Convert date format
    $mysqlDate = date('Y-m-d', strtotime($concertData['date']));
    if (!$mysqlDate) {
        throw new Exception("Invalid date format: " . $concertData['date']);
    }

    // Prepare ticket prices
    $ticketPrices = [
        'regular' => [
            'price' => (float)($_POST['all-price-regular'] ?? 0),
            'stock' => (int)($_POST['all-stock-regular'] ?? 0),
            'description' => $_POST['all-desc-regular'] ?? 'Standard admission ticket'
        ],
        'vip' => [
            'price' => (float)($_POST['all-price-vip'] ?? 0),
            'stock' => (int)($_POST['all-stock-vip'] ?? 0),
            'description' => $_POST['all-desc-vip'] ?? 'VIP access with premium viewing area'
        ],
        'platinum' => [
            'price' => (float)($_POST['all-price-platinum'] ?? 0),
            'stock' => (int)($_POST['all-stock-platinum'] ?? 0),
            'description' => $_POST['all-desc-platinum'] ?? 'Platinum experience with backstage access'
        ]
    ];

    // Prepare genres
    $genres = isset($_POST['all-genre']) ? (array)$_POST['all-genre'] : [];

    // Save to database
    try {
        $pdo->beginTransaction();
        
        // Handle artist
        $stmt = $pdo->prepare("SELECT ArtistID FROM artists WHERE Name = ?");
        $stmt->execute([$concertData['artist_name']]);
        $artist = $stmt->fetch();
        
        if ($artist) {
            $artistId = $artist['ArtistID'];
            // Update artist image if needed
            if (!empty($concertData['artist_image'])) {
                $stmt = $pdo->prepare("UPDATE artists SET ImageURL = ? WHERE ArtistID = ?");
                $stmt->execute([$concertData['artist_image'], $artistId]);
            }
        } else {
            // Insert new artist
            $stmt = $pdo->prepare("INSERT INTO artists (Name, ImageURL) VALUES (?, ?)");
            $stmt->execute([$concertData['artist_name'], $concertData['artist_image']]);
            $artistId = $pdo->lastInsertId();
        }
        
        // Handle concert
        if ($concertId) {
            // Update existing concert
            $stmt = $pdo->prepare("UPDATE concerts SET 
                Title = ?,
                Description = ?,
                ConcertDate = ?,
                ConcertTime = ?,
                Venue = ?,
                City = ?,
                Address = ?,
                Facilities = ?,
                MapLink = ?,
                ImageURL = ?,
                LongDescription = ?,
                ArtistID = ?
                WHERE ConcertID = ?
            ");
            $stmt->execute([
                $concertData['title'],
                $concertData['description'],
                $mysqlDate,
                $time,
                $concertData['venue'],
                $concertData['city'],
                $concertData['address'],
                $concertData['facilities'],
                $concertData['map_link'],
                $imagePath,
                $concertData['about'],
                $artistId,
                $concertId
            ]);
        } else {
            // Insert new concert
            $stmt = $pdo->prepare("INSERT INTO concerts (
                Title, Description, ConcertDate, ConcertTime, Venue, City, Address, 
                Facilities, MapLink, ImageURL, LongDescription, ArtistID
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $concertData['title'],
                $concertData['description'],
                $mysqlDate,
                $time,
                $concertData['venue'],
                $concertData['city'],
                $concertData['address'],
                $concertData['facilities'],
                $concertData['map_link'],
                $imagePath,
                $concertData['about'],
                $artistId
            ]);
            $concertId = $pdo->lastInsertId();
        }

        // Delete old ticket types
        $stmt = $pdo->prepare("DELETE FROM tickettypes WHERE ConcertID = ?");
        $stmt->execute([$concertId]);

        // Save ticket types
        foreach ($ticketPrices as $type => $data) {
            $stmt = $pdo->prepare("INSERT INTO tickettypes (
                ConcertID, TypeName, Price, QuantityAvailable, Description
            ) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $concertId,
                ucfirst($type),
                $data['price'],
                $data['stock'],
                $data['description']
            ]);
        }

        // Delete old genres
        $stmt = $pdo->prepare("DELETE FROM concertgenres WHERE ConcertID = ?");
        $stmt->execute([$concertId]);

        // Save genres
        foreach ($genres as $genreId) {
            $genreId = (int)$genreId;
            if ($genreId > 0) {
                $stmt = $pdo->prepare("INSERT INTO concertgenres (ConcertID, GenreID) VALUES (?, ?)");
                $stmt->execute([$concertId, $genreId]);
            }
        }

        $pdo->commit();
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Concert saved successfully',
            'id' => $concertId
        ]);
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        throw new Exception('Save failed: ' . $e->getMessage());
    }
}

function handleDeleteConcert($pdo) {
    $concertId = $_POST['id'] ?? 0;
    if (!$concertId) {
        throw new Exception("Invalid concert ID");
    }

    try {
        $pdo->beginTransaction();

        // Delete genres
        $stmt = $pdo->prepare("DELETE FROM concertgenres WHERE ConcertID = ?");
        $stmt->execute([$concertId]);
        
        // Delete tickets
        $stmt = $pdo->prepare("DELETE FROM tickettypes WHERE ConcertID = ?");
        $stmt->execute([$concertId]);
        
        // Delete concert
        $stmt = $pdo->prepare("DELETE FROM concerts WHERE ConcertID = ?");
        $stmt->execute([$concertId]);
        
        $pdo->commit();
        
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        throw new Exception('Delete failed: ' . $e->getMessage());
    }
}
?>