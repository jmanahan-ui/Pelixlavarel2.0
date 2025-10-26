<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy Management</title>
    <style>
        /* --- Reset & Base --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fcd1e8, #d1c1f9);
            color: #2c2c2c;
            line-height: 1.6;
        }

        a { text-decoration: none; }

        /* --- Container (Transparent) --- */
        .container {
            width: 100%;
            max-width: 100%;
            margin: 20px auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.1); /* transparent with slight overlay */
            backdrop-filter: blur(10px); /* subtle blur for readability */
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            font-size: 3rem;
            color: #9b59b6;
            margin-bottom: 40px;
        }

        h2 {
            color: #8e44ad;
            font-size: 2rem;
            margin-bottom: 25px;
        }

        /* --- Forms --- */
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 16px 18px;
            margin-bottom: 20px;
            border: 1px solid #d3bdf0;
            border-radius: 12px;
            font-size: 18px;
            transition: 0.2s;
            background-color: rgba(255,255,255,0.8);
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #9b59b6;
            outline: none;
        }

        label {
            font-weight: 700;
            margin-bottom: 8px;
            display: block;
            font-size: 18px;
            color: #7d3c98;
        }

        /* --- Buttons --- */
        .btn {
            display: inline-block;
            padding: 14px 24px;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            border: none;
            transition: 0.3s;
            text-align: center;
            font-size: 18px;
        }

        .btn-success { background-color: #28a745; color: #fff; }
        .btn-success:hover { background-color: #218838; }

        .btn-secondary { background-color: #9b59b6; color: #fff; }
        .btn-secondary:hover { background-color: #8e44ad; }

        .btn-dark { background-color: #6c3483; color: #fff; }
        .btn-dark:hover { background-color: #5b2c6f; }

        .btn-warning { background-color: #ff79c6; color: #fff; }
        .btn-warning:hover { background-color: #ff4fa1; }

        .btn-danger { background-color: #d32f2f; color: #fff; }
        .btn-danger:hover { background-color: #b71c1c; }

        /* --- Alerts --- */
        .alert-success {
            background-color: rgba(248, 215, 245, 0.8);
            color: #6f1e7e;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #e1b3f0;
            font-size: 18px;
        }

        /* --- Tables --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 18px;
            background-color: rgba(255,255,255,0.15); /* subtle transparent table */
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            text-align: left;
        }

        th { background-color: rgba(155, 89, 182, 0.8); color: #fff; }
        tr:hover { background-color: rgba(242, 229, 249, 0.5); }

        td:last-child {
            display: flex;
            gap: 10px;
        }

        td:last-child form, td:last-child a { margin: 0; }

        /* --- Dashboard Cards --- */
        .card {
            background: rgba(249, 193, 232, 0.7);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            backdrop-filter: blur(5px);
        }

        .card:hover { transform: translateY(-5px); }

        .card h1 { font-size: 3rem; margin: 10px 0 0 0; color: #8e44ad; }
        .card h4 { color: #6c3483; font-size: 1.5rem; }

        /* --- Responsive --- */
        @media (max-width: 1440px) { .container { padding: 35px 50px; } }
        @media (max-width: 1024px) { 
            .container { padding: 30px 40px; }
            table, th, td { font-size: 16px; }
            .btn { padding: 12px 18px; font-size: 16px; }
        }
        @media (max-width: 768px) { 
            .container { padding: 20px 25px; }
            h1 { font-size: 2.5rem; }
            h2 { font-size: 1.8rem; }
            table, th, td { font-size: 14px; }
            .btn { padding: 10px 14px; font-size: 14px; }
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Pharmacy Management</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Main Content --}}
        @yield('content')
    </div>
</body>
</html>
