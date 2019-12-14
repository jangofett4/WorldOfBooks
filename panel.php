<?php session_start(); ?>
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
                    <div class="text-center">
                        <h6 class="col display-4">Kitap Ekle</h6>
                    </div>
                    <div class="col-sm-5 mx-auto">
                        <div>
                            <input type="file" class="custom-file-input" id="customFile" lang="tr" name="picture">
                            <label class="custom-file-label" for="customFile">Resim Seç</label>
                        </div>
                        <div>
                            <label for="exampleFormControlSelect1">Kitap Türü</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="booktype">
                                <option>Şiir</option>
                                <option>Hikaye</option>
                                <option>Roman</option>
                                <option>Tarih</option>
                                <option>Masal</option>
                            </select>
                        </div>
                        <div>
                            Kitap İsmi
                            <input type="text" class="form-control" placeholder="Kitap İsmi" name="bookname">
                        </div>
                        <div>
                            Yazar İsmi
                            <input type="text" class="form-control" placeholder="Yazar İsmi" name="author">
                        </div>
                        <div>
                            Yayın Evi
                            <input type="text" class="form-control" placeholder="Yayın Evi" name="publisher">
                        </div>
                        <div>
                            Stok
                            <input type="number" class="form-control" placeholder="Stok" name="stock">
                        </div>
                        <div>
                            Fiyat
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₺</span>
                                </div>
                                <input type="number" min="1" max="10000" class="form-control" placeholder="Fiyat" name="cost">
                            </div>
                        </div>
                        <div>
                            İlk Baskı Yılı
                            <input type="text" class="form-control" placeholder="İlk Baskı Yılı" name="publishdate">
                        </div>
                        <div>
                            Sayfa Sayısı
                            <input type="number" min="1" max="10000" class="form-control" placeholder="Sayfa Sayısı" name="papercount">
                        </div>
                        <div>
                            Dili
                            <input type="text" class="form-control" placeholder="Dili" name="language">
                        </div>
                        <div>
                            Açıklama
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>

                        <button type="button" class="btn btn-danger d-block mx-auto mt-2 px-5">Ekle</button>
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