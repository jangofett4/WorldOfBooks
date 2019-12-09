<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>World Of Books</title>
    <script src="js/wobmain.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="#" class="navbar-brand">World of Books</a>
        <form class="form-inline">
            <input type="search" class="form-control mr-sm-2" placeholder="Kitap Adı" aria-placeholder="Kitap Adı" name="bookname"/>
            <button class="btn btn-outline-success" type="button" onclick="ajaxsearchbook(bookname.value)">Ara</button>
        </form>
    </nav>

    <!-- Libraries -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.4.5/fuse.min.js"></script> -->
</body>
</html>