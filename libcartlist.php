<?php
require_once "libcon.php";
require_once "libssn.php";

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
        <a class="dropdown-item px-sm-2" href="#" id="cart<?php echo $id ?>">
            <div class="w-100">
                <div class="row no-gutters border">
                    <div class="col-sm-2 align-self-center ml-sm-2">
                        <img src="<?php echo $book["coverpath"] ?>" class="card-img" alt="...">
                    </div>
                    <div class="col">
                        <div class="card-body text-wrap">
                            <p class="card-text"><?php echo $book["name"] ?><?php if ($count > 1) echo " x " . $count ?></p>
                            <?php if ($count > 1) { ?>
                                <p class="card-text">Toplam: <small class="text-muted"><?php echo $book["cost"] ?> x <?php echo $count ?> = <b><?php echo $book["cost"] * $count ?> ₺</b></small></p>
                            <?php } else { ?>
                                <p class="card-text">Toplam: <small class="text-muted"><b><?php echo $book["cost"] ?> ₺</b></small></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php
    }
    echo '<span class="d-none" id="cartTotalValue">' . $total . "</span>";
    echo '<span class="d-none" id="cartTotalItems">' . $totalcount . "</span>";
} elseif ($logged) {
    $usercart = LibSSN::getvnd("user_cart");
    foreach ($usercart as $id => $count) {
        $itemcount++;
        $totalcount += $count;
        $key = $con->key("Books", $id);
        $book = $con->lookup($key);
        $total += $book["cost"] * $count;
    ?>
        <a class="dropdown-item px-sm-2" href="#" id="cart<?php echo $id ?>">
            <div class="w-100">
                <div class="row no-gutters border">
                    <div class="col-sm-2 align-self-center ml-sm-2">
                        <img src="<?php echo $book["coverpath"] ?>" class="card-img" alt="...">
                    </div>
                    <div class="col">
                        <div class="card-body text-wrap">
                            <p class="card-text"><?php echo $book["name"] ?><?php if ($count > 1) echo " x " . $count ?></p>
                            <?php if ($count > 1) { ?>
                                <p class="card-text">Toplam: <small class="text-muted"><?php echo $book["cost"] ?> x <?php echo $count ?> = <b><?php echo $book["cost"] * $count ?> ₺</b></small></p>
                            <?php } else { ?>
                                <p class="card-text">Toplam: <small class="text-muted"><b><?php echo $book["cost"] ?> ₺</b></small></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </a>
<?php
    }
    echo '<span class="d-none" id="cartTotalValue">' . $total . "</span>";
    echo '<span class="d-none" id="cartTotalItems">' . $totalcount . "</span>";
}
?>