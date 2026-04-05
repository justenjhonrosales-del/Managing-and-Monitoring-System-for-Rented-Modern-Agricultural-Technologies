<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - AgriRent Buguey</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-dark: #1b5e20;
            --primary-light: #4caf50;
            --text-dark: #1a1a1a;
            --text-light: #6b7280;
            --bg-light: #f3f4f6;
            --white: #ffffff;
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
            margin-bottom: 30px;
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

        /* FILTERS */
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            align-items: center;
        }

        .filter-tabs {
            display: flex;
            gap: 0;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 1px solid #e0e0e0;
            background: var(--white);
            color: var(--text-dark);
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-radius: 0;
        }

        .filter-btn:first-child {
            border-radius: 6px 0 0 6px;
        }

        .filter-btn:last-child {
            border-radius: 0 6px 6px 0;
        }

        .filter-btn:hover {
            background: var(--bg-light);
        }

        .filter-btn.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .filter-dropdown {
            margin-left: auto;
            position: relative;
        }

        .dropdown-toggle {
            padding: 10px 20px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: var(--white);
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
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

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            min-width: 90px;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .empty-state {
            text-align: center;
            color: #9ca3af;
            padding: 40px;
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

            .filters {
                flex-wrap: wrap;
            }

            .filter-dropdown {
                margin-left: 0;
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
                <a href="{{ route('admin.reports') }}" class="sidebar-item active">
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
                <h1>Reports</h1>
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

            <!-- FILTERS -->
            <div class="filters">
                <div class="filter-tabs">
                    <a href="{{ route('admin.reports', ['status' => 'all']) }}" class="filter-btn {{ $status === 'all' ? 'active' : '' }}">All</a>
                    <a href="{{ route('admin.reports', ['status' => 'active']) }}" class="filter-btn {{ $status === 'active' ? 'active' : '' }}">Active</a>
                    <a href="{{ route('admin.reports', ['status' => 'pending']) }}" class="filter-btn {{ $status === 'pending' ? 'active' : '' }}">Pending</a>
                    <a href="{{ route('admin.reports', ['status' => 'completed']) }}" class="filter-btn {{ $status === 'completed' ? 'active' : '' }}">Completed</a>
                    <a href="{{ route('admin.reports', ['status' => 'cancelled']) }}" class="filter-btn {{ $status === 'cancelled' ? 'active' : '' }}">Cancelled</a>
                </div>
                <div class="filter-dropdown">
                    <button class="dropdown-toggle">📋</button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Equipment</th>
                            <th>Date Rented</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentals as $rental)
                            <tr>
                                <td><strong>{{ $rental->rental_number }}</strong></td>
                                <td>{{ $rental->customer_name }}</td>
                                <td>
                                    @if(is_array($rental->equipment) && count($rental->equipment) > 0)
                                        @foreach($rental->equipment as $item)
                                            <div>{{ $item['name'] ?? 'Unknown' }}</div>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $rental->rental_from ? $rental->rental_from->format('M d') : 'N/A' }}</td>
                                <td>{{ $rental->rental_to ? $rental->rental_to->format('M d') : 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ $rental->status }}">
                                        {{ ucfirst($rental->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">No rental records found</td>
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
    </script>
</body>
</html>
