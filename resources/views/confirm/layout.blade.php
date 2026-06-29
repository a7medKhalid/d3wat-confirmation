<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'تأكيد الحضور')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            font-family: "Cairo", "Segoe UI", Tahoma, sans-serif;
            color: #ffffff;
            background: #1a1410 url("{{ asset('images/invite-bg.png') }}") center center / cover no-repeat fixed;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(12, 18, 14, 0.55) 0%,
                rgba(20, 14, 16, 0.72) 45%,
                rgba(10, 12, 10, 0.82) 100%
            );
            pointer-events: none;
        }

        .page {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 24rem;
            text-align: center;
        }

        .ornament {
            width: 3.5rem;
            height: 1px;
            margin: 0 auto 1.25rem;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.85), transparent);
        }

        .ornament-bottom {
            margin: 1.25rem auto 0;
        }

        .card-title {
            margin: 0 0 0.5rem;
            font-family: "Amiri", "Times New Roman", serif;
            font-size: clamp(1.75rem, 6vw, 2.2rem);
            font-weight: 700;
            letter-spacing: 0.02em;
            text-shadow: 0 2px 18px rgba(0, 0, 0, 0.45);
        }

        .guest-name {
            display: inline-block;
            margin: 0.75rem auto 1rem;
            padding: 0.55rem 1.75rem;
            border: 1px solid rgba(255, 255, 255, 0.92);
            border-radius: 999px;
            font-family: "Amiri", serif;
            font-size: 1.15rem;
            line-height: 1.5;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(2px);
        }

        .message {
            margin: 0;
            font-size: 1rem;
            font-weight: 300;
            line-height: 1.9;
            color: rgba(255, 255, 255, 0.94);
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.35);
        }

        .message-strong {
            margin: 0 0 0.75rem;
            font-family: "Amiri", serif;
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.7;
        }

        .subtitle {
            margin-top: 0.85rem;
            font-size: 0.92rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.78);
        }

        .panel {
            margin-top: 1.5rem;
            padding: 1.5rem 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 1.25rem;
            background: rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(4px);
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            margin-top: 1.5rem;
        }

        .btn-form {
            margin: 0;
        }

        .btn {
            display: block;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.92);
            border-radius: 999px;
            padding: 0.95rem 1.25rem;
            font-family: "Cairo", sans-serif;
            font-size: 1rem;
            font-weight: 400;
            letter-spacing: 0.01em;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            text-shadow: 0 1px 8px rgba(0, 0, 0, 0.25);
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-confirm {
            border-color: rgba(255, 255, 255, 0.95);
        }

        .btn-decline {
            border-color: rgba(255, 255, 255, 0.7);
            color: rgba(255, 255, 255, 0.92);
        }
    </style>
</head>
<body>
    <main class="page">
        @yield('content')
    </main>
</body>
</html>
