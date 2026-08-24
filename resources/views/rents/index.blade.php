<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rents - AgriRent Buguey</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Rents page specific styles - scoped to .rents-page to avoid global changes */
        .rents-page { background: #f6f7f9; min-height: 100vh; padding: 28px 20px; font-family: 'Inter', sans-serif; color: #0f172a; }
        .rents-header { max-width: 1180px; margin: 0 auto 18px; }
        .rents-title { font-size: 28px; font-weight: 800; margin: 6px 0 4px; color: #0b1220; }
        .rents-sub { color: #6b7280; margin-bottom: 12px; }

        .rents-container { max-width: 1180px; margin: 0 auto; background: #fff; border-radius: 14px; padding: 26px; box-shadow: 0 6px 18px rgba(12, 18, 31, 0.04); border: 1px solid rgba(15,23,42,0.04); }

        .rents-top { display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom: 18px; }
        .rents-tabs { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
        .rents-tab { background: transparent; border: 1px solid #e5e7eb; padding:8px 16px; border-radius: 999px; color:#0f172a; font-weight:700; cursor:pointer; }
        .rents-tab.active { background:#047857; border-color:#047857; color:#fff; box-shadow: 0 6px 12px rgba(4,120,87,0.08); }

        .rents-filters { display:flex; gap:12px; align-items:center; }
        .rents-search { display:flex; align-items:center; gap:8px; }
        .rents-search input[type="search"] { padding:10px 12px; border-radius:10px; border:1px solid #e6e9ee; min-width:220px; }
        .rents-select, .rents-date { padding:10px 12px; border-radius:10px; border:1px solid #e6e9ee; background:#fff; }

        .rents-table-wrapper { overflow-x:auto; }
        table.rents-table { width:100%; border-collapse:collapse; min-width:1100px; }
        table.rents-table thead th { background:#f3f4f6; color:#0f172a; font-weight:700; padding:14px 12px; text-align:left; border-bottom:1px solid #e6e9ee; }
        table.rents-table tbody td { background: #fff; padding:12px; vertical-align:middle; border-bottom:1px solid #f1f5f9; }

        .rents-equipment { display:flex; gap:12px; align-items:center; }
        .rents-equipment-image { width:40px; height:40px; border-radius:8px; object-fit:cover; display:inline-block; }
        .rents-equipment-name { font-weight:700; color:#0b1220; }

        .rents-address { max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

        .rents-status { display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px; font-weight:700; font-size:0.85rem; }
        .rents-status.pending { background:#fef3c7; color:#92400e; }
        .rents-status.approved { background:#dcfce7; color:#065f46; }
        .rents-status.rejected { background:#fee2e2; color:#991b1b; }
        .rents-status.completed { background:#dbeafe; color:#1e3a8a; }

        .rents-action-button { display:inline-flex; align-items:center; justify-content:center; background:#047857; color:#fff; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:700; min-width:84px; height:36px; }

        .rents-status.paid { background:#d1fae5; color:#064e3b; }

        .rents-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 12px 16px;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(15,23,42,0.12);
            display: none;
            z-index: 1200;
            max-width: 320px;
        }

        .rents-payment-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.52);
            backdrop-filter: blur(4px);
            z-index: 1100;
            padding: 16px;
        }

        .rents-payment-overlay.visible {
            display: flex;
        }

        .rents-payment-modal {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.16);
            width: min(100%, 420px);
            max-width: 420px;
            padding: 24px;
            position: relative;
        }

        .rents-payment-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .rents-payment-modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .rents-payment-modal-close {
            background: transparent;
            border: none;
            color: #475569;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
        }

        .rents-payment-modal-body {
            display: grid;
            gap: 16px;
            color: #334155;
            font-size: 0.96rem;
            margin-bottom: 24px;
        }

        .rents-payment-modal-body .rents-payment-row {
            display: grid;
            gap: 6px;
        }

        .rents-payment-modal-body .rents-payment-row label {
            font-weight: 700;
            color: #0f172a;
        }

        .rents-payment-modal-body .rents-payment-value {
            color: #475569;
        }

        .rents-payment-modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .rents-cancel-button,
        .rents-mark-paid-button {
            border: none;
            border-radius: 10px;
            min-width: 120px;
            padding: 10px 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .rents-cancel-button {
            background: #f8fafc;
            color: #475569;
        }

        .rents-mark-paid-button {
            background: #047857;
            color: #ffffff;
        }

        @media (max-width: 900px) {
            .rents-top { flex-direction:column; align-items:stretch; }
            .rents-filters { justify-content:flex-start; }
            .rents-search input[type="search"] { min-width:140px; }
        }
    </style>
</head>
<body>

<div class="rents-page">
    <header class="rents-header">
        <h1 class="rents-title">Staff Dashboard</h1>
        <div class="rents-sub"></div>
    </header>

    <section class="rents-container">
        <div class="rents-top">
            <div class="rents-tabs" role="tablist" aria-label="Rental categories">
                <button class="rents-tab active" data-filter="all">All Rentals</button>
                <button class="rents-tab" data-filter="Tractor">Tractor</button>
                <button class="rents-tab" data-filter="Reaper or Thresher">Thresher</button>
                <button class="rents-tab" data-filter="Kuliglig">Kuliglig</button>
            </div>

            <div class="rents-filters">
                <div class="rents-search">
                    <input id="rentsSearch" type="search" placeholder="Search" aria-label="Search rentals">
                </div>
                <select id="rentsStatus" class="rents-select" aria-label="Filter status">
                    <option value="all">All</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Approved</option>
                </select>
                <input id="rentsDate" class="rents-date" type="date" aria-label="Filter by date">
            </div>
        </div>

        <div class="rents-table-wrapper">
            <table class="rents-table">
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
                <tbody id="rentsTableBody">
                    @forelse($rentals as $rental)
                        @php
                            $equipmentName = 'Unknown';
                            $rawEquipmentName = 'Unknown';
                            $equipmentImage = null;
                            if (is_array($rental->equipment) && count($rental->equipment) > 0) {
                                $rawEquipmentName = $rental->equipment[0]['name'] ?? 'Unknown';
                                $equipmentName = $rawEquipmentName === 'Reaper or Thresher' ? 'Thresher' : $rawEquipmentName;
                                $equipmentImage = $rental->equipment[0]['image'] ?? null;
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

                        <tr class="rents-table-row" data-rental-id="{{ $rental->id }}" data-equipment="{{ $rawEquipmentName }}" data-status="{{ $rental->status }}" data-date="{{ $rowDateIso }}">
                            <td>
                                <div class="rents-equipment">
                                    @php
                                        $showImage = $equipmentImage && strtolower(trim($equipmentName)) !== 'tractor';
                                    @endphp
                                    @if($showImage)
                                        <img class="rents-equipment-image" src="{{ asset('images/' . $equipmentImage) }}" alt="{{ $equipmentName }}">
                                    @endif
                                    <div class="rents-equipment-name">{{ $equipmentName }}</div>
                                </div>
                            </td>
                            <td>{{ $rental->customer_name }}</td>
                            <td>{{ $rental->age }}</td>
                            <td class="rents-address" title="{{ $rental->primary_address }}">{{ $rental->primary_address }}</td>
                            <td>{{ ucfirst($rental->usage_type ?? 'public') }}</td>
                            <td>{{ $selectedValue }}</td>
                            <td>{{ $durationText }}</td>
                            <td>{{ $rental->rental_from ? $rental->rental_from->format('d/m/Y') : '-' }}</td>
                            <td>{{ $rental->start_time ?? '-' }}</td>
                            <td>
                                @php
                                    $displayPrice = $rental->total_amount;
                                    if ($rawEquipmentName === 'Reaper or Thresher') {
                                        $displayPrice = $rental->usage_type === 'public' ? '10%' : '12%';
                                    } else {
                                        $displayPrice = '₱' . number_format($rental->total_amount, 2);
                                    }
                                @endphp
                                {{ $displayPrice }}
                            </td>
                            <td>
                                <span class="rents-status {{ strtolower($rental->status) }}">{{ ucfirst($rental->status) }}</span>
                            </td>
                            <td>
                                @if($rental->status === 'pending')
                                    <button type="button" class="rents-action-button rents-pay-confirm-button"
                                        data-rental-id="{{ $rental->id }}"
                                        data-equipment="{{ $equipmentName }}"
                                        data-total-amount="{{ $rental->total_amount }}"
                                        data-rental-date="{{ $rental->rental_from ? $rental->rental_from->format('d/m/Y') : '-' }}"
                                        data-start-time="{{ $rental->start_time ?? '-' }}"
                                        data-duration="{{ $durationText }}">
                                        Confirm Payment
                                    </button>
                                @elseif($rental->status === 'paid')
                                    <button type="button" class="rents-action-button approved-button" disabled>Approved</button>
                                @else
                                    <a href="{{ route('rents.show', $rental->id) }}" class="rents-action-button">View Details</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="no-rentals">You have not submitted any rentals yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<div id="rentsNotification" class="rents-notification" role="status" aria-live="polite"></div>

<script>
    // Tabs, search, status, and date filters - client side only to avoid backend changes
    (function(){
        const tabs = document.querySelectorAll('.rents-tab');
        const rows = Array.from(document.querySelectorAll('.rents-table-row'));
        const search = document.getElementById('rentsSearch');
        const status = document.getElementById('rentsStatus');
        const date = document.getElementById('rentsDate');

        function applyFilters(){
            const activeTab = document.querySelector('.rents-tab.active');
            const tabFilter = activeTab ? activeTab.dataset.filter : 'all';
            const q = (search.value || '').toLowerCase().trim();
            const statusFilter = (status.value || 'all').toLowerCase();
            const dateFilter = (date.value || '').trim();

            rows.forEach(row => {
                const equipment = (row.dataset.equipment||'').toLowerCase();
                const customer = (row.cells[1].innerText||'').toLowerCase();
                const address = (row.cells[3].innerText||'').toLowerCase();
                const rowStatus = (row.dataset.status||'').toLowerCase();
                const rowDate = (row.dataset.date||'');

                let visible = true;

                // Tab filter
                if (tabFilter !== 'all' && equipment !== tabFilter.toLowerCase()) visible = false;

                // Search filter (search equipment, customer, address)
                if (q && !(equipment.includes(q) || customer.includes(q) || address.includes(q))) visible = false;

                // Status filter
                if (statusFilter !== 'all' && rowStatus !== statusFilter) visible = false;

                // Date filter
                if (dateFilter && rowDate !== dateFilter) visible = false;

                row.style.display = visible ? '' : 'none';
            });
        }

        tabs.forEach(tab => tab.addEventListener('click', function(){
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            applyFilters();
        }));

        [search, status, date].forEach(el => el && el.addEventListener('input', applyFilters));
    })();

    (function(){
        const notification = document.getElementById('rentsNotification');

        function updateRowAfterPaid(rentalId) {
            const row = document.querySelector(`.rents-table-row[data-rental-id="${rentalId}"]`);
            if (!row) return;
            const statusTag = row.querySelector('.rents-status');
            const actionCell = row.cells[row.cells.length - 1];
            if (statusTag) {
                statusTag.textContent = 'Paid';
                statusTag.className = 'rents-status paid';
            }
            if (actionCell) {
                actionCell.innerHTML = `
                    <button type="button" class="rents-action-button approved-button" disabled>Approved</button>
                `;
            }
        }

        function getCsrfToken() {
            const token = document.querySelector('meta[name="csrf-token"]');
            return token ? token.getAttribute('content') : document.querySelector('input[name="_token"]')?.value;
        }

        // Use event delegation so dynamically-rendered rows still work
        document.addEventListener('click', function(event) {
            const button = event.target.closest('.rents-pay-confirm-button');
            if (!button) return;
            event.preventDefault();

            const rentalId = button.dataset.rentalId;

            // Ensure Swal exists before using it
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 (Swal) is not loaded.');
                return;
            }

            Swal.fire({
                title: 'Confirm Payment',
                text: 'Are you sure you want to mark this rental as paid?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Mark as Paid',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    handleMarkPaid(rentalId);
                }
            });
        });

        function handleMarkPaid(rentalId) {
            if (!rentalId) return;

            const url = `/rents/${rentalId}/mark-paid`;
            const token = getCsrfToken();

            fetch(url, {
                method: 'PATCH',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({}),
            })
                .then(response => response.json().then(data => ({status: response.status, body: data})))
                .then(({status, body}) => {
                    if (status >= 200 && status < 300) {
                        updateRowAfterPaid(rentalId);
                        Swal.fire({
                            icon: 'success',
                            title: 'Paid successfully',
                            text: 'The rental has been marked as paid.',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment failed',
                            text: 'Unable to mark this rental as paid. Please try again.'
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Payment failed',
                        text: 'Unable to mark this rental as paid. Please try again.'
                    });
                });
        }

        // No overlay event handlers required — SweetAlert2 handles confirmation now.
    })();
</script>
</body>
</html>
