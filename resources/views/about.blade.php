<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About CAMIA | Municipality of Buguey</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .about-page {
            --about-primary: #087448;
            --about-dark: #075235;
            --about-deep: #063d2a;
            --about-light: #edf8f0;
            --about-pale: #f7fcf8;
            --about-ink: #163b2b;
            --about-muted: #557064;
            --about-line: #d7eadb;
            background: #fff;
            color: var(--about-ink);
            font-family: 'DM Sans', sans-serif;
            line-height: 1.55;
            min-height: 100vh;
        }

        .about-page *,
        .about-page *::before,
        .about-page *::after { box-sizing: border-box; }

        .about-page a { color: inherit; }
        .about-page img { max-width: 100%; display: block; }
        .about-page h1,
        .about-page h2,
        .about-page h3,
        .about-page p,
        .about-page ul { margin-top: 0; }

        .about-page .about-nav {
            align-items: center;
            background: #fff;
            border-bottom: 1px solid #e5efe7;
            display: flex;
            gap: 40px;
            height: 72px;
            left: 0;
            margin: 0;
            max-width: none;
            padding: 0 max(24px, calc((100% - 1200px) / 2 + 24px));
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .about-page main { padding-top: 72px; }

        .about-page .about-brand {
            align-items: center;
            display: flex;
            gap: 10px;
            margin-right: auto;
            flex-direction: row-reverse;
            text-decoration: none;
        }

        .about-page .about-brand h3 { font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; margin: 0; }
        .about-page .about-brand img { flex-shrink: 0; height: 50px; object-fit: contain; width: 50px; }
        .about-page .about-brand strong { color: #000; font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; white-space: nowrap; }
        .about-page .about-brand small { display: none; }

        .about-page .about-nav-links { align-items: center; display: flex; flex-shrink: 0; gap: 32px; list-style: none; margin: 0; padding: 0; }
        .about-page .about-nav-links a { color: #000; font-family: 'DM Sans', sans-serif; font-size: .9rem; font-weight: 500; letter-spacing: .02em; position: relative; text-decoration: none; }
        .about-page .about-nav-links a::after { background: var(--about-primary); bottom: -4px; content: ''; height: 2px; left: 0; position: absolute; transition: width .25s; width: 0; }
        .about-page .about-nav-links a:hover { color: var(--about-primary); }
        .about-page .about-nav-links a:hover::after { width: 100%; }
        .about-page .about-nav-action { background: #2e7d32; border-radius: 50px; color: #fff; font-family: 'DM Sans', sans-serif; font-size: .875rem; font-weight: 600; letter-spacing: .02em; margin-left: auto; padding: 9px 22px; text-decoration: none; transition: background .2s, transform .2s; white-space: nowrap; }
        .about-page .about-nav-action:hover { background: #1b5e20; transform: translateY(-1px); }

        .about-page .about-hero {
    background-image:
        linear-gradient(
            90deg,
            rgba(3, 61, 42, 0.82) 0%,
            rgba(3, 61, 42, 0.62) 42%,
            rgba(3, 61, 42, 0.20) 75%,
            rgba(3, 61, 42, 0.08) 100%
        ),
        url("{{ asset('images/tractor-1.png') }}");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    min-height: 350px;
    position: relative;
    overflow: hidden;
}

        .about-page .about-hero-inner {
    align-items: center;
    display: flex;
    margin: auto;
    max-width: 1200px;
    min-height: 350px;
    padding: 48px 24px;
    position: relative;
    z-index: 2;
}
        .about-page .about-hero-copy {
    color: #fff;
    min-width: 0;
    max-width: 590px;
    position: relative;
    z-index: 2;
}
    .about-page .about-kicker {
    color: #fff;
    font-size: .92rem;
    font-weight: 700;
    letter-spacing: .22em;
    margin-bottom: 2px;
}
        .about-page .about-hero h1 {
    color: #fff;
    font-family: 'Playfair Display', serif;
    font-size: clamp(3.2rem, 7vw, 5.7rem);
    letter-spacing: .03em;
    line-height: .95;
    margin-bottom: 18px;
}
        .about-page .about-hero p {
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.45;
    max-width: 500px;
}
        .about-page .about-hero-tractor { align-self: center; height: auto; max-height: none; object-fit: contain; object-position: center; width: 100%; }

        .about-page .about-section { padding: 64px 24px; }
        .about-page .about-heading { align-items: center; display: flex; gap: 13px; margin-bottom: 10px; }
        .about-page .about-heading h2 { color: var(--about-deep); font-size: clamp(1.65rem, 3vw, 2.15rem); line-height: 1.15; margin: 0; }
        .about-page .about-heading-icon,
        .about-page .about-feature-icon,
        .about-page .about-contact-icon { align-items: center; background: var(--about-primary); border-radius: 50%; color: #fff; display: inline-flex; flex: 0 0 auto; height: 43px; justify-content: center; width: 43px; }
        .about-page .about-section-subtitle { color: var(--about-muted); margin: 0 0 28px 56px; }

        .about-page .about-system-grid { align-items: center; display: grid; gap: 42px; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); }
        .about-page .about-system-copy { min-width: 0; }
        .about-page .about-system-copy p { color: var(--about-muted); font-size: .98rem; margin-bottom: 17px; }
        .about-page .about-system-image { background: var(--about-pale); border: 1px solid var(--about-line); border-radius: 16px; min-width: 0; padding: 13px; }
        .about-page .about-feature-grid { display: grid; gap: 16px; grid-template-columns: repeat(3, 1fr); }
        .about-page .about-feature-card { background: #fff; border: 1px solid var(--about-line); border-radius: 12px; box-shadow: 0 6px 18px rgba(7, 82, 53, .06); min-height: 165px; padding: 22px; }
        .about-page .about-feature-card h3 { color: var(--about-deep); font-size: 1rem; margin: 12px 0 6px; }
        .about-page .about-feature-card p { color: var(--about-muted); font-size: .85rem; margin: 0; }

        .about-page .about-steps { align-items: stretch; display: grid; gap: 16px; grid-template-columns: repeat(3, 1fr); }
        .about-page .about-step { background: var(--about-pale); border: 1px solid var(--about-line); border-radius: 10px; padding: 17px 12px; position: relative; text-align: center; }
        .about-page .about-step-number { align-items: center; background: var(--about-primary); border-radius: 50%; color: #fff; display: inline-flex; font-size: .76rem; font-weight: 700; height: 25px; justify-content: center; width: 25px; }
        .about-page .about-step h3 { color: var(--about-deep); font-size: .78rem; margin: 10px 0 6px; }
        .about-page .about-step p { color: var(--about-muted); font-size: .72rem; margin: 0; }

        .about-page .about-access-grid { display: grid; gap: 22px; grid-template-columns: repeat(2, 1fr); }
        .about-page .about-access-card { background: #fff; border: 1px solid var(--about-line); border-radius: 12px; overflow: hidden; }
        .about-page .about-access-card h3 { background: var(--about-primary); color: #fff; font-size: 1rem; margin: 0; padding: 13px 20px; }
        .about-page .about-access-card ul { color: var(--about-muted); list-style: none; margin: 0; padding: 19px 22px; }
        .about-page .about-access-card li { font-size: .88rem; margin: 7px 0; padding-left: 22px; position: relative; }
        .about-page .about-access-card li::before { color: var(--about-primary); content: '✓'; font-weight: 700; left: 0; position: absolute; }

        .about-page .about-contact { align-items: center; background: #fff; border-top: 1px solid var(--about-line); display: grid; gap: 30px; grid-template-columns: 1.2fr .8fr; padding: 52px max(24px, calc((100% - 1200px) / 2)); }
        .about-page .about-contact-item { align-items: center; display: flex; gap: 14px; }
        .about-page .about-contact h2 { color: var(--about-deep); font-size: 1.7rem; margin: 0 0 8px; }
        .about-page .about-contact p { color: var(--about-muted); font-size: .9rem; margin: 0; max-width: 580px; }
        .about-page .about-contact-details { display: grid; gap: 18px; }
        .about-page .about-contact-details strong { color: var(--about-deep); display: block; }
        .about-page .about-contact-details span { color: var(--about-muted); font-size: .85rem; }

        .about-page .about-footer { background: var(--about-deep); color: #d9f3df; font-size: .78rem; padding: 18px 24px; text-align: center; }

        @media (max-width: 850px) {
            .about-page .about-nav { gap: 14px; }
            .about-page .about-nav-links { gap: 13px; position: static; transform: none; }
            .about-page .about-hero-inner,
            .about-page .about-system-grid,
            .about-page .about-contact { grid-template-columns: 1fr; }
            .about-page .about-hero-inner { min-height: 520px; }
            .about-page .about-hero-tractor { justify-self: center; max-width: 470px; }
            .about-page .about-feature-grid { grid-template-columns: repeat(2, 1fr); }
            .about-page .about-steps { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 560px) {
            .about-page .about-nav { flex-wrap: wrap; padding: 10px 16px; }
            .about-page .about-nav-links { order: 3; overflow-x: auto; padding-bottom: 3px; width: 100%; }
            .about-page .about-nav-action { margin-left: 0; }
            .about-page main { padding-top: 117px; }
            .about-page .about-section { padding: 44px 18px; }
            .about-page .about-section-subtitle { margin-left: 0; }
            .about-page .about-feature-grid,
            .about-page .about-access-grid,
            .about-page .about-steps { grid-template-columns: 1fr; }
            .about-page .about-contact { padding: 42px 18px; }
        }
    </style>
</head>
<body class="about-page">
    <nav class="about-nav" aria-label="Main navigation">
        <a class="about-brand" href="{{ route('staff.welcome') }}">
            <h3>CAMIA</h3>
            <img src="{{ asset('images/buguey-logo.png') }}" alt="Municipality of Buguey logo">
        </a>
        <ul class="about-nav-links">
            <li><a href="{{ route('staff.welcome') }}">Home</a></li>
            <li><a href="{{ route('rents.index') }}">Rents</a></li>
            <li><a href="{{ route('staff.schedule') }}">Schedule</a></li>
            <li><a href="{{ route('about') }}" aria-current="page">About</a></li>
            @if (session('welcome_dashboard_logged_in') && session('welcome_dashboard_role') === 'staff')
                <li><button type="button" class="nav-settings" id="openSettingsModal">Settings</button></li>
            @endif
        </ul>
        @if (session('welcome_dashboard_logged_in'))
            <a class="about-nav-action" href="{{ route('welcome.logout') }}">Logout</a>
        @else
            <a class="about-nav-action" href="{{ route('welcome.login.show') }}">Login</a>
        @endif
    </nav>

    @include('partials.staff-settings-modal')

    <main>
        <section class="about-hero">
            <div class="about-hero-inner">
                <div class="about-hero-copy">
                    <div class="about-kicker">ABOUT</div>
                    <h1>CAMIA</h1>
                    <p>Managing and Monitoring System for Rented<br>Modern Agriculture Equipment in Buguey, Cagayan</p>
                </div>
            
        </section>

        <section class="about-section">
            <div class="about-section-inner about-system-grid">
                <div class="about-system-copy">
                    <div class="about-heading"><h2>About the System</h2></div>
                    <p>CAMIA is a centralized system designed to help manage and monitor the rental of modern agricultural equipment in Buguey, Cagayan. It helps Admin and Staff organize renter information, equipment records, rental transactions, payment details, and equipment status in one system.</p>
                    <p>The system aims to make rental management faster, more organized, and easier to monitor, while reducing manual recording and helping keep accurate records.</p>
                </div>
                <div class="about-system-image"><img src="{{ asset('images/tractor-2.png') }}" alt="Agricultural equipment in a field"></div>
            </div>
        </section>

        <section class="about-section about-tinted">
            <div class="about-section-inner">
                <div class="about-heading"><h2>Services / Features</h2></div>
                <p class="about-section-subtitle">Key features and services provided by the system.</p>
                <div class="about-feature-grid">
                    @foreach ([
                        ['', 'Rental Management', 'Staff can record renter information, select equipment, and process rental transactions.'],
                        ['', 'Equipment Management', 'Staff can view equipment and check whether each item is Available, Pending, or Under Maintenance.'],
                        ['', 'Monitoring', 'Admin can monitor rentals, equipment status, payments, and other important records.'],
                        ['', 'Payment & Profit Monitoring', 'Admin can review rental prices, payments, and monitor the income generated from equipment rentals.'],
                        ['', 'Reports & Records', 'Admin can manage records and generate reports for easier documentation and monitoring.'],
                        ['', 'Account & System Management', 'The system provides separate access for Admin and Staff to help protect important records.']
                    ] as $feature)
                        <article class="about-feature-card">
                            <h3>{{ $feature[1] }}</h3>
                            <p>{{ $feature[2] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="about-section-inner">
                <div class="about-heading"><h2>How It Works</h2></div>
                <p class="about-section-subtitle">Simple and organized steps from login to monitoring.</p>
                <div class="about-steps">
                    @foreach ([
                        ['1', 'LOGIN', 'Admin or Staff logs into the system using their assigned account.'],
                        ['2', 'ENTER RENTER INFORMATION', 'Staff records the necessary information of the renter/customer.'],
                        ['3', 'SELECT EQUIPMENT', 'Staff selects the agricultural equipment to be rented.'],
                        ['4', 'PROCESS RENTAL', 'The system calculates the rental price and records the transaction.'],
                        ['5', 'MONITOR STATUS', 'Equipment status can be monitored as Available, Pending, or Maintenance.'],
                        ['6', 'ADMIN MONITORING', 'Admin reviews rental records, payments, equipment status, and system information.']
                    ] as $step)
                        <article class="about-step"><span class="about-step-number">{{ $step[0] }}</span><h3>{{ $step[1] }}</h3><p>{{ $step[2] }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="about-section about-tinted">
            <div class="about-section-inner">
                <div class="about-heading"><h2>User Access</h2></div>
                <p class="about-section-subtitle">Different roles, same goal — efficient and secure management.</p>
                <div class="about-access-grid">
                    <article class="about-access-card"><h3>STAFF</h3><ul><li>Manage renter information</li><li>Process rentals</li><li>Select equipment</li><li>View equipment availability</li><li>Record rental transactions</li></ul></article>
                    <article class="about-access-card"><h3>ADMIN</h3><ul><li>Monitor all records</li><li>Manage rental information</li><li>Monitor payments and profit</li><li>Update equipment/rental status</li><li>Generate reports</li><li>Manage system settings and security</li></ul></article>
                </div>
            </div>
        </section>

        <section class="about-contact">
            <div>
                <div</span><div><h2>Contact &amp; Support</h2><p>For concerns regarding equipment rental records, system access, or account-related matters, authorized Staff or Admin users may coordinate with the designated office.</p></div></div>
            </div>
            <div class="about-contact-details">
                <div class="about-contact-item"><div><strong>Municipality of Buguey</strong><span>Buguey, Cagayan</span></div></div>
            </div>
        </section>
    </main>

    <footer class="about-footer">CAMIA &nbsp;•&nbsp; Municipality of Buguey</footer>
</body>
</html>
