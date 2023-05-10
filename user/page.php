<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

include 'connection.php';

$user_id = $_SESSION['user_id'];

$sql = $conn->query("SELECT * FROM tb_task_collection WHERE user_id='$user_id'");
$no = 0;

$u = $_SESSION['username'];
$photo = $_SESSION['photo'];
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
            User Page
        </div>
        <div class="header_img me-1"> <img src="../admin/profile/<?php echo $photo ?>" alt=""> </div>
    </header>
    <div class="l-navbar bg-dark" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class="fa-solid fa-database"></i>
                    <span class="nav_logo-name">Assigment Collection</span> </a>
                <div class="nav_list">
                    <a href="page.php" class="nav_link active" title="Assigment Display"> <i
                            class="fa-solid fa-display"></i>
                        <span class="nav_name">Display Screen</span>
                    </a>
                    <a href="info.php" class="nav_link" title="Information"> <i class="fa-regular fa-file-lines"></i>
                        <span class="nav_name">Information</span>
                    </a>
                    <a href="comunication.php" class="nav_link" title="Comunication"> <i class="fa-solid fa-comments"></i>
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
            <div class="bg-info rounded mb-2 p-4" style="height: 11rem;">
                <img class="mx-auto d-block rounded-circle mb-2" src="../admin/profile/<?php echo $photo ?>"
                    style="width: 4rem; height: 4rem;">
                <p class=" text-capitalize text-center fs-3"><strong>Hello,</strong>
                    <?php echo $u ?>
                </p>
            </div>
            <?php
            $quotes = [
                "The biggest challenge in life is being yourself… in a world trying to make you like everyone else.",
                "Happiness is not something ready-made. It comes from your own actions. <b>-Dalai Lama</b>",
                "Believe you can and you’re halfway there. <b>-Theodore Roosevelt</b>",
                "It does not matter how slowly you go as long as you do not stop. <b>-Confucius</b>",
                "Life is 10% what happens to us and 90% how we react to it. <b>-Charles R. Swindoll</b>",
                "Don't watch the clock; do what it does. Keep going. <b>-Sam Levenson</b>",
                "Your only limit is the amount of action you take. The world is full of great things to do, but only if you're willing to act.",
                "Chase your dreams until you catch them...and then dream, catch, and dream again! <b>-Dee Marie</b>",
                "The best way to predict your future is to create it. <b>-Abraham Lincoln</b>",
                "The only way to do great work is to love what you do. <b>- Steve Jobs</b>"
            ];

            $randomQuote = $quotes[array_rand($quotes)];
            ?>
            <div class="card border-success mb-2">
                <div class="card-body">
                    <?php echo $randomQuote ?>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="manage.php" type="button" class="btn btn-success"><i class="fa-solid fa-upload me-1"></i>
                    Upload Your Assigment</a>
            </div>
            <br>
            <?php if (mysqli_num_rows($sql) > 0) {
                while ($result = mysqli_fetch_assoc($sql)) { ?>
                    <div class="card">
                        <div class="card-header">
                            <?php echo $result['full_name']; ?> [
                            <?php echo $result['student_ident_num']; ?> ]
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <img class="rounded" src="../admin/file_manager/<?php echo $result['upload_file']; ?>"
                                    alt="<?php echo $result['upload_file']; ?>" style="width: 10rem; height: 10rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <?php echo $result['class']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo $result['gender']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo $result['subjects']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php echo $result['notes']; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-row-reverse">
                                <a href="procces.php?delete=<?php echo $result['id_data']; ?>" type="button"
                                    class="fa-solid fa-trash btn btn-outline-danger" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this data?')">
                                </a>
                                <a href="manage.php?change=<?php echo $result['id_data']; ?>" type="button"
                                    class="fa-solid fa-pen-to-square btn btn-outline-success me-2" title="Edit">
                                </a>
                            </div>
                        </div>
                    </div> <br>
                <?php }
            } else { ?>
                <hr>
                <p class="fs-1 text-center text-secondary">Empty Assigment</p>
            <?php } ?>
        </div>
        <!--Container Main end-->
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