<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managing and Monitoring System for Rented Modern Agricultural Technologies</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* --- CSS VARIABLES & RESET --- */
        :root {
            --primary-color: #2e7d32;
            --primary-dark: #1b5e20;
            --primary-light: #4caf50;
            --accent-color: #f9a825;
            --text-dark: #1a1a1a;
            --text-light: #6b7280;
            --bg-light: #f3f4f6;
            --cream: #faf9f6;
            --white: #ffffff;
            --border-radius: 8px;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --transition: all 0.3s ease;
            --container-width: 1200px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html
        {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'DM Sans', 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--white);
            scroll-behavior: smooth;
        }

        /* --- LAYOUT UTILITIES --- */
        .container {
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 24px;
        }

        section { padding: 80px 0; }

        h1, h2, h3 { line-height: 1.2; margin-bottom: 1rem; }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.25rem;
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto 3rem auto;
            font-size: 1.05rem;
        }

        /* =============================================
           NAVIGATION — REDESIGNED
           ============================================= */
        header {
            background-color: var(--white);
            box-shadow: 0 1px 0 rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 72px;
            gap: 40px;
            position: relative;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
            order: -1;
            margin-right: auto;
            flex-direction: row-reverse;
            margin-left: -2rem;
        }

        .nav-logo h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color:black;
            margin: 0;
            white-space: nowrap;
            margin-left: 2rem;
        }

        .nav-logo img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            flex-shrink: 0;
        }

       

        .nav-links {
            list-style: none;
            display: flex;
            gap: 32px;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nav-links a {
            text-decoration: none;
            color:black;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.02em;
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.25s;
        }

        .nav-links a:hover { color: var(--primary-color); }
        .nav-links a:hover::after { width: 100%; }

        .nav-right {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            margin-left: auto;
            order: 1;
        }

        .btn-login {
            background: var(--primary-color);
            color: var(--white);
            padding: 9px 22px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.02em;
            transition: background 0.2s, transform 0.2s;
            white-space: nowrap;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        @media (max-width: 900px) {
            .nav-links { display: none; }
        }

        /* =============================================
           HERO SECTION
           ============================================= */
        .hero {
            background-image: url('../images/bg-hero.png');
            background-size: cover;
            background-position: center;
            background-color: var(--primary-dark);
            color: var(--white);
            text-align: center;
            padding: 120px 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
        
            pointer-events: none;
        }

        .hero .container { position: relative; }

        .hero h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            max-width: 100%;
            margin: 0 auto 20px auto;
            text-align: center;
            color: white;
        
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 680px;
            margin: 0 auto 40px auto;
            opacity: 0.9;
            text-align: center;
        }

        .hero-buttons { text-align: center; }

        .hero-buttons button {
            background-color: var(--white);
            color: var(--text-dark);
            padding: 14px 40px;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(249,168,37,0.4);
            font-family: 'DM Sans', sans-serif;
        }

        .hero-buttons button:hover {
            background-color:var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px var(--primary-light);
            color: white;
        }

        /* =============================================
           ABOUT SECTION — REDESIGNED
           ============================================= */
        #about {
            padding: 100px 0;
            background: var(--cream);
        }

        .about-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .about-header h2 {
            font-size: 2.8rem;
            color: var(--primary-dark);
            margin-bottom: 10px;
            letter-spacing: 0.05em;
        }

    

        .about-grid-three {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
            margin-top: 40px;
        }

        .about-col {
            padding: 40px;
            background: #f5f5f5;
            border-radius: 12px;
            text-align: left;
        }

        .about-col h3 {
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .about-col p {
            font-size: 0.95rem;
            color: var(--text-light);
            line-height: 1.8;
            margin-bottom: 0;
        }

        .about-features-list {
            list-style: none;
            font-size: 0.95rem;
            color: var(--text-light);
            line-height: 1.8;
        }

        .about-features-list li {
            margin-bottom: 12px;
            padding-left: 0;
        }

        .about-features-list li::before {
            content: '•';
            margin-right: 10px;
            color: var(--primary-color);
            font-weight: bold;
        }

        @media (max-width: 1024px) {
            .about-grid-three {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
            .about-col {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .about-grid-three {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .about-header h2 {
                font-size: 2rem;
            }
            .about-col {
                padding: 25px;
            }
            .about-col h3 {
                font-size: 1.2rem;
            }
        }

        /* --- SERVICES --- */
        .bg-light { background-color: var(--bg-light); }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        .icon-box { display: none; }
        .service-card h3 { font-size: 1.2rem; margin-bottom: 10px; }
        .service-card p { font-size: 0.95rem; color: var(--text-light); }

        /* --- HOW IT WORKS --- */
        .process-container {
            display: flex;
            justify-content: space-between;
            position: relative;
            gap: 20px;
        }

        .process-container::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 50px;
            right: 50px;
            height: 2px;
            background-color: #e5e7eb;
            z-index: 0;
            display: none;
        }

        @media (min-width: 900px) {
            .process-container::before { display: block; }
        }

        .process-step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
            background: var(--white);
        }

        .step-number {
            width: 80px;
            height: 80px;
            background-color: var(--white);
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 20px auto;
            box-shadow: 0 0 0 10px var(--white);
        }

        .process-step h3 { font-size: 1.2rem; margin-bottom: 10px; }
        .process-step p { font-size: 0.95rem; color: var(--text-light); padding: 0 10px; }

        /* =============================================
           FOOTER — REDESIGNED
           ============================================= */
        .footer-accent-bar {
            height: 4px;
            background: linear-gradient(90deg, var(--primary-light) 0%, var(--accent-color) 50%, var(--primary-light) 100%);
        }

        footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 72px 0 0;
        }

        .footer-inner {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr;
            gap: 60px;
            padding-bottom: 60px;
        }

        .footer-brand .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .footer-logo-leaf {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 50% 10% 50% 10%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .footer-brand p {
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            line-height: 1.8;
            max-width: 300px;
            margin-bottom: 28px;
        }

        .footer-social { display: flex; gap: 10px; flex-wrap: wrap; }

        .social-pill {
            background: rgba(255,255,255,0.1);
            color: var(--white);
            border-radius: 50px;
            padding: 7px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: background 0.2s;
        }

        .social-pill:hover { background: rgba(255,255,255,0.2); }

        .footer-col h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--white);
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .footer-col ul a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .footer-col ul a:hover { color: var(--accent-color); }

        .footer-contact-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-bottom: 14px;
            font-size: 0.875rem;
            color: rgba(255,255,255,0.65);
        }

        .footer-contact-item .f-icon {
            color: var(--accent-color);
            margin-top: 2px;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .footer-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 0;
        }

        .footer-bottom {
            padding: 22px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.4);
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 900px) {
            .footer-inner { grid-template-columns: 1fr 1fr; gap: 40px; }
            .footer-brand { grid-column: 1 / -1; }
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .process-container { flex-direction: column; }
            .step-number { width: 60px; height: 60px; font-size: 1.2rem; margin-bottom: 15px; }
            .hero-buttons button { padding: 12px 28px; font-size: 1rem; }
        }

        @media (max-width: 600px) {
            .footer-inner { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 10px; text-align: center; }
        }

        /* =============================================
           RENTAL PORTAL MODAL
           ============================================= */
        .rental-portal {
            display: none;
            height: 100vh;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: #f5f5f5;
            overflow-y: auto;
            z-index: 999;
            padding: 40px 20px;
        }

        .rental-portal.active {
            display: block;
        }

        .rental-portal-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 2rem;
            cursor: pointer;
            color: var(--text-dark);
            background: none;
            border: none;
            z-index: 1000;
        }

        .rental-portal-close:hover {
            color: var(--primary-color);
        }

        .rental-portal-inner {
            max-width: 900px;
            margin: 0 auto;
            background: var(--white);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .rental-portal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .rental-portal-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--primary-dark);
            margin: 0;
        }

        .btn-add-new {
            background: var(--primary-color);
            color: var(--white);
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .btn-add-new:hover {
            background: var(--primary-dark);
        }

        .equipment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .equipment-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            background: #f9f9f9;
        }

        .equipment-card-image {
            width: 100%;
            height: 150px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .equipment-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .equipment-card-info {
            padding: 15px;
        }

        .equipment-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .equipment-card-stock {
            display: flex;
            gap: 10px;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .stock-available {
            background: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .stock-pending {
            background: #e2e3e5;
            color: #383d41;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity-selector label {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .quantity-input {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }

        .customer-info-section {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .customer-info-section h3 {
            font-size: 1.3rem;
            color: var(--text-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .customer-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-full-width {
            grid-column: 1 / -1;
        }

        .btn-rent {
            width: 100%;
            padding: 14px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

    </style>
</head>
<body>

    <!-- =============================================
         NAVIGATION — REDESIGNED
         ============================================= -->
    <header>
        <div class="container">
            <nav>
        
                    
                <div class="nav-logo">
<h3>Municipality Of Buguey</h3>
                      <img src="{{ asset('images/buguey-logo.png') }}" alt="Municipality Logo">
                </div>

                <ul class="nav-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#process">How It Works</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>

                <div class="nav-right">
                    @if (session('welcome_dashboard_logged_in'))
                        <a href="{{ route('welcome.logout') }}" class="btn-login">Logout</a>
                    @else
                        <a href="{{ route('welcome.login.show') }}" class="btn-login">Login</a>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="container">
                <h1>Welcome to the Managing and Monitoring System for Rented Modern Agricultural Technologies.</h1>
                <p>Empowering Buguey's farming community with a centralized platform to track, manage, and reserve agricultural equipment.</p>
                <div class="hero-buttons">
                    <a href="{{ route('rental') }}"><button>Rent now</button></a>
                </div>
            </div>
        </section>

        <!-- =============================================
             ABOUT SECTION — REDESIGNED
             ============================================= -->
        <section id="about">
            <div class="container">
                <div class="about-header">
                    <h2>ABOUT THE SYSTEM</h2>
                    
                </div>

                <div class="about-grid-three">
                    <!-- Column 1 -->
                    <div class="about-col">
                        <h3>Our Roots & Community Focus</h3>
                        <p>Agriculture is the primary source of income in Buguey, Cagayan. Our platform's vision is to fully modernize the agricultural technology rental process, supporting local farmers with digital tools for better harvests.</p>
                    </div>

                    <!-- Column 2 -->
                    <div class="about-col">
                        <h3>100% Digitalized Process</h3>
                        <p>Eliminating paper-based rental records, miscommunication, and delays. Features zero-paper files, enhancing transparency and improving scheduling with real-time system updates for all stakeholders.</p>
                    </div>

                    <!-- Column 3 -->
                    <div class="about-col">
                        <h3>Key System Features</h3>
                        <ul class="about-features-list">
                            <li>Coverage: serving the Buguey community</li>
                            <li>Centralized digital record-keeping</li>
                            <li>Real-time availability tracking</li>
                            <li>Transparent stakeholder logs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="bg-light">
            <div class="container">
                <h2>What We Offer</h2>
                <p class="section-subtitle">Comprehensive tools designed to make farm equipment rental efficient and hassle-free.</p>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><path d="M4,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M4,6V18H20V6H4M6,9H18V11H6V9M6,13H15V15H6V13Z" /></svg>
                        </div>
                        <h3>Real-Time Equipment Listing</h3>
                        <p>View available farm machines, including tractors, harvesters, threshers, and irrigation equipment.</p>
                    </div>
                    <div class="service-card">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><path d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" /></svg>
                        </div>
                        <h3>Availability Status</h3>
                        <p>Check the real-time status of farm technology to see if it is free or currently booked.</p>
                    </div>
                    <div class="service-card">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" /></svg>
                        </div>
                        <h3>Secure Booking &amp; Scheduling</h3>
                        <p>Reserve farm equipment for specific times to lock in rental periods and prevent double booking conflicts.</p>
                    </div>
                    <div class="service-card">
                       
                        <h3>Records Management</h3>
                        <p>Access organized rental histories, equipment conditions, and transparent transaction logs.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="process">
            <div class="container">
                <h2>A Simple Process for Local Farmers</h2>
                <p class="section-subtitle">We've streamlined the rental process into three easy steps.</p>
                <div class="process-container">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <h3>Check Availability Online</h3>
                        <p>Browse our digital equipment listing to view specifications, current conditions, and pickup locations for the machinery you need.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <h3>Visit the Office</h3>
                        <p>To ensure security and prevent fraudulent bookings, our system requires you to visit the agricultural office to finalize your rental in person.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <h3>Rent and Record</h3>
                        <p>An administrator will securely log your identity, rental duration, and the associated costs into the system.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- =============================================
         FOOTER — REDESIGNED
         ============================================= -->
    <div class="footer-accent-bar"></div>
    <footer id="contact">
        <div class="container">
            <div class="footer-inner">

                <!-- Brand -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        
                        AgriRent Buguey
                    </div>
                    <p>A managing and monitoring system for rented modern agricultural technologies. Empowering farmers in Buguey, Cagayan with digital tools for a better harvest.</p>
                    <div class="footer-social">
                        <a href="#" class="social-pill"> Facebook</a>
                        <a href="#" class="social-pill"> Email</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#process">How It Works</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <div class="footer-contact-item">
                        <span class="f-icon"></span>
                        <span><strong>Camia Agency</strong><br>Zone 7, Maddalero, Buguey, Cagayan</span>
                    </div>
                    <div class="footer-contact-item">
                        <span class="f-icon"></span>
                        <span>Serving Northern Cagayan's farming community along the northeastern coast of Luzon</span>
                    </div>
                    <div class="footer-contact-item">
                        <span class="f-icon"></span>
                        <span>Office Hours: Mon–Fri, 8AM–5PM</span>
                    </div>
                </div>

            </div><!-- /.footer-inner -->

            <hr class="footer-divider">

            <div class="footer-bottom">
                <span>&copy; 2023 Managing and Monitoring System for Rented Modern Agricultural Technologies. All rights reserved.</span>
            
            </div>
        </div>
    </footer>

</body>
</html>