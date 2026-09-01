<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payments Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2e7d32;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            color: #2e7d32;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .report-title {
            font-size: 28px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .report-date {
            font-size: 12px;
            color: #666;
        }

        /* SUMMARY SECTION */
        .summary-section {
            margin-bottom: 30px;
        }

        .summary-title {
            font-size: 14px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #2e7d32;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }

        .summary-card-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .summary-card-value {
            font-size: 18px;
            font-weight: bold;
            color: #2e7d32;
        }

        /* TABLE SECTION */
        .table-section {
            margin-top: 30px;
        }

        .table-title {
            font-size: 14px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #2e7d32;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background: #2e7d32;
            color: white;
        }

        th {
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid #2e7d32;
        }

        td {
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            font-size: 11px;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        tbody tr:hover {
            background: #f5f5f5;
        }

        .total-row {
            background: #e8f5e9;
            font-weight: bold;
        }

        .total-row td {
            border: 1px solid #2e7d32;
            padding: 12px;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 10px;
            color: #999;
        }

        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 20px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <div class="logo">FARMERS EQUIPMENT RENTAL</div>
            <div class="report-title">Payments Report</div>
            <div class="report-date">Generated on: {{ $reportDate }}</div>
        </div>

        <!-- SUMMARY SECTION -->
        <div class="summary-section">
            <div class="summary-title">INCOME SUMMARY</div>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-card-label">Daily Income</div>
                    <div class="summary-card-value">₱{{ number_format($dailyIncome, 2) }}</div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-label">Weekly Income</div>
                    <div class="summary-card-value">₱{{ number_format($weeklyIncome, 2) }}</div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-label">Yearly Income</div>
                    <div class="summary-card-value">₱{{ number_format($yearlyIncome, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- TABLE SECTION -->
        <div class="table-section">
            <div class="table-title">PAYMENT TRANSACTIONS</div>
            
            @if($completedRentals->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Rental ID</th>
                            <th>Customer Name</th>
                            <th>Date Completed</th>
                            <th>Payment Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completedRentals as $rental)
                            <tr>
                                <td>{{ $rental->rental_number }}</td>
                                <td>{{ $rental->customer_name }}</td>
                                <td>{{ $rental->updated_at->format('Y-m-d') }}</td>
                                <td>₱{{ number_format($rental->payment_amount !== null && $rental->payment_amount > 0 ? $rental->payment_amount : $rental->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3" style="text-align: right;">TOTAL:</td>
                            <td>₱{{ number_format($completedRentals->sum(function($rental) { return $rental->payment_amount !== null && $rental->payment_amount > 0 ? $rental->payment_amount : $rental->total_amount; }), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    No payment records found for the selected criteria.
                </div>
            @endif
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>This is an automated report generated from the Farmers Equipment Rental system.</p>
            <p>Report Date: {{ $reportDate }}</p>
        </div>
    </div>
</body>
</html>
