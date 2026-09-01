<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Delivery Schedule - AgriRent Buguey</title>
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

        /* HEADER & NAVBAR */
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
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
        }

        .btn-logout {
            background: var(--primary-color);
            color: var(--white);
            padding: 9px 22px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.02em;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: var(--primary-dark);
        }

        /* MAIN CONTENT */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-bottom: 30px;
        }

        /* SUMMARY CARDS */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .summary-label {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* CONTROLS */
        .schedule-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .nav-btn {
            padding: 8px 16px;
            background: var(--white);
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            color: var(--text-dark);
        }

        .nav-btn:hover {
            background: var(--bg-light);
            border-color: var(--primary-color);
        }

        .nav-btn.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .calendar-month-year {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
            min-width: 200px;
            text-align: center;
        }

        /* EQUIPMENT TABS */
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

        /* CALENDAR */
        .calendar-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            margin-bottom: 1px;
            background: #e0e0e0;
        }

        .weekday-header {
            background: var(--bg-light);
            padding: 12px;
            text-align: center;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e0e0e0;
        }

        .calendar-day {
            background: var(--white);
            padding: 8px 8px 10px;
            min-height: 120px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .calendar-day.other-month {
            background: var(--bg-light);
            color: var(--text-light);
        }

        .calendar-day.today {
            background: rgba(46, 125, 50, 0.05);
            border: 2px solid var(--primary-color);
        }

        .calendar-day-number {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .calendar-day.other-month .calendar-day-number {
            color: var(--text-light);
        }

        .calendar-events {
            display: flex;
            flex-direction: column;
            gap: 6px;
            overflow: hidden;
        }

        .calendar-event {
            background: #edf7ee;
            border: 1px solid rgba(46, 125, 50, 0.18);
            color: #1f2937;
            padding: 6px 7px;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 600;
            cursor: pointer;
            word-break: break-word;
            transition: all 0.2s ease;
            text-align: left;
            position: relative;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .calendar-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .calendar-event .event-time {
            font-size: 0.7rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .calendar-event .event-equipment {
            font-size: 0.68rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .calendar-event .event-customer {
            font-size: 0.66rem;
            line-height: 1.3;
            color: #374151;
            white-space: normal;
        }

        .calendar-event.tractor {
            background: #edf7ee;
            border-color: rgba(46, 125, 50, 0.2);
        }

        .calendar-event.thresher {
            background: #fff4df;
            border-color: rgba(245, 158, 11, 0.25);
        }

        .calendar-event.kuliglig {
            background: #eef3ff;
            border-color: rgba(59, 130, 246, 0.25);
        }

        .calendar-event.conflict {
            border-color: rgba(239, 68, 68, 0.6);
            background: #fff1f2;
        }

        .calendar-event.conflict::after {
            content: "⚠ Conflict";
            position: absolute;
            top: -7px;
            right: 2px;
            font-size: 0.55rem;
            font-weight: 700;
            color: #b91c1c;
            background: rgba(255,255,255,0.9);
            border-radius: 10px;
            padding: 1px 5px;
        }

        .calendar-more {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #374151;
            padding: 5px 8px;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 30px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .modal-section {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 14px;
            background: #fafafa;
        }

        .modal-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .modal-row:last-child {
            border-bottom: none;
        }

        .modal-label {
            font-weight: 600;
            color: var(--text-dark);
            min-width: 150px;
        }

        .modal-value {
            color: var(--text-light);
            text-align: right;
            flex: 1;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 16px;
        }

        .modal-action-btn {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .nav-links { gap: 16px; }
            .page-title { font-size: 1.8rem; }
            .schedule-controls { flex-direction: column; align-items: flex-start; }
            .calendar-day { min-height: 100px; }
            .calendar-event { font-size: 0.65rem; }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
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
                <li><a href="{{ route('staff.schedule') }}" style="color: var(--primary-color); font-weight: 600;">Schedule</a></li>
            </ul>

            <div class="nav-right">
                <a href="{{ route('welcome.logout') }}" class="btn-logout">Logout</a>
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <div class="container">
        <h1 class="page-title">Equipment Delivery Schedule</h1>

        <!-- SUMMARY CARDS -->
        <div class="summary-cards">
            <div class="summary-card">
                <div class="summary-label">Today's Deliveries</div>
                <div class="summary-value" id="todayDeliveries">0</div>
            </div>
            <div class="summary-card">
                <div class="summary-label">Upcoming Deliveries</div>
                <div class="summary-value" id="upcomingDeliveries">0</div>
            </div>
            <div class="summary-card">
                <div class="summary-label">Schedule Conflicts</div>
                <div class="summary-value" id="conflictCount" style="color: #ef4444;">0</div>
            </div>
        </div>

        <!-- EQUIPMENT TABS -->
        <div class="equipment-tabs">
            <button class="equipment-tab active" data-filter="all">All Equipment</button>
            <button class="equipment-tab" data-filter="Tractor">Tractor</button>
            <button class="equipment-tab" data-filter="Reaper or Thresher">Thresher</button>
            <button class="equipment-tab" data-filter="Kuliglig">Kuliglik</button>
        </div>

        <!-- CALENDAR CONTROLS -->
        <div class="schedule-controls">
            <div class="calendar-nav">
                <button class="nav-btn" id="prevBtn">← Previous</button>
                <button class="nav-btn" id="todayBtn">Today</button>
                <button class="nav-btn" id="nextBtn">Next →</button>
            </div>
            <div class="calendar-month-year" id="monthYear"></div>
        </div>

        <!-- CALENDAR -->
        <div class="calendar-container">
            <div class="calendar-weekdays">
                <div class="weekday-header">Sun</div>
                <div class="weekday-header">Mon</div>
                <div class="weekday-header">Tue</div>
                <div class="weekday-header">Wed</div>
                <div class="weekday-header">Thu</div>
                <div class="weekday-header">Fri</div>
                <div class="weekday-header">Sat</div>
            </div>
            <div class="calendar-grid" id="calendarGrid"></div>
        </div>
    </div>

    <!-- RENTAL DETAILS MODAL -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Delivery Schedule</h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody"></div>
            <div class="modal-footer">
                <button class="modal-action-btn" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Rental data from server
        const rentalsData = @json($rentals);

        // Calendar state
        let currentDate = new Date();
        let activeFilter = 'all';

        // Helper function to get equipment class
        function getEquipmentClass(equipment) {
            if (equipment.includes('Tractor')) return 'tractor';
            if (equipment.includes('Reaper') || equipment.includes('Thresher')) return 'thresher';
            if (equipment.includes('Kuliglig')) return 'kuliglig';
            return '';
        }

        // Detect conflicts
        function findConflicts() {
            const conflicts = {};
            rentalsData.forEach((rental, index) => {
                if (!rental.rental_from) return;
                
                const dateStr = rental.rental_from;
                const timeStr = rental.start_time || '';
                const equipment = rental.equipment && rental.equipment.length > 0 ? rental.equipment[0].name : '';
                
                const key = `${dateStr}-${timeStr}-${equipment}`;
                
                if (!conflicts[key]) {
                    conflicts[key] = [];
                }
                conflicts[key].push(index);
            });

            return conflicts;
        }

        const conflicts = findConflicts();

        function getEquipmentName(rental) {
            if (!rental.equipment || !Array.isArray(rental.equipment) || rental.equipment.length === 0) {
                return 'Unknown';
            }
            return rental.equipment[0].name || 'Unknown';
        }

        function getStatusLabel(status) {
            if (!status) return 'Pending';
            const normalized = String(status).toLowerCase();
            if (normalized === 'paid') return 'Paid';
            if (normalized === 'pending') return 'Pending';
            if (normalized === 'active') return 'Active';
            if (normalized === 'cancelled') return 'Cancelled';
            if (normalized === 'completed') return 'Completed';
            return status.charAt(0).toUpperCase() + status.slice(1);
        }

        function parseTimeToMinutes(value) {
            if (!value || typeof value !== 'string') return 0;
            const match = value.match(/(\d{1,2}):(\d{2})\s*(AM|PM)/i);
            if (!match) return 0;
            let hours = parseInt(match[1], 10);
            const minutes = parseInt(match[2], 10);
            const suffix = match[3].toUpperCase();
            if (suffix === 'PM' && hours !== 12) hours += 12;
            if (suffix === 'AM' && hours === 12) hours = 0;
            return hours * 60 + minutes;
        }

        // Filter rentals by date
        function getRentalsForDate(date) {
            const dateStr = date.toISOString().split('T')[0];
            return rentalsData
                .filter(rental => {
                    if (!rental.rental_from) return false;
                    if (rental.rental_from !== dateStr) return false;
                    if (activeFilter === 'all') return true;
                    const equipment = getEquipmentName(rental);
                    return equipment === activeFilter;
                })
                .sort((a, b) => parseTimeToMinutes(a.start_time) - parseTimeToMinutes(b.start_time));
        }

        // Render calendar
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                               'July', 'August', 'September', 'October', 'November', 'December'];
            document.getElementById('monthYear').textContent = `${monthNames[month]} ${year}`;
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            
            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = '';
            
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const date = new Date(year, month - 1, day);
                createDayCell(date, true);
            }
            
            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(year, month, day);
                createDayCell(date, false);
            }
            
            const totalCells = calendarGrid.children.length;
            const remainingCells = 42 - totalCells;
            for (let day = 1; day <= remainingCells; day++) {
                const date = new Date(year, month + 1, day);
                createDayCell(date, true);
            }
        }

        function createDayCell(date, isOtherMonth) {
            const calendarGrid = document.getElementById('calendarGrid');
            const cell = document.createElement('div');
            cell.className = 'calendar-day';
            
            if (isOtherMonth) {
                cell.classList.add('other-month');
            }
            
            const today = new Date();
            if (date.toDateString() === today.toDateString()) {
                cell.classList.add('today');
            }
            
            const dayNum = document.createElement('div');
            dayNum.className = 'calendar-day-number';
            dayNum.textContent = date.getDate();
            cell.appendChild(dayNum);
            
            if (!isOtherMonth) {
                const rentals = getRentalsForDate(date);
                const eventsDiv = document.createElement('div');
                eventsDiv.className = 'calendar-events';

                if (rentals.length > 0) {
                    const visibleRentals = rentals.slice(0, 3);
                    visibleRentals.forEach(rental => {
                        const equipment = getEquipmentName(rental);
                        const timeStr = rental.start_time || '--:--';
                        const dateStr = rental.rental_from;
                        const key = `${dateStr}-${timeStr}-${equipment}`;
                        const isConflict = conflicts[key] && conflicts[key].length > 1;

                        const eventDiv = document.createElement('button');
                        eventDiv.type = 'button';
                        eventDiv.className = `calendar-event ${getEquipmentClass(equipment)} ${isConflict ? 'conflict' : ''}`;
                        eventDiv.innerHTML = `
                            <div class="event-time">${timeStr}</div>
                            <div class="event-equipment">${equipment}</div>
                            <div class="event-customer">${rental.customer_name || 'Unknown customer'}</div>
                        `;
                        eventDiv.onclick = (e) => {
                            e.stopPropagation();
                            showRentalDetails(rental);
                        };
                        eventsDiv.appendChild(eventDiv);
                    });

                    if (rentals.length > 3) {
                        const moreBtn = document.createElement('button');
                        moreBtn.type = 'button';
                        moreBtn.className = 'calendar-more';
                        moreBtn.textContent = `+${rentals.length - 3} more`;
                        moreBtn.onclick = (e) => {
                            e.stopPropagation();
                            showDaySchedule(date, rentals);
                        };
                        eventsDiv.appendChild(moreBtn);
                    }
                }
                
                cell.appendChild(eventsDiv);
            }
            
            calendarGrid.appendChild(cell);
        }

        function showDaySchedule(date, rentals) {
            const formattedDate = new Date(date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const html = `
                <div class="modal-section">
                    <div class="modal-section-title">Schedule List</div>
                    ${rentals.map(rental => {
                        const equipment = getEquipmentName(rental);
                        return `
                            <div class="modal-row">
                                <div class="modal-label">${rental.start_time || '--:--'}</div>
                                <div class="modal-value">${equipment}<br>${rental.customer_name || 'Unknown customer'}</div>
                            </div>
                        `;
                    }).join('')}
                </div>
            `;
            document.getElementById('modalTitle').textContent = 'Delivery Schedule';
            document.getElementById('modalBody').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">Date</div>
                    <div class="modal-row">
                        <div class="modal-label">Selected Date</div>
                        <div class="modal-value">${formattedDate}</div>
                    </div>
                </div>
                ${html}
            `;
            document.getElementById('eventModal').classList.add('active');
        }

        // Show rental details modal
        function showRentalDetails(rental) {
            const equipment = getEquipmentName(rental);
            const meta = rental.equipment && rental.equipment.length > 0 ? rental.equipment[0].meta : {};
            
            let durationValue = '-';
            if (equipment === 'Kuliglig') {
                durationValue = meta.days ? `${meta.days} Day(s)` : '-';
            } else {
                durationValue = meta.hectares ? `${meta.hectares} Hectare(s)` : '-';
            }
            
            const durationText = rental.rental_duration_hours ? 
                `${Math.floor(rental.rental_duration_hours)}h ${Math.round((rental.rental_duration_hours % 1) * 60)}m` : '-';
            
            const html = `
                <div class="modal-section">
                    <div class="modal-section-title">Customer Information</div>
                    <div class="modal-row">
                        <div class="modal-label">Full Name</div>
                        <div class="modal-value">${rental.customer_name || '-'}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Age</div>
                        <div class="modal-value">${rental.age || '-'}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Primary Address</div>
                        <div class="modal-value">${rental.primary_address || '-'}</div>
                    </div>
                </div>
                <div class="modal-section">
                    <div class="modal-section-title">Rental Information</div>
                    <div class="modal-row">
                        <div class="modal-label">Equipment</div>
                        <div class="modal-value">${equipment}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Usage Type</div>
                        <div class="modal-value">${rental.usage_type ? rental.usage_type.charAt(0).toUpperCase() + rental.usage_type.slice(1) : '-'}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Selected ${equipment === 'Kuliglig' ? 'Days' : 'Hectares'}</div>
                        <div class="modal-value">${durationValue}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Duration</div>
                        <div class="modal-value">${durationText}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Rental Date</div>
                        <div class="modal-value">${rental.rental_from ? new Date(rental.rental_from).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'}) : '-'}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Start Time</div>
                        <div class="modal-value">${rental.start_time || '-'}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Rental Price</div>
                        <div class="modal-value">₱${rental.total_amount ? Number(rental.total_amount).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00'}</div>
                    </div>
                    <div class="modal-row">
                        <div class="modal-label">Status</div>
                        <div class="modal-value" style="color: ${rental.status === 'paid' ? '#22c55e' : '#f59e0b'}; font-weight: 600;">${getStatusLabel(rental.status)}</div>
                    </div>
                </div>
            `;
            
            document.getElementById('modalTitle').textContent = 'Delivery Schedule';
            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('eventModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('eventModal').classList.remove('active');
        }

        // Update summary cards
        function updateSummary() {
            const today = new Date();
            const todayStr = today.toISOString().split('T')[0];
            
            let todayCount = 0;
            let upcomingCount = 0;
            let conflictCount = 0;
            
            rentalsData.forEach(rental => {
                if (!rental.rental_from) return;
                
                const rentalDate = new Date(rental.rental_from);
                if (rental.rental_from === todayStr) {
                    todayCount++;
                } else if (rentalDate > today) {
                    upcomingCount++;
                }
            });
            
            Object.values(conflicts).forEach(group => {
                if (group.length > 1) {
                    conflictCount++;
                }
            });
            
            document.getElementById('todayDeliveries').textContent = todayCount;
            document.getElementById('upcomingDeliveries').textContent = upcomingCount;
            document.getElementById('conflictCount').textContent = conflictCount;
        }

        // Event listeners
        document.getElementById('prevBtn').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        document.getElementById('todayBtn').addEventListener('click', () => {
            currentDate = new Date();
            renderCalendar();
        });

        document.querySelectorAll('.equipment-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.equipment-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                activeFilter = this.dataset.filter;
                renderCalendar();
            });
        });

        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize
        renderCalendar();
        updateSummary();
    </script>
</body>
</html>
