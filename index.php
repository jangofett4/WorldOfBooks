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
    <?php include "templates/nav.php" ?>

    <div class="container text-center" style="margin-top: 30px">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="slider/nresim1.jpg" alt="First slide" height="400px" style="background-image: url('slider/nresim1.jpg')">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="slider/nresim2.jpg" alt="Second slide" height="400px" style="background-image: url('slider/nresim2.jpg')">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="slider/nresim3.jpg" alt="Third slide" height="400px">
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
    <div class="container " style="margin-top: 30px">
        <div class="row text-center justify-content-md-center">
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/nhp6.jpg" alt="Harry Potter ve Melez Prens" /></div>
                    <div class="card-body-index">
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
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp77.jpg?" alt="Harry Potter ve Ölüm Yadigarları"></div>
                    <div class="card-body-index">
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
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp1.jpg?" alt="Harry Potter ve Felsefe Taşı"></div>
                    <div class="card-body-index">
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
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/nhp4.jpg?" alt="Harry Potter ve Ateş Kadehi"></div>
                    <div class="card-body-index">
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
        <div class="row text-center justify-content-md-center" style="margin-top: 10px">
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/nhp6.jpg?" alt="Harry Potter ve Melez Prens"></div>
                    <div class="card-body-index">
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
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp77.jpg?" alt="Harry Potter ve Ölüm Yadigarları"></div>
                    <div class="card-body-index">
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
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/hp1.jpg?" alt="Harry Potter ve Felsefe Taşı"></div>
                    <div class="card-body-index">
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
            <a class="no-links-visible" href="pageBookInfo.php">
                <div class="col card mx-1" style="width: 17rem;">
                    <div class="p-3"><img class="card-img-top border border-dark" src="slider/nhp4.jpg" alt="Harry Potter ve Ateş Kadehi"></div>
                    <div class="card-body-index">
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
    <?php include "templates/footer.php" ?>

    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>