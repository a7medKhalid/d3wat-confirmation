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
        :root {
            --bg-deep: #1a1410;
            --bg-green: #1e2a22;
            --bg-warm: #2a1f1c;
            --rose-soft: #c9a0a8;
            --rose-muted: #8f5f6a;
            --text: #ffffff;
            --text-soft: rgba(255, 255, 255, 0.82);
            --border: rgba(255, 255, 255, 0.88);
            --panel: rgba(30, 42, 34, 0.55);
        }

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
            color: var(--text);
            background:
                radial-gradient(ellipse 80% 60% at 50% 0%, rgba(143, 95, 106, 0.22) 0%, transparent 55%),
                radial-gradient(ellipse 70% 50% at 80% 100%, rgba(30, 42, 34, 0.9) 0%, transparent 50%),
                linear-gradient(165deg, var(--bg-green) 0%, var(--bg-warm) 42%, var(--bg-deep) 100%);
        }

        .page {
            width: 100%;
            max-width: 24rem;
            text-align: center;
        }

        .ornament {
            width: 3.5rem;
            height: 1px;
            margin: 0 auto 1.25rem;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
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
            color: var(--text);
        }

        .guest-name {
            display: inline-block;
            margin: 0.75rem auto 1rem;
            padding: 0.55rem 1.75rem;
            border: 1px solid var(--border);
            border-radius: 999px;
            font-family: "Amiri", serif;
            font-size: 1.15rem;
            line-height: 1.5;
            color: var(--text);
            background: rgba(255, 255, 255, 0.05);
        }

        .message {
            margin: 0;
            font-size: 1rem;
            font-weight: 300;
            line-height: 1.9;
            color: var(--text-soft);
        }

        .message-strong {
            margin: 0 0 0.75rem;
            font-family: "Amiri", serif;
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.7;
            color: var(--text);
        }

        .subtitle {
            margin-top: 0.85rem;
            font-size: 0.92rem;
            font-weight: 300;
            color: var(--rose-soft);
        }

        .panel {
            margin-top: 1.5rem;
            padding: 1.5rem 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 1.25rem;
            background: var(--panel);
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
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 0.95rem 1.25rem;
            font-family: "Cairo", sans-serif;
            font-size: 1rem;
            font-weight: 400;
            cursor: pointer;
            transition: background 0.2s ease, border-color 0.2s ease;
            background: transparent;
            color: var(--text);
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }

        .btn-decline {
            border-color: rgba(255, 255, 255, 0.65);
            color: var(--text-soft);
        }
    </style>
</head>
<body>
    <main class="page">
        @yield('content')
    </main>
</body>
</html>
