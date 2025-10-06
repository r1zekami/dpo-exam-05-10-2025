<?php
$servername = "db";
$username = "root";
$password = "qwerty";
$database = "db1";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query_users = "SELECT * FROM users";
$users_result = mysqli_query($conn, $query_users);
if (!$users_result) {
    die("Users query failed: " . mysqli_error($conn));
}

$query_posts = "SELECT * FROM posts";
$posts_result = mysqli_query($conn, $query_posts);
if (!$posts_result) {
    die("Posts query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Viewer</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { color: #333; }
        .empty { color: #888; }
    </style>
</head>
<body>
    <h1>User List</h1>
    <?php if (mysqli_num_rows($users_result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($users_result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['password']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="empty">No users found.</p>
    <?php endif; ?>

    <h1>Posts</h1>
    <?php if (mysqli_num_rows($posts_result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image Path</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($post = mysqli_fetch_assoc($posts_result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['id']); ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($post['content'])); ?></td>
                        <td><?php echo htmlspecialchars($post['image_path']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="empty">No posts found.</p>
    <?php endif; ?>

<?php
mysqli_close($conn);
?>
</body>
</html>