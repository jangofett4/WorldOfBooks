<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>World Of Books</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/wob.css">

    <script src="js/wobmain.js?"></script>
</head>

<body>
    <?php include "templates/nav.php"  ?>
    <div class="container mb-sm-5">
        <form id="cardForm" class="w-100">
            <div class="row">
                <div class="col mt-sm-5">
                    <fieldset>
                        <legend>Fatura Bilgileri</legend>
                        <div class="form-row mb-sm-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Ad" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Soyad" required>
                            </div>
                        </div>
                        <div class="form-row mb-sm-3">
                            <div class="col">
                                <input type="email" class="form-control" placeholder="E-Posta" required>
                            </div>
                            <div class="col">
                                <input type="tel" class="form-control" placeholder="Cep Telefonu : 5xxxxxxxxx" pattern="[1-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" required>
                            </div>
                        </div>
                        <div class="form-row mb-sm-3">
                            <div class="col">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Adres" required></textarea>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col mt-sm-5">
                    <fieldset>
                        <legend>Ödeme Bilgileri</legend>
                        <div class="form-row mb-sm-3">
                            <div class="col">
                                <div class='card-wrapper mb-sm-2 w-100'></div>
                            </div>
                            <!-- CSS is included via this JavaScript file -->
                            <script src="js/card.js"></script>
                        </div>
                        <div class="form-row mb-sm-3">
                            <div class="col">
                                <input type="text" class="form-control mb-sm-3" name="number" placeholder="Kredi Kartı Numarası" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control mb-sm-3" name="name" placeholder="İsim Soyisim" required>
                            </div>
                        </div>
                        <div class="form-row mb-sm-3">
                            <div class="col">
                                <input type="text" class="form-control mb-sm-3" name="expiry" placeholder="Geçerlilik Tarihi" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control mb-sm-3" name="cvc" placeholder="Güvenlik Numarası" required>
                            </div>
                        </div>
                        <script>
                            var card = new Card({
                                form: '#cardForm',
                                container: '.card-wrapper',

                                placeholders: {
                                    number: '1234 5678 9000 0000',
                                    name: 'Barış Doğan',
                                    expiry: '12/2025',
                                    cvc: '123'
                                }
                            });
                        </script>
                    </fieldset>
                </div>
                <div class="col-sm-2 mt-sm-5">
                    <fieldset class="text-right border p-sm-2">
                        <legend>Sipariş Özeti</legend>
                        <div><small>1 Ürün</small></div>
                        <div><small>Ödenecek Tutar</small></div>
                        <h4>30 ₺</h4>
                        <button class="btn btn-primary d-block w-100">Onayla</button>
                    </fieldset>
                </div>
            </div>
            <div class="row mb-sm-5">
                <small>*Bilgiler toplanmıyor sadece görünüş amaçlıdır</small>
            </div>
        </form>
    </div>
    <div style="margin-top: 13%"><?php include "templates/footer.php"  ?></div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>