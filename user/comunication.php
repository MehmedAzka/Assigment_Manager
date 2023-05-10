<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT m.id_mail, m.mail, u.username, m.user_id FROM tb_mail m INNER JOIN tb_users u ON m.user_id = u.user_id WHERE m.user_id = '$user_id';";
$sql = mysqli_query($conn, $query);
$no = 0;

if (isset($_POST['submit'])) {
    $mail = $_POST['mail'];
    $sender = $_SESSION['user_id'];
    $location = $_POST['user_id'];

    $query = "INSERT INTO tb_mail VALUES (null, '$mail', '$sender', '$location')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "<script>alert('New Message');</script>";
        header('Location: comunication.php');
        exit();
    } else {
        $_SESSION['error'] = "<script>alert('Error?');</script>";
    }
}

$photo = $_SESSION['photo'];

$c = $conn->query("SELECT * FROM tb_users");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../admin/img/folder.png">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- DataTables CDN, Style, Script -->
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.css">
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>
    <title>User Page</title>
</head>


<body id="body-pd">
    <header class="header bg-secondary" id="header">
        <div class="header_toggle text-dark"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="badge bg-info text-wrap fs-6" style="width: 8rem;">
            Comunication
        </div>
        <div class="header_img me-1"> <img src="../admin/profile/<?php echo $photo ?>" alt=""> </div>
    </header>
    <div class="l-navbar bg-dark" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class="fa-solid fa-database"></i>
                    <span class="nav_logo-name">Assigment Collection</span> </a>
                <div class="nav_list">
                    <a href="page.php" class="nav_link" title="Assigment Display"> <i class="fa-solid fa-display"></i>
                        <span class="nav_name">Display Screen</span>
                    </a>
                    <a href="info.php" class="nav_link" title="Information"> <i class="fa-regular fa-file-lines"></i>
                        <span class="nav_name">Information</span>
                    </a>
                    <a href="comunication.php" class="nav_link active" title="Comunication"> <i
                            class="fa-solid fa-comments"></i>
                        <span class="nav_name">Comunication</span>
                    </a>
                </div>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <div class="container pt-4">
            <br>
            <!-- Output Event -->
            <div class="card">
                <div class="card-body">
                    <p class="badge bg-primary text-wrap p-2 fs-6" style="width: 100%; height: 2rem;"><i
                            class="fa-regular fa-envelope"></i> Mail Box</p>
                    <div class="overflow-y-scroll" style="height: 260px;">
                        <?php if (mysqli_num_rows($sql) > 0) {
                            while ($result = mysqli_fetch_assoc($sql)) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex flex-row-reverse">
                                            <a href="delete.php?delete=<?php echo $result['id_mail'] ?>" type="button"
                                                class="btn btn-outline-danger btn-sm" name="delete" id="delete">X</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $result['mail'] ?> <br>
                                    </div>
                                </div>
                                <br>
                            <?php }
                        } else { ?>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <p class="fs-1 text-center text-secondary">Empty</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <br>
            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Type Here" aria-label="Type Here"
                        aria-describedby="basic-addon1" name="mail" id="mail">
                </div>

                <select required id="user_id" name="user_id" class="form-select mb-3">
                    <?php while ($result = mysqli_fetch_assoc($c)) { ?>
                        <option value="<?php echo $result['user_id'] ?>"><?php echo $result['username'] ?></option>
                    <?php } ?>
                </select>

                <div class="col text-end">
                    <button class="btn btn-outline-success" type="submit" name="submit" id="submit">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css");

    :root {
        --header-height: 3rem;
        --nav-width: 68px;
        --first-color: #4723D9;
        --first-color-light: #AFA5D9;
        --white-color: #F7F6FB;
        --body-font: 'Nunito', sans-serif;
        --normal-font-size: 1rem;
        --z-fixed: 100
    }

    *,
    ::before,
    ::after {
        box-sizing: border-box
    }

    body {
        position: relative;
        margin: var(--header-height) 0 0 0;
        padding: 0 1rem;
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
        transition: .5s
    }

    a {
        text-decoration: none
    }

    .header {
        width: 100%;
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background-color: var(--white-color);
        z-index: var(--z-fixed);
        transition: .5s
    }

    .header_toggle {
        color: var(--first-color);
        font-size: 1.5rem;
        cursor: pointer
    }

    .header_img {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden
    }

    .header_img img {
        width: 40px
    }

    .l-navbar {
        position: fixed;
        top: 0;
        left: -30%;
        width: var(--nav-width);
        height: 100vh;
        background-color: var(--first-color);
        padding: .5rem 1rem 0 0;
        transition: .5s;
        z-index: var(--z-fixed)
    }

    .nav {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden
    }

    .nav_logo,
    .nav_link {
        display: grid;
        grid-template-columns: max-content max-content;
        align-items: center;
        column-gap: 1rem;
        padding: .5rem 0 .5rem 1.5rem
    }

    .nav_logo {
        margin-bottom: 2rem
    }

    .nav_logo-icon {
        font-size: 1.25rem;
        color: var(--white-color)
    }

    .nav_logo-name {
        color: var(--white-color);
        font-weight: 700
    }

    .nav_link {
        position: relative;
        color: var(--first-color-light);
        margin-bottom: 1.5rem;
        transition: .3s
    }

    .nav_link:hover {
        color: var(--white-color)
    }

    .nav_icon {
        font-size: 1.25rem
    }

    .show {
        left: 0
    }

    .body-pd {
        padding-left: calc(var(--nav-width) + 1rem)
    }

    .active {
        color: var(--white-color)
    }

    .active::before {
        content: '';
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--white-color)
    }

    .height-100 {
        height: 100vh
    }

    @media screen and (min-width: 768px) {
        body {
            margin: calc(var(--header-height) + 1rem) 0 0 0;
            padding-left: calc(var(--nav-width) + 2rem)
        }

        .header {
            height: calc(var(--header-height) + 1rem);
            padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
        }

        .header_img {
            width: 40px;
            height: 40px
        }

        .header_img img {
            width: 45px
        }

        .l-navbar {
            left: 0;
            padding: 1rem 1rem 0 0
        }

        .show {
            width: calc(var(--nav-width) + 156px)
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 188px)
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function (event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });

    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<!-- popovers -->
<script src="js/bootstrap.bundle.min.js"></script>

</html>