<?php
session_start();
include '../includes/db.php';

$error = "";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $sql = mysqli_query($conn, "
        SELECT * FROM admins
        WHERE username = '$username'
        AND password = '$password'
    ");

    if (mysqli_num_rows($sql) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Login";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">

                <div class="card mt-5 shadow">
                    <div class="card-body">

                        <h3 class="text-center mb-4">Admin Login</h3>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                            <button name="login" class="btn btn-primary w-100">Login</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
