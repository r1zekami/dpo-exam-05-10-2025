<?php
if (!isset($_COOKIE['User'])) {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_COOKIE['User']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .col-8 {
            flex: 0 0 66.66%;
        }
        .col-12 {
            flex: 0 0 100%;
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .hello {
            color: #333;
            font-size: 2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRc5a41eLPh7MgLBIIQX772nrjYPZXOF-pow&s" alt="funny image">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="hello">Hello, <?php echo $username; ?>!</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>