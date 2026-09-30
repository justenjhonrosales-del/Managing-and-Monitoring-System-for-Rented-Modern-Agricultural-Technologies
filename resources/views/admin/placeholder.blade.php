<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar')
        <main class="main-content admin-placeholder-main">
            <h1>{{ $pageTitle }}</h1>
        </main>
    </div>
</body>
</html>