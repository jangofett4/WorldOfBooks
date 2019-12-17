<?php
require_once "libcon.php";
require_once "libssn.php";
?>
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
    <?php
    if (isset($_GET["book"])) {
        $con = DSConnection::open_or_get();
        $key = $con->key("Books", $_GET["book"]);
        $book = $con->lookup($key);
        ?>
        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col">
                    <h1 class="display-5"><?php $book["name"] ?></h1>
                </div>

                <div class="text-center col align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>


            </div>
            <div class="row">
                <div class="col">
                    <img src="<?php echo $book["coverpath"] ?>" alt="resim1" class="img-thumbnail" height="300px" width="400px">
                </div>
                <div class="col">
                    <div class="row col-sm-auto w-100 border">
                        <span style="padding: 10px">Yazar : <span class="font-weight-bold"><?php echo $book["author"] ?></span></span>
                    </div>
                    <div class="row col-sm-auto w-100 border">
                        <span style="padding: 10px">Yayın Evi : <span class="font-weight-bold"><?php echo $book["publisher"] ?></span></span>
                    </div>
                    <div class="border col-sm-auto w-100 row text-center" style="padding: 10px;height: 200px">
                        <div class="col align-self-center">
                            <span class="font-weight-bold text-primary"><?php echo $book["cost"] ?> ₺</span>
                        </div>
                        <div class="col align-self-center">
                            <button class="btn btn-circle btn-dark btn-sm"><span class="fa fa-minus"></span></button>
                            0
                            <button class="btn btn-circle btn-dark btn-sm"><span class="fa fa-plus"></span></button>
                        </div>
                        <div class="col align-self-center">
                            <button type="button" class="btn btn-danger" onclick="ajaxaddtocart(<?php echo $_GET['book']; ?>, 1)">Sepete Ekle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <p><?php echo $book["description"] ?></p>
            <p class="text-center"> <span class="font-weight-bold">Sayfa Sayısı : </span> <span><?php echo $book["papercount"] ?></span> </p>
            <p class="text-center"> <span class="font-weight-bold">İlk Baskı Yılı : </span> <span><?php echo $book["published"] ?></span> </p>
            <p class="text-center"> <span class="font-weight-bold">Dili : </span> <span><?php echo $book["language"] ?></span> </p>
        </div>
    <?php } ?>
    <?php include "templates/footer.php" ?>



    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>