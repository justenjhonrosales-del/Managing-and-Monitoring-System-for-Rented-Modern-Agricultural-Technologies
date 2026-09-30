<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - AgriRent Buguey</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-dark: #1b5e20;
            --primary-light: #4caf50;
            --text-dark: #1a1a1a;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background: var(--primary-dark);
            padding: 25px 20px;
            grid-column: 1;
            grid-row: 1 / -1;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
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
            background: var(--bg-light);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
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
            cursor: pointer;
        }

        /* SUMMARY CARDS */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .summary-card {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .summary-card-content h3 {
            font-size: 0.9rem;
            color: var(--text-light);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .summary-card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            font-family: 'Playfair Display', serif;
        }

        .summary-card-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .summary-card:nth-child(1) {
        }

        .summary-card:nth-child(2) {
        }

        .summary-card:nth-child(3) {
        }

        /* PAYMENTS TABLE SECTION */
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px;
        }

        .filter-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-box select,
        .filter-box input {
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
        }

        #searchPayment {
            margin-right: 20px;
        }

        /* TABLE */
        .table-wrapper {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #e5e7eb;
        }

        .pagination-info {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .pagination a,
        .pagination button {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            cursor: pointer;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.85rem;
        }

        .pagination button.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--bg-light);
        }

        th {
            padding: 15px 25px;
            text-align: left;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 15px 25px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.9rem;
        }

        tbody tr:hover {
            background: var(--bg-light);
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-light);
        }

        @media (max-width: 1200px) {
            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
            }
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
                max-height: 200px;
                overflow-x: auto;
                z-index: 1000;
            }

            .main-content {
                padding-bottom: 250px;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            th, td {
                padding: 10px 15px;
                font-size: 0.8rem;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar')

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- HEADER -->
            <div class="header">
                <h1>Payment Transactions</h1>
                <div class="header-right">
                    <div class="admin-profile">
                        <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                        <div class="admin-avatar">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="summary-card-content">
                        <h3>Weekly Income</h3>
                        <div class="summary-card-value">₱{{ number_format($weeklyIncome, 2) }}</div>
                    </div>
                    
                </div>

                <div class="summary-card">
                    <div class="summary-card-content">
                        <h3>Monthly Income</h3>
                        <div class="summary-card-value">₱{{ number_format($monthlyIncome, 2) }}</div>
                    </div>
                    
                </div>

                <div class="summary-card">
                    <div class="summary-card-content">
                        <h3>Yearly Income</h3>
                        <div class="summary-card-value">₱{{ number_format($yearlyIncome, 2) }}</div>
                    </div>
                    
                </div>
            </div>

            <div class="table-wrapper">
                <div class="table-header">
                    <div class="pagination-info">
                        Showing <span id="pageCount">1</span> to <span id="showingCount">10</span> of <span id="totalCount">{{ $paidRentals->count() }}</span> Entries
                    </div>
                    <div class="pagination">
                        <button onclick="previousPage()">&laquo;</button>
                        <button class="active" onclick="goToPage(1)">1</button>
                        <button>&raquo;</button>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Payment Amount</th>
                        </tr>
                    </thead>
                    <tbody id="paymentTableBody">
                        @forelse($paidRentals as $rental)
                            @php
                                $paymentPrice = $rental->payment_amount !== null && $rental->payment_amount > 0
                                    ? $rental->payment_amount
                                    : $rental->total_amount;
                            @endphp
                            <tr class="payment-row">
                                <td><input type="checkbox"></td>
                                <td>{{ $rental->customer_name }}</td>
                                <td>{{ $rental->primary_address }}</td>
                                <td><strong>₱{{ number_format($paymentPrice, 2) }}</strong></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">No payment records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function previousPage() {
            console.log('Previous page');
        }

        function goToPage(page) {
            console.log('Go to page', page);
        }
    </script>
</body>
</html>
