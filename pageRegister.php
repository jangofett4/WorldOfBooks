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

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>

    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-4 border  p-4 m-1">
                <div class="group-row text-center mb-2">
                    <span class="text-center"> Zaten Üyeyim! <a href="pageLogin.php" style="text-decoration: underline">Giriş Yap</a></span>
                </div>
                <form>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="exampleInputEmail1">Ad*</label>
                            <input type="text" class="form-control" id="inputName" name="uname" placeholder="Adınızı Yazınız" required>
                        </div>
                        <div class="col-sm">
                            <label for="exampleInputEmail1">Soyad*</label>
                            <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Soyadınızı Yazınız" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Posta Adresi*</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="E-Postanızı Yazınız" style="margin-bottom: 4px" required>
                        <label for="exampleInputEmail1">E-Posta Adresi(Tekrar)*</label>
                        <input type="email" class="form-control" id="inputEmailRe" name="emailre" placeholder="E-Postanızı Yazınız" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="exampleInputPassword1">Şifre*</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Şifrenizi Yazınız" required>
                        </div>
                        <div class="col-sm">
                            <label for="exampleInputPassword1">Şifre(Tekrar)*</label>
                            <input type="password" class="form-control" id="inputPasswordRe" name="passwordre" placeholder="Şifrenizi Yazınız" required>
                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col-sm">
                            <button type="button" class="btn btn-danger px-5 btn-block" onclick="ajaxregister(uname.value, surname.value, email.value, emailre.value, password.value, passwordre.value)">Üye Ol</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-7  text-center p-5 m-1">
                <div class="col-sm">
                    <h1 class="display-5">Üye Ol</h1>
                </div>
                <div class="col-sm"><span class="fas fa-user-plus fa-10x p-4" style="color: rgb(220,220,220)"></span></div>
                <div class="col-sm"><span>Üyelik formundaki boş alanları doldurarak hemen üye olabilirsiniz.</br>Hemen üye olarak binlerce kitaba anında ulaşın!</span></div>
            </div>
        </div>
        <div class="modal fade" data-backdrop="static" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-sm modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mx-auto" id="exampleModalLabel">Kayıt Yapılıyor</h5>
                    </div>
                    <div class="modal-body mx-auto">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom"><?php include "templates/footer.php" ?></div>
    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>