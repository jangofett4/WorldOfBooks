<?php
require_once "libssn.php";
require_once "libcon.php";

if (!LibSSN::getnd("logged")) {
    header("Location: pageLogin.php");
    exit();
}

$hist = LibSSN::getvnd("user_history");

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
    <div class="container container-fixed">
        <?php
        $con = DSConnection::open_or_get();
        ?> 
        <?php if (count($hist) == 0) { ?>
            <div class="text-center">
                <h1 class="display-3">Daha önce alışveriş yapmamışsınız</h1>
                <h1 class="display-4">Alışverişe başlamak için <a href="index.php">tıklayın</a>!</h1>
            </div>
        <?php } else { ?>
            <div class="text-center">
                <h3>Satın Alma Geçmişi</h3>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Ürün</th>
                            <th scope="col"></th>
                            <th scope="col">Adet</th>
                            <th scope="col">Birim Fiyat</th>
                            <th scope="col">Toplam Fiyat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /** @var int $id */
                        foreach ($hist as $elem) {
                            $bookid = $elem["book"];
                            $count = $elem["count"];
                            $key = $con->key("Books", $bookid);
                            $book = $con->lookup($key);
                        ?>
                            <tr id="bigcart<?php echo $bookid ?>">
                                <td class="align-middle">
                                    <img src="<?php echo $book["coverpath"] ?>" class="img-bigcart">
                                </td>
                                <td class="align-middle"> <?php echo $book["name"] ?></td>
                                <td class="align-middle"><?php echo $count ?></td>
                                <td class="align-middle"><?php echo $book["cost"] ?> ₺</td>
                                <td class="align-middle"><span><?php echo $book["cost"] * $count ?></span> ₺</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    <?php include "templates/footer.php" ?>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>