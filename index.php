<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>World Of Books</title>
    <style>
        .carousel-inner {
            width: 100%;
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
    <div class="container text-center" style="margin-top: 30px">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="slider/resim1.jpg" alt="First slide" height="400px">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="slider/resim2.jpg" alt="Second slide" height="400px">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="slider/resim3.jpg" alt="Third slide" height="400px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container" style="margin-top: 30px">
        <div class="row text-center">
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2 " style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp6.jpg" alt="Harry Potter ve Melez Prens"/></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Harry Potter ve Melez Prens</p>
                        <p class="card-text" >J. K. Rowling </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">20 TL </p>
                    </div>
                </div>
            </a>
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp7.jpg" alt="Harry Potter ve Ölüm Yadigarları"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Harry Potter ve Ölüm Yadigarları</p>
                        <p class="card-text">J. K. Rowling </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">20 TL </p>
                    </div>
                </div>
            </a>
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp1.jpg" alt="Harry Potter ve Felsefe Taşı"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Harry Potter ve Felsefe Taşı</p>
                        <p class="card-text">J. K. Rowling </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">20 TL </p>
                    </div>
                </div>
            </a>
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp4.jpg" alt="Harry Potter ve Ateş Kadehi"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Kitap Adı</p>
                        <p class="card-text">Yazar </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">Fiyat </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="row" style="margin-top: 10px">
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp6.jpg" alt="Harry Potter ve Melez Prens"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Harry Potter ve Melez Prens</p>
                        <p class="card-text">J. K. Rowling </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">20 TL </p>
                    </div>
                </div>
            </a>
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp7.jpg" alt="Harry Potter ve Ölüm Yadigarları"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Harry Potter ve Ölüm Yadigarları</p>
                        <p class="card-text">J. K. Rowling </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">20 TL </p>
                    </div>
                </div>
            </a>
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp1.jpg" alt="Harry Potter ve Felsefe Taşı"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Harry Potter ve Felsefe Taşı</p>
                        <p class="card-text">J. K. Rowling </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">20 TL </p>
                    </div>
                </div>
            </a>
            <a class="no-links-visible" href="bookinfo.php">
                <div class="col card mr-sm-2" style="width: 17rem;">
                <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp4.jpg" alt="Harry Potter ve Ateş Kadehi"></div>
                    <div class="card-body">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <p class="card-text">Kitap Adı</p>
                        <p class="card-text">Yazar </p>
                        <p class="card-text">Kitabevi </p>
                        <p class="card-text">Fiyat </p>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>