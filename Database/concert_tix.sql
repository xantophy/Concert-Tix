-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2025 pada 02.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concert_tix`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artists`
--

CREATE TABLE `artists` (
  `ArtistID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ImageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artists`
--

INSERT INTO `artists` (`ArtistID`, `Name`, `ImageURL`) VALUES
(36, 'Coldplay', 'https://deras.id/wp-content/uploads/2023/05/IMG_20230521_103756-564x470.jpg'),
(37, 'LE SSERAFIM', 'https://i.pinimg.com/736x/6a/e7/6d/6ae76ddb80b5bfcafeedd6f312fc4964.jpg'),
(38, 'The 1975', 'https://i.pinimg.com/736x/69/0f/03/690f03b59d98d9f7bebca87859885b8f.jpg'),
(39, 'NOAH', 'https://about.vidio.com/wp-content/uploads/2022/09/Blog_Noah-1.jpg'),
(40, 'IVE', 'https://i.pinimg.com/736x/0a/27/61/0a2761ae8902ccd5b35b488d6376811d.jpg'),
(41, 'Tame Impala', 'https://i.pinimg.com/736x/99/78/64/997864275ce154efda6c3fdf3e0587d6.jpg'),
(42, 'BLACKPINK', 'https://i.pinimg.com/736x/7d/36/43/7d36431f7aa222b3b24d29cba24aa082.jpg'),
(43, 'Red Velvet', 'https://i.pinimg.com/736x/1b/5d/d1/1b5dd1bdb2656f71678da543a341016d.jpg'),
(44, 'Taylor Swift', 'https://i.pinimg.com/736x/6a/44/e3/6a44e3b81fa49e2358ca6e6b67d67512.jpg'),
(45, 'IU', 'https://i.pinimg.com/736x/34/a3/a1/34a3a138ec6010d69c05d9d99f703f36.jpg'),
(46, 'New Jeans', 'https://i.pinimg.com/736x/5a/2f/cc/5a2fcc087ef912223be6a2b17e8ae33c.jpg'),
(47, 'Metallica', 'https://i.pinimg.com/736x/02/af/1e/02af1ed2b79ca6a8924feed0fa157184.jpg'),
(48, 'Doja Cat', 'https://i.pinimg.com/736x/ae/40/2f/ae402f50120c63157aea87ff5d5983b5.jpg'),
(49, 'Stray Kids', 'https://i.pinimg.com/736x/83/75/52/83755269590030116e60f36f163736e6.jpg'),
(50, 'Hans Zimmer', 'https://i.pinimg.com/736x/fd/89/08/fd890871e1de76696df2f1edf6dbb687.jpg'),
(51, 'Kendrick Lamar', 'https://i.pinimg.com/736x/0a/7f/66/0a7f66613f473286a8ad0c5261fa5d44.jpg'),
(52, 'Erasure', 'https://i.pinimg.com/736x/8d/ba/e5/8dbae5509f7f188716e8aab556821ca6.jpg'),
(53, 'Adele', 'https://i.pinimg.com/736x/a7/30/7a/a7307aee370b0bf4cd2bd5c04f1cb80e.jpg'),
(54, 'Yo-Yo Ma', 'https://i.pinimg.com/736x/2a/71/bc/2a71bcc83b2d845c614159bd05afa106.jpg'),
(55, 'Tomorrowland Brasil', 'https://i.pinimg.com/736x/a2/42/cc/a242cc8de41a64f3cd01b16221a4268e.jpg'),
(56, 'BTS', 'https://i.pinimg.com/736x/d8/98/cf/d898cf796a89747d79e7e6dfa2794b5e.jpg'),
(57, 'Rolling Stones', 'https://i.pinimg.com/736x/0d/43/bf/0d43bf2fa1a5ef37692d8fb03dc996a5.jpg'),
(58, 'Bad Bunny', 'https://i.pinimg.com/736x/38/0a/f0/380af035098c3fb7b953e1c21256d504.jpg'),
(59, 'Burna Boy', 'https://i.pinimg.com/736x/db/7c/c5/db7cc52a7c232852380c1252f5f4bf67.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cartitems`
--

CREATE TABLE `cartitems` (
  `CartItemID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `TicketTypeID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `LastUpdated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `concertgenres`
--

CREATE TABLE `concertgenres` (
  `ConcertID` int(11) NOT NULL,
  `GenreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `concertgenres`
--

INSERT INTO `concertgenres` (`ConcertID`, `GenreID`) VALUES
(6, 1),
(6, 2),
(7, 1),
(7, 4),
(8, 6),
(9, 1),
(9, 2),
(10, 1),
(11, 7),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(15, 16),
(16, 1),
(17, 8),
(18, 1),
(18, 9),
(19, 1),
(20, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `concerts`
--

CREATE TABLE `concerts` (
  `ConcertID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `ConcertDate` date NOT NULL,
  `ConcertTime` time NOT NULL,
  `Venue` varchar(255) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Address` text DEFAULT NULL,
  `Facilities` text DEFAULT NULL,
  `MapLink` varchar(700) DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `ArtistID` int(11) DEFAULT NULL,
  `Status` enum('upcoming','active','sold_out','past','cancelled') DEFAULT 'upcoming',
  `LongDescription` text DEFAULT NULL,
  `IsSlider` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `concerts`
--

INSERT INTO `concerts` (`ConcertID`, `Title`, `Description`, `ConcertDate`, `ConcertTime`, `Venue`, `City`, `Address`, `Facilities`, `MapLink`, `ImageURL`, `ArtistID`, `Status`, `LongDescription`, `IsSlider`) VALUES
(6, 'Coldplay - Music of the Spheres World Tour', 'Coldplay brings their mesmerizing \'Music of the Spheres\' World Tour to Seoul! Get ready for a night filled with emotional anthems, cosmic visuals, and immersive light shows. From classics like \'Fix You\' and \'Yellow\' to recent hits like \'My Universe,\' this show promises an unforgettable experience. Fans will wear LED wristbands that sync with the music', '2025-06-26', '19:00:00', 'Seoul Olympic Stadium', 'Korea', '25 Olympic-ro, Songpa District, Seoul, Korea Selatan', 'Wheelchair accessible, Food stalls, etc', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3164.664192866968!2d127.0702237!3d37.5158376!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca450879adccd%3A0x7701bd84f28c7f68!2sOlympic%20Stadium!5e0!3m2!1sen!2sid!4v1750183345639!5m2!1sen!2sid', '../assets/image_concert/6851462d25021_Coldplay - Music of the Spheres World Tour.jpg', 36, 'upcoming', 'Coldplay brings their mesmerizing \'Music of the Spheres\' World Tour to Seoul! Get ready for a night filled with emotional anthems, cosmic visuals, and immersive light shows. From classics like \'Fix You\' and \'Yellow\' to recent hits like \'My Universe,\' this show promises an unforgettable experience. Fans will wear LED wristbands that sync with the music, turning the stadium into a sea of colors. Chris Martin and the band are set to deliver a heartfelt performance that celebrates unity, love, and the power of music. A once-in-a-lifetime concert you won’t want to miss', 1),
(7, 'LE SSERAFIM - 1st Tour \'Flame Rises\'', 'Join LE SSERAFIM as they embark on their powerful first world tour, \'Flame Rises\'! With bold choreography, stunning visuals, and high-energy performances, this K-Pop girl group is ready to set the stage on fire. Fans can expect to see dynamic hits like \'Antifragile\' and \'Fearless\' live for the first time', '2025-06-13', '14:13:00', 'KSPO Dome', 'Korea', '424 Olympic-ro, Songpa District, Seoul, Korea Selatan', 'Wheelchair accessible, Food stalls, etc', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.523707050855!2d127.12736439999998!3d37.5191503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357caf8af3895a03%3A0x3b6ac5d5d4ff9a9a!2sKSPO%20DOME%20(Olympic%20Gymnastics%20Arena)!5e0!3m2!1sen!2sid!4v1750183603674!5m2!1sen!2sid', '../assets/image_concert/6851df0159837_685147977d29a_Taylor Swift - The Eras Tour.jpg', 37, 'upcoming', 'Join LE SSERAFIM as they embark on their powerful first world tour, \'Flame Rises\'! With bold choreography, stunning visuals, and high-energy performances, this K-Pop girl group is ready to set the stage on fire. Fans can expect to see dynamic hits like \'Antifragile\' and \'Fearless\' live for the first time. Taking place at the iconic KSPO Dome, the concert promises an unforgettable night of music, emotion, and connection. Be part of LE SSERAFIM’s global journey and feel the flames of their rising fame!', 1),
(8, 'The 1975 - At Their Very Best Tour', 'British band The 1975 returns to the stage with their electrifying \'At Their Very Best\' tour. Known for their eclectic sound and visually stunning performances, they\'re set to light up the O2 Arena with fan favorites.', '2025-07-07', '20:00:00', 'O2 Arena London', 'London', 'Peninsula Square, London SE10 0DX, United Kingdom', 'Wheelchair accessible, Food stalls, Merchandise stands, Free WiFi', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4967.109495136737!2d-0.0036312991709692155!3d51.50303778220669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a81c5507b387%3A0x981ded0cf3b9dadf!2sThe%20O2!5e0!3m2!1sen!2sid!4v1750183689546!5m2!1sen!2sid', '../assets/image_concert/concert8.jpg', 38, 'upcoming', 'British band The 1975 returns to the stage with their electrifying \'At Their Very Best\' tour. Known for their eclectic sound and visually stunning performances, they\'re set to light up the O2 Arena with fan favorites like \'Somebody Else\' and \'Love It If We Made It\'. Expect a mix of emotion, energy, and unforgettable indie rock anthems. With Matty Healy\'s charismatic stage presence and genre-blending music, this concert is a must-see for fans new and old. Don\'t miss this vibrant night in London!', 0),
(9, 'NOAH - The Final Chapter', 'NOAH, one of Indonesia\'s most legendary bands, presents their final chapter in an emotional farewell concert. Held at the grand Stadion GBK Jakarta.', '2025-08-06', '20:00:00', 'Stadion GBK, Jakarta', 'Jakarta', 'Jl. Pintu Satu Senayan, Gelora, Tanah Abang, Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270, Indonesia', 'Wheelchair accessible, Food courts, ATMs, First aid stations', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.34640776403!2d106.79890997499035!3d-6.217967543770008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e74f2341fff266d!2sGelora%20Bung%20Karno%20Main%20Stadium!5e0!3m2!1sen!2sid!4v1750183765594!5m2!1sen!2sid', '../assets/image_concert/concert9.jpg', 39, 'upcoming', 'NOAH, one of Indonesia\'s most legendary bands, presents their final chapter in an emotional farewell concert. Held at the grand Stadion GBK Jakarta, the event will feature decades of hits including \'Separuh Aku\' and \'Bintang di Surga\'. This is more than just a performance—it\'s a tribute to their musical journey and devoted fans. Don\'t miss this historic moment as NOAH takes the stage one last time to celebrate their legacy and bid a heartfelt goodbye to the Indonesian music scene.', 0),
(10, 'IVE - The 1st World Tour \'Show What I Have\'', 'K-Pop sensation IVE kicks off their very first world tour, \'Show What I Have\', live at Tokyo Dome! With dazzling performances, catchy hits.', '2025-08-21', '18:00:00', 'Tokyo Dome', 'Tokyo', '1-3-61 Koraku, Bunkyo City, Tokyo 112-0004, Japan', 'Wheelchair accessible, Merchandise booths, Food vendors', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.836552588336!2d139.7493163757888!3d35.705639572579315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c4782eed4f3%3A0x5058b288249e640e!2sTokyo%20Dome!5e0!3m2!1sen!2sid!4v1750183905915!5m2!1sen!2sid', '../assets/image_concert/concert10.jpg', 40, 'upcoming', 'K-Pop sensation IVE kicks off their very first world tour, \'Show What I Have\', live at Tokyo Dome! With dazzling performances, catchy hits like \'Love Dive\' and \'After Like\', and jaw-dropping visuals, this concert is set to wow audiences. Known for their charisma and fresh style, IVE invites fans into their musical universe for a night of celebration and connection. Join the wave and witness one of K-Pop\'s brightest rising stars take the global stage by storm!', 0),
(11, 'Tame Impala - Live Experience', 'Immerse yourself in a surreal world of sound and visuals with Tame Impala\'s Live Experience at the iconic Sydney Opera House.', '2025-09-05', '21:00:00', 'Sydney Opera House', 'Sydney', 'Bennelong Point, Sydney NSW 2000, Australia', 'Wheelchair accessible, Bars, Coat check', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.2757238835025!2d151.21272177570816!3d-33.85678437323111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae665e892fdd%3A0x3133f8d75a1ac251!2sSydney%20Opera%20House!5e0!3m2!1sen!2sid!4v1750183961547!5m2!1sen!2sid', '../assets/image_concert/concert11.jpg', 41, 'upcoming', 'Immerse yourself in a surreal world of sound and visuals with Tame Impala\'s Live Experience at the iconic Sydney Opera House. Led by Kevin Parker, the band will deliver mesmerizing performances of hits like \'The Less I Know the Better\' and \'Let It Happen\'. Expect a blend of dreamy lights, trippy visuals, and hypnotic grooves in a concert that feels otherworldly. Perfect for longtime fans and newcomers alike, this show is more than music—it\'s an experience for the senses.', 0),
(12, 'BLACKPINK WORLD TOUR [BORN PINK]', 'BLACKPINK brings their powerful \'BORN PINK\' world tour to Singapore! Expect a spectacular night full of hit songs, fierce choreography.', '2025-09-20', '20:00:00', 'National Stadium Singapore', 'Singapore', '1 Stadium Drive, Singapore 397629', 'Wheelchair accessible, Food courts, Merchandise stands, ATMs', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7850286115636!2d103.8722676749657!3d1.304012998683617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da184966f67bcd%3A0x2d296d925d398f55!2sNational%20Stadium!5e0!3m2!1sen!2sid!4v1750184028913!5m2!1sen!2sid', '../assets/image_concert/concert12.jpg', 42, 'upcoming', 'BLACKPINK brings their powerful \'BORN PINK\' world tour to Singapore! Expect a spectacular night full of hit songs, fierce choreography, and jaw-dropping visuals. Jisoo, Jennie, Rosé, and Lisa will dazzle the stage with global chart-toppers like \'Pink Venom\', \'Shut Down\', and \'How You Like That\'. The National Stadium will be filled with Blinks from across Asia, united by the music and passion of K-Pop\'s global queens. Be there to witness history in the making.', 0),
(13, 'Red Velvet - R to V Tour', 'Red Velvet brings their enchanting \'R to V\' world tour to Bangkok! Known for their dual concept of sweet and edgy.', '2025-10-05', '19:00:00', 'Impact Arena, Bangkok', 'Bangkok', '99 Popular Rd, Ban Mai, Pak Kret District, Nonthaburi 11120, Thailand', 'Wheelchair accessible, Food stalls, Merchandise booths', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3872.7897200784514!2d100.54580507509313!3d13.911513586497211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e28374759ade4b%3A0x98e04841a8c7a8b0!2sIMPACT%20Arena!5e0!3m2!1sen!2sid!4v1750184073837!5m2!1sen!2sid', '../assets/image_concert/concert13.jpg', 43, 'upcoming', 'Red Velvet brings their enchanting \'R to V\' world tour to Bangkok! Known for their dual concept of sweet and edgy, this K-Pop group will deliver a night full of fan-favorite hits like \'Psycho\', \'Feel My Rhythm\', and \'Red Flavor\'. With stunning visuals, captivating vocals, and synchronized choreography, Irene, Seulgi, Wendy, Joy, and Yeri promise an unforgettable experience for ReVeluvs. The Impact Arena will come alive with energy, colors, and love for Red Velvet\'s unique charm. Be there for an electrifying night that celebrates music and joy.', 0),
(14, 'Taylor Swift - The Eras Tour', 'Taylor Swift\'s record-breaking \'The Eras Tour\' arrives in Los Angeles for a dazzling showcase of her entire musical journey.', '2025-10-20', '18:00:00', 'Sofi Stadium, Los Angeles', 'Los Angeles', '1001 Stadium Drive, Inglewood, CA 90301, USA', 'Wheelchair accessible, Food courts, Merchandise stands, ATMs', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3309.519814853639!2d-118.3415984242877!3d33.953476473194236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2b786cbfb8f4f%3A0x5fb99cb7249e4170!2sSoFi%20Stadium!5e0!3m2!1sen!2sid!4v1750184125664!5m2!1sen!2sid', '../assets/image_concert/concert14.jpg', 44, 'upcoming', 'Taylor Swift\'s record-breaking \'The Eras Tour\' arrives in Los Angeles for a dazzling showcase of her entire musical journey. From the country roots of \'Fearless\' to the synth-pop of \'1989\' and the indie vibes of \'Folklore\', fans will experience every era live on stage. With costume changes, stunning visuals, and powerful storytelling, Taylor connects with her audience like no one else. Sofi Stadium transforms into a Swiftie wonderland in a show that spans 3+ hours of pure emotion and excitement. This concert is a love letter to every chapter of her career.', 0),
(15, 'IU - H.E.R World Tour', 'Korean soloist IU brings her heartfelt \'H.E.R\' world tour to the Taipei Arena. Known for her angelic voice and emotional ballads.', '2025-11-04', '19:30:00', 'Taipei Arena', 'Taipei', 'No. 2, Section 4, Nanjing East Road, Songshan District, Taipei City, Taiwan 105', 'Wheelchair accessible, Food vendors, Merchandise stands', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.5103815287493!2d121.54754497537702!3d25.050684877805594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442abe81eb85771%3A0x682251d5c6f37a58!2sTaipei%20Arena!5e0!3m2!1sen!2sid!4v1750184172772!5m2!1sen!2sid', '../assets/image_concert/concert15.jpg', 45, 'upcoming', 'Korean soloist IU brings her heartfelt \'H.E.R\' world tour to the Taipei Arena. Known for her angelic voice and emotional ballads like \'Love Poem\' and \'Through the Night\', IU delivers an intimate concert filled with storytelling and warmth. Fans can expect stunning live vocals, gentle stage production, and a personal connection that makes her concerts so special. With a mix of pop, R&B, and acoustic sounds, this is a must-see show for anyone who loves music with soul. A night of emotions, memories, and pure artistry awaits.', 0),
(16, 'New Jeans - 2024 World Tour', 'The fresh faces of K-Pop, New Jeans, take their first-ever world tour to Seoul! Performing live at the Jamsil Indoor Stadium.', '2025-11-19', '18:30:00', 'Jamsil Indoor Stadium', 'Seoul', '25 Olympic-ro, Songpa-gu, Seoul, South Korea', 'Wheelchair accessible, Food courts, Merchandise stands', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.648757965817!2d127.0733498758714!3d37.516201572051685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca451397f664d%3A0x82edb56cd4a74e2d!2sJamsil%20Arena!5e0!3m2!1sen!2sid!4v1750184270763!5m2!1sen!2sid', '../assets/image_concert/concert16.jpg', 46, 'upcoming', 'The fresh faces of K-Pop, New Jeans, take their first-ever world tour to Seoul! Performing live at the Jamsil Indoor Stadium, the girls will bring vibrant energy, Y2K fashion, and chart-topping tracks like \'Hype Boy\' and \'Super Shy\'. Known for their youthful charm and fun choreography, New Jeans creates a concert full of interaction, positivity, and high vibes. Fans will be treated to catchy tunes and adorable stage presence from start to finish. Join the movement and dance the night away with New Jeans!', 0),
(17, 'Metallica - M72 World Tour', 'Metallica\'s explosive two-night concert experience', '2025-12-04', '19:30:00', 'Foro Sol, Mexico City', 'Mexico City', 'Av. Viaducto Rio de la Piedad S/N, Granjas México, Iztacalco, 08400 Ciudad de México, CDMX, Mexico', 'Wheelchair accessible, Food vendors, Merchandise stands, ATMs', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.1690114580374!2d-99.09819602478635!3d19.405102181868408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fc241cd2cc61%3A0xd994597d3d690170!2sGNP%20Seguros%20Stadium!5e0!3m2!1sen!2sid!4v1750184319848!5m2!1sen!2sid', '../assets/image_concert/concert17.jpg', 47, 'upcoming', 'Metallica\'s explosive two-night concert experience at Foro Sol in Mexico City. The legendary heavy metal band will perform their greatest hits spanning their entire career, from \'Enter Sandman\' to their latest releases. Known for their high-energy performances and pyrotechnic displays, Metallica promises an unforgettable night of headbanging and metal anthems. This is a must-see event for any metal fan, with the band\'s signature sound and showmanship on full display.', 0),
(18, 'Doja Cat - The Scarlet Tour', 'Doja Cat\'s dark and daring new tour', '2025-12-19', '20:30:00', 'Madison Square Garden, NYC', 'New York', '4 Pennsylvania Plaza, New York, NY 10001, USA', 'Wheelchair accessible, Food courts, Merchandise stands, ATMs', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.523722565976!2d-73.99601362397233!3d40.7505044713879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a21fb011c85%3A0x33df10e49762f8e4!2sMadison%20Square%20Garden!5e0!3m2!1sen!2sid!4v1750184370505!5m2!1sen!2sid', '../assets/image_concert/concert18.jpg', 48, 'upcoming', 'Doja Cat\'s dark and daring new tour comes to Madison Square Garden. Following the release of her latest album, this show promises to be a visual and musical spectacle, featuring her signature blend of pop, rap, and R&B. Known for her charismatic stage presence and bold performances, Doja Cat will perform hits like \'Say So\', \'Kiss Me More\', and tracks from her newest work. Expect stunning choreography, elaborate costumes, and a night of non-stop entertainment from one of music\'s most dynamic performers.', 0),
(19, 'Stray Kids - 5-STAR Dome Tour', 'Stray Kids\' biggest Japanese dome tour yet', '2026-01-03', '19:00:00', 'Kyocera Dome Osaka', 'Osaka', '3-1 Senri Banpaku Koen, Suita, Osaka 565-0826, Japan', 'Wheelchair accessible, Food vendors, Merchandise stands', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.422674173!2d135.4735677757431!3d34.6692803729309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e7b24b87684b%3A0x535f75f9161484f1!2sKyocera%20Dome%20%C5%8Csaka!5e0!3m2!1sen!2sid!4v1750184466109!5m2!1sen!2sid', '../assets/image_concert/concert19.jpg', 49, 'upcoming', 'Stray Kids\' biggest Japanese dome tour yet comes to Kyocera Dome Osaka. The 8-member K-Pop group known for their powerful performances and self-produced music will showcase their latest hits and fan favorites. With their high-energy choreography, impressive rap lines, and captivating stage presence, Stray Kids promise an unforgettable night for their Japanese STAY fans. This dome tour marks their growing global popularity and showcases why they\'re one of the most exciting acts in K-Pop today.', 0),
(20, 'Hans Zimmer Live', 'Legendary film composer performs live with orchestra', '2026-01-18', '19:45:00', 'Royal Albert Hall, London', 'London', 'Kensington Gore, South Kensington, London SW7 2AP, UK', 'Wheelchair accessible, Bars, Coat check', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.6707760306886!2d-0.17994092338029846!3d51.50090877181195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876055b21867ad1%3A0x5efe9cee35da2fd9!2sRoyal%20Albert%20Hall!5e0!3m2!1sen!2sid!4v1750184515635!5m2!1sen!2sid', '../assets/image_concert/concert20.jpg', 50, 'upcoming', 'Legendary film composer Hans Zimmer performs live with orchestra at the iconic Royal Albert Hall. Experience the magic of cinema as Zimmer and his ensemble bring to life his most famous scores from films like \'The Lion King\', \'Inception\', \'Gladiator\', \'Pirates of the Caribbean\', and many more. This spectacular show combines stunning visuals with powerful live music, offering fans a unique opportunity to hear these iconic compositions performed by the composer himself. A must-see event for film and music lovers alike.', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `genres`
--

CREATE TABLE `genres` (
  `GenreID` int(11) NOT NULL,
  `genre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `genres`
--

INSERT INTO `genres` (`GenreID`, `genre`) VALUES
(11, 'Afrobeats'),
(16, 'Ballad'),
(4, 'Classical'),
(14, 'EDM'),
(10, 'Film Scores'),
(8, 'Heavy Metal'),
(5, 'Hip-Hop'),
(6, 'Indie Rock'),
(3, 'Jazz'),
(1, 'Pop'),
(9, 'Pop/Rap'),
(13, 'Pop/Soul'),
(7, 'Psychedelic Rock'),
(15, 'Reggaeton'),
(2, 'Rock'),
(12, 'Synthpop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `TicketTypeID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderDate` datetime DEFAULT current_timestamp(),
  `TotalAmount` decimal(10,2) NOT NULL,
  `PaymentStatus` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `PaymentMethodID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `PaymentMethodID` int(11) NOT NULL,
  `MethodName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `TicketID` int(11) NOT NULL,
  `OrderItemID` int(11) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `Status` enum('valid','used','cancelled') DEFAULT 'valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickettypes`
--

CREATE TABLE `tickettypes` (
  `TicketTypeID` int(11) NOT NULL,
  `ConcertID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `QuantityAvailable` int(11) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tickettypes`
--

INSERT INTO `tickettypes` (`TicketTypeID`, `ConcertID`, `TypeName`, `Price`, `QuantityAvailable`, `Description`) VALUES
(109, 20, 'Regular', 2500000.00, 34, 'Standard admission ticket'),
(110, 20, 'Vip', 3500000.00, 534, 'VIP access with premium viewing area'),
(111, 20, 'Platinum', 4500000.00, 3043, 'Platinum experience with backstage access'),
(118, 19, 'Regular', 32424.00, 234234, 'Standard admission ticket'),
(119, 19, 'Vip', 2200000.00, 2000, 'VIP access with premium viewing area'),
(120, 19, 'Platinum', 3000000.00, 1000, 'Platinum experience with backstage access'),
(121, 18, 'Regular', 23432.00, 324, 'Standard admission ticket'),
(122, 18, 'Vip', 3000000.00, 1000, 'VIP access with premium viewing area'),
(123, 18, 'Platinum', 4000000.00, 500, 'Platinum experience with backstage access'),
(124, 17, 'Regular', 32423.00, 432, 'Standard admission ticket'),
(125, 17, 'Vip', 234.00, 42, 'VIP access with premium viewing area'),
(126, 17, 'Platinum', 3500000.00, 50, 'Platinum experience with backstage access'),
(127, 16, 'Regular', 324234.00, 234, 'Standard admission ticket'),
(128, 16, 'Vip', 1300000.00, 1500, 'VIP access with premium viewing area'),
(129, 16, 'Platinum', 2432.00, 4324, 'Platinum experience with backstage access'),
(130, 15, 'Regular', 3242.00, 2342, 'Standard admission ticket'),
(131, 15, 'Vip', 1800000.00, 1000, 'VIP access with premium viewing area'),
(132, 15, 'Platinum', 2500000.00, 500, 'Platinum experience with backstage access'),
(133, 14, 'Regular', 234.00, 243, 'Standard admission ticket'),
(134, 14, 'Vip', 3500000.00, 1000, 'VIP access with premium viewing area'),
(135, 14, 'Platinum', 5000000.00, 200, 'Platinum experience with backstage access'),
(136, 13, 'Regular', 324.00, 234, 'Standard admission ticket'),
(137, 13, 'Vip', 1500000.00, 1000, 'VIP access with premium viewing area'),
(138, 13, 'Platinum', 2500000.00, 80, 'Platinum experience with backstage access'),
(139, 12, 'Regular', 234.00, 234, 'Standard admission ticket'),
(140, 12, 'Vip', 2500000.00, 500, 'VIP access with premium viewing area'),
(141, 12, 'Platinum', 3000000.00, 300, 'Platinum experience with backstage access'),
(142, 11, 'Regular', 234.00, 24, 'Standard admission ticket'),
(143, 11, 'Vip', 2500000.00, 100, 'VIP access with premium viewing area'),
(144, 11, 'Platinum', 3200000.00, 30, 'Platinum experience with backstage access'),
(145, 10, 'Regular', 234.00, 234, 'Standard admission ticket'),
(146, 10, 'Vip', 1500000.00, 1000, 'VIP access with premium viewing area'),
(147, 10, 'Platinum', 2000000.00, 500, 'Platinum experience with backstage access'),
(148, 9, 'Regular', 324.00, 234, 'Standard admission ticket'),
(149, 9, 'Vip', 1200000.00, 1000, 'VIP access with premium viewing area'),
(150, 9, 'Platinum', 1800000.00, 50, 'Platinum experience with backstage access'),
(151, 8, 'Regular', 324.00, 234, 'Standard admission ticket'),
(152, 8, 'Vip', 2500000.00, 200, 'VIP access with premium viewing area'),
(153, 8, 'Platinum', 3500000.00, 100, 'Platinum experience with backstage access'),
(154, 6, 'Regular', 234.00, 423, 'Standard admission ticket'),
(155, 6, 'Vip', 2750000.00, 800, 'VIP access with premium viewing area'),
(156, 6, 'Platinum', 3750000.00, 1000, 'Platinum experience with backstage access'),
(157, 7, 'Regular', 32424.00, 234234, 'Standard admission ticket'),
(158, 7, 'Vip', 1000000.00, 3424, 'VIP access with premium viewing area'),
(159, 7, 'Platinum', 1500000.00, 5435, 'Platinum experience with backstage access');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usergenres`
--

CREATE TABLE `usergenres` (
  `UserID` int(11) NOT NULL,
  `GenreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `usergenres`
--

INSERT INTO `usergenres` (`UserID`, `GenreID`) VALUES
(1, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ProfilePictureURL` varchar(255) DEFAULT NULL,
  `Role` enum('user','admin') NOT NULL DEFAULT 'user',
  `RegistrationDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `PasswordHash`, `Email`, `ProfilePictureURL`, `Role`, `RegistrationDate`) VALUES
(1, 'weiwei', '$2y$10$fGw52E/3p1TV/wG.925FpuyCcxZgWwtR4IhAayP0ka20vRSJrWHm.', 'wei@gmail.com', NULL, 'user', '2025-06-18 03:22:07'),
(2, 'asdas', '$2y$10$K0ud1g1JseuyZkhJ01WMFuM7w4TSz.fpsTB1jPcA8tnX85ivQ.Dui', 'asdasd@gmail.com', NULL, 'user', '2025-06-18 03:24:59'),
(3, 'hakim', '$2y$10$etv//MvMQiYyAimxN6Whr.sHxYT0ZZkFw6Uorf2GoH3WnASmVwHMa', 'hakim@gmail.com', NULL, 'user', '2025-06-18 03:29:25'),
(4, 'hakimweve', '$2y$10$1dSKdBuPhCQFMzJv1BHrO.1cpIlVEkdslRgJ21Cc6MuSNsxWHqt0K', 'hakimweve@gmail.com', NULL, 'user', '2025-06-18 04:05:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`ArtistID`);

--
-- Indeks untuk tabel `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`CartItemID`),
  ADD KEY `CartID` (`CartID`),
  ADD KEY `TicketTypeID` (`TicketTypeID`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`CartID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indeks untuk tabel `concertgenres`
--
ALTER TABLE `concertgenres`
  ADD PRIMARY KEY (`ConcertID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indeks untuk tabel `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`ConcertID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indeks untuk tabel `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GenreID`),
  ADD UNIQUE KEY `Name` (`genre`);

--
-- Indeks untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `TicketTypeID` (`TicketTypeID`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PaymentMethodID` (`PaymentMethodID`);

--
-- Indeks untuk tabel `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`PaymentMethodID`),
  ADD UNIQUE KEY `MethodName` (`MethodName`);

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`TicketID`),
  ADD UNIQUE KEY `UniqueCode` (`UniqueCode`),
  ADD KEY `OrderItemID` (`OrderItemID`);

--
-- Indeks untuk tabel `tickettypes`
--
ALTER TABLE `tickettypes`
  ADD PRIMARY KEY (`TicketTypeID`),
  ADD KEY `ConcertID` (`ConcertID`);

--
-- Indeks untuk tabel `usergenres`
--
ALTER TABLE `usergenres`
  ADD PRIMARY KEY (`UserID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artists`
--
ALTER TABLE `artists`
  MODIFY `ArtistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `concerts`
--
ALTER TABLE `concerts`
  MODIFY `ConcertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `genres`
--
ALTER TABLE `genres`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `PaymentMethodID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tickettypes`
--
ALTER TABLE `tickettypes`
  MODIFY `TicketTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `carts` (`CartID`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`TicketTypeID`) REFERENCES `tickettypes` (`TicketTypeID`);

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Ketidakleluasaan untuk tabel `concertgenres`
--
ALTER TABLE `concertgenres`
  ADD CONSTRAINT `concertgenres_ibfk_1` FOREIGN KEY (`ConcertID`) REFERENCES `concerts` (`ConcertID`) ON DELETE CASCADE,
  ADD CONSTRAINT `concertgenres_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`);

--
-- Ketidakleluasaan untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`TicketTypeID`) REFERENCES `tickettypes` (`TicketTypeID`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`PaymentMethodID`) REFERENCES `paymentmethods` (`PaymentMethodID`);

--
-- Ketidakleluasaan untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`OrderItemID`) REFERENCES `orderitems` (`OrderItemID`);

--
-- Ketidakleluasaan untuk tabel `tickettypes`
--
ALTER TABLE `tickettypes`
  ADD CONSTRAINT `tickettypes_ibfk_1` FOREIGN KEY (`ConcertID`) REFERENCES `concerts` (`ConcertID`);

--
-- Ketidakleluasaan untuk tabel `usergenres`
--
ALTER TABLE `usergenres`
  ADD CONSTRAINT `usergenres_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `usergenres_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
