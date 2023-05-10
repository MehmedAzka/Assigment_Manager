<!DOCTYPE html>

<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

$student_id = '';
$fn = '';
$sin = '';
$gender = '';
$clss = '';
$subjects = '';
$notes = '';

if (isset($_GET['change'])) {
    $student_id = $_GET['change'];

    $query = "SELECT * FROM tb_task_collection WHERE id_data = '$student_id';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);

    $fn = $result['full_name'];
    $sin = $result['student_ident_num'];
    $gender = $result['gender'];
    $clss = $result['class'];
    $subjects = $result['subjects'];
    $notes = $result['notes'];
}

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
        <div class="badge bg-success text-wrap fs-6" style="width: 8rem;">
            User Page
        </div>
        <div class="header_img"> <img src="../admin/profile/<?php echo $photo ?>" alt=""> </div>
    </header>
    <div class="l-navbar bg-dark" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class="fa-solid fa-database"></i>
                    <span class="nav_logo-name">Assigment Manager</span>
                </a>
                <div class="nav_list">
                    <a href="page.php" class="nav_link active" title="Assigment Display"> <i
                            class="fa-solid fa-display"></i>
                        <span class="nav_name">Assigment Display</span>
                    </a>
                    <a href="info.php" class="nav_link" title="Information"> <i class="fa-regular fa-file-lines"></i>
                        <span class="nav_name">Information</span>
                    </a>
                    <a href="comunication.php" class="nav_link" title="Comunication"> <i
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
        <br>
        <form method="POST" action="procces.php" enctype="multipart/form-data" class="m-3">
            <input type="hidden" value="<?php echo $student_id ?>" name="student_id">
            <div class="mb-3 row">
                <label for="full_name" class="col-sm-2 col-form-label">
                    Full Name
                </label>
                <div class="col-sm-10">
                    <input required type="text" name="full_name" class="form-control" id="full_name"
                        placeholder="Ex: Steve Normann" value="<?php echo $fn ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="student_ident_num" class="col-sm-2 col-form-label">
                    Student Ident Num
                </label>
                <div class="col-sm-10">
                    <input required type="text" name="student_ident_num" class="form-control" id="student_ident_num"
                        placeholder="Ex: 0123" value="<?php echo $sin ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="gender" class="col-sm-2 col-form-label">
                    Gender
                </label>
                <div class="col-sm-10">
                    <select required id="gender" name="gender" class="form-select">
                        <option <?php if ($gender == "Man") {
                            echo "selected";
                        } ?> value="Man">Man</option>
                        <option <?php if ($gender == "Woman") {
                            echo "selected";
                        } ?> value="Woman">Woman</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="class" class="col-sm-2 col-form-label">Class</label>
                <div class="col-sm-10">
                    <select required id="class" name="class" class="form-select">
                        <option <?php if ($clss == "1-7") {
                            echo "selected";
                        } ?> value="1-7">1-7</option>
                        <option <?php if ($clss == "2-8") {
                            echo "selected";
                        } ?> value="2-8">2-8</option>
                        <option <?php if ($clss == "3-9") {
                            echo "selected";
                        } ?> value="3-9">3-9</option>
                        <option <?php if ($clss == "1-10") {
                            echo "selected";
                        } ?> value="1-10">1-10</option>
                        <option <?php if ($clss == "2-11") {
                            echo "selected";
                        } ?> value="2-11">2-11</option>
                        <option <?php if ($clss == "3-12") {
                            echo "selected";
                        } ?> value="3-12">3-12</option>
                        <option <?php if ($clss == "4-10") {
                            echo "selected";
                        } ?> value="4-10">4-10</option>
                        <option <?php if ($clss == "5-11") {
                            echo "selected";
                        } ?> value="5-11">5-11</option>
                        <option <?php if ($clss == "6-12") {
                            echo "selected";
                        } ?> value="6-12">6-12</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="subjects" class="col-sm-2 col-form-label">
                    Subjects
                </label>
                <div class="col-sm-10">
                    <input required type="text" name="subjects" class="form-control" id="subjects"
                        placeholder="Ex: Programming/ DKV/ VideoGraphy" value="<?php echo $subjects ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="file" class="col-sm-2 col-form-label">
                    Upload File
                </label>
                <div class="col-sm-10">
                    <input <?php if (!isset($_GET['change'])) {
                        echo "required";
                    } ?> class="form-control" type="file"
                        name="file" id="file">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="notes" class="col-sm-2 col-form-label">
                    Notes
                </label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo $notes ?></textarea>
                </div>
            </div>

            <div class="mb-3 row mt-4">
                <div class="col text-end">

                    <?php
                    if (isset($_GET['change'])) {
                        ?>
                        <button type="submit" name="action" value="edit"
                            class="fa-solid fa-floppy-disk btn btn-primary btn-lg"></button>
                        <?php
                    } else {
                        ?>
                        <button type="submit" name="action" value="add"
                            class="fa-solid fa-plus btn btn-primary btn-lg"></button>
                        <?php
                    }
                    ?>

                    <!-- <a href="index.php" type="button" class="btn btn-danger">Cancle</a> -->
                </div>
            </div>
        </form>
        <br>
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
<!-- dataTables -->
<script>
    $(document).ready(function () {
        $('#tAssigment').DataTable();
    });
</script>

</html>