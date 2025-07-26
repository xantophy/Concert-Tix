<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="shortcut icon" href="../assets/images/logo_1.png" type="image/x-icon" />
    <title>Search Concerts - ConcertTix</title>

    <!-- Bootstrap CSS & Icons -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /></noscript>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>

    <style>
      /* VARIABLES */
      /* VARIABLES */
      :root {
        --primary-purple: #8a4fff;
        --primary-orange: #ff6600;
        --gradient-purple: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        --text-dark: #333;
        --text-light: #f8f9fa;
        --background-light: #f5f0ff;
        --background-white: #ffffff;
        --border-light: rgba(138, 79, 255, 0.2);
        --shadow-soft: 0 10px 30px rgba(138, 79, 255, 0.1);
        --shadow-medium: 0 5px 15px rgba(138, 79, 255, 0.2);
        --navbar-padding-x: 1.5rem;
      }

      /* BASE STYLES */
      body {
        background: linear-gradient(to bottom, #f5f0ff 0%, #ffffff 100%);
        overflow-x: hidden;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      /* Base container adjustments */
      .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
      }

      @media (min-width: 768px) {
        .container-fluid {
          padding-left: 2rem;
          padding-right: 2rem;
        }
      }

      /* Filter sidebar adjustments */
      @media (max-width: 991.98px) {
        .search-filters.sticky-top {
          position: static;
          max-height: none;
          margin-bottom: 20px;
        }
      }

      /* Grid layout adjustments */
      .search-results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 12px;
        padding: 0;
      }

      @media (min-width: 576px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }
      }

      @media (min-width: 768px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
      }

      @media (min-width: 992px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
      }

      @media (min-width: 1200px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }
      }

      /* Card adjustments */
      .concert-card {
        width: 100%;
        height: auto;
        min-height: 360px;
      }

      @media (min-width: 576px) {
        .concert-card {
          min-height: 380px;
        }
      }

      .card-img {
        height: 180px;
      }

      @media (min-width: 576px) {
        .card-img {
          height: 200px;
        }
      }

      @media (min-width: 768px) {
        .card-img {
          height: 220px;
        }
      }

      @media (min-width: 992px) {
        .card-img {
          height: 230px;
        }
      }

      /* Text adjustments for mobile */
      .card-title {
        font-size: 0.9rem;
      }

      .card-description {
        font-size: 0.7rem;
        -webkit-line-clamp: 2;
      }

      @media (min-width: 576px) {
        .card-title {
          font-size: 1rem;
        }

        .card-description {
          font-size: 0.72rem;
        }
      }

      /* Navbar adjustments for mobile */
      @media (max-width: 767.98px) {
        .navbar-brand {
          font-size: 1.4rem !important;
        }

        .navbar .container {
          flex-wrap: nowrap;
          padding-left: 0.5rem;
          padding-right: 0.5rem;
        }

        .navbar-toggler {
          margin-right: 0.5rem !important;
        }

        .input-group {
          width: 100%;
        }

        #searchInput {
          font-size: 0.9rem;
        }
      }

      /* Better mobile menu */
      .offcanvas-start {
        width: 280px;
      }

      @media (max-width: 575.98px) {
        .offcanvas-start {
          width: 85%;
        }
      }

      /* Pagination adjustments */
      .pagination {
        flex-wrap: wrap;
      }

      .page-item .page-link {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
        margin: 2px;
      }

      @media (min-width: 576px) {
        .page-item .page-link {
          width: 40px;
          height: 40px;
          margin: 0 3px;
        }
      }

      @media (min-width: 768px) {
        .page-item .page-link {
          margin: 0 5px;
        }
      }
      @media (min-width: 992px) {
        .col-lg-2 {
          flex: 0 0 220px; /* Lebar filter lebih kecil */
          max-width: 220px;
        }

        .col-lg-10 {
          flex: 0 0 calc(100% - 220px);
          max-width: calc(100% - 220px);
        }

        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); /* Lebarkan card sedikit */
          gap: 10px;
          row-gap: 20px;
        }
      }

      /* Untuk layar sangat lebar */
      @media (min-width: 1600px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }
      }
      /* Wider container */
      .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
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

      /* Offcanvas menu styles */
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
      /* Navbar brand */
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

      /* Cart & Account Buttons */
      .navbar .btn-outline-secondary {
        border-color: rgba(255, 255, 255, 0.5);
        color: rgba(255, 255, 255, 0.8);
        background: transparent;
        position: relative;
        transition: all 0.3s ease;
      }

      .navbar .btn-outline-secondary:hover {
        border-color: white;
        color: white;
        background: rgba(255, 255, 255, 0.1);
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

      /* Ikon search di navbar ungu (scrolled) */
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

      .navbar.scrolled .btn-purple-gradient {
        background: var(--primary-orange);
        color: white;
      }

      .navbar.scrolled .btn-purple-gradient:hover {
        background: #ff5500;
        color: white;
        box-shadow: 0 4px 15px rgba(255, 102, 0, 0.3);
      }

      .btn-outline-purple {
        color: #8a4fff;
        border-color: #8a4fff;
        transition: all 0.3s ease;
      }

      .btn-outline-purple:hover {
        background: #8a4fff;
        color: white;
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

      /* Hover effect for gradient button */
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

        .navbar .input-group {
          width: 100%;
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
      }

      /* Navbar toggler */
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

      .navbar.scrolled .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      /* Search Page Specific Styles */
      .search-hero {
        padding: 80px 0 40px;
        text-align: center;
        background: linear-gradient(to bottom, rgba(138, 79, 255, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
      }

      .search-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        background: linear-gradient(90deg, #8a4fff, #ff6600);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
      }

      .search-results-count {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
      }

      /* Search Filters */
      .search-filters {
        z-index: 990;
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
      }

      .filter-group {
        margin-bottom: 20px;
      }

      .filter-group h5 {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
      }

      .filter-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
      }

      .filter-btn {
        padding: 8px 15px;
        background: #f5f0ff;
        border: none;
        border-radius: 20px;
        color: #8a4fff;
        font-size: 0.9rem;
        transition: all 0.3s ease;
      }

      .filter-btn:hover,
      .filter-btn.active {
        background: var(--primary-purple);
        color: white;
      }

      .price-range-slider {
        width: 100%;
        margin-top: 15px;
      }

      .price-range-values {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 0.9rem;
        color: #666;
      }

      /* Search Results */
      .search-results-container {
        display: flex;
        flex-direction: column;
      }

      /* Using exact same card style as fixed landing page */
      .search-results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(224px, 1fr));
        gap: 10px;
        row-gap: 20px;
        justify-content: center;
        padding: 0;
      }

      .search-filters.sticky-top {
        z-index: 990;
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        position: -webkit-sticky; /* Untuk browser Safari */
        position: sticky;
        top: 80px; /* Sesuaikan dengan tinggi navbar */
        max-height: calc(100vh - 100px); /* Tinggi maksimum */
        overflow-y: auto; /* Enable scroll jika konten terlalu panjang */
      }

      /* Untuk menghilangkan scrollbar yang tidak perlu */
      .search-filters.sticky-top::-webkit-scrollbar {
        width: 5px;
      }

      .search-filters.sticky-top::-webkit-scrollbar-thumb {
        background-color: rgba(138, 79, 255, 0.3);
        border-radius: 10px;
      }

      .search-filters.sticky-top::-webkit-scrollbar-track {
        background-color: rgba(138, 79, 255, 0.1);
      }

      @media (min-width: 992px) {
        .col-lg-3 {
          flex: 0 0 280px; /* Lebar tetap 280px */
          max-width: 280px;
        }

        .col-lg-9 {
          flex: 0 0 calc(100% - 280px);
          max-width: calc(100% - 280px);
        }
      }

      .concert-card {
        width: 224px;
        height: 360px;
        margin-right: 0;
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
      /* Genre badge styles */
      .genre-badge {
        position: absolute;
        bottom: 0px;
        left: 0px;
        right: 0;
        z-index: 2;
        background: linear-gradient(135deg, #8a4fffad, #ff6600b7);
        color: white;
        padding: 4px 10px;
        border-radius: 0px;
        font-size: 0.8rem;
        max-width: 100%;
        overflow: hidden;
        white-space: nowrap;
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

      @keyframes marquee {
        0% {
          transform: translateX(0);
        }
        100% {
          transform: translateX(-100%);
        }
      }

      /* Hover effect for marquee text */
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
      /* Price badge */
      .price-badge-bottom {
        position: absolute;
        top: 0;
        right: 0;
        left: 40%;
        background: linear-gradient(135deg, #8a4fffad, #ff6600b7);
        color: white;
        padding: 6px 12px;
        border-radius: 0 0 0 30px;
        font-size: 0.8rem;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        clip-path: polygon(15% 100%, 100% 100%, 100% 0, 0 0);
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
      /* Button styles */
      .btn-action {
        transition: all 0.3s ease;
      }

      .btn-detail {
        background-color: white;
        color: var(--primary-purple);
        border: 1px solid rgba(138, 79, 255, 0.3);
      }

      .btn-detail:hover {
        background-color: rgba(138, 79, 255, 0.05);
        border-color: rgba(138, 79, 255, 0.5);
      }

      .btn-buy {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;

        box-shadow: 0 2px 5px rgba(138, 79, 255, 0.3);
        border: none;
      }

      .btn-buy:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(138, 79, 255, 0.4);
        background: linear-gradient(135deg, #7a3fef 0%, #4e1dd0 100%);
      }

      .card-price {
        margin: 10px 0;
      }

      .card-price .from {
        display: block;
        font-size: 0.8rem;
        color: #666;
      }

      .card-price .amount {
        font-size: 1.3rem;
        font-weight: 700;
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

      .btn-buy-now {
        background: linear-gradient(135deg, #8a4fff 0%, #5e2de0 100%);
        color: white;
        border: none;
        padding: 6px 20px;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 10px;
        font-size: 0.9rem;
      }

      .btn-buy-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(138, 79, 255, 0.4);
      }
      /* Animations for btn navbr */
      @keyframes floatLink {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-2px);
        }
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

      @keyframes float {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-5px);
        }
      }

      /* Apply animations */
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

      /* Animations for cards */
      @keyframes cardEntrance {
        from {
          opacity: 0;
          transform: translateY(50px) rotateY(15deg);
          filter: blur(2px);
        }
        to {
          opacity: 1;
          transform: translateY(0) rotateY(0);
          filter: blur(0);
        }
      }

      /* Pagination */
      .pagination {
        margin-top: 40px;
        width: 100%;
        display: flex;
        justify-content: center;
      }

      .page-item .page-link {
        color: var(--primary-purple);
        border: none;
        margin: 0 5px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
      }

      .page-item.active .page-link {
        background: var(--primary-purple);
        color: white;
      }

      .page-item:not(.active) .page-link:hover {
        background: rgba(138, 79, 255, 0.1);
      }

      .page-item.disabled .page-link {
        color: #dee2e6;
      }

      /* Scroll to top indicator */
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

      /* Responsive Adjustments */
      @media (max-width: 1200px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }
      }

      @media (max-width: 992px) {
        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }
      }

      @media (max-width: 768px) {
        .search-hero {
          padding: 60px 0 30px;
        }

        .search-hero h1 {
          font-size: 2rem;
        }

        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
          gap: 10px;
          row-gap: 20px;
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

        .pagination {
          margin-top: 30px;
        }
      }

      @media (max-width: 576px) {
        .search-hero {
          padding: 40px 0 20px;
        }

        .search-hero h1 {
          font-size: 1.8rem;
        }

        .search-results-grid {
          grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
          gap: 10px;
          row-gap: 20px;
        }

        .concert-card {
          width: 100%;
          max-width: 280px;
          height: auto;
          margin: 0 auto 20px;
        }

        .card-img {
          height: 180px;
        }

        .card-body {
          height: auto;
          padding: 15px;
        }

        .pagination {
          margin-top: 20px;
        }

        .page-item .page-link {
          width: 35px;
          height: 35px;
          margin: 0 3px;
        }
      }
      /* Footer styles */
      footer {
        background: linear-gradient(to bottom, #f9f5ff 0%, #ffffff 100%);
        padding: 2rem 0;
        margin-top: 3rem;
        border-top: 1px solid var(--border-light);
      }

      .footer-link {
        transition: all 0.3s ease;
        display: inline-block;
        color: var(--text-dark);
        text-decoration: none;
      }

      .footer-link:hover {
        color: var(--primary-purple) !important;
        transform: translateX(5px);
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
      /* Wave Background */
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
    </style>
  </head>
  <body>
    <!-- Scroll to top indicator -->
    <div class="scroll-indicator" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
      <i class="bi bi-arrow-up"></i>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-1" id="mainNavbar">
      <div class="container">
        <!-- Hamburger Menu Button -->
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
          <form class="w-100 position-relative" role="search" id="searchForm">
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
          <a href="../user/cart/" class="btn btn-sm btn-outline-secondary d-none d-md-flex align-items-center" style="border-radius: 50px; padding: 0.5rem 0.9rem">
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
            <a href="../user/cart/" class="nav-link d-flex align-items-center py-2" href="generate search page update.html"> <i class="bi bi-cart2 me-3 fs-5" style="color: #8a4fff"></i> Cart </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="#all-concerts-section" data-bs-dismiss="offcanvas"> <i class="bi bi-ticket-perforated me-3 fs-5" style="color: #8a4fff"></i> Concert </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center py-2" href="../public/events/"> <i class="bi bi-music-note-list me-3 fs-5" style="color: #8a4fff"></i> Genre </a>
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

    <!-- Search Hero Section -->
    <!-- Search Hero Section -->
    <section class="search-hero">
      <div class="container">
        <h1>Search Results</h1>
        <p class="search-results-count">28 concerts found for "Arctic Monkeys"</p>
      </div>
    </section>

    <!-- Main Content -->
    <main class="container-fluid mb-5 px-4 px-lg-5">
      <div class="row gx-4">
        <!-- Filters Column -->
        <aside class="col-lg-3 mb-4 mb-lg-0">
          <!-- Ubah dari col-lg-3 ke col-lg-2 -->
          <div class="search-filters sticky-top" style="top: 80px; max-height: calc(100vh - 100px); overflow-y: auto">
            <div class="filter-group">
              <h5>Genre</h5>
              <div class="filter-options">
                <button class="filter-btn">Rock</button>
                <button class="filter-btn active">Hip Hop</button>
                <button class="filter-btn">EDM</button>
                <button class="filter-btn">Pop</button>
                <button class="filter-btn active">K-Pop</button>
                <button class="filter-btn">Jazz</button>
                <button class="filter-btn">clasic</button>
                <button class="filter-btn">Indie</button>
              </div>
            </div>

            <div class="filter-group">
              <h5>Date</h5>
              <div class="filter-options">
                <button class="filter-btn">Any date</button>
                <button class="filter-btn">Today</button>
                <button class="filter-btn">This week</button>
                <button class="filter-btn">This month</button>
              </div>
            </div>

            <div class="filter-group">
              <h5>Price Range</h5>
              <input type="range" class="price-range-slider" min="0" max="5000000" step="50000" value="2500000" />
              <div class="price-range-values">
                <span>Rp 0</span>
                <span>Rp 5.000.000</span>
              </div>
            </div>

            <div class="filter-group">
              <h5>Location</h5>
              <div class="filter-options">
                <button class="filter-btn">Jakarta</button>
                <button class="filter-btn">Bandung</button>
                <button class="filter-btn">Surabaya</button>
                <button class="filter-btn">Bali</button>
              </div>
            </div>

            <button class="btn btn-purple-gradient w-100 mt-3">Apply Filters</button>
            <button class="btn btn-outline-purple w-100 mt-2">Reset</button>
          </div>
        </aside>

        <!-- Results Column -->
        <div class="col-lg-9">
          <div class="search-results-container">
            <div class="search-results-grid" id="resultsContainer">
              <!-- Cards will be generated by JavaScript -->
            </div>

            <!-- Pagination -->
            <nav aria-label="Search results pagination" class="mt-5" id="paginationContainer">
              <ul class="pagination justify-content-center">
                <!-- Pagination will be generated by JavaScript -->
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </main>

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
                    <a href="../privacy_policy.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
                      <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> Privacy Policy
                    </a>
                  </li>
                  <li>
                    <a href="../tems_of_service.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
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
                    <a href="../faqs.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease"> <i class="bi bi-chevron-right me-2" style="color: #8a4fff"></i> FAQs </a>
                  </li>
                  <li class="mb-2">
                    <a href="../refund_policy.html" class="footer-link text-muted d-flex align-items-center" style="text-decoration: none; transition: all 0.3s ease">
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
              <a href="../privacy_policy.html" class="text-muted small" style="text-decoration: none">Privacy Policy</a>
              <a href="../tems_of_service.html" class="text-muted small" style="text-decoration: none">Terms of Service</a>
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
      // Concert data structure
      const concertData = {
        search: [
          {
            id: 1,
            image: "https://i.pinimg.com/736x/9c/61/dc/9c61dc646178c933c15d50b757c6dd33.jpg",
            title: "Arctic Monkeys World Tour",
            genre: "Indie Rock",
            venue: "Jakarta International Stadium",
            date: { day: "7", month: "JUN" },
            price: "Rp 1.400.000",
            description: "Experience the Arctic Monkeys live in concert with their greatest hits and spectacular stage production.",
            backDetails: {
              date: "Fri, Jun 7, 2024",
              time: "8:30 PM",
              venue: "Jakarta International Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/04/de/32/04de329554d94c92b85b50c24cbad6bc.jpg",
            title: "Arctic Monkeys - The Car Tour",
            genre: "Indie Rock",
            venue: "GBK Stadium",
            date: { day: "15", month: "JUL" },
            price: "Rp 1.800.000",
            description: "Special performance featuring songs from their latest album 'The Car' along with classic hits.",
            backDetails: {
              date: "Mon, Jul 15, 2024",
              time: "9:00 PM",
              venue: "GBK Stadium",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/1d/93/e3/1d93e3f9c30da00791583b8b8d8aee19.jpg",
            title: "Arctic Monkeys - AM Album Night",
            genre: "Indie Rock",
            venue: "ICE BSD",
            date: { day: "22", month: "AUG" },
            price: "Rp 2.500.000",
            description: "Special one-night-only performance of the entire AM album plus other fan favorites.",
            backDetails: {
              date: "Thu, Aug 22, 2024",
              time: "8:00 PM",
              venue: "ICE BSD",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5b/e6/fa/5be6fa96291f009d46402b060d0a6635.jpg",
            title: "Arctic Monkeys - VIP Experience",
            genre: "Indie Rock",
            venue: "The Kasablanka Hall",
            date: { day: "5", month: "SEP" },
            price: "Rp 5.000.000",
            description: "Exclusive VIP package including premium seating, meet & greet, and limited edition merchandise.",
            backDetails: {
              date: "Thu, Sep 5, 2024",
              time: "7:30 PM",
              venue: "The Kasablanka Hall",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/17/22/ab/1722ab4cc73b6ce9d7c90edf5d72ca14.jpg",
            title: "Arctic Monkeys - Tranquility Base Tour",
            genre: "Indie Rock",
            venue: "Beach City International Stadium",
            date: { day: "12", month: "OCT" },
            price: "Rp 1.200.000",
            description: "Experience the psychedelic sounds of Tranquility Base Hotel & Casino performed live.",
            backDetails: {
              date: "Sat, Oct 12, 2024",
              time: "8:00 PM",
              venue: "Beach City International Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/b3/20/9e/b3209e6399e17ada801326c945d9be4a.jpg",
            title: "Arctic Monkeys - Early Years",
            genre: "Indie Rock",
            venue: "Senayan Tennis Indoor",
            date: { day: "19", month: "NOV" },
            price: "Rp 1.600.000",
            description: "A special concert featuring songs from their first two albums performed in an intimate setting.",
            backDetails: {
              date: "Tue, Nov 19, 2024",
              time: "8:30 PM",
              venue: "Senayan Tennis Indoor",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/79/6d/b0/796db0ac0342e28ebbc8d2b82334e925.jpg",
            title: "Arctic Monkeys - Humbug Anniversary",
            genre: "Indie Rock",
            venue: "Jakarta Convention Center",
            date: { day: "3", month: "DEC" },
            price: "Rp 1.900.000",
            description: "Celebrating the anniversary of their third studio album Humbug with a special performance.",
            backDetails: {
              date: "Tue, Dec 3, 2024",
              time: "8:00 PM",
              venue: "Jakarta Convention Center",
            },
          },
          {
            id: 1,
            image: "https://i.pinimg.com/736x/9c/61/dc/9c61dc646178c933c15d50b757c6dd33.jpg",
            title: "Arctic Monkeys World Tour",
            genre: "Indie Rock",
            venue: "Jakarta International Stadium",
            date: { day: "7", month: "JUN" },
            price: "Rp 1.400.000",
            description: "Experience the Arctic Monkeys live in concert with their greatest hits and spectacular stage production.",
            backDetails: {
              date: "Fri, Jun 7, 2024",
              time: "8:30 PM",
              venue: "Jakarta International Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/04/de/32/04de329554d94c92b85b50c24cbad6bc.jpg",
            title: "Arctic Monkeys - The Car Tour",
            genre: "Indie Rock",
            venue: "GBK Stadium",
            date: { day: "15", month: "JUL" },
            price: "Rp 1.800.000",
            description: "Special performance featuring songs from their latest album 'The Car' along with classic hits.",
            backDetails: {
              date: "Mon, Jul 15, 2024",
              time: "9:00 PM",
              venue: "GBK Stadium",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/1d/93/e3/1d93e3f9c30da00791583b8b8d8aee19.jpg",
            title: "Arctic Monkeys - AM Album Night",
            genre: "Indie Rock",
            venue: "ICE BSD",
            date: { day: "22", month: "AUG" },
            price: "Rp 2.500.000",
            description: "Special one-night-only performance of the entire AM album plus other fan favorites.",
            backDetails: {
              date: "Thu, Aug 22, 2024",
              time: "8:00 PM",
              venue: "ICE BSD",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5b/e6/fa/5be6fa96291f009d46402b060d0a6635.jpg",
            title: "Arctic Monkeys - VIP Experience",
            genre: "Indie Rock",
            venue: "The Kasablanka Hall",
            date: { day: "5", month: "SEP" },
            price: "Rp 5.000.000",
            description: "Exclusive VIP package including premium seating, meet & greet, and limited edition merchandise.",
            backDetails: {
              date: "Thu, Sep 5, 2024",
              time: "7:30 PM",
              venue: "The Kasablanka Hall",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/17/22/ab/1722ab4cc73b6ce9d7c90edf5d72ca14.jpg",
            title: "Arctic Monkeys - Tranquility Base Tour",
            genre: "Indie Rock",
            venue: "Beach City International Stadium",
            date: { day: "12", month: "OCT" },
            price: "Rp 1.200.000",
            description: "Experience the psychedelic sounds of Tranquility Base Hotel & Casino performed live.",
            backDetails: {
              date: "Sat, Oct 12, 2024",
              time: "8:00 PM",
              venue: "Beach City International Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/b3/20/9e/b3209e6399e17ada801326c945d9be4a.jpg",
            title: "Arctic Monkeys - Early Years",
            genre: "Indie Rock",
            venue: "Senayan Tennis Indoor",
            date: { day: "19", month: "NOV" },
            price: "Rp 1.600.000",
            description: "A special concert featuring songs from their first two albums performed in an intimate setting.",
            backDetails: {
              date: "Tue, Nov 19, 2024",
              time: "8:30 PM",
              venue: "Senayan Tennis Indoor",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/79/6d/b0/796db0ac0342e28ebbc8d2b82334e925.jpg",
            title: "Arctic Monkeys - Humbug Anniversary",
            genre: "Indie Rock",
            venue: "Jakarta Convention Center",
            date: { day: "3", month: "DEC" },
            price: "Rp 1.900.000",
            description: "Celebrating the anniversary of their third studio album Humbug with a special performance.",
            backDetails: {
              date: "Tue, Dec 3, 2024",
              time: "8:00 PM",
              venue: "Jakarta Convention Center",
            },
          },
          {
            id: 1,
            image: "https://i.pinimg.com/736x/9c/61/dc/9c61dc646178c933c15d50b757c6dd33.jpg",
            title: "Arctic Monkeys World Tour",
            genre: "Indie Rock",
            venue: "Jakarta International Stadium",
            date: { day: "7", month: "JUN" },
            price: "Rp 1.400.000",
            description: "Experience the Arctic Monkeys live in concert with their greatest hits and spectacular stage production.",
            backDetails: {
              date: "Fri, Jun 7, 2024",
              time: "8:30 PM",
              venue: "Jakarta International Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/04/de/32/04de329554d94c92b85b50c24cbad6bc.jpg",
            title: "Arctic Monkeys - The Car Tour",
            genre: "Indie Rock",
            venue: "GBK Stadium",
            date: { day: "15", month: "JUL" },
            price: "Rp 1.800.000",
            description: "Special performance featuring songs from their latest album 'The Car' along with classic hits.",
            backDetails: {
              date: "Mon, Jul 15, 2024",
              time: "9:00 PM",
              venue: "GBK Stadium",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/1d/93/e3/1d93e3f9c30da00791583b8b8d8aee19.jpg",
            title: "Arctic Monkeys - AM Album Night",
            genre: "Indie Rock",
            venue: "ICE BSD",
            date: { day: "22", month: "AUG" },
            price: "Rp 2.500.000",
            description: "Special one-night-only performance of the entire AM album plus other fan favorites.",
            backDetails: {
              date: "Thu, Aug 22, 2024",
              time: "8:00 PM",
              venue: "ICE BSD",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5b/e6/fa/5be6fa96291f009d46402b060d0a6635.jpg",
            title: "Arctic Monkeys - VIP Experience",
            genre: "Indie Rock",
            venue: "The Kasablanka Hall",
            date: { day: "5", month: "SEP" },
            price: "Rp 5.000.000",
            description: "Exclusive VIP package including premium seating, meet & greet, and limited edition merchandise.",
            backDetails: {
              date: "Thu, Sep 5, 2024",
              time: "7:30 PM",
              venue: "The Kasablanka Hall",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/17/22/ab/1722ab4cc73b6ce9d7c90edf5d72ca14.jpg",
            title: "Arctic Monkeys - Tranquility Base Tour",
            genre: "Indie Rock",
            venue: "Beach City International Stadium",
            date: { day: "12", month: "OCT" },
            price: "Rp 1.200.000",
            description: "Experience the psychedelic sounds of Tranquility Base Hotel & Casino performed live.",
            backDetails: {
              date: "Sat, Oct 12, 2024",
              time: "8:00 PM",
              venue: "Beach City International Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/b3/20/9e/b3209e6399e17ada801326c945d9be4a.jpg",
            title: "Arctic Monkeys - Early Years",
            genre: "Indie Rock",
            venue: "Senayan Tennis Indoor",
            date: { day: "19", month: "NOV" },
            price: "Rp 1.600.000",
            description: "A special concert featuring songs from their first two albums performed in an intimate setting.",
            backDetails: {
              date: "Tue, Nov 19, 2024",
              time: "8:30 PM",
              venue: "Senayan Tennis Indoor",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/79/6d/b0/796db0ac0342e28ebbc8d2b82334e925.jpg",
            title: "Arctic Monkeys - Humbug Anniversary",
            genre: "Indie Rock",
            venue: "Jakarta Convention Center",
            date: { day: "3", month: "DEC" },
            price: "Rp 1.900.000",
            description: "Celebrating the anniversary of their third studio album Humbug with a special performance.",
            backDetails: {
              date: "Tue, Dec 3, 2024",
              time: "8:00 PM",
              venue: "Jakarta Convention Center",
            },
          },
          {
            id: 1,
            image: "https://i.pinimg.com/736x/9c/61/dc/9c61dc646178c933c15d50b757c6dd33.jpg",
            title: "Arctic Monkeys World Tour",
            genre: "Indie Rock",
            venue: "Jakarta International Stadium",
            date: { day: "7", month: "JUN" },
            price: "Rp 1.400.000",
            description: "Experience the Arctic Monkeys live in concert with their greatest hits and spectacular stage production.",
            backDetails: {
              date: "Fri, Jun 7, 2024",
              time: "8:30 PM",
              venue: "Jakarta International Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/04/de/32/04de329554d94c92b85b50c24cbad6bc.jpg",
            title: "Arctic Monkeys - The Car Tour",
            genre: "Indie Rock",
            venue: "GBK Stadium",
            date: { day: "15", month: "JUL" },
            price: "Rp 1.800.000",
            description: "Special performance featuring songs from their latest album 'The Car' along with classic hits.",
            backDetails: {
              date: "Mon, Jul 15, 2024",
              time: "9:00 PM",
              venue: "GBK Stadium",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/1d/93/e3/1d93e3f9c30da00791583b8b8d8aee19.jpg",
            title: "Arctic Monkeys - AM Album Night",
            genre: "Indie Rock",
            venue: "ICE BSD",
            date: { day: "22", month: "AUG" },
            price: "Rp 2.500.000",
            description: "Special one-night-only performance of the entire AM album plus other fan favorites.",
            backDetails: {
              date: "Thu, Aug 22, 2024",
              time: "8:00 PM",
              venue: "ICE BSD",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5b/e6/fa/5be6fa96291f009d46402b060d0a6635.jpg",
            title: "Arctic Monkeys - VIP Experience",
            genre: "Indie Rock",
            venue: "The Kasablanka Hall",
            date: { day: "5", month: "SEP" },
            price: "Rp 5.000.000",
            description: "Exclusive VIP package including premium seating, meet & greet, and limited edition merchandise.",
            backDetails: {
              date: "Thu, Sep 5, 2024",
              time: "7:30 PM",
              venue: "The Kasablanka Hall",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/17/22/ab/1722ab4cc73b6ce9d7c90edf5d72ca14.jpg",
            title: "Arctic Monkeys - Tranquility Base Tour",
            genre: "Indie Rock",
            venue: "Beach City International Stadium",
            date: { day: "12", month: "OCT" },
            price: "Rp 1.200.000",
            description: "Experience the psychedelic sounds of Tranquility Base Hotel & Casino performed live.",
            backDetails: {
              date: "Sat, Oct 12, 2024",
              time: "8:00 PM",
              venue: "Beach City International Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/b3/20/9e/b3209e6399e17ada801326c945d9be4a.jpg",
            title: "Arctic Monkeys - Early Years",
            genre: "Indie Rock",
            venue: "Senayan Tennis Indoor",
            date: { day: "19", month: "NOV" },
            price: "Rp 1.600.000",
            description: "A special concert featuring songs from their first two albums performed in an intimate setting.",
            backDetails: {
              date: "Tue, Nov 19, 2024",
              time: "8:30 PM",
              venue: "Senayan Tennis Indoor",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/79/6d/b0/796db0ac0342e28ebbc8d2b82334e925.jpg",
            title: "Arctic Monkeys - Humbug Anniversary",
            genre: "Indie Rock",
            venue: "Jakarta Convention Center",
            date: { day: "3", month: "DEC" },
            price: "Rp 1.900.000",
            description: "Celebrating the anniversary of their third studio album Humbug with a special performance.",
            backDetails: {
              date: "Tue, Dec 3, 2024",
              time: "8:00 PM",
              venue: "Jakarta Convention Center",
            },
          },
          {
            id: 1,
            image: "https://i.pinimg.com/736x/9c/61/dc/9c61dc646178c933c15d50b757c6dd33.jpg",
            title: "Arctic Monkeys World Tour",
            genre: "Indie Rock",
            venue: "Jakarta International Stadium",
            date: { day: "7", month: "JUN" },
            price: "Rp 1.400.000",
            description: "Experience the Arctic Monkeys live in concert with their greatest hits and spectacular stage production.",
            backDetails: {
              date: "Fri, Jun 7, 2024",
              time: "8:30 PM",
              venue: "Jakarta International Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/04/de/32/04de329554d94c92b85b50c24cbad6bc.jpg",
            title: "Arctic Monkeys - The Car Tour",
            genre: "Indie Rock",
            venue: "GBK Stadium",
            date: { day: "15", month: "JUL" },
            price: "Rp 1.800.000",
            description: "Special performance featuring songs from their latest album 'The Car' along with classic hits.",
            backDetails: {
              date: "Mon, Jul 15, 2024",
              time: "9:00 PM",
              venue: "GBK Stadium",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/1d/93/e3/1d93e3f9c30da00791583b8b8d8aee19.jpg",
            title: "Arctic Monkeys - AM Album Night",
            genre: "Indie Rock",
            venue: "ICE BSD",
            date: { day: "22", month: "AUG" },
            price: "Rp 2.500.000",
            description: "Special one-night-only performance of the entire AM album plus other fan favorites.",
            backDetails: {
              date: "Thu, Aug 22, 2024",
              time: "8:00 PM",
              venue: "ICE BSD",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5b/e6/fa/5be6fa96291f009d46402b060d0a6635.jpg",
            title: "Arctic Monkeys - VIP Experience",
            genre: "Indie Rock",
            venue: "The Kasablanka Hall",
            date: { day: "5", month: "SEP" },
            price: "Rp 5.000.000",
            description: "Exclusive VIP package including premium seating, meet & greet, and limited edition merchandise.",
            backDetails: {
              date: "Thu, Sep 5, 2024",
              time: "7:30 PM",
              venue: "The Kasablanka Hall",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/17/22/ab/1722ab4cc73b6ce9d7c90edf5d72ca14.jpg",
            title: "Arctic Monkeys - Tranquility Base Tour",
            genre: "Indie Rock",
            venue: "Beach City International Stadium",
            date: { day: "12", month: "OCT" },
            price: "Rp 1.200.000",
            description: "Experience the psychedelic sounds of Tranquility Base Hotel & Casino performed live.",
            backDetails: {
              date: "Sat, Oct 12, 2024",
              time: "8:00 PM",
              venue: "Beach City International Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/b3/20/9e/b3209e6399e17ada801326c945d9be4a.jpg",
            title: "Arctic Monkeys - Early Years",
            genre: "Indie Rock",
            venue: "Senayan Tennis Indoor",
            date: { day: "19", month: "NOV" },
            price: "Rp 1.600.000",
            description: "A special concert featuring songs from their first two albums performed in an intimate setting.",
            backDetails: {
              date: "Tue, Nov 19, 2024",
              time: "8:30 PM",
              venue: "Senayan Tennis Indoor",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/79/6d/b0/796db0ac0342e28ebbc8d2b82334e925.jpg",
            title: "Arctic Monkeys - Humbug Anniversary",
            genre: "Indie Rock",
            venue: "Jakarta Convention Center",
            date: { day: "3", month: "DEC" },
            price: "Rp 1.900.000",
            description: "Celebrating the anniversary of their third studio album Humbug with a special performance.",
            backDetails: {
              date: "Tue, Dec 3, 2024",
              time: "8:00 PM",
              venue: "Jakarta Convention Center",
            },
          },
          {
            id: 1,
            image: "https://i.pinimg.com/736x/9c/61/dc/9c61dc646178c933c15d50b757c6dd33.jpg",
            title: "Arctic Monkeys World Tour",
            genre: "Indie Rock",
            venue: "Jakarta International Stadium",
            date: { day: "7", month: "JUN" },
            price: "Rp 1.400.000",
            description: "Experience the Arctic Monkeys live in concert with their greatest hits and spectacular stage production.",
            backDetails: {
              date: "Fri, Jun 7, 2024",
              time: "8:30 PM",
              venue: "Jakarta International Stadium",
            },
          },
          {
            id: 2,
            image: "https://i.pinimg.com/736x/04/de/32/04de329554d94c92b85b50c24cbad6bc.jpg",
            title: "Arctic Monkeys - The Car Tour",
            genre: "Indie Rock",
            venue: "GBK Stadium",
            date: { day: "15", month: "JUL" },
            price: "Rp 1.800.000",
            description: "Special performance featuring songs from their latest album 'The Car' along with classic hits.",
            backDetails: {
              date: "Mon, Jul 15, 2024",
              time: "9:00 PM",
              venue: "GBK Stadium",
            },
          },
          {
            id: 3,
            image: "https://i.pinimg.com/736x/1d/93/e3/1d93e3f9c30da00791583b8b8d8aee19.jpg",
            title: "Arctic Monkeys - AM Album Night",
            genre: "Indie Rock",
            venue: "ICE BSD",
            date: { day: "22", month: "AUG" },
            price: "Rp 2.500.000",
            description: "Special one-night-only performance of the entire AM album plus other fan favorites.",
            backDetails: {
              date: "Thu, Aug 22, 2024",
              time: "8:00 PM",
              venue: "ICE BSD",
            },
          },
          {
            id: 4,
            image: "https://i.pinimg.com/736x/5b/e6/fa/5be6fa96291f009d46402b060d0a6635.jpg",
            title: "Arctic Monkeys - VIP Experience",
            genre: "Indie Rock",
            venue: "The Kasablanka Hall",
            date: { day: "5", month: "SEP" },
            price: "Rp 5.000.000",
            description: "Exclusive VIP package including premium seating, meet & greet, and limited edition merchandise.",
            backDetails: {
              date: "Thu, Sep 5, 2024",
              time: "7:30 PM",
              venue: "The Kasablanka Hall",
            },
          },
          {
            id: 5,
            image: "https://i.pinimg.com/736x/17/22/ab/1722ab4cc73b6ce9d7c90edf5d72ca14.jpg",
            title: "Arctic Monkeys - Tranquility Base Tour",
            genre: "Indie Rock",
            venue: "Beach City International Stadium",
            date: { day: "12", month: "OCT" },
            price: "Rp 1.200.000",
            description: "Experience the psychedelic sounds of Tranquility Base Hotel & Casino performed live.",
            backDetails: {
              date: "Sat, Oct 12, 2024",
              time: "8:00 PM",
              venue: "Beach City International Stadium",
            },
          },
          {
            id: 6,
            image: "https://i.pinimg.com/736x/b3/20/9e/b3209e6399e17ada801326c945d9be4a.jpg",
            title: "Arctic Monkeys - Early Years",
            genre: "Indie Rock",
            venue: "Senayan Tennis Indoor",
            date: { day: "19", month: "NOV" },
            price: "Rp 1.600.000",
            description: "A special concert featuring songs from their first two albums performed in an intimate setting.",
            backDetails: {
              date: "Tue, Nov 19, 2024",
              time: "8:30 PM",
              venue: "Senayan Tennis Indoor",
            },
          },
          {
            id: 7,
            image: "https://i.pinimg.com/736x/79/6d/b0/796db0ac0342e28ebbc8d2b82334e925.jpg",
            title: "Arctic Monkeys - Humbug Anniversary",
            genre: "Indie Rock",
            venue: "Jakarta Convention Center",
            date: { day: "3", month: "DEC" },
            price: "Rp 1.900.000",
            description: "Celebrating the anniversary of their third studio album Humbug with a special performance.",
            backDetails: {
              date: "Tue, Dec 3, 2024",
              time: "8:00 PM",
              venue: "Jakarta Convention Center",
            },
          },
        ],
      };

      // Variables for pagination
      let currentPage = 1;
      const cardsPerPage = 24;

      // Function to display cards for current page
      function displayCards(page) {
        const resultsContainer = document.getElementById("resultsContainer");
        resultsContainer.innerHTML = "";

        const startIndex = (page - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;
        const cardsToShow = concertData.search.slice(startIndex, endIndex);

        cardsToShow.forEach((concert, index) => {
          const card = document.createElement("div");
          card.className = "concert-card";
          card.style.setProperty("--order", index);
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
                  <span class="amount">Mulai ${concert.price}</span>
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
                  <a href="../user/cart/?add=${concert.id}" class="btn btn-sm btn-action btn-cart" title="Add to Cart">
                    <i class="bi bi-cart-plus"></i>
                  </a>
                  <a href="../public/events/detail_concert.html" class="btn btn-sm btn-action btn-detail flex-grow-1">
                    <i class="bi bi-info-circle me-1"></i> Details
                  </a>
                  <a href="../user/payment/" class="btn btn-sm btn-action btn-buy">
                    <i class="bi bi-credit-card me-1"></i> Buy
                  </a>
                </div>
              </div>
            </div>
          </div>
        `;
          resultsContainer.appendChild(card);
        });

        // Setup animations for the new cards
        setupCardAnimations();
      }

      // Function to setup pagination
      function setupPagination() {
        const paginationContainer = document.getElementById("paginationContainer");
        const totalPages = Math.ceil(concertData.search.length / cardsPerPage);

        let paginationHTML = `
        <ul class="pagination justify-content-center">
          <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">
              <i class="bi bi-chevron-left"></i>
            </a>
          </li>
      `;

        for (let i = 1; i <= totalPages; i++) {
          paginationHTML += `
          <li class="page-item ${i === currentPage ? "active" : ""}">
            <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
          </li>
        `;
        }

        paginationHTML += `
          <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
        </ul>
      `;

        paginationContainer.innerHTML = paginationHTML;
      }

      // Function to change page
      function changePage(page) {
        if (page < 1 || page > Math.ceil(concertData.search.length / cardsPerPage)) return;

        currentPage = page;
        displayCards(currentPage);
        setupPagination();
        window.scrollTo({ top: 0, behavior: "smooth" });
      }

      // Setup card animations
      // Setup card animations
      function setupCardAnimations() {
        // Optimize performance
        gsap.utils.toArray(".concert-card").forEach((card) => {
          card.style.willChange = "transform, opacity, filter";
          card.style.backfaceVisibility = "hidden";
        });

        // Animate cards
        gsap.utils.toArray(".concert-card").forEach((card, i) => {
          // Set initial state
          gsap.set(card, {
            opacity: 0,
            y: 50,
            rotationY: 15,
            scale: 0.9,
            filter: "blur(2px)",
          });

          // Entrance animation
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

          // Hover effects
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

      // Make navbar change on scroll
      function setupNavbarScroll() {
        window.addEventListener("scroll", function () {
          const navbar = document.querySelector(".navbar");
          if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
          } else {
            navbar.classList.remove("scrolled");
          }
        });
      }

      // Scroll indicator
      function setupScrollIndicator() {
        window.addEventListener("scroll", () => {
          const scrollIndicator = document.querySelector(".scroll-indicator");
          if (window.scrollY > 300) {
            scrollIndicator.classList.add("visible");
          } else {
            scrollIndicator.classList.remove("visible");
          }
        });
      }

      // Setup filter functionality
      function setupFilters() {
        const filterBtns = document.querySelectorAll(".filter-btn");

        filterBtns.forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.preventDefault();

            // For mobile, close offcanvas after selection
            if (window.innerWidth < 992) {
              const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById("sidebarMenu"));
              if (offcanvas) offcanvas.hide();
            }

            const parentGroup = this.closest(".filter-group");
            if (parentGroup) {
              parentGroup.querySelectorAll(".filter-btn").forEach((b) => b.classList.remove("active"));
              this.classList.add("active");
            }
          });
        });
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
      // Get search query from URL
      function getSearchQuery() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get("q") || "Arctic Monkeys";
      }

      // Update UI with search query
      function updateSearchResults() {
        const query = getSearchQuery();
        document.querySelector(".search-hero h1").textContent = `Search Results for "${query}"`;
        document.querySelector(".search-results-count").textContent = `${concertData.search.length} concerts found for "${query}"`;

        // Update search input value
        const searchInput = document.getElementById("searchInput");
        if (searchInput) {
          searchInput.value = query;
        }
      }

      // Handle search form submission
      document.getElementById("searchForm")?.addEventListener("submit", function (e) {
        e.preventDefault();
        const query = document.getElementById("searchInput").value.trim();
        if (query) {
          alert("Search functionality would redirect to: search.html?q=" + encodeURIComponent(query));
          // window.location.href = `search.html?q=${encodeURIComponent(query)}`;
        }
      });
      // Replace the existing setupCardInteractions function with:
      function setupCardInteractions() {
        // Handle card clicks
        document.querySelectorAll(".concert-card").forEach((card) => {
          card.addEventListener("click", function (e) {
            // Don't flip if clicking on a button
            if (e.target.closest(".btn-action")) return;

            // For mobile, toggle flip on click
            if (window.innerWidth < 992) {
              const inner = this.querySelector(".card-inner");
              if (inner.style.transform === "rotateY(180deg)") {
                inner.style.transform = "";
              } else {
                inner.style.transform = "rotateY(180deg)";
              }
            }
          });
        });
        // Cart button
        document.querySelectorAll(".btn-outline-purple").forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;

            // Animation
            gsap.to(this, {
              scale: 1.3,
              duration: 0.2,
              yoyo: true,
              repeat: 1,
              ease: "power1.out",
            });

            console.log(`Added to cart: ${title}`);
          });
        });

        // Detail button
        document.querySelectorAll(".btn-detail").forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;
            console.log(`View details: ${title}`);
          });
        });

        // Buy button
        document.querySelectorAll(".btn-buy").forEach((btn) => {
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".concert-card");
            const title = card.querySelector(".card-title").textContent;
            console.log(`Buy now: ${title}`);
          });
        });
      }
      // Initialize everything when DOM is loaded
      document.addEventListener("DOMContentLoaded", function () {
        setupCardInteractions();
        setupFilters();
        updateSearchResults();
        displayCards(currentPage);
        setupPagination();
        setupNavbarScroll();
        setupScrollIndicator();
        setupOffcanvas();

        // Initialize Bootstrap components
        if (typeof bootstrap === "undefined") {
          const script = document.createElement("script");
          script.src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js";
          document.body.appendChild(script);
        }
      });
    </script>
  </body>
</html>
