<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rentals - AgriRent Buguey</title>
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

        .status-select {
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .btn-update {
            background: var(--primary-color);
            color: var(--white);
            padding: 6px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-update:hover {
            background: var(--primary-dark);
        }

        .btn-delete {
            background: #ef4444;
            color: var(--white);
            padding: 6px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.2s;
            margin-left: 8px;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .status-pending {
            color: #f97316;
            font-weight: 600;
        }

        .status-active {
            color: #22c55e;
            font-weight: 600;
        }

        .status-completed {
            color: #8b5cf6;
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

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: var(--white);
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
            border: none;
            background: none;
        }

        .modal-close:hover {
            color: var(--text-dark);
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .modal-label {
            font-weight: 600;
            color: var(--text-dark);
            width: 40%;
        }

        .modal-value {
            color: var(--text-light);
            width: 60%;
            text-align: right;
        }

        .modal-form-group {
            margin-bottom: 15px;
        }

        .modal-form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .modal-form-group input,
        .modal-form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .modal-form-group input:focus,
        .modal-form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-modal-update {
            background: var(--primary-color);
            color: var(--white);
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-modal-update:hover {
            background: var(--primary-dark);
        }

        .btn-modal-cancel {
            background: #e5e7eb;
            color: var(--text-dark);
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-modal-cancel:hover {
            background: #d1d5db;
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
                <a href="{{ route('admin.rentals') }}" class="sidebar-item active">
                    Rentals
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
                <h1>Manage Rentals</h1>
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

            <!-- SEARCH -->
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Search by rental ID or customer name...">
            </div>

            <!-- TABLE -->
            <div class="table-container">
                <table id="rentalsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Equipment</th>
                            <th>Date</th>
                            <th>Actions</th>
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
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $rental->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button class="btn-update" onclick="openModal('{{ $rental->id }}', '{{ $rental->rental_number }}', '{{ $rental->customer_name }}', '{{ json_encode($rental->equipment) }}', '{{ $rental->rental_from }}', '{{ $rental->rental_to }}', '{{ $rental->rental_duration_hours }}', '{{ $rental->total_amount }}', '{{ $rental->status }}')">Update</button>
                                    <form action="{{ route('rental.destroy', $rental->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this rental?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #9ca3af; padding: 40px;">No rentals found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RENTAL DETAILS MODAL -->
    <div id="rentalModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <div class="modal-header" id="modalTitle">Rental Details</div>
            
            <div class="modal-body">
                <div class="modal-row">
                    <span class="modal-label">Customer</span>
                    <span class="modal-value" id="modalCustomer">-</span>
                </div>
                <div class="modal-row">
                    <span class="modal-label">Equipment</span>
                    <span class="modal-value" id="modalEquipment">-</span>
                </div>
            </div>

            <form id="updateRentalForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-form-group">
                    <label>From (Date)</label>
                    <div style="padding: 8px 12px; background: #f5f5f5; border-radius: 4px; border: 1px solid #e0e0e0;" id="rentalFromDisplay">-</div>
                </div>

                <div class="modal-form-group">
                    <label>To (Date)</label>
                    <input type="date" name="rental_to" id="rentalToInput">
                </div>

                <div class="modal-form-group">
                    <label>Duration (Hours)</label>
                    <div style="padding: 8px 12px; background: #f5f5f5; border-radius: 4px; border: 1px solid #e0e0e0;" id="durationHoursDisplay">-</div>
                </div>

                <div class="modal-form-group">
                    <label>Total Amount</label>
                    <input type="number" name="total_amount" id="totalAmount" step="0.01" placeholder="Enter amount">
                </div>

                <div class="modal-form-group">
                    <label>Status</label>
                    <select name="status" id="statusSelect">
                        <option value="pending">Pending</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-modal-update">Update Status</button>
                </div>
            </form>
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

        // Modal functions
        function openModal(id, rentalNumber, customer, equipment, from, to, duration, amount, status) {
            const modal = document.getElementById('rentalModal');
            modal.classList.add('active');

            // Set modal title
            document.getElementById('modalTitle').textContent = `Rental Details - ${rentalNumber}`;
            document.getElementById('modalCustomer').textContent = customer;

            // Parse and display equipment
            try {
                const equipmentArray = JSON.parse(equipment.replace(/&quot;/g, '"'));
                let equipmentText = '';
                equipmentArray.forEach(item => {
                    equipmentText += `[ ${item.name} x${item.quantity} ] `;
                });
                document.getElementById('modalEquipment').textContent = equipmentText || '-';
            } catch (e) {
                document.getElementById('modalEquipment').textContent = '-';
            }

            // Display From date (read-only)
            const fromDate = from && from !== 'null' ? from.split(' ')[0] : '-';
            document.getElementById('rentalFromDisplay').textContent = fromDate;

            // Set To date input (editable calendar)
            document.getElementById('rentalToInput').value = to && to !== 'null' ? to.split(' ')[0] : '';

            // Display Duration (read-only)
            const durationDisplay = duration && duration !== 'null' ? duration + ' hrs' : '-';
            document.getElementById('durationHoursDisplay').textContent = durationDisplay;

            // Set form values
            document.getElementById('totalAmount').value = amount && amount !== 'null' ? amount : '';
            document.getElementById('statusSelect').value = status;

            // Set form action
            document.getElementById('updateRentalForm').action = `/admin/rentals/${id}/status`;
        }

        function closeModal() {
            const modal = document.getElementById('rentalModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('rentalModal');
            if (event.target === modal) {
                modal.classList.remove('active');
            }
        }
    </script>
</body>
</html>
