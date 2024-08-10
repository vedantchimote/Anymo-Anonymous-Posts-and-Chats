$(document).ready(function() {

    if ($('div.header-message').length > 0) {

        $("div.header-message").removeClass( "gone" );
    }

    $(document).on("click", "button.close-privacy-message", function() {

        $("div.header-message").remove();

        $.cookie("privacy", "close", { expires : 7, path: '/' });

        return false;
    });
});