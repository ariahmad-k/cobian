<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!-- HTML dimulai -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "layout/header.html"; ?>

    <div class="container mt-5 text-center">
        <?php if (isset($_SESSION["username"])): ?>
            <h3 class="mb-4">Selamat datang, <span class="text-primary"><?= htmlspecialchars($_SESSION["username"]) ?></span>!</h3>

            <form action="dasboard.php" method="POST">
                <button type="submit" name="logout" class="btn btn-danger" href="logout.php">Logout</button>
            </form>
        <?php else: ?>
            <h3 class="mb-4">Anda belum login</h3>
            <a href="login.php" class="btn btn-primary me-2">Login</a>
            <a href="register.php" class="btn btn-success">Register</a>
        <?php endif; ?>
    </div>

    <?php include "layout/footer.html"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
