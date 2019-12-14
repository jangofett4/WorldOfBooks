<?php session_start(); ?>
<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>World Of Books</title>
    <style>
        .carousel-inner {
            height: 400px;
            max-height: 400px !important;

        }

        .checked {
            color: orange;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/wob.css">
    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php

    use Google\Cloud\Datastore\Entity;

    $logged = false;
    $hasdata = false;
    if (isset ($_POST["username"], $_POST["password"]))
    {
        $hasdata = true;
        include_once "libcon.php";
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        $con = DSConnection::open_or_get();
        $query = $con->query()
            ->kind("AdminInfo")
            ->filter("username", "=", $username)
            ->filter("password", "=", $password);
        $result = $con->runQuery($query);

        if (iterator_count($result) == 1) {
            $logged = true;
            /** @var Entity as $admin */
            foreach ($result as $admin) {
                $_SESSION["admin_key"] = $admin->key();
                $_SESSION["admin_name"] = $admin["name"];
                $_SESSION["admin_surname"] = $admin["surname"];
                $_SESSION["admin_username"] = $username;
                $_SESSION["admin_password"] = $password;
                break;
        }
    }
    }
    if (!$logged)
    {
    ?>
    <div class="container">
        <div class="row" style="height: 100vh">
            <div class="col-sm-5 my-auto mx-auto">
                <div class="card">
                    <h5 class="card-header text-center">Yönetici Paneli</h5>
                    <div class="card-body">
                        <form action="panel.php" method="post">
                            <div class="form-group">
                                <label for="adminUsername">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="adminUsername" aria-describedby="usernameHelp" name="username">
                            </div>
                            <div class="form-group">
                                <label for="adminPassword">Şifre</label>
                                <input type="password" class="form-control" id="adminPassword" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Giriş</button>
                        </form>
                        <?php
                        if ($hasdata)
                        {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                            <strong>Hata!</strong> Kullanıcı adı ya da şifre hatalı.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                        <?php
                        } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    else
    {
    ?>

    <?php
    }
    ?>
    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>