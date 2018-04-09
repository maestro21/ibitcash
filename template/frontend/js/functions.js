$(function(){

    var url = $.url().attr('path');

    $(".first-wrapper ul.list-items li, #topmenu li, #usermenu li").each(function()
    {
        var link = $("a", this).url().attr('path');

        if(url==link)
        {
            $(this).addClass('active');
        }
    });

});