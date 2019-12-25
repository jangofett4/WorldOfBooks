var searchTimeout;

function post(path, params, method='post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
  
    document.body.appendChild(form);
    form.submit();
  }

function ajaxsearchbook(value) {
    if (searchTimeout)
        clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        if (value == "")
            return;
        $.get("libsearch.php", { query: value }, function (data) {
            console.log(data);
        });
    }, 600);
}

function ajaxstock(book, count)
{
    let btnp, btnm, btne, ld;
    ld = $("#ld" + book);
    if (!ld.hasClass("d-none"))
        return;
    ld.toggleClass("d-none");
    btnp = $("#bp" + book); btnp.toggleClass("disabled");
    btnm = $("#bm" + book); btnm.toggleClass("disabled");
    btne = $("#be" + book); btne.toggleClass("disabled");

    $.post("libstock.php", { "book": book, "count": count }, (result) => {
        btnp.toggleClass("disabled");
        btnm.toggleClass("disabled");
        btne.toggleClass("disabled");
        ld.toggleClass("d-none");
        switch (result)
        {
            case "":
                let elem = $("#stk" + book);
                elem.text(parseInt(elem.html()) + parseInt(count));
                break;
            case "ERR_RESTRICT":
                console.log("This action is restricted");
                break;
            case "ERR_EMPTY_INPUT":
                console.log("User left the input empty");
                break;
            case "ERR_NOT_ENOUGH_BOOK":
                console.log("Not enough books to remove");
                break;
            default:
                console.log("Connection error");
                break;
        }
    });
}

function ajaxeditbook(book)
{
    $("#bkeName")[0].value = $("#bnm" + book).html();
    $("#bkeAuthor")[0].value = $("#bat" + book).html();
    $("#bkeType")[0].value = $("#btp" + book).html();
    $("#bkePublisher")[0].value = $("#bpb" + book).html();
    $("#bkeStock")[0].value = $("#stk" + book).html();
    $("#bkeCost")[0].value = $("#bct" + book).html();
    $("#bkePublished")[0].value = $("#bpd" + book).html();
    $("#bkePapers")[0].value = $("#bpc" + book).html();
    $("#bkeLanguage")[0].value = $("#bln" + book).html();
    $("#bkeDescription")[0].value = $("#bds" + book).html();
    $("#bkeBook")[0].value = book;
    let modal = $("#editModal");
    modal.modal();
}

function ajaxcanceledit()
{
    let modal = $("#editModal");
    alertClear("#editAlertArea");
    modal.modal("hide");
}

function alertAt(elem, state, message)
{
    let col = "success";
    let bold = "";
    if (state == "error")
    {
        col = "danger";
        bold = "Hata! ";
    }
    $(elem).html('<div class="alert alert-' + col + ' alert-dismissible fade show mt-3 mb-0" role="alert"><strong>' + bold + '</strong>' + message + '.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>')
}

function alertClear(elem)
{
    $(elem).html("");
}

function ajaxdelete(book)
{
    let spin = $("#modspin" + book);
    $("#delbtn" + book).toggleClass("d-none");
    spin.toggleClass("d-none");
    $.post("libdeletebook.php", { "book": book }, (result) => {
        switch (result)
        {
            case "ERR_EMPTY_INPUT":
                console.log("User left the input empty");
                break;
            case "ERR_RESTRICT":
                window.location.assign("panel.php?restrict=1");
                break;
            case "ERR_CONNECTION":
                console.log("Connection error");
                break;
            case "":
                $("#bookrow" + book).toggleClass("d-none");
                break;
        }
    });
}

function ajaxeditdone()
{
    let modal = $("#editModal");
    let modal2 = $("#loadingModal");
    modal2.modal();
    let bkeName, bkeAuthor, bkeType, bkePublisher, bkeStock, bkeCost, bkePublished, bkePapers, bkeLanguage, bkeDescription;
    bkeName = $("#bkeName")[0].value;
    bkeAuthor = $("#bkeAuthor")[0].value;
    bkeType = $("#bkeType")[0].value;
    bkePublisher = $("#bkePublisher")[0].value;
    bkeStock = $("#bkeStock")[0].value;
    bkeCost = $("#bkeCost")[0].value;
    bkePublished = $("#bkePublished")[0].value;
    bkePapers = $("#bkePapers")[0].value;
    bkeLanguage = $("#bkeLanguage")[0].value;
    bkeDescription = $("#bkeDescription")[0].value;
    let key = $("#bkeBook")[0].value;
    $.post("libeditbook.php", {
        "book": key,
        "bookname": bkeName,
        "author": bkeAuthor,
        "booktype": bkeType,
        "publisher": bkePublisher,
        "stock": bkeStock,
        "cost": bkeCost,
        "publishdate": bkePublished,
        "papercount": bkePapers,
        "language": bkeLanguage,
        "description": bkeDescription
    }, (result) => {
        modal2.modal("hide");
        switch (result)
        {
            case "ERR_EMPTY_INPUT":
                alertAt("#editAlertArea", "error", "Boş bırakılan alanları doldurunuz");
                break;
            case "ERR_RESTRICT":
                window.location.assign("panel.php?restrict=1");
                break;
            case "ERR_CONNECTION":
                alertAt("#editAlertArea", "error", "Sunucu ile bağlantı kurulamadı");
                break;
            case "":
                $("#bnm" + key).text(bkeName);
                $("#bat" + key).text(bkeAuthor);
                $("#bpb" + key).text(bkePublisher);
                $("#bct" + key).text(bkeCost);
                $("#stk" + key).text(bkeStock);
                $("#bpd" + key).text(bkePublished);
                $("#bpc" + key).text(bkePapers);
                $("#bln" + key).text(bkeLanguage)
                $("#bds" + key).text(bkeDescription);
                $("#btp" + key).text(bkeType);
                modal.modal("hide");
                break;
        }
    });
}

