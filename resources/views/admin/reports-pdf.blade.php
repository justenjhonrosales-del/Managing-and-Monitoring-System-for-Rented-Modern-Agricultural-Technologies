<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approved Rentals Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #1f2937; font-size: 9px; }
        h1 { margin: 0 0 6px; color: #075e49; font-size: 20px; }
        .period { margin-bottom: 16px; color: #64748b; font-size: 10px; }
        .summary { margin-bottom: 14px; padding: 9px 12px; background: #eaf5f1; color: #075e49; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 7px 5px; color: #fff; background: #08745b; text-align: left; }
        td { padding: 6px 5px; border-bottom: 1px solid #dce6e1; vertical-align: top; }
        tbody tr:nth-child(even) { background: #f6faf8; }
        .amount { text-align: right; white-space: nowrap; }
        .empty { padding: 24px; color: #64748b; text-align: center; }
        .total { margin-top: 12px; text-align: right; font-size: 12px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Approved Equipment Rentals</h1>
    <div class="period">Approval period: {{ $periodStart->format('M d, Y') }} to {{ $periodEnd->format('M d, Y') }}</div>
    <div class="summary">{{ $paidRentals->count() }} approved rental record(s) in the last 30 days</div>

    <table>
        <thead>
            <tr>
                <th>Rental ID</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Equipment</th>
                <th>Rental Date</th>
                <th>Approved At</th>
                <th class="amount">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($paidRentals as $rental)
                @php
                    $equipmentItems = is_array($rental->equipment) ? $rental->equipment : [];
                    $equipmentNames = collect($equipmentItems)->pluck('name')->filter()->implode(', ');
                    $amount = $rental->payment_amount !== null && $rental->payment_amount > 0
                        ? $rental->payment_amount
                        : $rental->total_amount;
                @endphp
                <tr>
                    <td>{{ $rental->rental_number }}</td>
                    <td>{{ $rental->customer_name }}</td>
                    <td>{{ $rental->primary_address }}</td>
                    <td>{{ $equipmentNames ?: '-' }}</td>
                    <td>{{ $rental->rental_from?->format('Y-m-d') ?? '-' }}</td>
                    <td>{{ $rental->updated_at?->format('Y-m-d H:i') ?? '-' }}</td>
                    <td class="amount">PHP {{ number_format((float) $amount, 2) }}</td>
                </tr>
            @empty
                <tr><td class="empty" colspan="7">No approved rentals in this 30-day period.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">Total approved amount: PHP {{ number_format($totalAmount, 2) }}</div>
</body>
</html>
