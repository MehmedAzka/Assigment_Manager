<?php
session_start();

include('connection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tb_users WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['photo'] = $row['photo'];
            $_SESSION['role'] = $row['role'];

            if ($_SESSION['role'] == 'admin') {
                header('Location: admin/page.php');
                exit();
            } elseif ($_SESSION['role'] == 'user') {
                header('Location: user/page.php');
                exit();
            } elseif ($_SESSION['role'] == 'teacher') {
                header('location: teacher/page.php');
                exit();
            }
        } else {
            $_SESSION['error'] = "<script>alert('Wrong username or email!');</script>";
        }
    } else {
        $_SESSION['error'] = "<script>alert('Wrong username or email!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Login</title>
</head>

<body>
    <?php if (isset($_SESSION['error'])) { ?>
        <div>
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle col">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Log In</h5>
                    <br>
                    <form method="post">
                        <!-- username -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1" name="username" required>
                        </div>
                        <!-- pass -->
                        <div class="input-group mb-3 me-2">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                aria-describedby="basic-addon1" name="password" required>
                        </div>
                        <!-- submit button -->
                        <div class="d-grid gap-2 mb-3">
                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                        </div>
                        <!-- forgot password? -->
                        <div class="d-flex justify-content-between">
                            <a href="#">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-center">
                <span class="me-1">don't have an account?</span>
                <a href="register.php" class="card-link">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>