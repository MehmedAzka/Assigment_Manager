<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

include('connection.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $split = explode('.', $_FILES['photo']['name']);
    $extention = $split[count($split) - 1];

    $photo = $username . '.' . $extention;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $dir = "admin/profile/";
    $tmpFile = $_FILES['photo']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $photo);

    $sql = "SELECT * FROM tb_users WHERE email='$email' OR username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('username or email already registered!');</script>";
    } else {
        $sql = "INSERT INTO tb_users (username, email, photo, password, role) VALUES ('$username', '$email', '$photo', '$password', '$role')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Akun berhasil dibuat. Silakan login!";
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan. Silakan coba lagi!";
        }
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
    <title>Register</title>
</head>

<body>
    <?php if (isset($_SESSION['error'])) { ?>
        <div>
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="d-flex justify-content-center">
                <div class="align-items-center">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h1 class="d-flex justify-content-center">Sign Up</h1>
                            <br>
                            <form method="POST" enctype="multipart/form-data">
                                <!-- username -->
                                <div class="input-group mb-3">
                                    <span for="username" class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control text-lowercase" id="username" name="username"
                                        placeholder="Username" required aria-describedby="basic-addon1">
                                </div>
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <span for="email" class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                        required aria-describedby="basic-addon1">
                                </div>
                                <!-- photo -->
                                <div class="input-group mb-3">
                                    <span for="photo" class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-image"></i></span>
                                    <input type="file" class="form-control" name="photo" id="photo" accept="image/*"
                                        placeholder="Photo Profile" required aria-describedby="basic-addon1">
                                </div>
                                <!-- password -->
                                <div class="input-group mb-3">
                                    <span for="password" class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" required aria-describedby="basic-addon1">
                                </div>
                                <!-- role -->
                                <div class="input-group mb-3">
                                    <span for="role" class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-briefcase"></i></span>
                                    <select class="form-select" aria-label="Default select example" id="role"
                                        name="role">
                                        <option value="user">Student</option>
                                        <option value="teacher" disabled>Teacher</option>
                                    </select>
                                </div>
                                <!-- submit button -->
                                <div class="d-grid gap-2">
                                    <input class="btn btn-primary" type="submit" name="register">
                                </div>
                            </form>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me?
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <span class="me-1">have an account?</span>
                        <a href="index.php">login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>