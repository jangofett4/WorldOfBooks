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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
            <img src="favicon.ico" width="30" height="30" alt="">
        </a>
        <a class="navbar-brand">World of Books</a>
        <div class="input-group col-9">
            <!-- <div class="input-group-prepend">
                <span class="input-group-text"><span class="fa fa-search"></span></span>
            </div> -->
            <input type="text" class="form-control mr-sm-2" id="navsearch" onkeyup="ajaxsearchbook(this.value)" placeholder="Kitap ya da Yazar (örn. Harry Potter)">
            <span class="input-group-btn">
                <button class="btn btn-outline-success" type="submit"><span class="fa fa-search"></span></button>
            </span>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="loginpage.php">Giriş Yap <span class="sr-only">(current)</span></a>
                <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                    Sepet
                </button>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 50px">

        <div class="row">
            <div class="col-4 border  p-4 m-1">
                <div class="group-row text-center mb-2">
                    <span class="text-center"> Zaten Üyeyim! <a href="loginpage.php" style="text-decoration: underline">Giriş Yap</a></span>
                </div>
                <form>
                    <div class="form-group row">
                        <div class="col">
                            <label for="exampleInputEmail1">Ad*</label>
                            <input type="email" class="form-control" id="exampleInputName" name="name" placeholder="Adınızı Yazınız">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1">Soyad*</label>
                            <input type="email" class="form-control" id="exampleInputSurname" name="surname" placeholder="Soyadınızı Yazınız">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Posta Adresi*</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email1" placeholder="E-Postanızı Yazınız" style="margin-bottom: 4px">
                        <label for="exampleInputEmail1">E-Posta Adresi(Tekrar)*</label>
                        <input type="email" class="form-control" id="exampleInputEmail2" name="email2" placeholder="E-Postanızı Yazınız">
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="exampleInputPassword1">Şifre*</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password1" placeholder="Şifrenizi Yazınız">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">Şifre(Tekrar)*</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password2" placeholder="Şifrenizi Yazınız">
                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col"><button type="submit" class="btn btn-danger px-5 btn-block">Üye Ol</button></div>
                    </div>
                </form>
            </div>
            <div class="col-7  text-center p-5 m-1">
                <div class="col">
                    <h1 class="display-5">Üye Ol</h1>
                </div>
                <div class="col"><span class="fas fa-user-plus fa-10x p-4" style="color: rgb(220,220,220)"></span></div>
                <div class="col"><span>Üyelik formundaki boş alanları doldurarak hemen üye olabilirsiniz.</br>Hemen üye olarak binlerce kitaba anında ulaşın!</span></div>
            </div>
        </div>



    </div>





    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>