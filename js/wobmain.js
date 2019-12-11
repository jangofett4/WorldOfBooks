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

$(function () {
    $('.example-popover').popover({
      container: 'body'
    })
  });