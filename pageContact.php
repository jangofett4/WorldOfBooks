<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>World Of Books</title>
    <style>
        .checked {
            color: orange;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/wob.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php" ?>

    <div class="container ">
        <nav>
            <div class="nav nav-tabs row text-center border-bottom-0 mt-3" id="nav-tab" role="tablist">
                <a class="col active border-bottom mr-2 no-links-visible-pagecontact pb-2" id="nav-home-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Hakkımızda</a>
                <a class="col border-bottom ml-2 no-links-visible-pagecontact pb-2" id="nav-profile-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">İletişim</a>
            </div>
        </nav>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
            <div class="text-center">
                    <h6 class="col display-4">Hakkımızda</h6>
                </div>
                <div class="mb-3">
                    <h3 class="display-4 mb-3" style="font-size: 30px">World of Books Marka Vizyonu</h3>
                    <p>İnsanların zihnen özgürleşmesinin ve kişisel gelişimlerinin en büyük destekçisi olarak en çok sevilen ve tercih edilen deneyim markası olmak.</p>
                </div>
                <div>
                    <h3 class="display-4 mb-3" style="font-size: 30px">World of Books Marka Vizyonu</h3>
                    <p>Sınırları kaldıran, özgürleştiren, destekleyen ve cesaretlendiren platform olmak.</p>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="text-center">
                    <h6 class="col display-4">Bize Yazın</h6>
                </div>
                <div class="">
                    <div>
                        E-Posta
                        <input type="text" class="form-control" placeholder="E-Posta">
                    </div>
                    <div>
                        Ad
                        <input type="text" class="form-control" placeholder="Ad">
                    </div>
                    <div>
                        Soyad
                        <input type="text" class="form-control" placeholder="Soyad">
                    </div>
                    <div>
                        Yorum
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger d-block mx-auto mt-2 px-5">Gönder</button>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom"><?php include "templates/footer.php" ?></div>


    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>