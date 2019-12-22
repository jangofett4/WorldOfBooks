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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/wob.css">

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>
    <div class="container mt-5">
        <div class="row p-2">
            <div class="col">
                <div class="col  mb-3k mx-auto p-3">
                    <div class="row">
                        <div class="col-6 align-self-center font-weight-bold">ÜRÜN</div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col  align-self-center text-center font-weight-bold">ADET</div>
                                <div class="col align-self-center text-center font-weight-bold">BİRİM FİYAT</div>
                                <div class="col align-self-center text-center font-weight-bold">TOPLAM FİYAT</div>
                                <div class="col align-self-center text-center font-weight-bold">KALDIR</div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $con = DSConnection::open_or_get();
                    $ssncart = LibSSN::getvnd("cart");
                    $logged = LibSSN::getnd("logged");
                    $total = 0;
                    $itemcount = 0;
                    $totalcount = 0;
                    if (!$logged && $ssncart != null) {
                        foreach ($ssncart as $id => $count) {
                            $itemcount++;
                            $totalcount += $count;
                            $key = $con->key("Books", $id);
                            $book = $con->lookup($key);
                            $total += $book["cost"] * $count;
                    ?>
                            <div class="row no-gutters border mb-sm-2" id="bigcart<?php echo $id ?>">
                                <div class="col-2 align-self-center">
                                    <a href="pageBookInfo.php?book=<?php echo $id ?>"><img src="<?php echo $book["coverpath"] ?>" class="card-img card-img-search" alt="..."></a>
                                </div>
                                <div class="col-4 align-self-center">
                                    <?php echo $book["name"] ?>
                                </div>
                                <div class="col-6 align-self-center">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col align-self-center text-center">
                                                <?php echo $count ?>
                                            </div>
                                            <div class="col align-self-center text-center">
                                                <h5 class="bold"><?php echo $book["cost"] ?> ₺</h5>
                                            </div>
                                            <div class="col align-self-center text-center">
                                                <h5 class="bold"><?php echo $book["cost"] * $count ?> ₺</h5>
                                            </div>
                                            <div class="col align-self-center text-center">
                                                <span>
                                                    <a class="no-links-visible text-danger pointer" onclick="ajaxremovefromcart(<?php echo $id ?>)"><span class="fa fa-trash fa-2x"></span></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } elseif ($logged) {
                        $usercart = LibSSN::getvnd("user_cart");
                        foreach ($usercart as $id => $count) {
                            $itemcount++;
                            $totalcount += $count;
                            $key = $con->key("Books", $id);
                            $book = $con->lookup($key);
                            $total += $book["cost"] * $count;
                        ?>
                            <div class="row no-gutters border mb-sm-2" id="bigcart<?php echo $id ?>">
                                <div class="col-2 align-self-center">
                                    <img src="<?php echo $book["coverpath"] ?>" class="card-img card-img-search" alt="...">
                                </div>
                                <div class="col-4 align-self-center">
                                    <?php echo $book["name"] ?>
                                </div>
                                <div class="col-6 align-self-center">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col align-self-center text-center">
                                                <?php echo $count ?>
                                            </div>
                                            <div class="col align-self-center text-center">
                                                <h5 class="bold"><?php echo $book["cost"] ?> ₺</h5>
                                            </div>
                                            <div class="col align-self-center text-center">
                                                <h5 class="bold"><?php echo $book["cost"] * $count ?> ₺</h5>
                                            </div>
                                            <div class="col align-self-center text-center">
                                                <span>
                                                    <a class="no-links-visible text-danger pointer" onclick="ajaxremovefromcart(<?php echo $id ?>)"><span class="fa fa-trash fa-2x"></span></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-25" style="float: right">
                                <div class="row">
                                    <div class="col">
                                        <h5>Ara Toplam :</h5>
                                    </div>
                                    <div class="col">
                                        <h4><?php echo $total ?>
                                         ₺</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="w-100">
                                        <button type="button" class="btn btn-danger d-block w-100">SATIN AL</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include "templates/footer.php" ?>



    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>