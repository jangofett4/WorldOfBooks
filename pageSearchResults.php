<?php
require_once "libssn.php";

include_once "libsearch.php";

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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>

    <div class="container mt-5">
        <?php if ($books == null || count($books) == 0) { ?>
            <h1 class="display-4 text-center">Sonuç bulunamadı, başka bir şeyler aramayı deneyin.</h1>
        <?php } else foreach ($books as $book) { ?>
            <div class="row p-2">
                <div class="col">
                    <div class="col card mb-3k border mx-auto p-3">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <img src="<?php echo $book["coverpath"] ?>" class="card-img card-img-fluid card-img-search " alt="...">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <div class="row ">
                                        <div class="col align-self-center ">
                                            <h5 class="card-title"><?php echo $book["name"] ?></h5>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <p class="card-text"><?php echo $book["author"] ?></p>
                                            <p class="card-text"><?php echo $book["publisher"] ?></p>
                                        </div>
                                        <div class="col align-self-center ">
                                            <h5 class="bold"><?php echo $book["cost"] ?> ₺</h5>
                                        </div>
                                        <div class="col align-self-center">
                                            <div class="row m-2"><button type="button" class="btn btn-danger w-100">Sepete Ekle</button></div>
                                            <div class="row m-2"><a class="w-100" href="pageBookInfo.php"><button type="button" class="btn btn-danger w-100">Detaya Git</button></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php include "templates/footer.php" ?>
        <!-- Libraries -->
        <script src="js/jquery-3.4.1.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>