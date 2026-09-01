<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Rentals - AgriRent Buguey</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-dark: #1b5e20;
            --primary-light: #4caf50;
            --accent-color: #f9a825;
            --text-dark: #1a1a1a;
            --text-light: #6b7280;
            --bg-light: #f3f4f6;
            --white: #ffffff;
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f5f5f5;
            color: var(--text-dark);
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
            background: var(--white);
        }

        /* SIDEBAR */
        .sidebar {
            background: var(--primary-dark);
            padding: 25px 20px;
            grid-column: 1;
            grid-row: 1 / -1;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            padding: 12px 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: var(--white);
            font-weight: 700;
            font-size: 0.75rem;
            text-decoration: none;
            line-height: 1.3;
        }

        .sidebar-logo img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            margin-right: 8px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
        }

        .sidebar-item.active {
            background: var(--primary-light);
            color: var(--white);
        }

        /* MAIN CONTENT */
        .main-content {
            grid-column: 2;
            padding: 30px;
            background: var(--white);
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--text-dark);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background: var(--white);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            z-index: 1000;
            display: none;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 0.9rem;
            border: none;
            background: none;
            cursor: pointer;
            text-align: left;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: var(--bg-light);
            color: var(--primary-color);
        }

        .dropdown-item.logout {
            color: #ef4444;
        }

        .dropdown-item.logout:hover {
            background: #fee2e2;
        }

        /* ALERT */
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        /* TABS */
        .equipment-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .equipment-tab {
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .equipment-tab:hover {
            background: #e0e0e0;
        }

        .equipment-tab.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        /* SEARCH */
        .search-container {
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.9rem;
            width: 300px;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        /* TABLE */
        .table-container {
            overflow-x: auto;
            background: var(--white);
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            background: var(--bg-light);
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
            border-bottom: 1px solid #e0e0e0;
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.9rem;
        }

        tr:hover {
            background: var(--bg-light);
        }

        .status-paid {
            color: #22c55e;
            font-weight: 600;
        }

        .equipment-tag {
            display: inline;
            background: none;
            color: var(--text-dark);
            padding: 0;
            margin-right: 8px;
            font-weight: 500;
        }

        .btn-approved {
            background: #22c55e;
            color: var(--white);
            padding: 6px 16px;
            border: none;
            border-radius: 4px;
            cursor: not-allowed;
            font-size: 0.85rem;
            font-weight: 600;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                height: auto;
                border-top: 1px solid #e0e0e0;
                border-right: none;
                z-index: 1000;
                padding: 15px 20px;
            }

            .main-content {
                grid-column: 1;
                padding: 20px 15px;
                padding-bottom: 100px;
            }

            .table-container {
                overflow-x: scroll;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <a href="#" class="sidebar-logo">
                <img src="{{ asset('images/buguey-logo.png') }}" alt="Buguey Logo">
                FARMERS EQUIPMENT RENTAL
            </a>

            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item">
                    Dashboard
                </a>
                <a href="{{ route('admin.rentals') }}" class="sidebar-item">
                    Rentals
                </a>
                <a href="{{ route('admin.paid-rentals') }}" class="sidebar-item active">
                    Paid Rentals
                </a>
                <a href="{{ route('admin.reports') }}" class="sidebar-item">
                    Reports
                </a>
                <a href="{{ route('admin.payments') }}" class="sidebar-item">
                    Payment
                </a>
                <a href="{{ route('admin.settings') }}" class="sidebar-item">
                    Settings
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- HEADER -->
            <div class="header">
                <h1>Paid Rentals</h1>
                <div class="header-right">
                    <div class="admin-profile">
                        <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                        <div class="admin-avatar" onclick="toggleDropdown()">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            <div class="dropdown-menu" id="dropdownMenu">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ALERTS -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <!-- EQUIPMENT FILTER TABS -->
            <div class="equipment-tabs">
                <button class="equipment-tab active" data-filter="all">All Rentals</button>
                <button class="equipment-tab" data-filter="Tractor">Tractor</button>
                <button class="equipment-tab" data-filter="Reaper or Thresher">Thresher</button>
                <button class="equipment-tab" data-filter="Kuliglig">Kuliglig</button>
            </div>

            <!-- SEARCH -->
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Search by customer name or rental ID...">
            </div>

            <!-- TABLE -->
            <div class="table-container">
                <table id="paidRentalsTable">
                    <thead>
                        <tr>
                            <th>Equipment</th>
                            <th>Customer Name</th>
                            <th>Age</th>
                            <th>Primary Address</th>
                            <th>Usage Type</th>
                            <th>Selected Hectares</th>
                            <th>Duration</th>
                            <th>Rental Date</th>
                            <th>Start Time</th>
                            <th>Rental Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentals as $rental)
                            @php
                                $equipmentName = 'Unknown';
                                $rawEquipmentName = 'Unknown';
                                if (is_array($rental->equipment) && count($rental->equipment) > 0) {
                                    $rawEquipmentName = $rental->equipment[0]['name'] ?? 'Unknown';
                                    $equipmentName = $rawEquipmentName === 'Reaper or Thresher' ? 'Thresher' : $rawEquipmentName;
                                }
                                $durationText = '-';
                                if ($rental->rental_duration_hours !== null) {
                                    $hours = intval(floor($rental->rental_duration_hours));
                                    $minutes = intval(round(($rental->rental_duration_hours - $hours) * 60));
                                    $durationText = sprintf('%dh %02dm', $hours, $minutes);
                                }
                                $selectedValue = null;
                                if (strtolower(trim($equipmentName)) === 'kuliglig') {
                                    $selectedValue = isset($rental->equipment[0]['meta']['days']) ? $rental->equipment[0]['meta']['days'] . ' Day' . ($rental->equipment[0]['meta']['days'] != 1 ? 's' : '') : '-';
                                } else {
                                    $hectares = isset($rental->equipment[0]['meta']['hectares']) ? number_format($rental->equipment[0]['meta']['hectares'], 1) : null;
                                    $selectedValue = $hectares ? $hectares . ' Hectare' . ($hectares != 1 ? 's' : '') : '-';
                                }
                                $rowDateIso = $rental->rental_from ? $rental->rental_from->format('Y-m-d') : '';
                            @endphp

                            <tr class="paid-rental-row" data-equipment="{{ $rawEquipmentName }}" data-customer="{{ strtolower($rental->customer_name) }}" data-date="{{ $rowDateIso }}">
                                <td><strong>{{ $equipmentName }}</strong></td>
                                <td>{{ $rental->customer_name }}</td>
                                <td>{{ $rental->age }}</td>
                                <td title="{{ $rental->primary_address }}" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $rental->primary_address }}</td>
                                <td>{{ ucfirst($rental->usage_type ?? 'public') }}</td>
                                <td>{{ $selectedValue }}</td>
                                <td>{{ $durationText }}</td>
                                <td>{{ $rental->rental_from ? $rental->rental_from->format('d/m/Y') : '-' }}</td>
                                <td>{{ $rental->start_time ?? '-' }}</td>
                                <td>
                                    @php
                                        $displayPrice = $rental->total_amount;
                                        if ($rawEquipmentName === 'Reaper or Thresher') {
                                            if ($rental->payment_amount !== null && $rental->payment_amount > 0) {
                                                $displayPrice = '₱' . number_format((float) $rental->payment_amount, 2);
                                            } else {
                                                $displayPrice = $rental->usage_type === 'public' ? '10%' : '12%';
                                            }
                                        } else {
                                            $displayPrice = '₱' . number_format($rental->total_amount, 2);
                                        }
                                    @endphp
                                    {{ $displayPrice }}
                                </td>
                                <td><span class="status-paid">Paid</span></td>
                                <td><button type="button" class="btn-approved" disabled>Approved</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" style="text-align: center; color: #9ca3af; padding: 40px;">No paid rentals found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('dropdownMenu');
            const avatar = event.target.closest('.admin-avatar');
            if (!avatar) {
                menu.classList.remove('active');
            }
        });

        // Equipment tab filtering
        const tabs = document.querySelectorAll('.equipment-tab');
        const rows = Array.from(document.querySelectorAll('.paid-rental-row'));
        const searchInput = document.getElementById('searchInput');

        function applyFilters() {
            const activeTab = document.querySelector('.equipment-tab.active');
            const tabFilter = activeTab ? activeTab.dataset.filter : 'all';
            const searchTerm = (searchInput.value || '').toLowerCase().trim();

            rows.forEach(row => {
                const equipment = (row.dataset.equipment || '').toLowerCase();
                const customer = (row.cells[1].innerText || '').toLowerCase();
                const rentalId = (row.cells[0].innerText || '').toLowerCase();

                let visible = true;

                // Equipment filter
                if (tabFilter !== 'all' && equipment !== tabFilter.toLowerCase()) {
                    visible = false;
                }

                // Search filter
                if (searchTerm && !(customer.includes(searchTerm) || rentalId.includes(searchTerm))) {
                    visible = false;
                }

                row.style.display = visible ? '' : 'none';
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                applyFilters();
            });
        });

        searchInput.addEventListener('keyup', applyFilters);
    </script>
</body>
</html>
