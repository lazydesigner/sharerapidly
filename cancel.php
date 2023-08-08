<?php include './fun.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment Status</title>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            justify-content: center;
        }

        .container .card {
            flex: 0 0 200px;
            margin: 10px;
            border: 1px solid #ccc;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .container img {
            width: 100%;
            height: 131px;
            background-size: cover;
            object-fit: cover;
        }

        .container .body {
            padding-bottom: 10px;
        }

        .container h5 {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #566270;
        }

        .container h6 {
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
            color: #566270;
        }

        .status {
            background: #f8f8f8;
            border: 1px solid #ccc;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin: 50px 0;
        }

        .status .success {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
        }

        .status .error {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: red;
        }

        .container .main {
            width: 100%;
            text-align: center;
        }

        .status h4 {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #0077ff;
        }

        .main p {
            font-size: 16px;
            color: #4b4b4b;
        }

        .btn-link {
            padding: 10px 15px;
            color: #0077ff;
            border: 1px solid #0077ff;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main">
            <div class="status">
                <h1 class="error">Your PayPal Transaction has been canceled!</h1>
            </div>
            <a href="<?= base_url() ?>" class="btn-link">Back to Home</a>
        </div>
    </div>
</body>
</html>