<aside class="admin-sidebar" aria-label="Admin navigation">
    <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
        <img src="{{ asset('images/leaves icon.png') }}" alt="">
        <span class="admin-sidebar-brand-copy">
            <strong>CAMIA</strong>
            <small>Rented Agriculture Equipment<br>Management System<br>Buguey, Cagayan</small>
        </span>
    </a>

    <nav class="admin-sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.dashboard', 'admin.welcome')]) @if(request()->routeIs('admin.dashboard', 'admin.welcome')) aria-current="page" @endif>
            <svg class="admin-sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-8 9 8v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.rentals') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.rentals')]) @if(request()->routeIs('admin.rentals')) aria-current="page" @endif>
            <svg class="admin-sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M8 3v4m8-4v4M3 10h18m-13 4h3m2 0h3m-8 4h3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Manage Rentals</span>
        </a>
        <a href="{{ route('admin.equipment') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.equipment')]) @if(request()->routeIs('admin.equipment')) aria-current="page" @endif>
            <svg class="admin-sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 17h2l2-6h8l3 4h3v4h-2a2 2 0 0 1-4 0h-5a2 2 0 0 1-4 0H3zm4-6 1-4h6l1 4M9 7V5h5v2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="7" cy="19" r="1.5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17" cy="19" r="1.5" fill="none" stroke="currentColor" stroke-width="2"/></svg>
            <span>Equipment</span>
        </a>
        <a href="{{ route('admin.customers') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.customers')]) @if(request()->routeIs('admin.customers')) aria-current="page" @endif>
            <img class="admin-sidebar-icon admin-sidebar-image-icon" src="{{ asset('images/customers.svg') }}" alt="">
            <span>Customers</span>
        </a>
        <a href="{{ route('admin.paid-rentals') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.paid-rentals')]) @if(request()->routeIs('admin.paid-rentals')) aria-current="page" @endif>
            <svg class="admin-sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h8l4 4v14H6z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M14 3v5h5m-9 4h5m-5 4h5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Rental Records</span>
        </a>
        <a href="{{ route('admin.payments') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.payments')]) @if(request()->routeIs('admin.payments')) aria-current="page" @endif>
            <svg class="admin-sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="5" width="20" height="15" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M2 10h20m-5 5h2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Payment Monitoring</span>
        </a>
        <a href="{{ route('admin.reports') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.reports')]) @if(request()->routeIs('admin.reports')) aria-current="page" @endif>
            <img class="admin-sidebar-icon admin-sidebar-image-icon" src="{{ asset('images/reports.svg') }}" alt="">
            <span>Reports</span>
        </a>
        <a href="{{ route('admin.settings') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.settings')]) @if(request()->routeIs('admin.settings')) aria-current="page" @endif>
            <img class="admin-sidebar-icon admin-sidebar-image-icon" src="{{ asset('images/settings.svg') }}" alt="">
            <span>Settings</span>
        </a>
        <a href="{{ route('admin.change-password') }}" @class(['admin-sidebar-link', 'is-active' => request()->routeIs('admin.change-password')]) @if(request()->routeIs('admin.change-password')) aria-current="page" @endif>
            <img class="admin-sidebar-icon admin-sidebar-image-icon" src="{{ asset('images/change password.svg') }}" alt="">
            <span>Change Password</span>
        </a>
    </nav>
</aside>