//Email protection
(function($) {
    console.log($);
    $("a").each(function () {
        let link = $(this);
        let href = $(this).attr("href");
        if (typeof href !== typeof undefined && href !== false) {
            let my_string = '';
            if (href.indexOf('mailto:') !== -1) {
                let href_parts = href.split("mailto:")
                let str = href_parts[1];
                let new_href = '';
                for (let i = 0, len = str.length; i < len; i++) {
                    if (i == 0) {
                        my_string = str[i].charCodeAt(0);
                    } else {
                        my_string = my_string + "," + str[i].charCodeAt(0);
                    }
                }
                new_href = "javascript:void(location.href='mailto:'+String.fromCharCode(" + my_string + ")+'?')";
                link.attr("href", new_href);
            }
        }
    });

    //end document
})( jQuery );