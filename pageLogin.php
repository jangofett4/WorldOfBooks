<?php session_start(); ?>
<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>World Of Books</title>
    <style>
        .checked {
            color: orange;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/wob.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>

    <div class="container" style="margin-top: 50px">

        <div class="row">
            <div class="col border text-center p-5 m-1">
                <h1 class="display-5">Üye Girişi</h1>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="E-Posta">
                        <small id="emailHelp" class="form-text text-muted">E-Postanızı kimseyle paylaşmayız.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Şifre</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Şifre">
                    </div>
                    <button type="button" class="btn btn-secondary px-5 btn-block" onclick="ajaxlogin(email.value, password.value)">Giriş Yap</button>
                </form>
            </div>
            <div class="col border text-center p-5 m-1">
                <div class="col">
                    <h1 class="display-5">Üye Ol</h1><span class="fas fa-user-plus fa-10x p-4" style="color: rgb(220,220,220)"></span>
                </div>
                <div class="col"><a href="pageRegister.php"><button type="submit" class="btn btn-secondary px-5">Üye Ol</button></a></div>
            </div>
        </div>
    </div>
    <div class="modal fade" data-backdrop="static" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-sm modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Giriş Yapılıyor</h5>
                </div>
                <div class="modal-body mx-auto">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 16%"><?php include "templates/footer.php" ?></div>
    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>