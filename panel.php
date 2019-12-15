<?php
require_once "libssn.php";
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
    <?php

    use Google\Cloud\Datastore\Entity;

    $logged = false;
    $hasdata = false;
    $connecterr = false;
    if (isset($_SESSION["panellogged"])) $logged = true;
    if (!$logged)
        try {
            if (isset($_POST["username"], $_POST["password"])) {
                $hasdata = true;
                include_once "libcon.php";

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
                            <?php if (LibSSN::get("restrict")) { ?>
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
                    <a class="col active border-bottom mr-2 no-links-visible-pagecontact pb-2" id="nav-home-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Kitap Ekle</a>
                    <a class="col border-bottom ml-2 no-links-visible-pagecontact pb-2" id="nav-profile-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Kitap Düzenle</a>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <?php if (LibSSN::get("bookadd")) { ?>
                    <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                        Kitap Ekleme Başarılı!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                    <?php } ?>
                    <?php if (LibSSN::get("conerr")) { ?>
                    <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                        <strong>Hata!</strong> Sunucu ile bağlantı kurulamadı, tekrar deneyin.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                    <?php } ?>
                    <?php if (LibSSN::get("imagerr")) { ?>
                    <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                        <strong>Hata!</strong> Seçilen kapak fotoğrafı geçersiz.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                    <?php } ?>
                    <?php if (LibSSN::get("imagetoobig")) { ?>
                    <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                        <strong>Hata!</strong> Seçilen kapak fotoğrafı çok büyük, izin verilen max 3mb.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                    <?php } ?>
                    <?php if (LibSSN::get("imagetyperr")) { ?>
                    <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                        <strong>Hata!</strong> Seçilen kapak fotoğrafı formatı hatalı, izin verilen dosya türleri: PNG, JPG, JPEG.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                    <?php } ?>
                    <?php if (LibSSN::get("uplaoderr")) { ?>
                    <div class="alert col-sm-6 mx-auto alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
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
                        <form action="libaddbook.php" method="post" enctype="multipart/form-data">
                            <div>
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
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="text-center">
                        <h6 class="col display-4">Kitap Düzenle</h6>
                    </div>
                    <div class="mb-3">
                        <h3 class="display-4 mb-3" style="font-size: 30px">World of Books Marka Vizyonu</h3>
                        <p>İnsanların zihnen özgürleşmesinin ve kişisel gelişimlerinin önündeki engelleri kaldırarak kitaplara kolayca ulaşmasını sağlayarak en çok sevilen ve tercih edilen deneyim markası olmak.</p>
                    </div>
                    <div>
                        <h3 class="display-4 mb-3" style="font-size: 30px">World of Books Marka Vizyonu</h3>
                        <p>Sınırları kaldıran, özgürleştiren, ulaşılabilir bir platform olmak.</p>
                    </div>
                </div>
            </div>

        </div>

    <?php } ?>
    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>