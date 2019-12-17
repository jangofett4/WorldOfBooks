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
    $.post("libstock.php", { "book": book, "count": count }, (result) => {
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
                console.log("User left the input empty");
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