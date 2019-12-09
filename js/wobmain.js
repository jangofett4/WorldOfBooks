function ajaxsearchbook(value)
{
    $.get("search.php", { query: value }, function(data) {
        console.log(data);
    });
}