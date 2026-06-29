<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'تأكيد الحضور')</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            background: linear-gradient(160deg, #f8f4ef 0%, #ebe4d8 100%);
            color: #2c2418;
            padding: 1.5rem;
        }
        .card {
            width: 100%;
            max-width: 28rem;
            background: #fff;
            border-radius: 1rem;
            padding: 2rem 1.75rem;
            text-align: center;
            box-shadow: 0 12px 40px rgba(44, 36, 24, 0.08);
        }
        .icon {
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1.25rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
        }
        .icon-success { background: #e8f5e9; color: #2e7d32; }
        .icon-info { background: #fff8e1; color: #f57f17; }
        .icon-error { background: #ffebee; color: #c62828; }
        h1 {
            margin: 0 0 0.75rem;
            font-size: 1.5rem;
            line-height: 1.4;
        }
        p {
            margin: 0;
            line-height: 1.7;
            color: #5c5042;
        }
        .subtitle {
            margin-top: 0.75rem;
            font-size: 0.95rem;
        }
        .actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }
        .btn {
            display: block;
            width: 100%;
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .btn-confirm {
            background: #2e7d32;
            color: #fff;
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.25);
        }
        .btn-decline {
            background: #fff;
            color: #5c5042;
            border: 1px solid #d8cfc2;
        }
    </style>
</head>
<body>
    <main class="card">
        @yield('content')
    </main>
</body>
</html>
