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
                    <div class="input-group">
                        <input type="text" class="form-control mr-sm-2" id="navsearch" onkeyup="ajaxsearchbook(this.value)" placeholder="Kitap ya da Yazar (örn. Harry Potter)">
                        <span class="input-group-btn">
                            <button class="btn btn-outline-success" type="submit"><span class="fa fa-search"></span></button>
                        </span>
                    </div>
                </div>
                <div class="navbar-nav col-auto">
                    <?php
                    if (!isset($_SESSION["logged"])) {
                        ?>

                        <a class="nav-item nav-link active mr-sm-2" href="pageLogin.php">Giriş Yap <span class="sr-only">(current)</span></a>

                    <?php
                    } else {
                        ?>

                        <button type="button" class="btn btn-primary mr-sm-2">Profil</button>

                    <?php
                    }
                    ?>
                    <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                        Sepet
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>