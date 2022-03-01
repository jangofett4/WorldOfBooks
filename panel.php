<?php
require_once "libssn.php";
require_once "libcon.php";

use Google\Cloud\Datastore\Entity;

?>
<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>World Of Books</title>
    <style>
        .carousel-inner {
            height: 400px;
            max-height: 400px !important;

        }

        .checked {
            color: orange;
        }

        .point12 {
            font-size: 1.2em;
        }

        .pointer {
            cursor: pointer;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/wob.css">
    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>
    <?php

    $logged = false;
    $hasdata = false;
    $connecterr = false;
    if (isset($_SESSION["panellogged"])) $logged = true;
    if (!$logged)
        try {
            if (isset($_POST["username"], $_POST["password"])) {
                $hasdata = true;

                $username = $_POST["username"];
                $password = $_POST["password"];
                $con = DSConnection::open_or_get();
                $query = $con->query()
                    ->kind("AdminInfo")
                    ->filter("username", "=", $username)
                    ->filter("password", "=", $password);
                $result = $con->runQuery($query);

                if (iterator_count($result) == 1) {
                    $logged = true;
                    /** @var Entity as $admin */
                    foreach ($result as $admin) {
                        $_SESSION["admin_key"] = $admin->key();
                        $_SESSION["admin_name"] = $admin["name"];
                        $_SESSION["admin_surname"] = $admin["surname"];
                        $_SESSION["admin_username"] = $username;
                        $_SESSION["admin_password"] = $password;
                        $_SESSION["panellogged"] = true;
                        break;
                    }
                }
            }
        } catch (Exception $e) {
            $connecterr = true;
        }
    if (!$logged) {
    ?>
        <div class="container">
            <div class="row" style="height: 100vh">
                <div class="col-sm-5 my-auto mx-auto">
                    <div class="card">
                        <h5 class="card-header text-center">Yönetici Paneli</h5>
                        <div class="card-body">
                            <form action="panel.php" method="post">
                                <div class="form-group">
                                    <label for="adminUsername">Kullanıcı Adı</label>
                                    <input type="text" class="form-control" id="adminUsername" aria-describedby="usernameHelp" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="adminPassword">Şifre</label>
                                    <input type="password" class="form-control" id="adminPassword" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Giriş</button>
                            </form>
                            <?php if ($hasdata && !$connecterr) { ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                                    <strong>Hata!</strong> Kullanıcı adı ya da şifre hatalı.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                            <?php } elseif ($hasdata && $connecterr) { ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                                    <strong>Hata!</strong> Bulut sunucularına bağlantı başarısız, tekrar deneyin.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                            <?php } ?>
                            <?php if (LibSSN::get("restrict") || isset($_GET["restrict"])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                                    <strong>Hata!</strong>Bu işlem için yeterli yetkiniz yok, giriş yapın.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container ">
            <nav>
                <div class="nav nav-tabs row text-center border-bottom-0 mt-3" id="nav-tab" role="tablist">
                    <a class="col <?php if (!isset($_GET["panel2"])) echo 'active'; ?> border-bottom mr-2 no-links-visible-pagecontact pb-2" id="nav-home-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Kitap Ekle</a>
                    <a class="col <?php if (isset($_GET["panel2"])) echo 'active'; ?> border-bottom ml-2 no-links-visible-pagecontact pb-2" id="nav-profile-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Kitap Düzenle</a>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane fade <?php if (!isset($_GET["panel2"])) echo 'show active'; ?>" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <?php if (LibSSN::get("bookadd")) { ?>
                        <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                            Kitap Ekleme Başarılı!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (LibSSN::get("conerr")) { ?>
                        <div class="alert col-sm-6 mx-auto alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                            <strong>Hata!</strong> Sunucu ile bağlantı kurulamadı, tekrar deneyin.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (LibSSN::get("imagerr")) { ?>
                        <div class="alert col-sm-6 mx-auto alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                            <strong>Hata!</strong> Seçilen kapak fotoğrafı geçersiz.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (LibSSN::get("imagetoobig")) { ?>
                        <div class="alert col-sm-6 mx-auto alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                            <strong>Hata!</strong> Seçilen kapak fotoğrafı çok büyük, izin verilen max 3mb.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (LibSSN::get("imagetyperr")) { ?>
                        <div class="alert col-sm-6 mx-auto alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                            <strong>Hata!</strong> Seçilen kapak fotoğrafı formatı hatalı, izin verilen dosya türleri: PNG, JPG, JPEG.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (LibSSN::get("uplaoderr")) { ?>
                        <div class="alert col-sm-6 mx-auto alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                            <strong>Hata!</strong> Dosya yükleme hatası, tekrar deneyin.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="text-center">
                        <h1 class="col display-4">Kitap Ekle</h1>
                    </div>
                    <div class="col-sm-6 mx-auto">
                        <form action="libaddbook.php" method="post" accept-charset="UTF-8" enctype=multipart/form-data> <div>
                            <input type="file" class="custom-file-input" id="customFile" lang="tr" name="bookcover" required>
                            <label class="custom-file-label" for="customFile">Kapak Fotoğrafı Seçin</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            Kitap İsmi
                            <input type="text" class="form-control" placeholder="Kitap İsmi" name="bookname" required>
                        </div>
                        <div class="col">
                            Yazar İsmi
                            <input type="text" class="form-control" placeholder="Yazar İsmi" name="author" required>
                        </div>
                    </div>
                    <div>
                        <label for="bookTypeSelect">Kitap Türü</label>
                        <select class="form-control" id="bookTypeSelect" name="booktype">
                            <option>Şiir</option>
                            <option>Hikaye</option>
                            <option>Roman</option>
                            <option>Tarih</option>
                            <option>Masal</option>
                        </select>
                    </div>
                    <div>
                        Yayın Evi
                        <input type="text" class="form-control" placeholder="Yayın Evi" name="publisher" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            Stok
                            <input type="number" class="form-control" placeholder="Stok" name="stock" required>
                        </div>
                        <div class="col">
                            Fiyat
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₺</span>
                                </div>
                                <input type="number" min="1" step="0.05" max="10000" class="form-control" placeholder="Fiyat" name="cost" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        İlk Baskı Yılı
                        <input type="text" class="form-control" placeholder="İlk Baskı Yılı" name="publishdate" required>
                    </div>
                    <div>
                        Sayfa Sayısı
                        <input type="number" min="1" max="10000" class="form-control" placeholder="Sayfa Sayısı" name="papercount" required>
                    </div>
                    <div>
                        Dili
                        <input type="text" class="form-control" placeholder="Dili" name="language" required>
                    </div>
                    <div>
                        Açıklama
                        <textarea class="form-control" rows="3" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block d-block mx-auto mt-2 px-5">Ekle</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade <?php if (isset($_GET["panel2"])) echo 'show active'; ?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="text-center">
                    <h6 class="col display-4">Kitap Düzenle</h6>
                </div>
                <div class="mb-3">
                    <form action="panel.php" method="get">
                        <div class="input-group">
                            <!-- onkeyup="ajaxsearchbook(this.value)" -->
                            <input type="text" class="form-control mr-sm-2" id="navsearch" placeholder="Kitap ya da Yazar (örn. Harry Potter)" name="query" value="<?php if (isset($_GET["query"])) echo $_GET["query"]; ?>">
                            <input type="hidden" name="panel2" value="1" />
                            <span class="input-group-btn">
                                <button class="btn btn-outline-success" type="submit"><span class="fa fa-search"></span></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="mb-3 mt-5">
                    <?php if (!isset($_GET["query"])) { ?>
                    <?php } else {
                            $search = $_GET["query"];
                            $split = explode(' ', $search);
                            $results = array();
                            $books = array();
                            $errored = false;
                            try {
                                $con = DSConnection::open_or_get();
                                foreach ($split as $word) {
                                    $word = strtolower($word);
                                    $query = $con->query()
                                        ->kind("Books")
                                        ->filter("tags", "=", $word);
                                    $result = $con->runQuery($query);
                                    /** @var Entity $book */
                                    foreach ($result as $book) {
                                        $key = $book->key()->pathEndIdentifier();
                                        if (!isset($results[$key])) {
                                            $results[$key] = true;
                                            array_push($books, [
                                                "added" => $book["date"],
                                                "name" => $book["name"],
                                                "author" => $book["author"],
                                                "type" => $book["type"],
                                                "stock" => $book["stock"],
                                                "cost" => $book["cost"],
                                                "published" => $book["published"],
                                                "publisher" => $book["publisher"],
                                                "papercount" => $book["papercount"],
                                                "language" => $book["language"],
                                                "description" => $book["description"],
                                                "coverpath" => $book["coverpath"],
                                                "key" => $key
                                            ]);
                                        }
                                    }
                                }
                            } catch (Exception $e) {
                                $errored = true;
                            } ?>
                        <?php if ($errored) { ?>
                            <h1 class="display-4">Sunucu ile stabil bağlantı kurulamadı, tekrar deneyin.</h1>
                        <?php } elseif (count($books) == 0) { ?>
                            <h1 class="display-4">Arama metnine uygun kitap bulunamadı, tekrar deneyin.</h1>
                        <?php } ?>
                        <?php foreach ($books as $book) {
                            $key = $book["key"]; ?>
                            <div class="row" id="bookrow<?php echo $key ?>">
                                <div class="col">
                                    <div class="row p-2">
                                        <p class="d-none" id="btp<?php echo $key ?>"><?php echo $book['type'] ?></p>
                                        <p class="d-none" id="bpd<?php echo $key ?>"><?php echo $book['published'] ?></p>
                                        <p class="d-none" id="bpc<?php echo $key ?>"><?php echo $book['papercount'] ?></p>
                                        <p class="d-none" id="bln<?php echo $key ?>"><?php echo $book['language'] ?></p>
                                        <p class="d-none" id="bds<?php echo $key ?>"><?php echo $book['description'] ?></p>
                                        <div class="col">
                                            <div class="col card mb-3k border mx-auto p-3">
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <img src="<?php echo $book["coverpath"] ?>" class="card-img card-img-fluid card-img-search" alt="...">
                                                    </div>
                                                    <div class="col">
                                                        <div class="card-body h-100">
                                                            <div class="row h-100">
                                                                <div class="col-sm-5 align-self-center ">
                                                                    <h5 class="card-title" id="bnm<?php echo $key; ?>"><?php echo $book["name"] ?></h5>
                                                                    <p class="card-text" id="bat<?php echo $key; ?>"><?php echo $book["author"] ?></p>
                                                                    <p class="card-text" id="bpb<?php echo $key; ?>"><?php echo $book["publisher"] ?></p>
                                                                    <p class="card-text"><b>Stokta: </b><span id="stk<?php echo $key ?>"><?php echo $book["stock"] ?></span></p>
                                                                </div>
                                                                <div class="col-sm-2 align-self-center ">
                                                                    <h5 class="bold"><span id="bct<?php echo $key; ?>"><?php echo $book["cost"] ?></span> ₺</h5>
                                                                </div>
                                                                <div class="col-sm-2 text-center align-self-center">
                                                                    <div class="spinner-border d-none" role="status" id="ld<?php echo $key ?>">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col align-self-center">
                                                                    <div class="row m-2">
                                                                        <button type="button" class="btn btn-danger w-100" id="be<?php echo $key ?>" onclick="ajaxeditbook(<?php echo $key ?>)">Düzenle</button>
                                                                    </div>
                                                                    <form>
                                                                        <div class="row m-2 ">
                                                                            <input type="number" class="form-control" placeholder="Stok" id="<?php echo $key ?>" value="0">
                                                                        </div>
                                                                        <div class="row m-2">
                                                                            <div class="col">
                                                                                <button type="button" class="btn btn-circle btn-dark d-block mx-auto" id="bm<?php echo $key ?>" onclick="ajaxstock(<?php echo $key ?>, -$('#<?php echo $key ?>')[0].value)"> <span class="fa fa-minus"></span> </button>
                                                                            </div>
                                                                            <div class="col">
                                                                                <button type="button" class="btn btn-circle btn-dark d-block mx-auto" id="bp<?php echo $key ?>" onclick="ajaxstock(<?php echo $key ?>, $('#<?php echo $key ?>')[0].value)"> <span class="fa fa-plus"></span></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center pointer" onclick="ajaxdelete(<?php echo $key ?>)" id="delbtn<?php echo $key ?>">
                                    <span class="fa fa-trash text-danger point12"></span>
                                </div>
                                <div class="spinner-border text-danger align-self-center d-none" id="modspin<?php echo $key ?>">
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="modal fade" data-backdrop="static" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header mb-sm-2">
                                    <h5 class="modal-title mx-auto">Kitap Düzenle</h5>
                                </div>
                                <input type="hidden" id="bkeBook"/>
                                <div class="modal-body">
                                    <div id="editAlertArea"></div>
                                    <div class="row">
                                        <div class="col">
                                            Kitap İsmi
                                            <input type="text" class="form-control" placeholder="Kitap İsmi" id="bkeName" required>
                                        </div>
                                        <div class="col">
                                            Yazar İsmi
                                            <input type="text" class="form-control" placeholder="Yazar İsmi" id="bkeAuthor" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="bookTypeSelect">Kitap Türü</label>
                                        <select class="form-control" id="bkeType">
                                            <option>Şiir</option>
                                            <option>Hikaye</option>
                                            <option>Roman</option>
                                            <option>Tarih</option>
                                            <option>Masal</option>
                                        </select>
                                    </div>
                                    <div>
                                        Yayın Evi
                                        <input type="text" class="form-control" placeholder="Yayın Evi" id="bkePublisher" required>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Stok
                                            <input type="number" class="form-control" placeholder="Stok" id="bkeStock" required>
                                        </div>
                                        <div class="col">
                                            Fiyat
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₺</span>
                                                </div>
                                                <input type="number" min="1" step="0.05" max="10000" class="form-control" placeholder="Fiyat" id="bkeCost" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        İlk Baskı Yılı
                                        <input type="text" class="form-control" placeholder="İlk Baskı Yılı" id="bkePublished" required>
                                    </div>
                                    <div>
                                        Sayfa Sayısı
                                        <input type="number" min="1" max="10000" class="form-control" placeholder="Sayfa Sayısı" id="bkePapers" required>
                                    </div>
                                    <div>
                                        Dili
                                        <input type="text" class="form-control" placeholder="Dili" id="bkeLanguage" required>
                                    </div>
                                    <div>
                                        Açıklama
                                        <textarea class="form-control" rows="3" id="bkeDescription" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row w-100">
                                        <div class="col">
                                            <button type="button" class="btn btn-success btn-block d-block mx-auto mt-2 px-5" onclick="ajaxeditdone()">Düzenle</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-outline-danger btn-block d-block mx-auto mt-2 px-5" onclick="ajaxcanceledit()">İptal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" data-backdrop="static" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-sm modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Düzenleme Uygulanıyor</h5>
                                </div>
                                <div class="modal-body mx-auto">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <button type="button" class="btn btn-secondary px-5 btn-block" onclick="ajaxpanellogout()">Çıkış Yap</button>
        </div>
        </div>
    <?php } ?>
    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>