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
            <div class="col border text-center p-5 m-1" >
                <h1 class="display-5">Üye Girişi</h1>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">E-Postanızı kimseyle paylaşmayınız.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Şifre</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-secondary px-5">Giriş Yap</button>
                </form>
            </div>
            <div class="col border text-center p-5 m-1">
                <div class="col"><h1 class="display-5">Üye Ol</h1><span class="fas fa-user-plus fa-10x p-4" style="color: rgb(220,220,220)"></span></div>
                <div class="col"><a href="registerpage.php"><button type="submit" class="btn btn-secondary px-5" >Üye Ol</button></a></div>
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