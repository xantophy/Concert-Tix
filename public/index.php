<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ConcertTix Landing</title>

    <!-- Bootstrap CSS & Icons -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /></noscript>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>

    <style>
      /* VARIABLES */
      :root {
        --primary-purple: #8a4fff;
        --primary-orange: #ff6600;
        --gradient-purple: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
      }

      /* BASE STYLES */
      body {
        background: linear-gradient(to bottom, #f5f0ff 0%, #ffffff 100%);
        overflow-x: hidden;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      /* Wider container */
      .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
      }

      /* Style untuk menu */
      .offcanvas-start {
        width: 250px;
        background: linear-gradient(to bottom, #f5f0ff 0%, #ffffff 100%);
      }

      .nav-link {
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease;
      }

      .nav-link:hover {
        background-color: rgba(138, 79, 255, 0.1);
        color: var(--primary-purple);
      }

      .offcanvas-body .nav-link {
        position: relative;
        overflow: hidden;
      }

      .offcanvas-body .nav-link::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background: var(--primary-purple);
        transition: width 0.3s ease;
      }

      .offcanvas-body .nav-link:hover::before {
        width: 100%;
      }

      /* Navbar Styles */
      .navbar {
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 15px rgba(138, 79, 255, 0.1);
        padding: 0.5rem 0;
      }
      .navbar .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
      }
      .navbar-brand {
        font-size: 1.6rem;
        font-weight: 700;
        transition: all 0.3s ease;
        margin-right: 1rem;
      }
      .navbar-brand:hover {
        transform: scale(1.03);
      }
      /* Style for scrolled navbar */
      .navbar.scrolled {
        padding: 0.5rem 0 !important;
        background: rgba(138, 79, 255, 0.98) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25) !important;
        backdrop-filter: blur(10px);
      }
      .navbar.scrolled .navbar-brand span:first-child {
        color: white !important;
      }
      .navbar.scrolled .navbar-brand span:last-child {
        color: var(--primary-orange) !important;
      }
      /* Search input styles */
      .navbar:not(.scrolled) .input-group {
        border: 2px solid var(--primary-purple);
        border-radius: 1.5rem;
        overflow: hidden;
      }

      .navbar:not(.scrolled) .form-control {
        border-left: none;
        border-color: var(--primary-purple);
        background-color: white;
      }
      /* Style for non-scrolled navbar buttons */
      .navbar:not(.scrolled) .btn-outline-secondary,
      .navbar:not(.scrolled) .btn-outline-purple {
        border-color: var(--primary-purple);
        color: var(--primary-purple);
      }
      .navbar:not(.scrolled) .btn-outline-secondary:hover,
      .navbar:not(.scrolled) .btn-outline-purple:hover {
        background: var(--primary-purple);
        color: white;
      }
      .navbar:not(.scrolled) .btn-purple-gradient {
        background: var(--gradient-purple);
        color: white;
      }
      .navbar:not(.scrolled) .btn-purple-gradient:hover {
        background: linear-gradient(135deg, #7a3fef 0%, #4e1dd0 100%);
        color: white;
      }
      /* Login Button */
      .navbar .btn-outline-purple {
        border-color: rgba(255, 255, 255, 0.5);
        color: rgba(255, 255, 255, 0.8);
        background: transparent;
      }

      .navbar .btn-outline-purple:hover {
        border-color: white;
        background: var(--primary-purple);
        color: white;
        box-shadow: 0 4px 10px rgba(138, 79, 255, 0.3);
      }
      /* Sign Up Button */
      .navbar .btn-purple-gradient {
        background: white;
        color: var(--primary-purple);
        border: none;
        box-shadow: 0 4px 15px rgba(138, 79, 255, 0.3);
        transition: all 0.3s ease;
      }
      /* Search input focus effect */
      .navbar .form-control:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 0.2rem rgba(138, 79, 255, 0.1);
      }
      .navbar .btn-purple-gradient:hover {
        background: white;
        color: var(--primary-purple);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(138, 79, 255, 0.4);
      }
      /* Style for scrolled navbar buttons */
      .navbar.scrolled .btn-outline-secondary,
      .navbar.scrolled .btn-outline-purple {
        border-color: rgba(255, 255, 255, 0.5);
        color: rgba(255, 255, 255, 0.8);
      }
      .navbar.scrolled .btn-outline-secondary:hover,
      .navbar.scrolled .btn-outline-purple:hover {
        border-color: var(--primary-orange);
        background: var(--primary-orange);
        color: white;
      }
      /* Ikon search di navbar */
      .navbar:not(.scrolled) .input-group-text {
        background-color: white;
        color: var(--primary-purple);
        border-right: none;
        border-color: var(--primary-purple);
      }
      .navbar.scrolled .input-group-text {
        color: rgb(228, 221, 221) !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
      }
      /* Placeholder text */
      .navbar:not(.scrolled) .form-control::placeholder {
        color: #6c757d;
      }
      .navbar.scrolled .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8) !important;
      }
      .navbar.scrolled .form-control {
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
      }
      .navbar.scrolled .input-group:hover .input-group-text {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: white !important;
      }
      /* Hover state untuk search di navbar putih */
      .navbar:not(.scrolled) .input-group:hover .input-group-text {
        background-color: var(--primary-purple);
        color: white;
      }

      .navbar:not(.scrolled) .input-group:hover .form-control {
        border-color: var(--primary-purple);
        color: #333;
      }

      .navbar:not(.scrolled) .form-control {
        border-color: var(--primary-purple);
        color: #333;
      }
      .navbar.scrolled .btn-purple-gradient {
        background: var(--primary-orange);
        color: white;
      }

      .navbar.scrolled .btn-purple-gradient:hover {
        background: #ff5500;
        color: white;
        box-shadow: 0 4px 15px rgba(255, 102, 0, 0.3);
      }
      /* Original Search Bar */
      .navbar-search .input-group {
        border-radius: 0.5rem;
      }
      .navbar-search .form-control {
        border-left: none;
      }
      /* Original Button Styles */

      .navbar-search .input-group-text {
        background: white;
        border-right: none;
        color: #6c757d;
      }
      .navbar .btn,
      .navbar .input-group-text,
      .navbar .form-control {
        transition: all 0.3s ease;
      }
      .navbar .form-control::placeholder {
        transition: all 0.3s ease;
      }
      /* Navbar Button Styles */
      .navbar .btn {
        transition: all 0.3s ease;
        border-radius: 50px;
        font-weight: 500;
        padding: 0.375rem 0.75rem;
      }
      .navbar-toggler {
        border: none;
        padding: 0.5rem;
        font-size: 1.25rem;
        display: block !important;
      }
      .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
      }
      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(138, 79, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }
      /* Warna saat navbar scrolled */
      .navbar.scrolled .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }
      .btn-primary {
        border-radius: 0.5rem;
        padding: 0.375rem 0.75rem;
      }
      .btn-purple-gradient {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }
      .btn-purple-gradient:hover {
        background: linear-gradient(135deg, #7a3fef 0%, #4e1dd0 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(138, 79, 255, 0.3);
      }
      .btn-purple-gradient::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.473), transparent);
        transition: 0.5s;
      }
      .btn-purple-gradient:hover::before {
        left: 100%;
      }
      /* Style untuk tombol detail */
      .btn-detail {
        background-color: white;
        color: var(--primary-purple);
        border: 1px solid rgba(138, 79, 255, 0.3);
      }
      .btn-detail:hover {
        background-color: rgba(138, 79, 255, 0.05);
        border-color: rgba(138, 79, 255, 0.5);
      }
      .btn-outline-purple {
        border-color: var(--primary-purple);
        color: var(--primary-purple);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
      }
      .btn-outline-purple:hover {
        background: var(--primary-purple);
        color: white;
      }
      .btn-buy {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;
        box-shadow: 0 2px 5px rgba(138, 79, 255, 0.3);
      }
      .btn-buy:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(138, 79, 255, 0.4);
      }
      /* Style untuk tombol beli */
      .btn-buy-now {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;
        border: none;
        padding: 6px 20px;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .btn-buy-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(138, 79, 255, 0.4);
      }
      /* Enhanced Load More Button */
      .btn-load-more {
        background: white;
        color: #8a4fff;
        border: 2px solid #8a4fff;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.4s ease;
        box-shadow: 0 4px 15px rgba(138, 79, 255, 0.1);
        padding: 12px 30px;
        position: relative;
        overflow: hidden;
      }
      .btn-load-more .btn-hover-effect {
        background: linear-gradient(135deg, rgba(138, 79, 255, 0.1) 0%, rgba(255, 102, 0, 0.1) 100%);
        transform: translateY(100%);
        transition: transform 0.4s ease;
        z-index: 0;
      }
      .btn-load-more:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(138, 79, 255, 0.2);
        color: #8a4fff;
      }
      .btn-load-more:hover .btn-hover-effect {
        transform: translateY(0);
      }
      /* App Download Buttons */
      .app-download-btn {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        height: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }
      .btn-app-store {
        background: #000000;
        border-radius: 12px;
      }
      .btn-google-play {
        background: #000000;
        border-radius: 12px;
      }
      .app-download-btn:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 8px 25px rgba(138, 79, 255, 0.3);
      }
      /* Apply animations for button */
      .menu-item-float {
        animation: floatLink 4s infinite ease-in-out;
      }
      .subtle-shake {
        animation: subtleShake 5s infinite ease-in-out;
      }
      .pulse-animation {
        animation: pulse 2s infinite ease-in-out;
      }
      .float-animation {
        animation: float 3s infinite ease-in-out;
      }
      .social-float {
        animation: float 4s infinite ease-in-out;
      }
      /* Delay animations for staggered effect */
      .menu-item-float:nth-child(1) {
        animation-delay: 0.1s;
      }
      .menu-item-float:nth-child(2) {
        animation-delay: 0.2s;
      }
      .menu-item-float:nth-child(3) {
        animation-delay: 0.3s;
      }
      .menu-item-float:nth-child(4) {
        animation-delay: 0.4s;
      }

      .social-float:nth-child(1) {
        animation-delay: 0.1s;
      }
      .social-float:nth-child(2) {
        animation-delay: 0.2s;
      }
      .social-float:nth-child(3) {
        animation-delay: 0.3s;
      }
      .social-float:nth-child(4) {
        animation-delay: 0.4s;
      }
      /* Enhanced Concert Cards */
      .concert-card {
        width: 224px;
        height: 360px;
        margin-right: 20px;
        scroll-snap-align: start;
        flex: 0 0 auto;
        perspective: 1000px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateY(20px) rotateY(10deg);
        transform: translateZ(0);

        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);

        position: relative;
        background: white;
        z-index: 1;

        will-change: transform, opacity, filter;
        backface-visibility: hidden;
      }
      .concert-card.animated {
        opacity: 1;
        transform: translateY(0) rotateY(0);
      }
      .concert-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(138, 79, 255, 0.1) 0%, rgba(255, 102, 0, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
      }
      .concert-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 15px 30px rgba(138, 79, 255, 0.2);
      }
      .concert-card:hover::before {
        opacity: 1;
      }
      .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
      }
      .concert-card:hover .card-inner {
        transform: rotateY(180deg);
      }
      .card-front,
      .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
      }
      .card-back {
        transform: rotateY(180deg);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .card-back-content {
        padding: 1rem;
        text-align: center;
        width: 100%;
      }
      .card-back-content h5 {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        color: #333;
      }
      .card-img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        transition: transform 0.5s ease;
      }
      .concert-card:hover .card-img {
        transform: scale(1.1);
      }
      .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 230px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
      }
      /* Hentikan animasi saat hover dan tampilkan tooltip */
      .concert-card:hover .marquee-text {
        animation-play-state: paused;
        position: relative;
      }
      .concert-card:hover .marquee-text::after {
        content: attr(data-genre);
        position: absolute;
        left: 0;
        top: 100%;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: normal;
        width: max-content;
        max-width: 200px;
        z-index: 10;
      }
      .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        width: 100%;
      }
      .marquee-text {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 15s linear infinite;
        white-space: nowrap;
      }
      .card-date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px;
        border-radius: 8px;
        text-align: center;
        width: 50px;
        z-index: 2;
      }
      .card-date-badge .day {
        font-size: 1.2rem;
        font-weight: bold;
        display: block;
        line-height: 1;
      }
      .card-date-badge .month {
        font-size: 0.7rem;
        text-transform: uppercase;
        display: block;
        line-height: 1;
      }
      .card-body {
        padding: 8px 12px 12px;
        height: calc(100% - 230px);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
      }
      .card-description {
        font-size: 0.72rem;
        color: #666;
        margin: 5px 0 8px;

        display: -webkit-box;
        -webkit-line-clamp: 3; /* ubah dari 2 jadi 3 */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4em;
        min-height: 3.6em; /* sesuaikan: 3 baris x 1.4 line-height x font-size kira-kira */
      }
      /* CSS untuk genre-badge di dalam gambar */
      .position-relative .genre-badge {
        position: absolute;
        bottom: 0px;
        left: 0px;
        right: 0;
        z-index: 2;
        background: linear-gradient(135deg, #8a4fffad, #ff6600b7);
        color: white;
        padding: 4px 10px;
        border-radius: 0px;
        font-size: 0, 8rem;
      }
      /*genre badge untuk genre yang ada di dalam card*/
      .genre-badge {
        max-width: 100%;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        background: rgba(138, 79, 255, 0.1);
        color: var(--primary-purple);
        padding: 4px 10px;
        border-radius: 0px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-bottom: 0px;
      }
      @keyframes marquee {
        0% {
          transform: translateX(0);
        }
        100% {
          transform: translateX(-100%);
        }
      }
      .price-badge-bottom {
        position: absolute;
        top: 0;

        right: 0;
        left: 40%;
        background: linear-gradient(135deg, #8a4fffad, #ff6600b7);
        color: white;
        padding: 6px 0;
        padding-left: 10px;
        border-radius: 0 0 0 30px;
        font-size: 0.79rem;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;

        clip-path: polygon(15% 100%, 100% 100%, 100% 0, 0 0);
      }
      .card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1px;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 1; /* Batasi ke 1 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 1.4em; /* Tinggi untuk 1 baris (1.2em per baris) */
        line-height: 1.2em;
      }
      .card-meta {
        margin-top: auto;
        font-size: 0.8rem;
        color: #666;
      }
      .card-meta i {
        margin-right: 5px;
        color: var(--primary-purple);
      }
      .card-meta span {
        display: -webkit-box;
        -webkit-line-clamp: 1; /* Batasi ke 1 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-top: 0;
        text-overflow: ellipsis;
        min-height: 1.4em; /* Tinggi untuk 1 baris */
        line-height: 1.2em;
      }
      .card-price {
        margin: 10px 0;
      }
      .card-price .from {
        font-size: 0.7rem;
        display: block;
      }
      .card-price .amount {
        font-weight: 600;
        color: var(--primary-purple);
      }
      .card-details {
        text-align: left;
        margin: 10px 0;
        font-size: 0.8rem;
        color: #555;
      }
      .card-details i {
        color: var(--primary-purple);
        margin-right: 8px;
        width: 20px;
        text-align: center;
      }
      /* FOOTER STYLES */
      .footer-link {
        transition: all 0.3s ease;
        display: inline-block;
      }
      .footer-link:hover {
        color: var(--primary-purple) !important;
        transform: translateX(5px);
      }
      .footer-link:hover {
        color: var(--primary-purple) !important;
        transform: translateX(5px);
      }
      /* Footer Wave Background */
      .wave-bg-footer {
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none"><path fill="%238a4fff" fill-opacity="0.05" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-repeat: no-repeat;
        background-position: bottom center;
        background-size: cover;
        height: 100%;
      }
      @media (max-width: 768px) {
        .wave-bg-footer {
          background-size: 150% auto;
        }
      }
      /* Social icons */
      .social-icon {
        transition: var(--transition);
        cursor: pointer;
      }
      .social-icon:hover {
        transform: scale(1.2) translateY(-3px);
        color: var(--primary-purple) !important;
      }

      /* Responsive adjustments */
      @media (max-width: 992px) {
        .navbar-brand span.ms-3 {
          display: none !important;
        }
        .navbar-collapse {
          padding-top: 1rem;
        }
        .justify-content-center {
          justify-content: flex-start !important;
          margin-left: 1rem;
        }
        .navbar-toggler.order-first {
          order: 0 !important;
        }
        .navbar-brand.order-lg-1 {
          order: 1 !important;
          margin-right: auto;
        }
        .justify-content-center.order-lg-2 {
          order: 3 !important;
          flex-basis: 100%;
          margin-top: 0.5rem;
        }
        .ms-lg-3.order-lg-3 {
          order: 2 !important;
          margin-left: auto;
        }
        .navbar .container {
          flex-wrap: wrap;
          justify-content: space-between;
        }
        .navbar-brand {
          order: 1;
          margin-right: auto;
        }
        .navbar-toggler {
          order: 0;
        }
        .navbar-collapse {
          order: 2;
          flex-basis: 100%;
        }
      }

      .grabbing {
        cursor: grabbing !important;
      }

      .grab {
        cursor: grab !important;
      }
      /* SLIDER STYLES */
      .slider-wrapper {
        width: 100vw;
        height: 400px;
        overflow: hidden;
        position: relative;
      }

      .slider-wrapper img {
        width: 100vw;
        height: 400px;
        object-fit: cover;
        object-position: center 30%;
        cursor: grab;
        user-select: none;
      }
      .main-slider {
        padding: 50px 0;
        background-color: #f7f7f7;
      }

      .mainslider {
        position: relative;
        width: 100%;
      }

      .bigbanner {
        position: relative;
        height: 80vh;
        overflow: hidden;
      }

      .sliderinfo {
        position: absolute;
        top: auto;
        bottom: 30px;
        left: 10px;
        right: 20px;

        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 16px;
        max-width: 600px;
        border-radius: 10px;
        font-size: 0.875rem;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.5s ease 0.3s;
      }

      .carousel-item.active .sliderinfo {
        transform: translateY(0);
        opacity: 1;
      }

      /* Info Section */
      .sliderinfolimit {
        font-size: 16px;
        color: white;
      }

      .sliderinfolimit .name {
        font-size: 24px;
        font-weight: bold;
        background: linear-gradient(90deg, #8a4fff, #ff6600);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline-block;
      }

      .sliderinfolimit .meta {
        margin-top: 15px;
        font-size: 14px;
      }

      .sliderinfolimit .meta .quality {
        font-weight: bold;
        color: #8a4fff;
      }

      .sliderinfolimit .meta .text {
        margin-right: 15px;
      }

      .sliderinfolimit .meta .text b {
        color: #ff6600;
      }

      .desc {
        margin-top: 2px;
        font-size: 14px;
        line-height: 1.5;
      }

      /* HOME-GENRES (Original style with new animations) */
      .home-genres {
        position: relative;
        max-width: 1080px;
        margin: -25px auto 0 auto;
        background: linear-gradient(to bottom, #f5f0ff 0%, #ffffff 100%);
        border-radius: 6px;
        padding: 0 40px 0 30px;
        z-index: 1;
        overflow: hidden;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        animation: glow 3s infinite alternate, subtleShake 5s infinite ease-in-out;
        transform-origin: center center;
      }

      @keyframes subtleShake {
        0%,
        100% {
          transform: translateX(0) rotate(0deg);
        }
        25% {
          transform: translateX(-2px) rotate(-0.5deg);
        }
        50% {
          transform: translateX(2px) rotate(0.5deg);
        }
        75% {
          transform: translateX(-1px) rotate(-0.3deg);
        }
      }

      @keyframes glow {
        0%,
        100% {
          box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        50% {
          box-shadow: 0 2px 10px rgba(138, 79, 255, 0.3);
        }
      }

      .home-genres .genre-listx {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        position: relative;
      }

      .home-genres .genre-listx a {
        line-height: 50px;
        color: rgba(0, 0, 0, 0.7);
        padding: 0 20px;
        font-size: 16px;
        display: inline-block;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        transform-origin: center bottom;
        animation: floatLink 4s infinite ease-in-out;
      }

      /* Floating animation for each link */
      @keyframes floatLink {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-2px);
        }
      }

      /* Individual delay for each link */
      .home-genres .genre-listx a:nth-child(1) {
        animation-delay: 0.1s;
      }
      .home-genres .genre-listx a:nth-child(2) {
        animation-delay: 0.2s;
      }
      .home-genres .genre-listx a:nth-child(3) {
        animation-delay: 0.3s;
      }
      .home-genres .genre-listx a:nth-child(4) {
        animation-delay: 0.4s;
      }
      .home-genres .genre-listx a:nth-child(5) {
        animation-delay: 0.5s;
      }
      .home-genres .genre-listx a:nth-child(6) {
        animation-delay: 0.6s;
      }
      .home-genres .genre-listx a:nth-child(7) {
        animation-delay: 0.7s;
      }
      .home-genres .genre-listx a:nth-child(8) {
        animation-delay: 0.8s;
      }

      .home-genres .genre-listx a:hover {
        color: var(--primary-purple);
        transform: translateY(-5px);
      }

      .home-genres .genre-listx a::after {
        content: "";
        position: absolute;
        bottom: 15px;
        left: 20px;
        width: 0;
        height: 2px;
        background: var(--primary-purple);
        transition: width 0.3s ease;
      }

      .home-genres .genre-listx a:hover::after {
        width: calc(100% - 40px);
      }

      .home-genres .alman a {
        background: #333;
        color: #f90;
        padding: 8px 30px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        margin-left: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .home-genres .alman a:hover {
        background: var(--primary-purple);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(143, 87, 255, 0.4);
      }

      .home-genres .alman a::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: 0.5s;
      }

      .home-genres .alman a:hover::before {
        left: 100%;
      }

      /* Hover effect on container */
      .home-genres:hover {
        animation: glow 3s infinite alternate, subtleShake 5s infinite ease-in-out, pulse 1s ease;
      }

      @keyframes pulse {
        0% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
        100% {
          transform: scale(1);
        }
      }

      /* Enhanced Concert Sections */
      .section-title-gradient {
        background: linear-gradient(90deg, #8a4fff, #ff6600);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
        font-size: 2rem;
      }

      .section-title-underline {
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60%;
        height: 4px;
        background: linear-gradient(90deg, #8a4fff, #ff6600);
        border-radius: 2px;
      }
      .section-entrance {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
      }
      .section-entrance.visible {
        opacity: 1;
        transform: translateY(0);
      }

      .upcoming-concerts-section {
        background: linear-gradient(to bottom, #f9f5ff 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
      }

      .upcoming-concerts-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="%238a4fff10" d="M0,0 L100,0 L100,100 L0,100 Z"></path></svg>');
        opacity: 0.1;
        z-index: 0;
      }

      /* All Concerts Grid Layout */
      .all-concerts-section {
        position: relative;
        overflow: hidden;
        background: linear-gradient(to bottom, #f9f5ff 0%, #ffffff 100%);
      }

      .all-concerts-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="%238a4fff10" d="M0,0 L100,0 L100,100 L0,100 Z"></path></svg>');
        opacity: 0.1;
        z-index: 0;
      }

      .all-concerts-container {
        position: relative;
        width: 100%;
        margin: 20px 0;
        padding: 0 0px; /* Tambahkan padding untuk mobile */
      }

      /* Update All Concerts Grid Layout */
      .all-concerts-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, 224px);

        gap: 40px; /* Jarak antar card sama dengan Popular Concerts */
        row-gap: 30px;
        justify-content: center;
        padding: 0px; /* Hilangkan padding tambahan */
      }

      /* All Concerts cards use the same .concert-card class as Featured/Upcoming */
      .all-concerts-wrapper .concert-card {
        margin: 0; /* Hilangkan margin-right yang sebelumnya ada */
        width: 100%; /* Gunakan full width grid cell */
      }

      /* HERO SECTION */
      .hero {
        text-align: center;
        padding: 80px 20px;
        position: relative;
      }

      .hero h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        animation: floatText 4s ease-in-out infinite;
      }

      @keyframes floatText {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-10px);
        }
      }

      .hero h1 span {
        background: linear-gradient(90deg, #8a4fff, #ff6600);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: textGradient 3s ease infinite;
        background-size: 200% auto;
      }

      .hero p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto;
        color: #555;
      }

      /* SCROLL INDICATOR */
      .scroll-indicator {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: var(--gradient-purple);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        z-index: 100;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(138, 79, 255, 0.4);
      }

      .scroll-indicator.visible {
        opacity: 1;
        transform: translateY(0);
      }

      .scroll-indicator:hover {
        animation: pulse 1s infinite;
      }

      /* Horizontal Scrolling Sections */
      .concerts-scroll-container {
        position: relative;
        width: 100%;
        margin: 20px 0;
      }

      /* Update the scroll wrapper to show partial cards */
      .concerts-scroll-wrapper {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding: 20px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        gap: 15px;
      }

      .concerts-scroll-wrapper::-webkit-scrollbar {
        display: none;
      }

      .scroll-button {
        display: flex !important; /* Pastikan button selalu visible */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: var(--primary-purple);
        color: white;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        z-index: 10;
        opacity: 0.8;
        transition: opacity 0.3s ease;
        border: none;
      }
      .scroll-button.disabled {
        opacity: 0.5;
        pointer-events: none;
      }

      .scroll-button:hover {
        opacity: 1;
        background: var(--primary-orange);
        transform: translateY(-50%) scale(1.1);
      }

      .scroll-button.left {
        left: 10px;
      }

      .scroll-button.right {
        right: 10px;
      }

      .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }

      /* Responsive Styling */
      @media (max-width: 1200px) {
        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }
      }

      @media (max-width: 992px) {
        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }
      }

      @media (max-width: 768px) {
        .navbar .container {
          flex-wrap: nowrap;
        }
        .navbar-toggler.me-2 {
          margin-right: 0.5rem !important;
        }
        .navbar-brand {
          font-size: 1.4rem !important;
          margin-right: 0;
        }
        .d-flex.flex-grow-1 {
          flex-grow: 0 !important;
          margin-left: auto;
        }
        .bigbanner {
          height: 300px;
        }

        .sliderinfo {
          padding: 15px;
          max-width: 90%;
        }

        .sliderinfolimit .name {
          font-size: 22px;
        }

        .sliderinfolimit .meta .quality {
          font-size: 13px;
        }

        .home-genres {
          margin-top: 0;
          border-radius: 0;
          padding: 10px;
        }
        .home-genres .genre-listx {
          justify-content: flex-start;
        }
        .genre-listx {
          white-space: normal;
          text-align: center;
          margin-bottom: 10px;
        }

        .alman {
          margin-top: 10px;
        }

        .hero h1 {
          font-size: 2rem;
        }

        .hero p {
          font-size: 1rem;
        }

        .concert-card {
          width: 192px;
          height: 380px;
        }

        .card-img {
          height: 180px;
        }

        .card-body {
          height: calc(100% - 180px);
        }

        .section-title-gradient {
          font-size: 1.5rem;
        }

        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }

        .all-concerts-wrapper .concert-card {
          width: 192px;
          height: 380px;
        }

        .all-concerts-wrapper .card-img {
          height: 180px;
        }

        .all-concerts-wrapper .card-body {
          height: calc(100% - 180px);
        }

        .scroll-button {
          display: none !important;
        }
      }
      @media (min-width: 768px) {
        .all-concerts-container {
          padding: 0; /* Hilangkan padding di desktop */
        }
      }
      @media (max-width: 576px) {
        .slider-wrapper img {
          height: 300px;
        }
        .home-genres .genre-listx a {
          padding: 6px 10px;
        }

        .home-genres .alman a {
          padding: 6px 12px;
        }
        .sliderinfo {
          left: 15px;
          bottom: 15px;
          padding: 15px;
        }

        .hero h1 {
          font-size: 1.8rem;
        }

        .concert-card {
          width: 176px;
          height: 360px;
        }

        .card-img {
          height: 160px;
        }

        .card-body {
          height: calc(100% - 160px);
        }

        .all-concerts-wrapper {
          grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }

        .all-concerts-wrapper .concert-card {
          width: 176px;
          height: 360px;
        }

        .all-concerts-wrapper .card-img {
          height: 160px;
        }

        .all-concerts-wrapper .card-body {
          height: calc(100% - 160px);
        }
      }

      /* Updated Music Note Animations */
      .music-note {
        position: absolute;
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.2rem;
        animation-name: floatNote;
        animation-timing-function: ease-in-out;
        animation-iteration-count: 1;
        user-select: none;
        z-index: 999;
        text-shadow: 0 2px 5px rgba(138, 79, 255, 0.5);
      }

      @keyframes floatNote {
        0% {
          transform: translateY(0) rotate(0deg) scale(0.8);
          opacity: 0;
        }
        10% {
          opacity: 0.8;
        }
        90% {
          opacity: 0.8;
        }
        100% {
          transform: translateY(-100vh) rotate(360deg) scale(1.2);
          opacity: 0;
        }
      }

      /* Add this to make notes appear more random */
      @keyframes sway {
        0%,
        100% {
          transform: translateX(0);
        }
        50% {
          transform: translateX(20px);
        }
      }

      /* Add to your existing CSS */
      .hover-grow:hover {
        transform: scale(1.05);
      }

      /* Animation for footer elements */
      .animate__animated {
        animation-duration: 1s;
      }
      #musicNotes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 9999;
        overflow: hidden;
      }
      /* Music notes in footer */
      .music-note {
        position: absolute;
        color: rgba(138, 79, 255, 0.3);
        font-size: 1.5rem;
        animation-name: floatUp;
        animation-timing-function: ease-out;
        animation-iteration-count: infinite;
        user-select: none;
      }

      @keyframes floatUp {
        0% {
          transform: translateY(0) rotate(0deg);
          opacity: 0;
        }
        50% {
          opacity: 0.5;
        }
        100% {
          transform: translateY(-100px) rotate(360deg);
          opacity: 0;
        }
      }

      /* App Promo Section */
      .app-promo-section {
        background: linear-gradient(135deg, #f9f5ff 0%, #ffffff 100%);
      }

      .app-section-bg-pattern {
        background: radial-gradient(circle at 20% 30%, rgba(138, 79, 255, 0.03) 0%, transparent 50%), radial-gradient(circle at 80% 70%, rgba(255, 102, 0, 0.03) 0%, transparent 50%);
      }

      .app-section-wave {
        height: 100px;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%238a4fff" fill-opacity="0.03" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>')
          no-repeat;
        background-size: cover;
      }

      .text-gradient-purple-orange {
        background: linear-gradient(90deg, #8a4fff 0%, #ff6600 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
      }

      /* Features */
      .feature-icon {
        width: 48px;
        height: 48px;
        background: rgba(138, 79, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #8a4fff;
        transition: all 0.3s ease;
      }

      .features-grid > div:hover .feature-icon {
        background: #8a4fff;
        color: white;
        transform: rotate(10deg) scale(1.1);
      }

      /* App Screenshot */
      .app-screenshot-container {
        perspective: 1000px;
      }

      .app-screenshot-frame {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(138, 79, 255, 0.2);
        transform: rotateY(-5deg) rotateX(5deg);
        transition: all 0.5s ease;
        border: 12px solid white;
        background: white;
      }

      .app-screenshot-container:hover .app-screenshot-frame {
        transform: rotateY(0) rotateX(0) scale(1.03);
      }

      /* Floating Elements */
      .floating-hero-element {
        position: absolute;
        opacity: 0.6;
        animation: floatAround 15s infinite linear;
        z-index: -1;
      }
      .floating-element {
        position: absolute;
        color: #8a4fff;
        font-size: 1.5rem;
        animation: float 6s infinite ease-in-out;
      }

      .floating-element.element-1 {
        top: 10%;
        left: 10%;
        animation-delay: 0s;
      }

      .floating-element.element-2 {
        top: 70%;
        left: 80%;
        animation-delay: 1s;
        color: #ff6600;
      }

      .floating-element.element-3 {
        top: 40%;
        left: 85%;
        animation-delay: 2s;
        color: #8a4fff;
      }
      /* Gradient animation */
      @keyframes gradientShift {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }
      .gradient-animated {
        background-size: 200% 200%;
        animation: gradientShift 6s ease infinite;
      }

      @keyframes floatAround {
        0% {
          transform: translate(0, 0) rotate(0deg);
        }
        25% {
          transform: translate(50px, 30px) rotate(90deg);
        }
        50% {
          transform: translate(100px, 0) rotate(180deg);
        }
        75% {
          transform: translate(50px, -30px) rotate(270deg);
        }
        100% {
          transform: translate(0, 0) rotate(360deg);
        }
      }

      @keyframes float {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-5px);
        }
      }

      /* Animations */
      .animate__delay-1-5s {
        animation-delay: 1.5s;
      }

      .animate__delay-2s {
        animation-delay: 2s;
      }

      .animate__delay-2-5s {
        animation-delay: 2.5s;
      }

      @media (max-width: 576px) {
        h1,
        h2,
        h3 {
          font-size: 90%;
        }
        .container {
          padding-left: 10px;
          padding-right: 10px;
        }
      }
      /* Tambahkan di CSS Anda */
      #all-concerts-section {
        scroll-margin-top: 80px; /* Sesuaikan dengan tinggi navbar */
      }

      .offcanvas-body a.nav-link {
        transition: all 0.3s ease;
      }

      .offcanvas-body a.nav-link:hover {
        transform: translateX(5px);
        color: var(--primary-purple) !important;
      }

      html {
        scroll-behavior: smooth;
      }

      /* Add to your CSS */
      .pagination .page-link {
        color: var(--primary-purple);
        border: 1px solid rgba(138, 79, 255, 0.3);
        margin: 0 5px;
        border-radius: 8px !important;
        min-width: 40px;
        text-align: center;
        transition: all 0.3s ease;
      }

      .pagination .page-item.active .page-link {
        background: var(--primary-purple);
        border-color: var(--primary-purple);
        color: white;
      }

      .pagination .page-link:hover {
        background: rgba(138, 79, 255, 0.1);
        color: var(--primary-purple);
      }

      .pagination .page-item.disabled .page-link {
        pointer-events: none;
        opacity: 0.6;
        background-color: #f8f9fa;
      }
    </style>
  </head>
  <body>
    <!-- Floating music notes -->
    <div id="musicNotes"></div>
    <!-- Scroll to top indicator -->
    <div class="scroll-indicator" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
      <i class="bi bi-arrow-up"></i>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-1" id="mainNavbar">
      <div class="container">
        <!-- Menu Button -->
        <button class="navbar-toggler order-first me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Logo -->
        <a href="../public/" class="navbar-brand fw-bold order-lg-1 mx-auto mx-lg-0 me-lg-4" href="#" style="font-size: 1.6rem"> <span style="color: #8a4fff">Concert</span><span style="color: #ff6600">Tix</span> </a>
        <a href="../public/" class="navbar-brand fw-bold order-lg-1 mx-auto mx-lg-0 me-lg-4" href="#" style="font-size: 1.6rem">
          <span class="ms-3 d-none d-lg-inline" style="font-size: 1.4rem; color: #7a3fef">Home Page</span>
        </a>
        <!-- Search Form -->
        <div class="order-lg-2 flex-grow-1 mx-2 mx-lg-0">
          <!-- Di navbar -->
          <form class="w-100 position-relative" role="search" id="searchForm" action="events/search.php" method="get">
            <div class="input-group" style="border-radius: 50px; border: 2px solid #8a4fff; overflow: hidden; transition: all 0.3s ease">
              <input class="form-control border-0 py-2 shadow-none" type="search" placeholder="Search Concert..." aria-label="Search" id="searchInput" style="box-shadow: none !important" />
              <button type="submit" class="btn btn-purple-gradient d-none d-md-block" style="border-radius: 0 50px 50px 0; padding: 0.5rem 1rem">
                <span>
                  <i class="bi bi-search text-purple"> Search</i>
                </span>
              </button>
            </div>
          </form>
        </div>
        <!-- Right Side Buttons -->
        <div class="d-flex align-items-center gap-2 ms-lg-3 order-lg-3">
          <a href="../user/cart/index.html" class="btn btn-sm btn-outline-secondary d-none d-md-flex align-items-center" style="border-radius: 50px; padding: 0.5rem 0.9rem">
            <i class="bi bi-cart2"></i>
            <span class="ms-1 d-none d-lg-inline">Cart</span>
          </a>
          <a href="../user/profile.php" class="btn btn-sm btn-outline-secondary d-none d-md-flex align-items-center" style="border-radius: 50px; padding: 0.5rem 0.9rem">
            <i class="bi bi-person"></i>
            <span class="ms-1 d-none d-lg-inline">Profile</span>
          </a>
          <a href="../auth/login.html" class="btn btn-sm btn-purple-gradient d-none d-md-inline-flex align-items-center social-float" style="border-radius: 50px; padding: 0.5rem 1rem">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
          </a>
          <a href="../auth/signup.html" class="btn btn-sm btn-purple-gradient d-none d-md-inline-flex align-items-center pulse-animation float-animation" style="border-radius: 50px; padding: 0.5rem 1rem">
            <i class="bi bi-person-plus me-1"></i> Sign Up
          </a>
        </div>
      </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="sidebarMenuLabel"><span style="color: #8a4fff">Concert</span><span style="color: #ff6600">Tix</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="../public/" class="nav-link active d-flex align-items-center py-2"> <i class="bi bi-house-door me-3 fs-5" style="color: #8a4fff"></i> Home Page </a>
          </li>
          <li class="nav-item">
            <a href="../user/profile.php" class="nav-link d-flex align-items-center py-2"> <i class="bi bi-person me-3 fs-5" style="color: #8a4fff"></i> Profile </a>
          </li>
          <li class="nav-item">
            <a href="../user/cart/" class="nav-link d-flex align-items-center py-2"> <i class="bi bi-cart2 me-3 fs-5" style="color: #8a4fff"></i> Cart </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="#all-concerts-section" data-bs-dismiss="offcanvas"> <i class="bi bi-ticket-perforated me-3 fs-5" style="color: #8a4fff"></i> Concert </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="events/search.php"> <i class="bi bi-music-note-list me-3 fs-5" style="color: #8a4fff"></i> Genre </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="../public/about.html"> <i class="bi bi-info-circle me-3 fs-5" style="color: #8a4fff"></i> About Us </a>
          </li>
        </ul>

        <hr class="my-3 mx-3" />
        <div class="px-3">
          <!-- Login Button -->
          <a href="../auth/login.html" class="btn btn-outline-purple w-100 mb-2 d-flex align-items-center justify-content-center" style="border-radius: 50px; padding: 0.5rem 1rem"> <i class="bi bi-box-arrow-in-right me-2"></i> Login </a>
          <!-- Register Button -->
          <a href="../auth/signup.html" class="btn btn-purple-gradient w-100 d-flex align-items-center justify-content-center pulse-animation float-animation" style="border-radius: 50px; padding: 0.5rem 1rem">
            <i class="bi bi-person-plus me-2"></i> Sign Up
          </a>
        </div>
        <hr class="my-3 mx-3" />
        <div class="px-3">
          <h6 class="text-muted mb-3">Follow Us</h6>
          <div class="social-links d-flex justify-content-center gap-4">
            <a href="https://www.facebook.com/groups/3288439241475430/" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-facebook fs-4"></i>
            </a>
            <a href="https://www.instagram.com/xtoph.y?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-instagram fs-4"></i>
            </a>
            <a href="https://x.com/home" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-twitter-x fs-4"></i>
            </a>
            <a href="https://www.youtube.com/@xant_san" class="text-decoration-none" style="color: #8a4fff">
              <i class="bi bi-youtube fs-4"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slider/carousel -->
    <div class="mt-0">
      <div id="carouselExample" class="carousel slide slider-wrapper" data-bs-ride="carousel">
        <div class="carousel-inner grab" id="dynamic-slider">
          <!-- Slider akan diisi oleh JavaScript -->
        </div>
      </div>
    </div>

    <!-- Pilihan Genre -->
    <div class="home-genres">
      <span class="genre-listx">
        <!-- Tambahkan parameter genre di URL -->
        <a href="events/search.php?genre=Pop">Pop</a>
        <a href="events/search.php?genre=Rock">Rock</a>
        <a href="events/search.php?genre=Jazz">Jazz</a>
        <a href="events/search.php?genre=Electronic">Electronic</a>
        <a href="events/search.php?genre=Hip-Hop">Hip Hop</a>
        <a href="events/search.php?genre=R&B">R&B</a>
        <a href="events/search.php?genre=Classical">Classical</a>
        <a href="events/search.php?genre=K-Pop">K-Pop</a>
      </span>
      <span class="alman">
        <a href="#all-concerts-section">All Concerts</a>
      </span>
    </div>

    <!-- Hero Section -->
    <section class="hero py-5">
      <!-- Tetap py-5 -->
      <div class="container">
        <h1 class="display-5 fw-bold">Find and Order <span>Concert Tickets</span> easily</h1>
        <p class="lead text-muted mt-3">Find upcoming concerts, get the best seats, and create unforgettable memories with your favorite artists.</p>
      </div>
    </section>

    <!-- Popular Concerts - Enhanced -->
    <section class="py-0">
      <div class="container">
        <div class="section-header mb-4">
          <h2 class="fw-bold mb-0 position-relative d-inline-block">
            <span class="section-title-gradient">Popular Concerts</span>
            <span class="section-title-underline"></span>
          </h2>
        </div>
        <div class="concerts-scroll-container position-relative">
          <div class="scroll-button left" onclick="scrollLeft('featured')">
            <i class="bi bi-chevron-left"></i>
          </div>
          <div class="concerts-scroll-wrapper" id="featured-scroll">
            <!-- Cards will be generated by JavaScript -->
          </div>
          <div class="scroll-button right" onclick="scrollRight('featured')">
            <i class="bi bi-chevron-right"></i>
          </div>
        </div>
      </div>
    </section>

    <!-- Recommendation Concerts -->
    <section class="py-1 upcoming-concerts-section">
      <div class="container">
        <div class="section-header mb-4">
          <h2 class="fw-bold mb-0 position-relative d-inline-block">
            <span class="section-title-gradient">Recommendation For You</span>
            <span class="section-title-underline"></span>
          </h2>
        </div>
        <div class="concerts-scroll-container position-relative">
          <div class="scroll-button left" onclick="scrollLeft('upcoming')">
            <i class="bi bi-chevron-left"></i>
          </div>
          <div class="concerts-scroll-wrapper" id="upcoming-scroll">
            <!-- Cards will be generated by JavaScript -->
          </div>
          <div class="scroll-button right" onclick="scrollRight('upcoming')">
            <i class="bi bi-chevron-right"></i>
          </div>
        </div>
      </div>
    </section>

    <!-- All Concerts Section -->
    <section id="all-concerts-section" class="py-1 all-concerts-section position-relative">
      <div class="container">
        <div class="section-header mb-4">
          <h2 class="fw-bold mb-4 position-relative d-inline-block">
            <span class="section-title-gradient">All Concerts</span>
            <span class="section-title-underline"></span>
          </h2>
        </div>
        <div class="all-concerts-container">
          <div class="all-concerts-wrapper">
            <!-- Cards will be generated by JavaScript -->
          </div>
        </div>
        <!-- Enhanced Load More Button -->
        <div class="text-center mt-5">
          <button class="btn btn-load-more px-5 py-3 position-relative overflow-hidden">
            <span class="position-relative z-index-1">Load More Concerts</span>
            <span class="btn-hover-effect position-absolute top-0 left-0 w-100 h-100"></span>
            <i class="bi bi-arrow-down-circle ms-2"></i>
          </button>
        </div>
      </div>
      <!-- Decorative elements -->
      <div class="position-absolute bottom-0 end-0 w-50 h-100" style="z-index: -1; opacity: 0.05">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
          <path
            fill="#8a4fff"
            d="M45.5,-45.5C58.3,-32.7,67.6,-16.3,67.2,-0.4C66.8,15.6,56.6,31.1,43.8,43.8C31.1,56.6,15.6,66.6,-1.2,67.8C-17.9,69,-35.8,61.4,-47.9,48.6C-60,35.8,-66.4,17.9,-65.2,1.1C-64,-15.6,-55.3,-31.3,-43.2,-44.1C-31.3,-55.3,-15.6,-63.6,0.7,-64.3C17,-65,34,-58,45.5,-45.5Z"
            transform="translate(100 100)"
          />
        </svg>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-5 position-relative overflow-hidden">
      <!-- Wave Background -->
      <div class="position-absolute bottom-0 start-0 w-100 h-100" style="z-index: 0; overflow: hidden">
        <div class="position-absolute bottom-0 start-0 w-100 h-100 wave-bg-footer"></div>
      </div>
      <div class="container position-relative" style="z-index: 1">
        <div class="row g-4">
          <!-- Left - Brand Info -->
          <div class="col-lg-4 mb-4">
            <div class="footer-brand">
              <h3 class="fw-bold mb-3" style="background: linear-gradient(90deg, #8a4fff, #ff6600); -webkit-background-clip: text; background-clip: text; color: transparent">Concert<span style="color: #ff6600">Tix</span></h3>
              <p class="text-muted mb-4">The easiest way to buy tickets for your favorite concerts and events worldwide.</p>
              <div class="d-flex gap-3 social-icons">
                <a
                  href="https://www.facebook.com/groups/3288439241475430/"
                  class="social-icon d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease"
                >
                  <i class="bi bi-facebook text-purple"></i>
                </a>
                <a
                  href="https://www.instagram.com/xtoph.y?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                  class="social-icon d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease"
                >
                  <i class="bi bi-instagram text-purple"></i>
                </a>
                <a href="https://x.com/home" class="social-icon d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease">
                  <i class="bi bi-twitter-x text-purple"></i>
                </a>
                <a
                  href="https://www.youtube.com/@xant_san"
                  class="social-icon d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: rgba(138, 79, 255, 0.1); transition: all 0.3s ease"
                >
                  <i class="bi bi-youtube text-purple"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Middle - Links -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="row g-4">
              <!-- Company -->
              <div class="col-sm-6">
                <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Company</h6>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="../public/about.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> About Us
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="../lost/404_page.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Careers
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="https://api.whatsapp.com/send?phone=6285156473714&text=Hi+Sir+Admin+ConcertTix" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Contact Us
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="privacy_policy.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Privacy Policy
                    </a>
                  </li>
                  <li>
                    <a href="tems_of_service.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Terms of Service
                    </a>
                  </li>
                </ul>
              </div>

              <!-- Support -->
              <div class="col-sm-6">
                <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Support</h6>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="../lost/404_page.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Help Center
                    </a>
                  </li>
                  <li class="mb-2">
                    <a href="faqs.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease"> <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> FAQs </a>
                  </li>
                  <li class="mb-2">
                    <a href="refund_policy.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Refund Policy
                    </a>
                  </li>
                  <li>
                    <a href="../lost/404_page.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Report an Issue
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Right - Newsletter -->
          <div class="col-md-6 col-lg-4 mb-4">
            <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Stay Updated</h6>
            <p class="text-muted mb-3">Subscribe to our newsletter for concert updates and exclusive offers.</p>
            <form class="mb-4">
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Your email" style="border-right: 0; border-color: #8a4fff" />
                <button class="btn btn-purple-gradient" type="submit" style="border-left: 0">
                  <i class="bi bi-send-fill"></i>
                </button>
              </div>
            </form>
            <h6 class="fw-bold mb-3 text-uppercase" style="color: #8a4fff">Download Our App</h6>
            <div class="d-flex gap-2 app-download">
              <a href="../lost/404_page.html" class="hover-grow" style="transition: all 0.3s ease">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Download_on_the_App_Store_Badge.svg/1280px-Download_on_the_App_Store_Badge.svg.png" alt="App Store" class="img-fluid rounded" style="height: 40px" />
              </a>
              <a href="../lost/404_page.html" class="hover-grow" style="transition: all 0.3s ease">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/1280px-Google_Play_Store_badge_EN.svg.png" alt="Google Play" class="img-fluid rounded" style="height: 40px" />
              </a>
            </div>
          </div>
        </div>
        <hr class="my-4" style="border-color: rgba(138, 79, 255, 0.1)" />
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <p class="mb-0 text-muted small">© 2025 ConcertTix. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-center text-md-end">
            <div class="d-flex justify-content-center justify-content-md-end gap-3">
              <a href="privacy_policy.html" class="text-muted small" style="text-decoration: none">Privacy Policy</a>
              <a href="tems_of_service.html" class="text-muted small" style="text-decoration: none">Terms of Service</a>
              <a href="../lost/404_page.html" class="text-muted small" style="text-decoration: none">Sitemap</a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
      // Variable untuk menyimpan data konser dari server
      let allConcertsData = [];

      // Fungsi untuk memuat data konser untuk bagian All Concerts
      function loadAllConcerts() {
        fetch("/Concert/auth/get_all_concerts.php")
          .then((response) => response.json())
          .then((concerts) => {
            allConcertsData = concerts; // Simpan data
            // Generate cards untuk 14 data pertama
            generateAllConcertsCards(0, 14, true);
          })
          .catch((error) => {
            console.error("Error loading concerts:", error);
          });
      }

      // Fungsi untuk memuat slider dari API
      function loadSliderConcerts() {
        fetch("/Concert/auth/get_slider_concerts.php")
          .then((response) => response.json())
          .then((concerts) => {
            const sliderContainer = document.getElementById("dynamic-slider");
            sliderContainer.innerHTML = "";

            concerts.forEach((concert, index) => {
              const activeClass = index === 0 ? "active" : "";
              sliderContainer.innerHTML += `
          <div class="carousel-item ${activeClass} position-relative">
            <img src="${concert.ImageURL}" class="d-block w-100 img-fluid" alt="${concert.Title}">
            <div class="sliderinfo">
              <div class="sliderinfolimit">
                <span class="name">${concert.Title}</span>
                <div class="meta">
                  <span class="quality">Genre:</span>
                  <span class="text"><b>${concert.Genres}</b></span>
                  <span class="quality">Location: </span>
                  <span class="text"><b>${concert.Venue}, ${concert.City}</b></span>
                </div>
                <div class="desc">
                  <p>${concert.Description}</p>
                </div>
              </div>
            </div>
          </div>
        `;
            });

            // Update carousel indicators
            const indicatorsContainer = document.querySelector(".carousel-indicators");
            indicatorsContainer.innerHTML = "";
            concerts.forEach((_, index) => {
              indicatorsContainer.innerHTML += `
          <button type="button" data-bs-target="#carouselExample" 
                  data-bs-slide-to="${index}" 
                  ${index === 0 ? 'class="active" aria-current="true"' : ""}
                  aria-label="Slide ${index + 1}"></button>
        `;
            });

            // Re-init carousel jika diperlukan
            if (typeof bootstrap !== "undefined") {
              new bootstrap.Carousel(document.getElementById("carouselExample"));
            }
          });
      }

      // Panggil saat halaman dimuat
      document.addEventListener("DOMContentLoaded", loadSliderConcerts);

      // Concert data structure
      const concertData = {
        featured: [
          {
            id: 1,
            image: "https://i.pinimg.com/736x/25/ea/d4/25ead43ae86599f8a7af105262b3f903.jpg",
            title: "Coldplay - Music of the Spheres World Tour",
            genre: "Pop Rock",
            venue: "Seoul Olympic Stadium",
            date: { day: "21", month: "JUL" },
            price: "Rp 1.750.000",
            description:
              "Coldplay brings their mesmerizing 'Music of the Spheres' World Tour to Seoul! Get ready for a night filled with emotional anthems, cosmic visuals, and immersive light shows. From classics like 'Fix You' and 'Yellow' to recent hits like 'My Universe,' this show promises an unforgettable experience. Fans will wear LED wristbands that sync with the music, turning the stadium into a sea of colors. Chris Martin and the band are set to deliver a heartfelt performance that celebrates unity, love, and the power of music. A once-in-a-lifetime concert you won’t want to miss.",
            backDetails: {
              date: "Sun, Jul 21, 2024",
              time: "7:00 PM",
              venue: "Seoul Olympic Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/69/0f/03/690f03b59d98d9f7bebca87859885b8f.jpg",
            title: "The 1975 - At Their Very Best Tour",
            genre: "Indie Rock",
            venue: "O2 Arena London",
            date: { day: "15", month: "SEP" },
            price: "Rp 1.200.000",
            description:
              "British band The 1975 returns to the stage with their electrifying ‘At Their Very Best’ tour. Known for their eclectic sound and visually stunning performances, they’re set to light up the O2 Arena with fan favorites like 'Somebody Else' and 'Love It If We Made It'. Expect a mix of emotion, energy, and unforgettable indie rock anthems. With Matty Healy's charismatic stage presence and genre-blending music, this concert is a must-see for fans new and old. Don’t miss this vibrant night in London!",
            backDetails: {
              date: "Sun, Sep 15, 2024",
              time: "8:00 PM",
              venue: "O2 Arena London",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/d1/49/34/d149346b0a65ff1292b8d5a5632317df.jpg",
            title: "LE SSERAFIM - 1st Tour 'Flame Rises'",
            genre: "K-Pop",
            venue: "KSPO Dome",
            date: { day: "19", month: "AUG" },
            price: "Rp 900.000",
            description:
              "Join LE SSERAFIM as they embark on their powerful first world tour, 'Flame Rises'! With bold choreography, stunning visuals, and high-energy performances, this K-Pop girl group is ready to set the stage on fire. Fans can expect to see dynamic hits like 'Antifragile' and 'Fearless' live for the first time. Taking place at the iconic KSPO Dome, the concert promises an unforgettable night of music, emotion, and connection. Be part of LE SSERAFIM’s global journey and feel the flames of their rising fame!",
            backDetails: {
              date: "Mon, Aug 19, 2024",
              time: "7:30 PM",
              venue: "KSPO Dome",
            },
          },
          {
            id: 4,
            image: "https://about.vidio.com/wp-content/uploads/2022/09/Blog_Noah-1.jpg",
            title: "NOAH - The Final Chapter",
            genre: "Pop Rock",
            venue: "Stadion GBK, Jakarta",
            date: { day: "16", month: "NOV" },
            price: "Rp 500.000",
            description:
              "NOAH, one of Indonesia’s most legendary bands, presents their final chapter in an emotional farewell concert. Held at the grand Stadion GBK Jakarta, the event will feature decades of hits including 'Separuh Aku' and 'Bintang di Surga'. This is more than just a performance—it’s a tribute to their musical journey and devoted fans. Don’t miss this historic moment as NOAH takes the stage one last time to celebrate their legacy and bid a heartfelt goodbye to the Indonesian music scene.",
            backDetails: {
              date: "Sat, Nov 16, 2024",
              time: "8:00 PM",
              venue: "Stadion GBK, Jakarta",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/0a/27/61/0a2761ae8902ccd5b35b488d6376811d.jpg",
            title: "IVE - The 1st World Tour 'Show What I Have'",
            genre: "K-Pop",
            venue: "Tokyo Dome",
            date: { day: "10", month: "OCT" },
            price: "Rp 950.000",
            description:
              "K-Pop sensation IVE kicks off their very first world tour, 'Show What I Have', live at Tokyo Dome! With dazzling performances, catchy hits like 'Love Dive' and 'After Like', and jaw-dropping visuals, this concert is set to wow audiences. Known for their charisma and fresh style, IVE invites fans into their musical universe for a night of celebration and connection. Join the wave and witness one of K-Pop’s brightest rising stars take the global stage by storm!",
            backDetails: {
              date: "Thu, Oct 10, 2024",
              time: "6:00 PM",
              venue: "Tokyo Dome",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/99/78/64/997864275ce154efda6c3fdf3e0587d6.jpg",
            title: "Tame Impala - Live Experience",
            genre: "Psychedelic Rock",
            venue: "Sydney Opera House",
            date: { day: "5", month: "DEC" },
            price: "Rp 1.350.000",
            description:
              "Immerse yourself in a surreal world of sound and visuals with Tame Impala’s Live Experience at the iconic Sydney Opera House. Led by Kevin Parker, the band will deliver mesmerizing performances of hits like 'The Less I Know the Better' and 'Let It Happen'. Expect a blend of dreamy lights, trippy visuals, and hypnotic grooves in a concert that feels otherworldly. Perfect for longtime fans and newcomers alike, this show is more than music—it’s an experience for the senses.",
            backDetails: {
              date: "Thu, Dec 5, 2024",
              time: "9:00 PM",
              venue: "Sydney Opera House",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/7d/36/43/7d36431f7aa222b3b24d29cba24aa082.jpg",
            title: "BLACKPINK WORLD TOUR [BORN PINK]",
            genre: "K-Pop",
            venue: "National Stadium Singapore",
            date: { day: "30", month: "JUN" },
            price: "Rp 1.600.000",
            description:
              "BLACKPINK brings their powerful 'BORN PINK' world tour to Singapore! Expect a spectacular night full of hit songs, fierce choreography, and jaw-dropping visuals. Jisoo, Jennie, Rosé, and Lisa will dazzle the stage with global chart-toppers like 'Pink Venom', 'Shut Down', and 'How You Like That'. The National Stadium will be filled with Blinks from across Asia, united by the music and passion of K-Pop’s global queens. Be there to witness history in the making.",
            backDetails: {
              date: "Sun, Jun 30, 2024",
              time: "8:00 PM",
              venue: "National Stadium Singapore",
            },
          },
          {
            id: 8,
            image: "https://i.pinimg.com/736x/65/23/6d/65236db799b48f72105ee09c048a7703.jpg",
            title: "Coldplay - Music of the Spheres",
            genre: "Pop Rock",
            venue: "Wembley Stadium",
            date: { day: "2", month: "AUG" },
            price: "Rp 1.750.000",
            description:
              "Coldplay’s 'Music of the Spheres' tour lands at Wembley Stadium for a magical night under the stars. With cosmic visuals, interactive LED wristbands, and timeless hits, the band will take the audience on an emotional journey. Sing along to 'Viva La Vida', 'The Scientist', and 'A Sky Full of Stars' in one of the most immersive concert experiences ever created. Coldplay continues to redefine what a live show can be—don’t miss your chance to be part of this interstellar celebration.",
            backDetails: {
              date: "Fri, Aug 2, 2024",
              time: "8:30 PM",
              venue: "Wembley Stadium",
            },
          },
        ],

        upcoming: [
          {
            id: 1,
            image: "https://i.pinimg.com/736x/1b/5d/d1/1b5dd1bdb2656f71678da543a341016d.jpg",
            title: "Red Velvet - R to V Tour",
            genre: "K-Pop",
            venue: "Impact Arena, Bangkok",
            date: { day: "7", month: "SEP" },
            price: "Rp 950.000",
            description:
              "Red Velvet brings their enchanting 'R to V' world tour to Bangkok! Known for their dual concept of sweet and edgy, this K-Pop group will deliver a night full of fan-favorite hits like 'Psycho', 'Feel My Rhythm', and 'Red Flavor'. With stunning visuals, captivating vocals, and synchronized choreography, Irene, Seulgi, Wendy, Joy, and Yeri promise an unforgettable experience for ReVeluvs. The Impact Arena will come alive with energy, colors, and love for Red Velvet’s unique charm. Be there for an electrifying night that celebrates music and joy.",
            backDetails: {
              date: "Sat, Sep 7, 2024",
              time: "7:00 PM",
              venue: "Impact Arena, Bangkok",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/6a/44/e3/6a44e3b81fa49e2358ca6e6b67d67512.jpg",
            title: "Taylor Swift - The Eras Tour",
            genre: "Pop",
            venue: "Sofi Stadium, Los Angeles",
            date: { day: "18", month: "AUG" },
            price: "Rp 2.000.000",
            description:
              "Taylor Swift’s record-breaking 'The Eras Tour' arrives in Los Angeles for a dazzling showcase of her entire musical journey. From the country roots of 'Fearless' to the synth-pop of '1989' and the indie vibes of 'Folklore', fans will experience every era live on stage. With costume changes, stunning visuals, and powerful storytelling, Taylor connects with her audience like no one else. Sofi Stadium transforms into a Swiftie wonderland in a show that spans 3+ hours of pure emotion and excitement. This concert is a love letter to every chapter of her career.",
            backDetails: {
              date: "Sun, Aug 18, 2024",
              time: "6:00 PM",
              venue: "Sofi Stadium, Los Angeles",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/34/a3/a1/34a3a138ec6010d69c05d9d99f703f36.jpg",
            title: "IU - H.E.R World Tour",
            genre: "K-Pop / Ballad",
            venue: "Taipei Arena",
            date: { day: "12", month: "JUL" },
            price: "Rp 1.100.000",
            description:
              "Korean soloist IU brings her heartfelt 'H.E.R' world tour to the Taipei Arena. Known for her angelic voice and emotional ballads like 'Love Poem' and 'Through the Night', IU delivers an intimate concert filled with storytelling and warmth. Fans can expect stunning live vocals, gentle stage production, and a personal connection that makes her concerts so special. With a mix of pop, R&B, and acoustic sounds, this is a must-see show for anyone who loves music with soul. A night of emotions, memories, and pure artistry awaits.",
            backDetails: {
              date: "Fri, Jul 12, 2024",
              time: "7:30 PM",
              venue: "Taipei Arena",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5a/2f/cc/5a2fcc087ef912223be6a2b17e8ae33c.jpg",
            title: "New Jeans - 2024 World Tour",
            genre: "K-Pop",
            venue: "Jamsil Indoor Stadium",
            date: { day: "28", month: "JUN" },
            price: "Rp 850.000",
            description:
              "The fresh faces of K-Pop, New Jeans, take their first-ever world tour to Seoul! Performing live at the Jamsil Indoor Stadium, the girls will bring vibrant energy, Y2K fashion, and chart-topping tracks like 'Hype Boy' and 'Super Shy'. Known for their youthful charm and fun choreography, New Jeans creates a concert full of interaction, positivity, and high vibes. Fans will be treated to catchy tunes and adorable stage presence from start to finish. Join the movement and dance the night away with New Jeans!",
            backDetails: {
              date: "Fri, Jun 28, 2024",
              time: "6:30 PM",
              venue: "Jamsil Indoor Stadium",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/25/ea/d4/25ead43ae86599f8a7af105262b3f903.jpg",
            title: "Coldplay - Music of the Spheres World Tour",
            genre: "Pop Rock",
            venue: "Seoul Olympic Stadium",
            date: { day: "21", month: "JUL" },
            price: "Rp 1.750.000",
            description:
              "Coldplay brings their mesmerizing 'Music of the Spheres' World Tour to Seoul! Get ready for a night filled with emotional anthems, cosmic visuals, and immersive light shows. From classics like 'Fix You' and 'Yellow' to recent hits like 'My Universe,' this show promises an unforgettable experience. Fans will wear LED wristbands that sync with the music, turning the stadium into a sea of colors. Chris Martin and the band are set to deliver a heartfelt performance that celebrates unity, love, and the power of music. A once-in-a-lifetime concert you won’t want to miss.",
            backDetails: {
              date: "Sun, Jul 21, 2024",
              time: "7:00 PM",
              venue: "Seoul Olympic Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/69/0f/03/690f03b59d98d9f7bebca87859885b8f.jpg",
            title: "The 1975 - At Their Very Best Tour",
            genre: "Indie Rock",
            venue: "O2 Arena London",
            date: { day: "15", month: "SEP" },
            price: "Rp 1.200.000",
            description:
              "British band The 1975 returns to the stage with their electrifying ‘At Their Very Best’ tour. Known for their eclectic sound and visually stunning performances, they’re set to light up the O2 Arena with fan favorites like 'Somebody Else' and 'Love It If We Made It'. Expect a mix of emotion, energy, and unforgettable indie rock anthems. With Matty Healy's charismatic stage presence and genre-blending music, this concert is a must-see for fans new and old. Don’t miss this vibrant night in London!",
            backDetails: {
              date: "Sun, Sep 15, 2024",
              time: "8:00 PM",
              venue: "O2 Arena London",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/d1/49/34/d149346b0a65ff1292b8d5a5632317df.jpg",
            title: "LE SSERAFIM - 1st Tour 'Flame Rises'",
            genre: "K-Pop",
            venue: "KSPO Dome",
            date: { day: "19", month: "AUG" },
            price: "Rp 900.000",
            description:
              "Join LE SSERAFIM as they embark on their powerful first world tour, 'Flame Rises'! With bold choreography, stunning visuals, and high-energy performances, this K-Pop girl group is ready to set the stage on fire. Fans can expect to see dynamic hits like 'Antifragile' and 'Fearless' live for the first time. Taking place at the iconic KSPO Dome, the concert promises an unforgettable night of music, emotion, and connection. Be part of LE SSERAFIM’s global journey and feel the flames of their rising fame!",
            backDetails: {
              date: "Mon, Aug 19, 2024",
              time: "7:30 PM",
              venue: "KSPO Dome",
            },
          },
          {
            id: 8,
            image: "https://about.vidio.com/wp-content/uploads/2022/09/Blog_Noah-1.jpg",
            title: "NOAH - The Final Chapter",
            genre: "Pop Rock",
            venue: "Stadion GBK, Jakarta",
            date: { day: "16", month: "NOV" },
            price: "Rp 500.000",
            description:
              "NOAH, one of Indonesia’s most legendary bands, presents their final chapter in an emotional farewell concert. Held at the grand Stadion GBK Jakarta, the event will feature decades of hits including 'Separuh Aku' and 'Bintang di Surga'. This is more than just a performance—it’s a tribute to their musical journey and devoted fans. Don’t miss this historic moment as NOAH takes the stage one last time to celebrate their legacy and bid a heartfelt goodbye to the Indonesian music scene.",
            backDetails: {
              date: "Sat, Nov 16, 2024",
              time: "8:00 PM",
              venue: "Stadion GBK, Jakarta",
            },
          },
          {
            id: 9,
            image: "https://i.pinimg.com/736x/0a/27/61/0a2761ae8902ccd5b35b488d6376811d.jpg",
            title: "IVE - The 1st World Tour 'Show What I Have'",
            genre: "K-Pop",
            venue: "Tokyo Dome",
            date: { day: "10", month: "OCT" },
            price: "Rp 950.000",
            description:
              "K-Pop sensation IVE kicks off their very first world tour, 'Show What I Have', live at Tokyo Dome! With dazzling performances, catchy hits like 'Love Dive' and 'After Like', and jaw-dropping visuals, this concert is set to wow audiences. Known for their charisma and fresh style, IVE invites fans into their musical universe for a night of celebration and connection. Join the wave and witness one of K-Pop’s brightest rising stars take the global stage by storm!",
            backDetails: {
              date: "Thu, Oct 10, 2024",
              time: "6:00 PM",
              venue: "Tokyo Dome",
            },
          },
        ],
      };

      // Function to generate Featured/Upcoming cards (horizontal scroll layout)
      function generateHorizontalCards(section) {
        const container = document.getElementById(`${section}-scroll`);
        if (!container) return;

        container.innerHTML = "";

        concertData[section].forEach((concert) => {
          const card = document.createElement("div");
          card.className = "concert-card";
          card.innerHTML = `
          <div class="card-inner">
            <div class="card-front">
              <div class="position-relative overflow-hidden">
                <img src="${concert.image}" class="card-img img-fluid" alt="${concert.title}">
                <div class="card-overlay"></div>
                  <div class="genre-badge">
                    <div class="marquee-container">
                      <span class="marquee-text" data-genre="${concert.genre}">${concert.genre}</span>
                    </div>
                  </div>
                <div class="price-badge-bottom">
                  <span class="amount">From ${concert.price}</span>
                </div>
                <div class="card-date-badge">
                  <span class="day">${concert.date.day}</span>
                  <span class="month">${concert.date.month}</span>
                </div>
              </div>
              <div class="card-body">
                <h5 class="card-title">${concert.title}</h5>
                <p class="card-description">${concert.description}</p>
                <div class="card-meta">
                  <span><i class="bi bi-geo-alt-fill"></i> ${concert.venue}</span>
                </div>
              </div>
            </div>
            <div class="card-back">
              <div class="card-back-content">
                <h5 class="mb-3">${concert.title}</h5>
                <div class="card-price mb-3">
                  <span class="from text-muted small">Start from</span>
                  <span class="amount h5">${concert.price}</span>
                </div>
                <div class="card-details small text-muted mb-4">
                  <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-calendar-event me-2"></i>
                    <span>${concert.backDetails.date}</span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-clock me-2"></i>
                    <span>${concert.backDetails.time}</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <i class="bi bi-geo-alt me-2"></i>
                    <span>${concert.backDetails.venue}</span>
                  </div>
                </div>
            <div class="d-flex gap-2">
                  <a href="../user/cart/?add=${concert.id}" >
                    <button class="btn btn-sm btn-action btn-cart" title="Add to Cart">
                     <i class="bi bi-cart-plus"></i>
                    </button>
                  </a>
                  
                  <a href="/Concert/public/detail_concert.html?concertId=${concert.ConcertID}">
                    <button class="btn btn-sm btn-action btn-detail flex-grow-1">
                      <i class="bi bi-info-circle me-1"></i>Details
                    </button>
                  </a>
                  <a href="../user/payment/" >
                   <button class="btn btn-sm btn-action btn-buy" >
                    <i class="bi bi-credit-card me-1"></i> Buy
                   </button>
                  </a>
             </div>
              </div>
            </div>
          </div>
        `;
          container.appendChild(card);
        });
      }

      // Function to generate All Concerts cards with pagination
      // Fungsi untuk generate card untuk All Concerts
      function generateAllConcertsCards(offset = 0, limit = 14, clearContainer = true) {
        const container = document.querySelector(".all-concerts-wrapper");
        if (!container) return;

        if (clearContainer) {
          container.innerHTML = "";
        }

        // Dapatkan subset data yang akan ditampilkan
        const concertsToShow = allConcertsData.slice(offset, offset + limit);

        concertsToShow.forEach((concert) => {
          // Format tanggal untuk ditampilkan di card
          const concertDate = new Date(concert.ConcertDate);
          const day = concertDate.getDate();
          const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
          const month = monthNames[concertDate.getMonth()];

          // Format waktu (HH:MM)
          const timeParts = concert.ConcertTime.split(":");
          const hours = timeParts[0];
          const minutes = timeParts[1];
          const formattedTime = `${hours}:${minutes}`;

          // Format harga dari MinPrice
          const minPrice = concert.MinPrice ? `Rp ${parseInt(concert.MinPrice).toLocaleString("id-ID")}` : "Rp 0";

          // Buat elemen card
          const card = document.createElement("div");
          card.className = "concert-card";
          card.innerHTML = `
        <div class="card-inner">
          <div class="card-front">
            <div class="position-relative overflow-hidden">
              <img src="${concert.ImageURL}" class="card-img img-fluid" alt="${concert.Title}">
              <div class="card-overlay"></div>
              <div class="genre-badge">
                <div class="marquee-container">
                  <span class="marquee-text" data-genre="${concert.Genres}">${concert.Genres}</span>
                </div>
              </div>
              <div class="price-badge-bottom">
                <span class="amount">From ${minPrice}</span>
              </div>
              <div class="card-date-badge">
                <span class="day">${day}</span>
                <span class="month">${month}</span>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title">${concert.Title}</h5>
              <p class="card-description">${concert.Description}</p>
              <div class="card-meta">
                <span><i class="bi bi-geo-alt-fill"></i> ${concert.Venue}, ${concert.City}</span>
              </div>
            </div>
          </div>
          <div class="card-back">
            <div class="card-back-content">
              <h5 class="mb-3">${concert.Title}</h5>
              <div class="card-price mb-3">
                <span class="from text-muted small">Start from</span>
                <span class="amount h5">${minPrice}</span>
              </div>
              <div class="card-details small text-muted mb-4">
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-calendar-event me-2"></i>
                  <span>${concert.ConcertDate}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-clock me-2"></i>
                  <span>${formattedTime}</span>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-geo-alt me-2"></i>
                  <span>${concert.Venue}, ${concert.City}</span>
                </div>
              </div>
              <div class="d-flex gap-2">
                <a href="/Concert/public/detail_concert.html?concertId=${concert.ConcertID}">
                  <button class="btn btn-sm btn-action btn-buy">
                    <i class="bi bi-credit-card me-1"></i> Buy
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      `;
          container.appendChild(card);
        });

        setupCardAnimations();
        setupCardInteractions();
      }

      function replaceWithPagination() {
        const loadMoreContainer = document.querySelector(".text-center.mt-5");
        if (!loadMoreContainer) return;

        // Hitung total page berdasarkan 28 card per page
        const totalPages = Math.ceil(concertData.all.length / 28);

        loadMoreContainer.innerHTML = `
    <nav aria-label="Concerts pagination">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        ${Array.from(
          { length: totalPages },
          (_, i) => `
          <li class="page-item ${i === 0 ? "active" : ""}">
            <a class="page-link" href="#" data-page="${i}">${i + 1}</a>
          </li>
        `
        ).join("")}
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  `;

        // Add click handlers
        document.querySelectorAll(".page-link").forEach((link) => {
          link.addEventListener("click", function (e) {
            e.preventDefault();

            const currentActive = document.querySelector(".pagination .active");
            let currentPage = currentActive ? parseInt(currentActive.textContent) - 1 : 0;

            if (this.textContent === "Previous") {
              if (currentPage > 0) {
                goToPage(currentPage - 1);
              }
            } else if (this.textContent === "Next") {
              goToPage(currentPage + 1);
            } else if (this.dataset.page) {
              goToPage(parseInt(this.dataset.page));
            }
          });
        });
      }

      function goToPage(pageNum) {
        const totalPages = Math.ceil(concertData.all.length / 28);

        // Pastikan pageNum valid
        pageNum = Math.max(0, Math.min(pageNum, totalPages - 1));

        const offset = pageNum * 28;
        generateAllConcertsCards(offset, 28, true);

        // Update active state dan tombol navigasi
        updatePaginationButtons(pageNum, totalPages);

        // Scroll to top
        document.getElementById("all-concerts-section").scrollIntoView({ behavior: "smooth" });
      }

      function updatePaginationButtons(currentPage, totalPages) {
        const pagination = document.querySelector(".pagination");
        if (!pagination) return;

        // Update Previous button
        const prevButton = pagination.querySelector(".page-item:first-child");
        if (currentPage === 0) {
          prevButton.classList.add("disabled");
        } else {
          prevButton.classList.remove("disabled");
        }

        // Update Next button
        const nextButton = pagination.querySelector(".page-item:last-child");
        if (currentPage >= totalPages - 1) {
          nextButton.classList.add("disabled");
        } else {
          nextButton.classList.remove("disabled");
        }

        // Update active page number
        pagination.querySelectorAll(".page-item").forEach((item, index) => {
          // Skip Previous (index 0) and Next (last index) buttons
          if (index > 0 && index < pagination.children.length - 1) {
            if (index - 1 === currentPage) {
              item.classList.add("active");
            } else {
              item.classList.remove("active");
            }
          }
        });
      }

      // Initialize carousel with drag functionality
      const carousel = document.querySelector("#carouselExample");
      const carouselInner = carousel.querySelector(".carousel-inner");
      const bsCarousel = bootstrap.Carousel.getOrCreateInstance(carousel);

      let isMouseDown = false;
      let startX = 0;
      let currentX = 0;
      const threshold = 50;

      carouselInner.addEventListener("mousedown", (e) => {
        e.preventDefault();
        isMouseDown = true;
        startX = e.clientX;
        carouselInner.classList.add("grabbing");
        carouselInner.classList.remove("grab");
      });

      carouselInner.addEventListener("mousemove", (e) => {
        if (!isMouseDown) return;
        currentX = e.clientX;
      });

      carouselInner.addEventListener("mouseup", () => {
        if (!isMouseDown) return;
        isMouseDown = false;
        const delta = currentX - startX;

        if (delta < -threshold) {
          bsCarousel.next();
        } else if (delta > threshold) {
          bsCarousel.prev();
        }

        carouselInner.classList.remove("grabbing");
        carouselInner.classList.add("grab");
      });

      carouselInner.addEventListener("mouseleave", () => {
        isMouseDown = false;
        carouselInner.classList.remove("grabbing");
        carouselInner.classList.add("grab");
      });

      window.addEventListener("load", () => {
        carouselInner.classList.add("grab");
      });

      // Enhanced Music Notes Creation
      function createMusicNotes() {
        const notesContainer = document.getElementById("musicNotes");
        const notes = ["♪", "♫", "♩", "♬"];
        const colors = ["#8a4fff", "#ff6600", "#5e2de0", "#ffcc00"];

        // Create initial notes
        for (let i = 0; i < 4; i++) {
          setTimeout(() => createNote(), i * 1000);
        }

        // Continue creating notes periodically
        setInterval(createNote, 3000);

        function createNote() {
          const note = document.createElement("div");
          note.className = "music-note";
          note.textContent = notes[Math.floor(Math.random() * notes.length)];
          note.style.left = Math.random() * 100 + "vw";
          note.style.top = "100vh";
          note.style.fontSize = 1 + Math.random() * 1.5 + "rem";
          note.style.color = colors[Math.floor(Math.random() * colors.length)];
          note.style.opacity = "0.8";

          // Random animation duration
          const duration = 5 + Math.random() * 30;
          note.style.animation = `floatNote ${duration}s linear forwards`;

          notesContainer.appendChild(note);

          // Remove note after animation completes
          setTimeout(() => {
            note.remove();
          }, duration * 1000);
        }
      }

      // Make navbar change on scroll
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });

      // Fungsi untuk menangani klik tombol keranjang
      function setupCartButtons() {
        document.querySelectorAll(".btn-outline-purple").forEach((button) => {
          button.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;
            const price = card.querySelector(".amount").textContent;

            // Simpan ke localStorage atau tampilkan notifikasi
            alert(`"${title}" telah ditambahkan ke keranjang dengan harga ${price}`);

            // Tambahkan efek visual
            gsap.to(this, {
              scale: 1.5,
              duration: 0.3,
              yoyo: true,
              repeat: 1,
              ease: "power2.out",
            });
          });
        });
      }

      // Panggil fungsi ini di DOMContentLoaded !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
      /*document.addEventListener("DOMContentLoaded", function () {
        // ... kode lainnya ...
        setupCartButtons();
      });*/

      // Scroll indicator
      window.addEventListener("scroll", () => {
        const scrollIndicator = document.querySelector(".scroll-indicator");
        if (window.scrollY > 300) {
          scrollIndicator.classList.add("visible");
        } else {
          scrollIndicator.classList.remove("visible");
        }
      });

      // Horizontal scrolling functions with looping
      function scrollLeft(section) {
        const scrollWrapper = document.getElementById(`${section}-scroll`);
        if (scrollWrapper) {
          const firstCard = scrollWrapper.querySelector(".concert-card");
          if (firstCard) {
            const cardWidth = firstCard.offsetWidth + parseInt(window.getComputedStyle(firstCard).marginRight);
            scrollWrapper.scrollBy({
              left: -cardWidth * 3,
              behavior: "smooth",
            });
          }
        }
      }

      function scrollRight(section) {
        const scrollWrapper = document.getElementById(`${section}-scroll`);
        if (scrollWrapper) {
          const firstCard = scrollWrapper.querySelector(".concert-card");
          if (firstCard) {
            const cardWidth = firstCard.offsetWidth + parseInt(window.getComputedStyle(firstCard).marginRight);
            scrollWrapper.scrollBy({
              left: cardWidth * 3,
              behavior: "smooth",
            });
          }
        }
      }

      // Update button visibility berdasarkan posisi scroll
      function updateScrollButtons(section) {
        const wrapper = document.getElementById(`${section}-scroll`);
        const leftBtn = wrapper.parentElement.querySelector(".scroll-button.left");
        const rightBtn = wrapper.parentElement.querySelector(".scroll-button.right");

        if (wrapper.scrollLeft <= 10) {
          leftBtn.style.opacity = "0.5";
          leftBtn.style.pointerEvents = "none";
        } else {
          leftBtn.style.opacity = "0.8";
          leftBtn.style.pointerEvents = "auto";
        }

        if (wrapper.scrollLeft >= wrapper.scrollWidth - wrapper.clientWidth - 10) {
          rightBtn.style.opacity = "0.5";
          rightBtn.style.pointerEvents = "none";
        } else {
          rightBtn.style.opacity = "0.8";
          rightBtn.style.pointerEvents = "auto";
        }
      }

      // Inisialisasi event listeners untuk scroll biasa
      function setupScrollListeners() {
        document.querySelectorAll(".concerts-scroll-wrapper").forEach((wrapper) => {
          wrapper.addEventListener("scroll", function () {
            const section = this.id.replace("-scroll", "");
            updateScrollButtons(section);
          });
        });
      }

      // Fungsi untuk setup tombol interaksi
      function setupCardInteractions() {
        // Tombol keranjang
        document.querySelectorAll(".btn-cart").forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;

            // Animasi
            gsap.to(this, {
              scale: 1.3,
              duration: 0.2,
              yoyo: true,
              repeat: 1,
              ease: "power1.out",
            });

            // Simpan ke keranjang (contoh)
            console.log(`Added to cart: ${title}`);
            // alert(`"${title}" ditambahkan ke keranjang`);
          });
        });

        // Tombol detail
        document.querySelectorAll(".btn-buy").forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;
            console.log(`View details: ${title}`);
            // alert(`Menampilkan detail untuk: ${title}`);
          });
        });

        // Tombol beli
        document.querySelectorAll(".btn-buy").forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;
            console.log(`Buy now: ${title}`);
            // alert(`Membeli tiket: ${title}`);
          });
        });
      }

      // Initialize with cloned cards for infinite loop effect
      function initializeInfiniteScroll(section) {
        const wrapper = document.getElementById(`${section}-scroll`);
        if (!wrapper) return;

        // Clone first few cards and append to end
        const cards = wrapper.querySelectorAll(".concert-card");
        const cardsToClone = Math.min(0, cards.length);

        for (let i = 0; i < cardsToClone; i++) {
          const clone = cards[i].cloneNode(true);
          wrapper.appendChild(clone);
        }

        // Clone last few cards and prepend to start
        for (let i = cards.length - 1; i >= Math.max(cards.length - 0, 0); i--) {
          const clone = cards[i].cloneNode(true);
          wrapper.insertBefore(clone, wrapper.firstChild);
        }

        // Scroll to the first original card
        setTimeout(() => {
          const firstOriginalCard = wrapper.querySelectorAll(".concert-card")[cardsToClone];
          if (firstOriginalCard) {
            wrapper.scrollLeft = firstOriginalCard.offsetLeft - 20;
          }
        }, 100);

        const leftBtn = wrapper.parentElement.querySelector(".scroll-button.left");
        const rightBtn = wrapper.parentElement.querySelector(".scroll-button.right");

        // Update button visibility
        function updateButtons() {
          // Always show buttons for infinite scroll
          if (leftBtn) leftBtn.style.display = "flex";
          if (rightBtn) rightBtn.style.display = "flex";
        }

        // Initial check
        updateButtons();

        // Add scroll event
        wrapper.addEventListener("scroll", function () {
          // Check if we need to loop (near start)
          if (wrapper.scrollLeft < 10) {
            setTimeout(() => {
              wrapper.scrollLeft = wrapper.scrollWidth - wrapper.clientWidth - 20;
            }, 50);
          }
          // Check if we need to loop (near end)
          else if (wrapper.scrollLeft > wrapper.scrollWidth - wrapper.clientWidth - 10) {
            setTimeout(() => {
              wrapper.scrollLeft = 20;
            }, 50);
          }

          updateButtons();
        });
      }

      // Add click event listeners to all scroll buttons
      function setupScrollButtons() {
        document.querySelectorAll(".concerts-scroll-container").forEach((container) => {
          const wrapper = container.querySelector(".concerts-scroll-wrapper");
          const leftBtn = container.querySelector(".scroll-button.left");
          const rightBtn = container.querySelector(".scroll-button.right");

          function updateButtons() {
            // Disable left button jika di awal
            if (wrapper.scrollLeft <= 10) {
              leftBtn.classList.add("disabled");
            } else {
              leftBtn.classList.remove("disabled");
            }

            // Disable right button jika di akhir
            if (wrapper.scrollLeft >= wrapper.scrollWidth - wrapper.clientWidth - 10) {
              rightBtn.classList.add("disabled");
            } else {
              rightBtn.classList.remove("disabled");
            }
          }

          // Initial check
          updateButtons();

          // Scroll event
          wrapper.addEventListener("scroll", updateButtons);

          // Button events
          leftBtn.addEventListener("click", () => {
            wrapper.scrollBy({ left: -300, behavior: "smooth" });
          });

          rightBtn.addEventListener("click", () => {
            wrapper.scrollBy({ left: 300, behavior: "smooth" });
          });
        });
      }

      // Enhanced card hover effects
      function setupCardHoverEffects() {
        document.querySelectorAll(".concert-card").forEach((card) => {
          card.addEventListener("mouseenter", () => {
            gsap.to(card, {
              scale: 1.03,
              boxShadow: "0 15px 30px rgba(138, 79, 255, 0.3)",
              duration: 0.3,
              ease: "power2.out",
            });
          });

          card.addEventListener("mouseleave", () => {
            gsap.to(card, {
              scale: 1,
              boxShadow: "0 10px 20px rgba(0, 0, 0, 0.1)",
              duration: 0.3,
              ease: "power2.out",
            });
          });
        });
      }
      // Animate elements when they come into view
      function setupScrollAnimations() {
        const sections = document.querySelectorAll("section");

        sections.forEach((section) => {
          gsap.to(section, {
            scrollTrigger: {
              trigger: section,
              start: "top 80%",
              toggleActions: "play none none none",
            },
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
          });
        });
      }

      // Add floating elements to hero section
      function addHeroDecorations() {
        const hero = document.querySelector(".hero");
        if (!hero) return;

        const symbols = ["♪", "♫", "♩", "♬"];
        const colors = ["#8a4fff", "#ff6600", "#5e2de0", "#ffcc00"];

        for (let i = 0; i < 8; i++) {
          const element = document.createElement("div");
          element.className = "floating-hero-element";
          element.textContent = symbols[Math.floor(Math.random() * symbols.length)];
          element.style.color = colors[Math.floor(Math.random() * colors.length)];
          element.style.fontSize = 1.5 + Math.random() * 2 + "rem";
          element.style.left = Math.random() * 100 + "%";
          element.style.top = Math.random() * 100 + "%";
          element.style.animationDuration = 10 + Math.random() * 20 + "s";
          element.style.animationDelay = Math.random() * 5 + "s";
          hero.appendChild(element);
        }
      }

      // Fungsi untuk toggle offcanvas
      function setupOffcanvas() {
        const offcanvasElement = document.getElementById("sidebarMenu");
        if (offcanvasElement) {
          if (!bootstrap.Offcanvas.getInstance(offcanvasElement)) {
            new bootstrap.Offcanvas(offcanvasElement);
          }
        }
      }
      // Gunakan satu fungsi animasi yang optimal untuk semua card
      function setupCardAnimations() {
        // Optimasi performa
        gsap.utils.toArray(".concert-card").forEach((card) => {
          card.style.willChange = "transform, opacity, filter";
          card.style.backfaceVisibility = "hidden"; // Untuk performa transform 3D
        });

        // Animasi yang lebih menarik untuk semua card
        gsap.utils.toArray(".concert-card").forEach((card, i) => {
          // Atur state awal
          gsap.set(card, {
            opacity: 0,
            y: 50,
            rotationY: 15,
            scale: 0.9,
            filter: "blur(2px)",
          });

          // Animasi masuk
          gsap.to(card, {
            opacity: 1,
            y: 0,
            rotationY: 0,
            scale: 1,
            filter: "blur(0px)",
            duration: 0.8,
            delay: i * 0.07,
            ease: "back.out(1.2)",
            scrollTrigger: {
              trigger: card.closest("section"),
              start: "top 85%",
              toggleActions: "play none none none",
              markers: false,
            },
            onComplete: () => {
              card.style.willChange = "auto";
            },
          });

          // Efek hover yang lebih menarik
          card.addEventListener("mouseenter", () => {
            gsap.to(card, {
              scale: 1.05,
              y: -5,
              rotationY: 5,
              boxShadow: "0 15px 30px rgba(138, 79, 255, 0.4)",
              duration: 0.3,
            });
          });

          card.addEventListener("mouseleave", () => {
            gsap.to(card, {
              scale: 1,
              y: 0,
              rotationY: 0,
              boxShadow: "0 10px 20px rgba(0, 0, 0, 0.1)",
              duration: 0.3,
            });
          });
        });
      }

      // Handle search form submission
      document.getElementById("searchForm")?.addEventListener("submit", function (e) {
        e.preventDefault();
        const query = document.getElementById("searchInput").value.trim();
        if (query) {
          window.location.href = `events/search.php?q=${encodeURIComponent(query)}`;
        }
      });

      // TAMBAHKAN fungsi WebP detection
      function checkWebPSupport() {
        const elem = document.createElement("canvas");
        if (elem.getContext?.("2d")) {
          document.body.classList.add(elem.toDataURL("image/webp").indexOf("data:image/webp") === 0 ? "webp" : "no-webp");
        }
      }

      // Awal dari file JavaScript kamu

      document.addEventListener("DOMContentLoaded", function () {
        loadAllConcerts();

        // Inisialisasi Bootstrap
        if (typeof bootstrap === "undefined") {
          const script = document.createElement("script");
          script.src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js";
          document.body.appendChild(script);
        }

        // Generate card
        generateHorizontalCards("featured");
        generateHorizontalCards("upcoming");
        generateAllConcertsCards(0, 14, true);

        // Setup fungsi lainnya
        setupCartButtons(); // PANGGIL DI SINI
        setupCardInteractions();
        setupScrollButtons();
        createMusicNotes();
        setupOffcanvas();
        setupCardAnimations(); // Gunakan satu fungsi animasi

        // Event listener untuk link offcanvas (INI YANG KITA MODIFIKASI)
        const offcanvasElement = document.getElementById("sidebarMenu"); // Pastikan sidebarMenu ada di HTML

        if (offcanvasElement) {
          const offcanvasLinks = offcanvasElement.querySelectorAll(".offcanvas-body a.nav-link"); // Atau hanya '.offcanvas-body a' jika semua link di sana adalah nav-link

          offcanvasLinks.forEach((link) => {
            link.addEventListener("click", function (event) {
              const href = this.getAttribute("href");

              // Tutup offcanvas terlebih dahulu
              const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
              if (offcanvasInstance) {
                offcanvasInstance.hide();
              }

              // Cek apakah link ini adalah link internal ke sebuah section
              if (href && href.startsWith("#") && href.length > 1) {
                event.preventDefault(); // Mencegah navigasi browser default

                const targetElement = document.querySelector(href);
                if (targetElement) {
                  window.setTimeout(() => {
                    targetElement.scrollIntoView({ behavior: "smooth" });
                    window.history.pushState(null, "", href); // Opsional
                  }, 300);
                }
              }
              // Jika bukan link internal, biarkan default browser berjalan.
            });
          });
        }

        // Navbar toggler
        const navbarToggler = document.querySelector(".navbar-toggler");
        const navbarCollapse = document.querySelector(".navbar-collapse");
        if (navbarToggler && navbarCollapse) {
          navbarToggler.addEventListener("click", function () {
            navbarCollapse.classList.toggle("show");
          });
        }

        // Event listener untuk tombol "Load More"
        document.querySelector(".btn-load-more")?.addEventListener("click", function () {
          const currentCards = document.querySelectorAll(".all-concerts-wrapper .concert-card").length;
          const nextOffset = currentCards;

          // Tampilkan 14 data berikutnya
          generateAllConcertsCards(nextOffset, 14, false);

          // Jika sudah menampilkan semua data, ganti dengan pagination
          if (currentCards + 14 >= allConcertsData.length) {
            replaceWithPagination();
          }
        });

        checkWebPSupport(); // PANGGIL DI SINI

        // ... tambahkan kode lain yang mungkin ada di filemu yang tidak ditampilkan ...
      }); // ---- AKHIR DARI SATU-SATUNYA BLOK DOMContentLoaded ----
    </script>
  </body>
</html>
