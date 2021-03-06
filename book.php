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
            color: #f39c12;
        }

        .hover-checked {
            color: #f8c471;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/wob.css">

    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>
    <?php
    if (isset($_GET["book"])) {
        $con = DSConnection::open_or_get();
        $bookid = $_GET["book"];
        $key = $con->key("Books", $bookid);
        $book = $con->lookup($key);
    ?>
        <div class="container container-fixed" style="margin-top: 50px">
            <div class="row">
                <div class="col">
                    <h1 class="display-5"><?php echo $book["name"] ?></h1>
                </div>
                <div class="text-center col-sm-3 align-self-center row" id="stars">
                    <?php
                    $totalrating = $book["totalrating"];
                    $totalrates = $book["totalrates"];

                    if ($totalrates == 0) {
                        $totalrating = 0;
                        $totalrates = 1;
                    }

                    $calcrate = floor($totalrating / $totalrates);
                    ?>
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <?php if ($i < $calcrate) { ?>
                            <div onmouseout="rating(<?php echo $calcrate ?>)" onmouseover="rating(<?php echo $i + 1; ?>)" onclick="ajaxratebook(<?php echo $bookid ?>, <?php echo $i + 1; ?>)"><span id="_<?php echo $i + 1 ?>" class="fa fa-star pointer col px-sm-1 hover-checked"></span></div>
                        <?php } else { ?>
                            <div onmouseout="rating(<?php echo $calcrate ?>)" onmouseover="rating(<?php echo $i + 1; ?>)" onclick="ajaxratebook(<?php echo $bookid ?>, <?php echo $i + 1; ?>)"><span id="_<?php echo $i + 1 ?>" class="fa fa-star pointer col px-sm-1"></span></div>
                        <?php } ?>
                    <?php } ?>
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
                            <button class="btn btn-circle btn-dark btn-sm" id="minus"><span class="fa fa-minus"></span></button>
                            <span id="count">1</span>
                            <button class="btn btn-circle btn-dark btn-sm" id="plus"><span class="fa fa-plus"></span></button>
                        </div>
                        <div class="col align-self-center">
                            <button type="button" class="btn btn-danger" onclick="ajaxaddtocart(<?php echo $_GET['book']; ?>, count)">Sepete Ekle</button>
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
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        var count = 1;
        $(document).ready(function() {
            $("#plus").on("click", function() {
                $("#count").html(++count);
            });
            $("#minus").on("click", function() {
                if (count > 1)
                    $("#count").html(--count);
            });
        });
    </script>
</body>

</html>