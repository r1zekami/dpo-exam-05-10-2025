<?php
require_once './db.php';
$conn = mysqli_connect('db', 'root', 'qwerty', 'db1');

session_start();

$error_message = '';

if (isset($_POST['submit'])) {
    $login = $_POST['login'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (empty($login) || empty($pass)) {
        $error_message = 'Please fill in all fields';
    } else {
        $query = "SELECT * FROM users WHERE username='$login' AND password='$pass'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            setcookie("User", $login, time() + 7200, "/");
            header('Location: profile.php');
            exit;
        } else {
            $error_message = 'Invalid username or password';
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .error {
            color: #d32f2f;
            margin-bottom: 20px;
        }
        form {
            max-width: 300px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #1976d2;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>
    <h1>Sign In</h1>
    <?php if ($error_message): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="login" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>