<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Rental Portal - AgriRent Buguey</title>
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
                            ['name' => 'Tractor', 'image' => 'tractor.png'],
                            ['name' => 'Reaper or Thresher', 'image' => 'reaper or thresher.jpg'],
                            ['name' => 'Kuliglig', 'image' => 'kuliglig.jpg'],
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
                                        <span class="equipment-status-value">2</span>
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
                                <button type="button" class="equipment-rent-btn">Rent Now</button>
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

            <script>
                let duplicateNameError = false;
                let debounceTimer;

                // Get customer name input
                const customerNameInput = document.querySelector('input[name="customer_name"]');
                
                // Create error message element
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

                // Insert error element after customer name input
                if (customerNameInput) {
                    customerNameInput.parentNode.insertBefore(errorElement, customerNameInput.nextSibling);

                    // Add event listener for real-time duplicate check
                    customerNameInput.addEventListener('input', function() {
                        clearTimeout(debounceTimer);
                        
                        debounceTimer = setTimeout(() => {
                            const customerName = this.value.trim();
                            
                            if (!customerName) {
                                duplicateNameError = false;
                                errorElement.style.display = 'none';
                                return;
                            }

                            // AJAX call to check for duplicate
                            fetch('{{ route("rental.checkDuplicateName") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    customer_name: customerName
                                })
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
                            .catch(error => {
                                console.error('Error checking duplicate name:', error);
                            });
                        }, 500); // Debounce by 500ms
                    });
                }

                document.getElementById('rentalForm').addEventListener('submit', function(e) {
                    // Check for duplicate name error
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

                    // Add equipment data to hidden input
                    document.getElementById('equipmentInput').value = JSON.stringify(equipment);
                });
            </script>
        </div>
    </main>

</body>
</html>
