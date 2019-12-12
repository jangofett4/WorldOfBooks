<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="mx-auto justify-content-md-center container">
        <div class="row col-lg justify-content-md-center">
            <div class="col-auto">
                <a class="navbar-brand" href="index.php">
                    <img src="favicon.ico" width="30" height="30" alt="">
                </a>
                <a class="navbar-brand">World of Books</a>
            </div>
            <div class="col-7">
                <div class="input-group">
                    <input type="text" class="form-control mr-sm-2" id="navsearch" onkeyup="ajaxsearchbook(this.value)" placeholder="Kitap ya da Yazar (örn. Harry Potter)">
                    <span class="input-group-btn">
                        <button class="btn btn-outline-success" type="submit"><span class="fa fa-search"></span></button>
                    </span>
                </div>
            </div>
            <div class="col-auto">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active mr-sm-2" href="pageLogin.php">Giriş Yap <span class="sr-only">(current)</span></a>
                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                            Sepet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>