function ajaxaddtocart(book, count)
{
    $.get("libaddtocart.php", {"book": book, "count": count}, (result) => {
        switch (result)
        {
            case "":
                break;
            case "ERR_EMPTY_INPUT":
                console.log("User left the input mpty");
                break;
        }
    }).done(() => {
        let cart = $("#navCart");
        $.get("libcartlist.php", {}, (result => {
            cart.html(result);
            $("#cartItems").text("Toplam " + $("#cartTotalItems").text() + " ürün");
            $("#cartValue").text($("#cartTotalValue").text() + " ₺");
        }));
    });
}

function rating(star)
{
    for (let i = star; i < 5; i++)
        $("#_" + (i + 1)).removeClass("hover-checked");
    for (let i = 0; i < star; i++)
        $("#_" + (i + 1)).addClass("hover-checked");
}

function ajaxratebook(book, star)

    $.get("librate.php", {"book": book, "rating": star}, (result) => {
        switch(result)
        {
            case "ERR_NOT_LOGGED_IN":
                window.location.append("pageLogin.php");
                break;
            case "ERR_EMPTY_INPUT":
                console.log("User left the input empty");
                break;
            case "ERR_RATING":
                console.log("User manipulated rating data");
                break;
            case "ERR_NOT_BOUGHT":
                console.log("User did not buy this book before");
                break;
            case "ERR_CONNECTION":
                console.log("Unable to connect to cloud");
                break;
            case "":
                /* TODO: handle rating */
                break;
        }
    });
}

function ajaxremovefromcart(book)
{
    $.get("libremovefromcart.php", { "book": book }, (result) => {
        switch (result)
        {
            case "":
                $("#cart" + book).toggleClass("d-none");
                $("#bigcart" + book).toggleClass("d-none");
                cartTotal = cartTotal - parseInt($("#bt" + book).text());
                cartItemsTotal = cartItemsTotal - parseInt($("#bc" + book).text());
                $("#cartTotal").text(cartTotal);
                $("#cartValue").text(cartTotal + " ₺");
                $("#cartItems").text("Toplam " + cartItemsTotal + " ürün");
                break;
            case "ERR_EMPTY_INPUT":
                console.log("User left the input empty");
                break;
            case "ERR_CONNECTION":
                console.log("Unable to connect to cloud");
                break;
        }
    });
}

function ajaxlogout()
{
    $.get("liblogout.php", (_) => {
        window.location.assign("index.php");
    });
}

function ajaxlogin(email, password)
{
    let modal = $("#loadingModal");
    modal.modal();
    $.post("liblogin.php", { "email": email, "password": password }, (result) => {
        modal.modal("hide");
        switch (result)
        {
            case "":
                window.location.assign("index.php");
                break;
            case "ERR_ALREADY_LOGGED":
                console.log("User is already logged in");
                break;
            case "ERR_EMPTY_INPUT":
                console.log("User left the input empty, somehow");
                break;
            case "ERR_USER_NOT_EXISTS":
                console.log("User does not exists on cloud");
                break;
            default:
                console.log("Unable to connect to cloud");
                break;
        }
    });
}

function ajaxregister(name, surname, email, emailre, password, passwordre)
{
    var domemailre = $("#inputEmailRe");
    var dompasswordre = $("#inputPasswordRe");

    domemailre.popover("dispose");
    dompasswordre.popover("dispose");

    if (email != emailre)
    {
        domemailre.popover({
            content: "E-Posta tekrarı uyuşmuyor!"
        });
        domemailre.popover("show");
        return;
    }

    if (password != passwordre)
    {
        dompasswordre.popover({
            content: "Şifre tekrarı uyuşmuyor!"
        });
        dompasswordre.popover("show");
        return;
    }

    if (password.length < 8)
    {
        dompasswordre.popover({
            content: "Şifre alanı en az 8 karakter olmalıdır.",
        });
        dompasswordre.popover("show");
        return;
    }
    let modal = $("#loadingModal");
    modal.modal();
    $.post("libregister.php", { "name": name, "surname": surname, "password": password, "email": email }, (result) => {
        modal.modal("hide");
        switch (result)
        {
            // TODO: properly show errors on page
            case "":
                window.location.assign("index.php");
                break;
            case "ERR_ALREADY_LOGGED":
                console.log("User is already logged in");
                break;
            case "ERR_EMPTY_INPUT":
                console.log("User left the input empty, somehow");
                break;
            case "ERR_USER_EXISTS":
                console.log("User exists on cloud already");
                break;
            default: // anything else is considered connection error
                console.log("Unable to connect to cloud");
                break;
        }
    });
}