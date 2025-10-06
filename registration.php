<?php
require_once './db.php';
$conn = mysqli_connect('db', 'root', 'qwerty', 'db1');

session_start();

if (isset($_COOKIE['User'])) {
    header('Location: profile.php');
    exit;
}

$error_message = '';
$success_message = '';

if (isset($_POST['submit'])) {
    $login = $_POST['login'] ?? '';
    $email_address = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (empty($login) || empty($email_address) || empty($pass)) {
        $error_message = 'Please fill in all fields!';
    } else {
        $query = "INSERT INTO users (username, email, password) VALUES ('$login', '$email_address', '$pass')";
        if (!mysqli_query($conn, $query)) {
            $error_message = 'Failed to add user: ' . mysqli_error($conn);
        } else {
            $success_message = 'User registered successfully. You can now <a href="login.php">log in</a>.';
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
        .success {
            color: #2e7d32;
            margin-bottom: 20px;
        }
        form {
            max-width: 300px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
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
    <h1>Register</h1>
    <?php if ($error_message): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="login" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Sign Up</button>
    </form>
</body>
</html>