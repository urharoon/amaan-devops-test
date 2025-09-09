<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .error-container {
            width: 80%;
            max-width: 600px;
            margin: 100px auto;
            text-align: center;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .error-icon {
            font-size: 5rem;
            color: #e74a3b;
            margin-bottom: 20px;
        }
        .error-title {
            color: #e74a3b;
            margin-bottom: 20px;
        }
        .btn-home {
            background-color: #4e73df;
            color: white;
            padding: 10px 25px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .btn-home:hover {
            background-color: #2e59d9;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body style="background-color: #f8f9fc;">
    <div class="error-container">
        <div class="error-icon">
            <i class="bi bi-exclamation-octagon"></i>
        </div>
        <h1 class="error-title">Oops! An Error Occurred</h1>
        <p>We're sorry, but the page you are looking for cannot be found or an error has occurred.</p>
        <p>Please check the URL or go back to the homepage.</p>
        <a href="index.php" class="btn-home">
            <i class="bi bi-house-door"></i> Go to Homepage
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
