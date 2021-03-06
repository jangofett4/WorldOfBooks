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
    <?php include "templates/nav.php"; ?>
    <div class="container container-fixed">
        <?php if (count($cart) == 0) { ?>
            <div class="text-center">
                <h1 class="display-3">Sepetinizde ürün yok</h1>
                <h1 class="display-4">Alışverişe başlamak için <a href="index.php">tıklayın</a>!</h1>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
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
                        foreach ($cartbooks as $ct) {
                            $book = $ct->book;
                            $count = $ct->count;
                        ?>
                            <tr id="bigcart<?php echo $id ?>">
                                <td class="align-middle"><img src="<?php echo $book["coverpath"] ?>" class="img-bigcart"></td>
                                <td class="align-middle"> <?php echo $book["name"] ?></td>
                                <td class="align-middle" id="bc<?php echo $id ?>"><?php echo $count ?></td>
                                <td class="align-middle"><?php echo $book["cost"] ?> ₺</td>
                                <td class="align-middle"><span id="bt<?php echo $id ?>"><?php echo $book["cost"] * $count ?></span> ₺</td>
                                <td class="align-middle">
                                    <a class="text-danger pointer" onclick="ajaxremovefromcart(<?php echo $id ?>)"><span class="fa fa-trash fa-2x"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <h5 class="col align-self-center">Toplam: <b id="cartTotal"><?php echo $total ?></b><b>₺</b></h5>
                <div class="col align-self-center"><button class="btn btn-block btn-success" onclick="buy()">Ödemeye Devam <span class="ml-sm-2 fa fa-angle-right"></span> </button></div>
            </div>
        <?php } ?>
    </div>
    <?php include "templates/footer.php" ?>
    <script>
        var cartTotal = <?php echo $total ?>;
        var cartItemsTotal = <?php echo $totalcount ?>;

        function buy() {
            <?php if ($logged) { ?>
                window.location.assign("buy.php");
            <?php } else { ?>
                window.location.assign("login.php");
            <?php } ?>
        }
    </script>
    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>