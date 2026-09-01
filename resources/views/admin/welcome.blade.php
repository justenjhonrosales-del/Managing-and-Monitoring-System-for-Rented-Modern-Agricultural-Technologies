<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AgriRent Buguey</title>
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
            width: 20px;
            height: 20px;
            object-fit: contain;
            filter: brightness(0) invert(1);
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

        .sidebar-item svg {
            width: 18px;
            height: 18px;
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

        .dropdown-menu a,
        .dropdown-menu form {
            width: 100%;
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

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            box-shadow: 0 8px 16px rgba(46, 125, 50, 0.1);
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* CONTENT GRID */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .card {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h3 {
            font-size: 1.15rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .card-empty {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* TABLE */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px;
            background: var(--bg-light);
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
            border-bottom: 1px solid #e0e0e0;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.9rem;
        }

        tr:hover {
            background: var(--bg-light);
        }

        .status-active {
            color: #22c55e;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-pending {
            color: #f97316;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-completed {
            color: #ef4444;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-cancelled {
            color: #8b5cf6;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* CHART */
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 300px;
        }

        .donut-chart {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: conic-gradient(
                #2e7d32 0deg 234deg,
                #64b5f6 234deg 270deg,
                #9e9e9e 270deg 360deg
            );
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .donut-chart::before {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            background: var(--white);
            border-radius: 50%;
        }

        .chart-center {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .chart-legend {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
            font-size: 0.85rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .legend-dot.available {
            background: #2e7d32;
        }

        .legend-dot.rented {
            background: #64b5f6;
        }

        .legend-dot.maintenance {
            background: #9e9e9e;
        }

        /* EQUIPMENT TAGS */
        .equipment-tag {
            display: inline;
            background: none;
            color: var(--text-dark);
            padding: 0;
            border-radius: 0;
            font-size: 0.9rem;
            margin-right: 8px;
            margin-bottom: 0;
            font-weight: 500;
            white-space: nowrap;
        }

        /* SEARCH BAR */
        .search-container {
            margin-bottom: 15px;
            flex-shrink: 0;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.9rem;
            width: 250px;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .sidebar-logo img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            margin-right: 8px;
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

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
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
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item active">
                    Dashboard
                </a>
                <a href="{{ route('admin.rentals') }}" class="sidebar-item">
                    
                    Rentals
                </a>
                <a href="{{ route('admin.paid-rentals') }}" class="sidebar-item">
                    
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
                <h1>Dashboard</h1>
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

            <!-- STATS GRID -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $rentals->count() }}</div>
                    <div class="stat-label">Total Rental Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $rentals->where('status', 'active')->count() }}</div>
                    <div class="stat-label">Active Rentals</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $rentals->where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Pending Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">₱{{ number_format($totalPayment ?? 0, 2) }}</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>

            <!-- CONTENT GRID -->
            <div class="content-grid">
                <!-- RECENT RENTALS -->
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Rentals</h3>
                        <span class="card-empty">{{ $rentals->count() }}</span>
                    </div>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Search by customer or rental ID...">
                    </div>
                    <div class="table-container">
                        <table id="rentalsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Equipment</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rentals as $rental)
                                    <tr class="rental-row" data-customer="{{ strtolower($rental->customer_name) }}" data-id="{{ strtolower($rental->rental_number) }}">
                                        <td><strong>{{ $rental->rental_number }}</strong></td>
                                        <td>{{ $rental->customer_name }}</td>
                                        <td>
                                            @if(is_array($rental->equipment) && count($rental->equipment) > 0)
                                                @foreach($rental->equipment as $item)
                                                    <span class="equipment-tag">[ {{ $item['name'] ?? 'Unknown' }} x{{ $item['quantity'] ?? 0 }} ]</span>
                                                @endforeach
                                            @elseif($rental->equipment)
                                                @if(is_string($rental->equipment))
                                                    {{ $rental->equipment }}
                                                @else
                                                    N/A
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $rental->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($rental->status === 'active')
                                                <span class="status-active">Active</span>
                                            @elseif($rental->status === 'pending')
                                                <span class="status-pending">Pending</span>
                                            @elseif($rental->status === 'completed')
                                                <span class="status-completed">Completed</span>
                                            @elseif($rental->status === 'cancelled')
                                                <span class="status-cancelled">Cancelled</span>
                                            @else
                                                <span class="status-completed">{{ ucfirst($rental->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: #9ca3af; padding: 20px;">No rental requests yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- EQUIPMENT OVERVIEW -->
                <div class="card">
                    <div class="card-header">
                        <h3>Equipment Overview</h3>
                        <span class="card-empty">0</span>
                    </div>
                    <div class="chart-container">
                        <div>
                            <div class="donut-chart">
                                <div class="chart-center"></div>
                            </div>
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <div class="legend-dot available"></div>
                                    <span>Available: 9</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot rented"></div>
                                    <span>Rented: 2</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot maintenance"></div>
                                    <span>Maintenance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('dropdownMenu');
            const avatar = event.target.closest('.admin-avatar');
            if (!avatar) {
                menu.classList.remove('active');
            }
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const rentalRows = document.querySelectorAll('.rental-row');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            rentalRows.forEach(row => {
                const customerName = row.getAttribute('data-customer');
                const rentalId = row.getAttribute('data-id');
                if (customerName.includes(searchTerm) || rentalId.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
