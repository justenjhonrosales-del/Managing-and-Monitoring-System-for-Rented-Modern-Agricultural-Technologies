<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Rental Portal - AgriRent Buguey</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: #f5f5f5;
            scroll-behavior: smooth;
        }

        /* --- LAYOUT UTILITIES --- */
        .container {
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* =============================================
           HEADER/NAVIGATION
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
            color: black;
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
            color: black;
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
           RENTAL PORTAL CONTENT
           ============================================= */
        main {
            min-height: calc(100vh - 72px);
            padding: 40px 20px;
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
            margin-bottom: 12px;
        }

        .equipment-status-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }

        .equipment-status-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f3f4f6;
            padding: 6px 8px;
            border-radius: 4px;
        }

        .equipment-status-label {
            color: var(--text-light);
        }

        .equipment-status-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .equipment-rent-btn {
            width: 100%;
            padding: 10px 12px;
            border: none;
            border-radius: 6px;
            background: var(--primary-color);
            color: var(--white);
            font-weight: 600;
            cursor: pointer;
        }

        .equipment-rent-btn:hover {
            background: var(--primary-dark);
        }

        .rent-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.35);
            align-items: flex-start;
            justify-content: center;
            z-index: 9999;
            padding: 20px 16px 16px;
            overflow-y: auto;
        }

        .rent-modal-overlay.show {
            display: flex;
        }

        .rent-modal-dialog {
            width: 100%;
            max-width: 860px;
            max-height: calc(100vh - 32px);
        }

        .rent-modal-card {
            width: 100%;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 40px 80px rgba(15, 23, 42, 0.14);
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 40px);
            overflow: hidden;
        }

        .rent-modal-card-inner {
            background: #ffffff;
            border-radius: 22px;
            padding: 0.95rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.05);
            overflow: hidden;
        }

        .rent-modal-body {
            padding: 0 1.15rem 1rem;
            background: #f8fafc;
            overflow: auto;
        }


        .rent-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 38px;
            height: 38px;
            border: none;
            background: rgba(255,255,255,0.95);
            font-size: 1.1rem;
            color: #1f2937;
            cursor: pointer;
            line-height: 1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.12);
            z-index: 2;
        }

        .rent-modal-image-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .rent-modal-image {
            width: 100%;
            height: 260px;
            object-fit: cover;
            display: block;
        }

        .rent-modal-body {
            padding: 0 1.15rem 1rem;
            background: #f8fafc;
            overflow-y: auto;
            flex: 1 1 auto;
            min-height: 0;
        }

        .rent-modal-card-inner {
            background: #ffffff;
            border-radius: 22px;
            padding: 1rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.05);
            min-height: 0;
        }

        .rent-modal-header-text {
            flex: 1 1 auto;
            max-width: calc(100% - 180px);
            text-align: center;
        }

        .rent-modal-header-text .fw-semibold {
            margin-bottom: 0.25rem;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .rent-modal-header-text .text-muted {
            font-size: 1rem;
            color: #4b5563;
        }

        .rent-modal-row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: nowrap;
        }

        .rent-modal-header-right {
            flex: 0 0 160px;
            min-width: 160px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            text-align: right;
        }

        .rent-modal-right-label {
            font-size: 1.2rem;
            
            margin-bottom: 0.25rem;
            margin-right: 5rem;
            white-space: nowrap;
            font-weight: bold;
        }

        .rent-modal-right-value {
            font-size: 1.4rem;
              color: #166534;
            margin-right: 5.8rem;
            white-space: nowrap;
        }

        .rent-modal-grid {
            display: grid;
            grid-template-columns: 1.55fr 1fr;
            gap: 1rem;
            align-items: start;
        }

        .rent-date-row {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin: 0.5rem 0 1rem;
        }

        .rent-date-row .form-group {
            flex: 1;
            max-width: 260px;
        }

        @media (max-width: 900px) {
            .rent-date-row {
                flex-direction: column;
                align-items: stretch;
            }
            .rent-date-row .form-group { max-width: 100%; }
        }

        .rent-modal-card-inner .rent-modal-row {
            margin-bottom: 0.8rem;
        }

        .rent-modal-fields {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            text-align: center;
        }

        .rent-modal-fields .d-flex {
            justify-content: center;
        }

        .rent-control-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .rent-modal-fields .mb-3 {
            width: 100%;
            max-width: 420px;
        }

        .rent-price-summary {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1rem;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .rent-summary-note {
            margin-top: 1rem;
            font-size: 0.92rem;
            color: #475569;
            line-height: 1.5;
        }

        .rent-modal-card {
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 40px);
        }

        @media (max-width: 900px) {
            .rent-modal-grid {
                grid-template-columns: 1fr;
            }
        }

        .rent-modal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .rent-modal-row .fw-semibold {
            margin-bottom: 0.35rem;
            font-weight: bold;
            margin-left: -3rem;
        }

        .rent-type-button {
            min-width: 112px;
            border-radius: 999px;
            padding: 0.6rem 1rem;
            border: 1px solid #d1d5db;
            background: #f8fafc;
            color: #164e0a;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .rent-type-button.active {
            background: #166534;
            color: #ffffff;
            border-color: #166534;
        }

        .rent-control-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .rent-control-row .btn {
            min-width: 42px;
            border-radius: 12px;
            padding: 0.6rem 0.85rem;
        }

        .rent-control-row input {
            width: 88px;
            border-radius: 12px;
            padding: 0.65rem 0.85rem;
            border: 1px solid #d1d5db;
        }

        .rent-meta {
            margin-top: 0.55rem;
            font-size: 0.88rem;
            color: #64748b;
        }

        .rent-price-summary {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1rem;
            min-height: 100%;
        }

        .rent-price-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #166534;
        }

        .rent-payment-select {
            width: 100%;
            border-radius: 14px;
            padding: 0.95rem 1rem;
            border: 1px solid #d1d5db;
            background: #ffffff;
            appearance: none;
        }

        .rent-modal-confirm {
            width: 100%;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.03em;
            background: #166534;
            border: none;
            color: #ffffff;
            padding: 0.95rem 1rem;
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

        .btn-rent:hover {
            background: var(--primary-dark);
        }

        .text-muted
        {
            margin-right:5.2rem;
            font-size: 1.5rem;
            margin-left: 5rem;
        }

        @media (max-width: 768px) {
            .rental-portal-inner {
                padding: 20px;
            }
            .rental-portal-header {
                flex-direction: column;
                gap: 15px;
            }
            .equipment-grid {
                grid-template-columns: 1fr;
            }
            main {
                padding: 20px 10px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVIGATION -->
    <header>
        <div class="container">
            <nav>
                <div class="nav-logo">
                    <h3>Municipality Of Buguey</h3>
                    <img src="{{ asset('images/buguey-logo.png') }}" alt="Municipality Logo">
                </div>

                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/#about">About</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="/#process">How It Works</a></li>
                    <li><a href="/#contact">Contact</a></li>
                </ul>

                <div class="nav-right">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-login">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-login">Login</a>
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- RENTAL PORTAL CONTENT -->
    <main>
        <div class="rental-portal-inner">
            @if ($message = Session::get('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #ef4444;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rental.store') }}" method="POST" id="rentalForm">
                @csrf
                <div class="rental-portal-header">
                    <h2>Equipment Rental Portal</h2>
                </div>

                <!-- Equipment Selection -->
                <div class="equipment-grid">
                    @php
                        $equipments = [
                            ['name' => 'Tractor', 'image' => 'tractor.png', 'available' => 2],
                            ['name' => 'Reaper or Thresher', 'image' => 'reaper or thresher.jpg', 'available' => 2],
                            ['name' => 'Kuliglig', 'image' => 'kuliglig.jpg', 'available' => 2],
                        ];
                    @endphp

                    @foreach ($equipments as $equipment)
                        <div class="equipment-card">
                            <div class="equipment-card-image">
                                <img src="{{ asset('images/' . $equipment['image']) }}" alt="{{ $equipment['name'] }}">
                            </div>
                            <div class="equipment-card-info">
                                <div class="equipment-card-title">{{ $equipment['name'] }}</div>
                                <div class="equipment-status-list">
                                    <div class="equipment-status-item">
                                        <span class="equipment-status-label">Available</span>
                                        <span class="equipment-status-value">{{ $equipment['available'] }}</span>
                                    </div>
                                    <div class="equipment-status-item">
                                        <span class="equipment-status-label">Pending</span>
                                        <span class="equipment-status-value">0</span>
                                    </div>
                                    <div class="equipment-status-item">
                                        <span class="equipment-status-label">Maintenance</span>
                                        <span class="equipment-status-value">0</span>
                                    </div>
                                </div>
                                @if ($equipment['name'] === 'Tractor' || $equipment['name'] === 'Kuliglig')
                                    <button type="button" class="equipment-rent-btn rent-trigger"
                                        data-image="{{ asset('images/' . $equipment['image']) }}"
                                        data-name="{{ $equipment['name'] }}"
                                        data-available="{{ $equipment['available'] }}"
                                        data-equipment-type="{{ $equipment['name'] === 'Kuliglig' ? 'kuliglig' : 'tractor' }}">
                                        Rent Now
                                    </button>
                                @else
                                    <button type="button" class="equipment-rent-btn">Rent Now</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Customer Information Section -->
                <div class="customer-info-section">
                    <h3>Customer Information</h3>
                    
                    <div class="customer-info-grid">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="customer_name" placeholder="Enter full name" value="{{ old('customer_name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" placeholder="Enter age" value="{{ old('age') }}" required>
                        </div>

                        <div class="form-group form-full-width">
                            <label>Primary Address</label>
                            <input type="text" name="primary_address" placeholder="Enter primary address" value="{{ old('primary_address') }}" required>
                        </div>

                        <input type="hidden" name="field_area" value="">
                        <input type="hidden" name="notes" value="">
                        <input type="hidden" name="delivery_notes" value="">
                        <input type="hidden" name="rental_from" value="">
                        <input type="hidden" name="rental_to" value="">
                        <input type="hidden" name="rental_duration_hours" value="">
                        <input type="hidden" name="equipment" id="equipmentInput" value="">
                    </div>
                </div>

                <!-- Rent Button -->
              
            </form>

            <div class="rent-modal-overlay" id="rentModal" aria-hidden="true">
                <div class="rent-modal-dialog" role="dialog" aria-modal="true">
                    <div class="rent-modal-card">
                        <div class="rent-modal-image-wrapper">
                            <img id="rentModalImage" src="" alt="Equipment image" class="rent-modal-image">
                            <button type="button" class="rent-modal-close" aria-label="Close modal">×</button>
                        </div>
                        <div class="rent-modal-body">
                            <div class="rent-modal-card-inner">
                                <div class="rent-modal-row mb-3">
                                    <div class="rent-modal-header-text">
                                        <div class="fw-semibold">Rental Details</div>
                                        <div class="text-muted" style="font-size:0.92rem;">Usage and price overview</div>
                                    </div>
                                    <div class="rent-modal-header-right text-end">
                                        <div class="rent-modal-right-label">Rental Summary</div>
                                    </div>
                                </div>

                                <div class="rent-modal-grid">
                                    <div class="rent-modal-fields">
                                        <div class="mb-3">
                                            <div class="fw-semibold mb-2">Usage Type</div>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <button type="button" class="rent-type-button active" data-rent-type="public">Public Use</button>
                                                <button type="button" class="rent-type-button" data-rent-type="private">Private Use</button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="fw-semibold">Hectares to Plow</div>
                                                <div class="text-muted" style="font-size:0.9rem;">1 Hectare</div>
                                            </div>
                                            <div class="rent-control-row">
                                                <button type="button" class="btn btn-outline-secondary" id="rentHectaresDecrease">-</button>
                                                <input type="text" id="rentHectaresInput" class="form-control text-center" value="1" readonly>
                                                <button type="button" class="btn btn-outline-secondary" id="rentHectaresIncrease">+</button>
                                            </div>
                                            <div class="rent-meta">Hours of Use: 2h 00m (Based on 1 Hectare)</div>
                                            <div class="mt-3">
                                                <label for="rentHoursToUse" class="fw-semibold d-block mb-2">Hours to Use</label>
                                                <input type="text" id="rentHoursToUse" class="form-control" value="2h 00m" readonly>
                                            </div>
                                        </div>

                                        <div class="rent-date-row">
                                            <div class="form-group">
                                                <label for="rentDate" class="fw-semibold d-block mb-2">Rental Date</label>
                                                <input type="date" id="rentDate" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="rentHours" class="fw-semibold d-block mb-2">Start Time</label>
                                                <input type="text" id="rentHours" name="rentHours" class="form-control" value="02:00 PM" placeholder="Select time" />
                                            </div>
                                        </div>

                                        <button type="button" class="rent-modal-confirm" id="rentModalConfirm">CONFIRM RENTAL</button>
                                    </div>

                                    <div class="rent-price-summary">
                                        <div class="rent-summary-heading">Rental Summary</div>
                                        <div class="rent-summary-row">
                                            <span class="rent-summary-label">Rental Date</span>
                                            <span id="rentModalDate" class="rent-summary-value">06/08/2026</span>
                                        </div>
                                        <div class="rent-summary-row">
                                            <span class="rent-summary-label">Start Time</span>
                                            <span id="rentModalHoursSummary" class="rent-summary-value">02:00 PM</span>
                                        </div>
                                        <div class="rent-summary-details">
                                            <div><strong>Use type:</strong> <span id="rentModalUseType">Public Use</span></div>
                                            <div><strong>Selected hectares:</strong> <span id="rentModalHectares">1 Hectare</span></div>
                                            <div><strong>Duration:</strong> <span id="rentModalDuration">2h 00m</span></div>
                                        </div>
                                        <div class="rent-price-block">
                                            <div class="rent-price-header">Rental Price</div>
                                            <div id="rentModalPrice" class="rent-price-value">₱2,800.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rent-modal-overlay" id="kuligligRentModal" aria-hidden="true">
                <div class="rent-modal-dialog" role="dialog" aria-modal="true">
                    <div class="rent-modal-card">
                        <div class="rent-modal-image-wrapper">
                            <img id="kuligligRentModalImage" src="{{ asset('images/kuliglig.jpg') }}" alt="Kuliglig equipment image" class="rent-modal-image">
                            <button type="button" class="rent-modal-close kuliglig-rent-close" aria-label="Close modal">×</button>
                        </div>
                        <div class="rent-modal-body">
                            <div class="rent-modal-card-inner">
                                <div class="rent-modal-row mb-3">
                                    <div class="rent-modal-header-text">
                                        <div class="fw-semibold">Rental Details</div>
                                        <div class="text-muted" style="font-size:0.92rem;">Rental and price overview</div>
                                    </div>
                                    <div class="rent-modal-header-right text-end">
                                        <div class="rent-modal-right-label">Rental Summary</div>
                                    </div>
                                </div>

                                <div class="rent-modal-grid">
                                    <div class="rent-modal-fields">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="fw-semibold">Days to Use</div>
                                                <div class="text-muted" style="font-size:0.9rem;">1 Day</div>
                                            </div>
                                            <div class="rent-control-row">
                                                <button type="button" class="btn btn-outline-secondary" id="kuligligDaysDecrease">-</button>
                                                <input type="text" id="kuligligDaysInput" class="form-control text-center" value="1" readonly>
                                                <button type="button" class="btn btn-outline-secondary" id="kuligligDaysIncrease">+</button>
                                            </div>
                                        </div>

                                        <div class="rent-date-row">
                                            <div class="form-group">
                                                <label for="kuligligRentDate" class="fw-semibold d-block mb-2">Rental Date</label>
                                                <input type="date" id="kuligligRentDate" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="kuligligRentHours" class="fw-semibold d-block mb-2">Start Time</label>
                                                <input type="text" id="kuligligRentHours" name="kuligligRentHours" class="form-control" value="02:00 PM" placeholder="Select time" />
                                            </div>
                                        </div>

                                        <button type="button" class="rent-modal-confirm" id="kuligligRentModalConfirm">CONFIRM RENTAL</button>
                                    </div>

                                    <div class="rent-price-summary">
                                        <div class="rent-summary-heading">Rental Summary</div>
                                        <div class="rent-summary-row">
                                            <span class="rent-summary-label">Rental Date</span>
                                            <span id="kuligligModalDate" class="rent-summary-value">06/08/2026</span>
                                        </div>
                                        <div class="rent-summary-row">
                                            <span class="rent-summary-label">Start Time</span>
                                            <span id="kuligligModalHoursSummary" class="rent-summary-value">02:00 PM</span>
                                        </div>
                                        <div class="rent-summary-row">
                                            <span class="rent-summary-label">Selected Days</span>
                                            <span id="kuligligModalSelectedDays" class="rent-summary-value">1 Day</span>
                                        </div>
                                        <div class="rent-summary-row">
                                            <span class="rent-summary-label">Duration</span>
                                            <span id="kuligligModalDuration" class="rent-summary-value">1 Day</span>
                                        </div>
                                        <div class="rent-price-block">
                                            <div class="rent-price-header">Rental Price</div>
                                            <div id="kuligligRentModalPrice" class="rent-price-value">₱500.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let duplicateNameError = false;
                let debounceTimer;

                const customerNameInput = document.querySelector('input[name="customer_name"]');
                const rentModal = document.getElementById('rentModal');
                const kuligligRentModal = document.getElementById('kuligligRentModal');
                const rentTriggers = document.querySelectorAll('.equipment-rent-btn.rent-trigger');
                const rentModalImage = document.getElementById('rentModalImage');
                const rentModalHoursSummary = document.getElementById('rentModalHoursSummary');
                const rentModalDate = document.getElementById('rentModalDate');
                const rentModalUseType = document.getElementById('rentModalUseType');
                const rentModalHectares = document.getElementById('rentModalHectares');
                const rentModalDuration = document.getElementById('rentModalDuration');
                const rentModalPrice = document.getElementById('rentModalPrice');
                const rentTypeButtons = document.querySelectorAll('.rent-type-button');
                const hectaresInput = document.getElementById('rentHectaresInput');
                const decreaseButton = document.getElementById('rentHectaresDecrease');
                const increaseButton = document.getElementById('rentHectaresIncrease');
                const rentModalConfirm = document.getElementById('rentModalConfirm');
                const rentCloseButton = document.querySelector('#rentModal .rent-modal-close');
                const hiddenEquipmentInput = document.getElementById('equipmentInput');
                const rentHoursToUseInput = document.getElementById('rentHoursToUse');
                const kuligligRentModalImage = document.getElementById('kuligligRentModalImage');
                const kuligligRentModalDate = document.getElementById('kuligligModalDate');
                const kuligligRentModalHoursSummary = document.getElementById('kuligligModalHoursSummary');
                const kuligligRentModalSelectedDays = document.getElementById('kuligligModalSelectedDays');
                const kuligligRentModalDuration = document.getElementById('kuligligModalDuration');
                const kuligligRentModalPrice = document.getElementById('kuligligRentModalPrice');
                const kuligligDaysInput = document.getElementById('kuligligDaysInput');
                const kuligligDaysDecreaseButton = document.getElementById('kuligligDaysDecrease');
                const kuligligDaysIncreaseButton = document.getElementById('kuligligDaysIncrease');
                const kuligligRentCloseButton = document.querySelector('#kuligligRentModal .rent-modal-close');
                const kuligligRentModalConfirm = document.getElementById('kuligligRentModalConfirm');

                // New date and hours inputs
                const rentDateInput = document.getElementById('rentDate');
                const rentHoursInput = document.getElementById('rentHours');
                const kuligligRentDateInput = document.getElementById('kuligligRentDate');
                const kuligligRentHoursInput = document.getElementById('kuligligRentHours');
                const rentalFromHidden = document.querySelector('input[name="rental_from"]');
                const rentalDurationHidden = document.querySelector('input[name="rental_duration_hours"]');

                const prices = { public: 2800, private: 3000 };
                let selectedType = 'public';
                let selectedHectares = 1.0;
                let selectedKuligligDays = 1;
                let manualHours = null;
                let hasManualHoursOverride = false;

                function computeRentalPrice(hectares, basePrice) {
                    const extraIntervals = Math.max(0, (parseFloat(hectares) - 1.0) / 0.1);
                    const increment = basePrice === prices.private ? 300 : 280;
                    return basePrice + (extraIntervals * increment);
                }

                function computeDurationHours(hectares) {
                    const extraIntervals = Math.max(0, (parseFloat(hectares) - 1.0) / 0.1);
                    const totalMinutes = 120 + (extraIntervals * 6);
                    const hours = Math.floor(totalMinutes / 60);
                    const minutes = totalMinutes % 60;

                    return {
                        totalHours: parseFloat((totalMinutes / 60).toFixed(2)),
                        hours,
                        minutes
                    };
                }

                function formatDuration(hectares) {
                    const duration = computeDurationHours(hectares);
                    return `${duration.hours}h ${duration.minutes.toString().padStart(2, '0')}m`;
                }

                // initialize date and hours inputs and wire events
                if (rentDateInput) {
                    const today = new Date().toISOString().slice(0,10);
                    if (!rentDateInput.value) rentDateInput.value = today;
                    if (rentalFromHidden) rentalFromHidden.value = rentDateInput.value;
                    rentDateInput.addEventListener('change', function() {
                        if (rentalFromHidden) rentalFromHidden.value = this.value;
                        updateModalValues();
                    });
                }

                if (rentHoursInput) {
                    if (!rentHoursInput.value) rentHoursInput.value = '02:00 PM';
                    manualHours = null;
                    hasManualHoursOverride = false;
                    if (rentalDurationHidden) rentalDurationHidden.value = computeDurationHours(selectedHectares).totalHours;

                    flatpickr(rentHoursInput, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'h:i K',
                        time_24hr: false,
                        minuteIncrement: 15,
                        defaultHour: 2,
                        defaultMinute: 0,
                        onChange: function(selectedDates, dateStr) {
                            if (!dateStr) return;
                            rentHoursInput.value = dateStr;
                            updateModalValues();
                        }
                    });

                    rentHoursInput.addEventListener('input', function() {
                        updateModalValues();
                    });
                }

                if (kuligligRentHoursInput) {
                    if (!kuligligRentHoursInput.value) kuligligRentHoursInput.value = '02:00 PM';

                    flatpickr(kuligligRentHoursInput, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'h:i K',
                        time_24hr: false,
                        minuteIncrement: 15,
                        defaultHour: 2,
                        defaultMinute: 0,
                        onChange: function(selectedDates, dateStr) {
                            if (!dateStr) return;
                            kuligligRentHoursInput.value = dateStr;
                            updateKuligligModalValues();
                        }
                    });

                    kuligligRentHoursInput.addEventListener('input', function() {
                        updateKuligligModalValues();
                    });
                }

                function formatPrice(value) {
                    return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 2 }).format(value);
                }

                function formatDisplayDate(value) {
                    const date = new Date(value);
                    if (isNaN(date)) return value;
                    return new Intl.DateTimeFormat('en-PH', { day: '2-digit', month: '2-digit', year: 'numeric' }).format(date);
                }

                function computeKuligligRentalPrice(days) {
                    return days * 500;
                }

                function formatKuligligDuration(days) {
                    return `${days} Day${days > 1 ? 's' : ''}`;
                }

                function updateKuligligModalValues() {
                    const durationText = formatKuligligDuration(selectedKuligligDays);
                    const price = computeKuligligRentalPrice(selectedKuligligDays);

                    if (kuligligRentModalDate) {
                        kuligligRentModalDate.textContent = formatDisplayDate(kuligligRentDateInput?.value || '');
                    }
                    if (kuligligRentModalHoursSummary) {
                        kuligligRentModalHoursSummary.textContent = kuligligRentHoursInput && kuligligRentHoursInput.value ? kuligligRentHoursInput.value : '02:00 PM';
                    }
                    if (kuligligRentModalSelectedDays) {
                        kuligligRentModalSelectedDays.textContent = durationText;
                    }
                    if (kuligligRentModalDuration) {
                        kuligligRentModalDuration.textContent = durationText;
                    }
                    if (kuligligRentModalPrice) {
                        kuligligRentModalPrice.textContent = formatPrice(price);
                    }
                    if (kuligligDaysInput) {
                        kuligligDaysInput.value = selectedKuligligDays;
                    }
                }

                function updateModalValues() {
                    const price = computeRentalPrice(selectedHectares, prices[selectedType]);
                    const duration = computeDurationHours(selectedHectares);
                    const durationText = formatDuration(selectedHectares);
                    const hoursToShow = duration.totalHours;

                    if (rentModalHoursSummary) {
                        rentModalHoursSummary.textContent = rentHoursInput && rentHoursInput.value ? rentHoursInput.value : '02:00 PM';
                    }
                    if (rentModalDate && rentDateInput) {
                        rentModalDate.textContent = formatDisplayDate(rentDateInput.value || '');
                    }
                    if (rentModalUseType) {
                        rentModalUseType.textContent = selectedType === 'public' ? 'Public Use' : 'Private Use';
                    }
                    if (rentModalHectares) {
                        rentModalHectares.textContent = `${selectedHectares.toFixed(1)} Hectare${selectedHectares > 1 ? 's' : ''}`;
                    }
                    if (rentModalDuration) {
                        rentModalDuration.textContent = durationText;
                    }
                    if (rentHoursToUseInput) {
                        rentHoursToUseInput.value = durationText;
                    }
                    rentModalPrice.textContent = formatPrice(price);
                    hectaresInput.value = selectedHectares.toFixed(1);
                    if (rentalDurationHidden) rentalDurationHidden.value = hoursToShow;
                    const rentMeta = document.querySelector('.rent-meta');
                    if (rentMeta) {
                        rentMeta.textContent = `Hours of Use: ${durationText} (Based on ${selectedHectares.toFixed(1)} Hectare${selectedHectares > 1 ? 's' : ''})`;
                    }
                }

                function setRentType(type) {
                    selectedType = type;
                    rentTypeButtons.forEach(function(button) {
                        button.classList.toggle('active', button.dataset.rentType === type);
                    });
                    updateModalValues();
                }

                function openRentModal(button) {
                    const imageSrc = button.dataset.image || '';
                    rentModalImage.src = imageSrc;
                    selectedType = 'public';
                    selectedHectares = 1;
                    setRentType('public');

                    // set defaults for date and hours when opening
                    if (rentDateInput) {
                        const today = new Date().toISOString().slice(0,10);
                        if (!rentDateInput.value) rentDateInput.value = today;
                        if (rentalFromHidden) rentalFromHidden.value = rentDateInput.value;
                    }
                    if (rentHoursInput) {
                        rentHoursInput.value = '02:00 PM';
                        manualHours = null;
                        hasManualHoursOverride = false;
                        if (rentalDurationHidden) rentalDurationHidden.value = computeDurationHours(selectedHectares).totalHours;
                    }

                    updateModalValues();
                    rentModal.classList.add('show');
                    rentModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                }

                function openKuligligRentModal(button) {
                    const imageSrc = button.dataset.image || '';
                    if (kuligligRentModalImage) kuligligRentModalImage.src = imageSrc;
                    selectedKuligligDays = 1;

                    if (kuligligRentDateInput) {
                        const today = new Date().toISOString().slice(0,10);
                        if (!kuligligRentDateInput.value) kuligligRentDateInput.value = today;
                    }
                    if (kuligligRentHoursInput) {
                        kuligligRentHoursInput.value = '02:00 PM';
                    }

                    updateKuligligModalValues();
                    kuligligRentModal.classList.add('show');
                    kuligligRentModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                }

                function closeRentModal() {
                    rentModal.classList.remove('show');
                    rentModal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }

                function closeKuligligRentModal() {
                    kuligligRentModal.classList.remove('show');
                    kuligligRentModal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }

                if (customerNameInput) {
                    const errorElement = document.createElement('div');
                    errorElement.id = 'duplicateNameError';
                    errorElement.style.cssText = `
                        display: none;
                        color: #dc2626;
                        background: #fee2e2;
                        padding: 10px 12px;
                        border-radius: 6px;
                        margin-top: 5px;
                        font-size: 0.9rem;
                        border: 1px solid #fecaca;
                    `;

                    customerNameInput.parentNode.insertBefore(errorElement, customerNameInput.nextSibling);

                    customerNameInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            const customerName = this.value.trim();
                            if (!customerName) {
                                duplicateNameError = false;
                                errorElement.style.display = 'none';
                                return;
                            }
                            fetch('{{ route("rental.checkDuplicateName") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ customer_name: customerName })
                            })
                            .then(response => response.json())
                            .then(data => {
                                duplicateNameError = data.exists;
                                if (data.exists) {
                                    errorElement.textContent = '❌ ' + data.message;
                                    errorElement.style.display = 'block';
                                } else {
                                    errorElement.style.display = 'none';
                                }
                            })
                            .catch(() => {
                                errorElement.style.display = 'none';
                            });
                        }, 500);
                    });
                }

                document.getElementById('rentalForm').addEventListener('submit', function(e) {
                    if (duplicateNameError) {
                        e.preventDefault();
                        alert('This name is already applied for renting equipment. Please use a different name.');
                        return false;
                    }

                    const equipment = [];
                    document.querySelectorAll('.equipment-card').forEach((card) => {
                        equipment.push({
                            name: card.querySelector('.equipment-card-title').textContent.trim(),
                            quantity: 1
                        });
                    });

                    if (equipment.length === 0) {
                        e.preventDefault();
                        alert('Please select at least one equipment to rent.');
                        return false;
                    }

                    hiddenEquipmentInput.value = JSON.stringify(equipment);
                });

                rentTypeButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        setRentType(this.dataset.rentType);
                    });
                });

                rentTriggers.forEach(function(button) {
                    button.addEventListener('click', function() {
                        if (this.dataset.equipmentType === 'kuliglig') {
                            openKuligligRentModal(this);
                        } else {
                            openRentModal(this);
                        }
                    });
                });

                decreaseButton.addEventListener('click', function() {
                    if (selectedHectares > 1.0) {
                        selectedHectares = parseFloat((selectedHectares - 0.1).toFixed(1));
                        if (selectedHectares < 1.0) selectedHectares = 1.0;
                        updateModalValues();
                    }
                });

                increaseButton.addEventListener('click', function() {
                    selectedHectares = parseFloat((selectedHectares + 0.1).toFixed(1));
                    updateModalValues();
                });

                kuligligDaysDecreaseButton?.addEventListener('click', function() {
                    if (selectedKuligligDays > 1) {
                        selectedKuligligDays -= 1;
                        updateKuligligModalValues();
                    }
                });

                kuligligDaysIncreaseButton?.addEventListener('click', function() {
                    selectedKuligligDays += 1;
                    updateKuligligModalValues();
                });

                rentCloseButton?.addEventListener('click', closeRentModal);
                kuligligRentCloseButton?.addEventListener('click', closeKuligligRentModal);
                kuligligRentModalConfirm?.addEventListener('click', closeKuligligRentModal);
                rentModal?.addEventListener('click', function(event) {
                    if (event.target === rentModal) {
                        closeRentModal();
                    }
                });
                kuligligRentModal?.addEventListener('click', function(event) {
                    if (event.target === kuligligRentModal) {
                        closeKuligligRentModal();
                    }
                });
            </script>
        </div>
    </main>

</body>
</html>
