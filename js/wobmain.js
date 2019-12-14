var searchTimeout;

function ajaxsearchbook(value) {
    if (searchTimeout)
        clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        if (value == "")
            return;
        $.get("search.php", { query: value }, function (data) {
            console.log(data);
        });
    }, 600);
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