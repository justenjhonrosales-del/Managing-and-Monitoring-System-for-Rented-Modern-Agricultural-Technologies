<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Details - {{ $rental->rental_number }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #f3f4f6;
            color: #111827;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }
        .details-container {
            max-width: 900px;
            margin: 32px auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.08);
            padding: 28px;
        }
        .details-header {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 24px;
        }
        .details-title {
            font-size: 1.75rem;
            margin: 0;
            font-weight: 700;
        }
        .details-section {
            margin-bottom: 24px;
        }
        .details-section h2 {
            font-size: 1rem;
            margin-bottom: 14px;
            color: #374151;
            letter-spacing: 0.01em;
            text-transform: uppercase;
        }
        .details-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        .details-card {
            background: #f9fafb;
            border-radius: 14px;
            padding: 18px;
            border: 1px solid #e5e7eb;
        }
        .details-card-label {
            display: block;
            margin-bottom: 6px;
            color: #6b7280;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.01em;
        }
        .details-card-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 600;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #047857;
            font-weight: 700;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <div class="details-header">
            <div>
                <h1 class="details-title">Rental Details</h1>
                <p style="margin: 0; color: #6b7280;">Rental ID: {{ $rental->rental_number }}</p>
            </div>
            <a href="{{ route('rents.index') }}" class="back-link">&larr; Back to Rents</a>
        </div>

        <div class="details-section">
            <h2>Customer Information</h2>
            <div class="details-grid">
                <div class="details-card">
                    <span class="details-card-label">Full Name</span>
                    <span class="details-card-value">{{ $rental->customer_name }}</span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Age</span>
                    <span class="details-card-value">{{ $rental->age }}</span>
                </div>
                <div class="details-card" style="grid-column: span 2;">
                    <span class="details-card-label">Primary Address</span>
                    <span class="details-card-value">{{ $rental->primary_address }}</span>
                </div>
            </div>
        </div>

        <div class="details-section">
            <h2>Equipment</h2>
            <div class="details-grid">
                <div class="details-card">
                    <span class="details-card-label">Equipment Name</span>
                    <span class="details-card-value">
                        {{ is_array($rental->equipment) && count($rental->equipment) > 0 ? $rental->equipment[0]['name'] : 'Unknown' }}
                    </span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Selected Hectares</span>
                    <span class="details-card-value">
                        {{ isset($rental->equipment[0]['meta']['hectares']) ? number_format($rental->equipment[0]['meta']['hectares'], 1) . ' Hectare' : '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="details-section">
            <h2>Rental Details</h2>
            <div class="details-grid">
                <div class="details-card">
                    <span class="details-card-label">Usage Type</span>
                    <span class="details-card-value">{{ ucfirst($rental->usage_type ?? 'public') }}</span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Duration</span>
                    <span class="details-card-value">
                        @php
                            if ($rental->rental_duration_hours !== null) {
                                $hours = intval(floor($rental->rental_duration_hours));
                                $minutes = intval(round(($rental->rental_duration_hours - $hours) * 60));
                                echo sprintf('%dh %02dm', $hours, $minutes);
                            } else {
                                echo '-';
                            }
                        @endphp
                    </span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Rental Date</span>
                    <span class="details-card-value">{{ $rental->rental_from ? $rental->rental_from->format('d/m/Y') : '-' }}</span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Start Time</span>
                    <span class="details-card-value">{{ $rental->start_time ?? '-' }}</span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Rental Price</span>
                    <span class="details-card-value">{{ $rental->total_amount !== null ? '₱' . number_format($rental->total_amount, 2) : '-' }}</span>
                </div>
                <div class="details-card">
                    <span class="details-card-label">Status</span>
                    <span class="details-card-value">{{ ucfirst($rental->status) }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
