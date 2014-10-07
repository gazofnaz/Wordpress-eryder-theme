jQuery(document).ready(function($) {
    $("#carousel").carouFredSel({
        items       : 1,
        scroll      : {
            fx          : "crossfade"
        },
        auto        : false,
        pagination  : {
            container       : "#carousel_thumbs",
            anchorBuilder: function( nr ) { 

                var src = $("img", this).attr( "src" );
                
                // Split off the filename with no extension (period + 3 letter extension)
                var new_src = src.substring(0,src.length-4);

                // Append the "-150x150"
                new_src += "-150x150";

                // Add the period and the 3 letter extension back on
                new_src += src.substring(src.length-4,src.length);

                // Set this as the source for our image
                return '<img src="' + new_src + '" />';
            }
        }
    });


});

