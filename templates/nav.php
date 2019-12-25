<?php
require_once "libcon.php";
require_once "libssn.php";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="mx-auto justify-content-md-center container">
        <div class="row col-lg justify-content-md-center">
            <div class="col-auto">
                <a class="navbar-brand" href="index.php">
                    <img src="favicon.ico" width="30" height="30" alt="">
                </a>
                <a class="navbar-brand">World of Books</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-auto collapse navbar-collapse row" id="navbarNavAltMarkup">
                <div class="col">
                    <form action="pageSearchResults.php" method="GET">
                        <div class="input-group">
                            <!-- onkeyup="ajaxsearchbook(this.value)" -->
                            <input type="text" class="form-control mr-sm-2" id="navsearch" placeholder="Kitap ya da Yazar (örn. Harry Potter)" name="query" value="<?php if (isset($_GET["query"])) echo $_GET["query"]; ?>">
                            <input type="hidden" name="dedicated" value="1" />
                            <span class="input-group-btn">
                                <button class="btn btn-outline-success" type="submit"><span class="fa fa-search"></span></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="navbar-nav col-auto">
                    <?php
                    if (!isset($_SESSION["logged"])) {
                    ?>

                        <a class="nav-item nav-link active mr-sm-2" href="pageLogin.php">Giriş Yap <span class="sr-only">(current)</span></a>

                    <?php
                    } else {
                    ?>

                        <a class="nav-link dropdown-toggle mr-2" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo ($_SESSION["user_name"] . " " . $_SESSION["user_surname"]) ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Siparişlerim</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="ajaxlogout()">Çıkış Yap</a>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="justify-content-center">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sepet
                        </button>
                        <div class="dropdown-menu text-center p-0" aria-labelledby="dropdownMenuButton" style="width: 23rem">
                            <div id="navCart">    
                                <?php require_once "cart.php" ?>
                            </div>
                            <div class="p-sm-4 text-center">
                                <div class="col text-center">
                                    <div class="row">
                                        <div class="w-auto mx-auto"><span class="card-text"><small id="cartItems">Toplam <?php echo $totalcount ?> ürün</small></span></div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="w-auto mx-auto">
                                            <h5 class="bold text-center" id="cartValue"><?php echo $total ?> ₺</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a href="pageCart.php" class="no-links-visible w-100"><button type="button" class="btn btn-danger d-block w-100">SEPETE GİT</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>