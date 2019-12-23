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
    <?php
    include "templates/nav.php";
    $con = DSConnection::open_or_get();
    $logged = LibSSN::getnd("logged");
    $cart = null;
    if ($logged) $cart = LibSSN::getvnd("user_cart");
    else $cart = LibSSN::getvnd("cart");
    ?>
    <div class="container">
        <?php if (count($cart) == 0) { ?>
            <div class="text-center">
                <h1 class="display-3">Sepetinizde ürün yok</h1>
                <h1 class="display-4">Alışverişe başlamak için <a href="index.php">tıklayın</a>!</h1>
            </div>
        <?php } else { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Ürün</th>
                        <th scope="col"></th>
                        <th scope="col">Adet</th>
                        <th scope="col">Birim Fiyat</th>
                        <th scope="col">Toplam Fiyat</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /** @var int $id */
                    foreach ($cart as $id => $count) {
                        $key = $con->key("Books", $id);
                        $book = $con->lookup($key);
                    ?>
                        <tr id="bigcart<?php echo $id ?>">
                            <td class="align-self-center"><img src="<?php echo $book["coverpath"] ?>" class="img-bigcart"></td>
                            <td class="align-middle"> <?php echo $book["name"] ?></td>  
                            <td class="align-middle"><?php echo $count ?></td>
                            <td class="align-middle"><?php echo $book["cost"] ?> ₺</td>
                            <td class="align-middle"><?php echo $total ?> ₺</td>
                            <td class="align-middle">
                                <a class="text-danger"><span class="fa fa-trash fa-2x"></span></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <?php include "templates/footer.php" ?>

    <!-- <div class="container mt-5">
        <div class="row p-2">
            <div class="col">
                <div class="col mb-3k mx-auto p-3">
                    <?php
                    $con = DSConnection::open_or_get();
                    $ssncart = LibSSN::getvnd("cart");
                    $logged = LibSSN::getnd("logged");
                    ?>
                    <?php if ((!$logged && count($ssncart) == 0) || ($logged && count(LibSSN::getvnd("user_cart")) == 0)) { ?>
                        <div class="text-center">
                            <h1 class="display-3">Sepetinizde ürün yok</h1>
                            <h1 class="display-4">Alışverişe başlamak için <a href="index.php">tıklayın</a>!</h1>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-6 align-self-center"><b>ÜRÜN</b></div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col align-self-center text-center"><b>ADET</b></div>
                                    <div class="col align-self-center text-center"><b>BİRİM FİYAT</b></div>
                                    <div class="col align-self-center text-center"><b>TOPLAM FİYAT</b></div>
                                    <div class="col align-self-center text-center"><b>KALDIR</b></div>
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
                                </div>
                                <?php
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
                                }
                                ?>
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>