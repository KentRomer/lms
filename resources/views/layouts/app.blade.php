<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'LearnHub')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 450px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 { text-align: center; }
        .subtitle { text-align: center; color: #555; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; }
        .btn { width: 100%; padding: 10px; background-color: #007bff; border: none; color: white; cursor: pointer; border-radius: 4px; }
        .btn:hover { background-color: #0056b3; }
        .error-message { color: red; margin-bottom: 10px; }
        .success-message { color: green; margin-bottom: 10px; }
        .footer-link { text-align: center; margin-top: 10px; }
        .logo svg { display: block; margin: 0 auto 15px; width: 60px; height: 60px; fill: #007bff; }
        .demo-tip { font-size: 0.85em; color: #666; margin-bottom: 15px; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
