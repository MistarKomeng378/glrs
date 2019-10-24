$(document).ready( initBookmarks );

function initBookmarks () {
    // Table of Contents links
    $("#TOC")
        .find(".tocBtn").click( toggleTOC ).end()
        //.find("A").click( scrollToBookmark )
        //.find("A").click( showCollapsibleSection ) // OLD
    ;
    // Links in the center pane
    //$("DIV.ui-layout-center A[href*=#]").click( scrollToBookmark );
    //.click( showCollapsibleSection );
};

function toggleTOC () {
    var $Btn = $(this);
    var $List = $(this).siblings("UL");
    if ($List.is(":visible")) {
        $List
            .css("width", $List.innerWidth())
            .slideUp('fast', function() {$(this).css("width","auto");})
        ;
        $Btn.css({ backgroundImage: 'url("img/icon_tree_on.gif")' });
    }
    else {
        $List.slideDown('fast');
        $Btn.css({ backgroundImage: 'url("img/icon_tree_off.gif")' });
    }
};