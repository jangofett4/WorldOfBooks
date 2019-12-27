<?php
$con = DSConnection::open_or_get();
$logged = LibSSN::getnd("logged");
$cart = null;
if ($logged)
    $cart = LibSSN::getvnd("user_cart");
else
    $cart = LibSSN::getvnd("cart");

if ($cart == null)
    $cart = array();

$total = 0;
$itemcount = 0;
$totalcount = 0;
$cartbooks = array();
$ellipsis = false;
$at = 0;
foreach ($cart as $id => $count) {
    $itemcount++;
    $totalcount += $count;
    $key = $con->key("Books", $id);
    $book = $con->lookup($key);
    $cartbooks[$id] = [$book, $count];
    $total += $book["cost"] * $count;
    if ($itemcount < 4) {
?>
        <a class="dropdown-item px-sm-2" href="pageBookInfo.php?book=<?php echo $id ?>" id="cart<?php echo $id ?>">
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
<?php } else {
    if (!$ellipsis)
        $at = $itemcount;
    $ellipsis = true;
    }
}
if ($ellipsis) { ?>
    <small class="align-self-center">ve <?php echo $itemcount - $at + 1 ?> kitap daha...</small>
<?php } ?>
