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

    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col">
                <h1 class="display-5">Kitap İsmi</h1>
            </div>

            <div class="text-center col align-self-center">
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
            </div>


        </div>
        <div class="row">
            <div class="col">
                <img src="slider/hp1.jpg" alt="resim1" class="img-thumbnail" height="300px" width="400px">
            </div>
            <div class="col">
                <div class="row" style="width: 500px">
                    <span class="border" style="width: 500px;padding: 10px">Yazar : <span class="font-weight-bold"> Yazar İsmi</span></span>
                </div>
                <div class="row" style="width: 500px">
                    <span class="border" style="width: 500px;padding: 10px">Yayın Evi : <span class="font-weight-bold">Yayın Evi İsmi</span></span>
                </div>
                <div class="border row text-center" style="width: 500px;padding: 10px;height: 200px">
                    <div class="col align-self-center">
                        <span class="font-weight-bold text-primary">Fiyat</span>
                    </div>
                    <div class="col align-self-center">
                        <button class="badge badge-pill badge-dark">-</button>
                        <label>20</label>
                        <button class="badge badge-pill badge-dark">+</button>
                    </div>
                    <div class="col align-self-center">
                        <button type="button" class="btn btn-danger">Sepete Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <p>"Harry, elleri titreyerek zarfı çevirince mor balmumundan bir mühür gördü; bir arma - koca bir 'H' harfinin çevresinde bir aslan, bir kartal, bir porsuk, bir de yılan."

            HARRY POTTER sıradan bir çocuk olduğunu sanırken, bir baykuşun getirdiği mektupla yaşamı değişir: Başvurmadığı halde Hogwarts Cadılık ve Büyücülük Okulu'na kabul edilmiştir. Burada birbirinden ilginç dersler alır, iki arkadaşıyla birlikte maceradan maceraya koşar. Yaşayarak öğrendikleri sayesinde küçük yaşta becerikli bir büyücü olup çıkar.
        </p>
        <p class="text-center"> <span class="font-weight-bold">Sayfa Sayısı : </span> <span>SAYI</span> </p>
        <p class="text-center"> <span class="font-weight-bold">İlk Baskı Yılı : </span> <span>YILI</span> </p>
        <p class="text-center"> <span class="font-weight-bold">Dili : </span> <span>DİLİ</span> </p>
    </div>
    <?php include "templates/footer.php" ?>



    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>

</html>