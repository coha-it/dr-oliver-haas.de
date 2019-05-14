! function($) {

    "use strict";

    // Ready
    $(document).ready(function(){


        // default is single
        var mode = "single";


        // default is global
        if(default_global_customization_type){
            mode = "global";
        }


        /* ---------------------------------------------------- */
        /* Classic Editor                                       */
        /* ---------------------------------------------------- */
        if($("body").hasClass("post-type-attachment") == false && $("#postbox-container-1").length > 0){

            // Click
            $(document).on("click", ".yp-btn", function(){

                // var
                var href = null;

                // Get href
                if($("#sample-permalink a").length > 0){
                    href = $("#sample-permalink a").attr("href");
                }

                // If not have sample permalink, this mean this is still draft.
                if(href == null || href == undefined || href == ""){

                    // Get preview href
                    href = $("#post-preview").attr("href");

                }

                // Save for preview
                $(window).off('beforeunload.edit-post');
                wp.autosave.server.tempBlockSave();
                $('form#post').submit();

                // Fix href
                if(href.indexOf("://") != -1){
                    href = href.split("://")[1];
                }

                // Get ID
                var id = $("#post_ID").val();

                // Last href
                href = "admin.php?page=yellow-pencil-editor&href=" + encodeURIComponent(href) + "&yp_page_id=" + id + "&yp_page_type=" + typenow + "&yp_mode=" + mode;

                // Open
                window.open(href, "_blank");


            });

            // Append The Button
            $("#postbox-container-1").prepend("<a class='yp-btn'><span class='dashicons dashicons-admin-appearance'></span>Edit Page - YellowPencil</a>");

        }


        

        /* ---------------------------------------------------- */
        /* Block Editor                                         */
        /* ---------------------------------------------------- */

        // Is Block
        if($("body").hasClass("block-editor-page")){

            // Delay
            window.ypLoaderBlock = setInterval(function(){

                // When block ready
                if($(".edit-post-header-toolbar").length > 0){

                    // Clear Interval
                    clearInterval(window.ypLoaderBlock);

                    // Call
                    yp_block_setup();

                }

            }, 300);

        }

        // Setup YP button
        function yp_block_setup(){

            // Click
            $(document).on("click", ".yp-btn", function(){

                // Save as draft
                if($(".editor-post-save-draft").length > 0){
                    $(".editor-post-save-draft").trigger("click");
                }

                // Get ID
                var id = $("#post_ID").val();

                // Last href
                var href = "admin.php?page=yellow-pencil-editor&href&yp_page_id=" + id + "&yp_page_type=" + typenow + "&yp_mode="+ mode;

                // Open
                window.open(href, "_blank");


            });

            // Append The Button

            // before toolbar
            if($(".edit-post-header-toolbar__block-toolbar").length > 0){
                $(".edit-post-header-toolbar__block-toolbar").before("<button type='button' class='components-button components-icon-button yp-btn'><span class='dashicons dashicons-admin-appearance'></span></button>");
            
            // After block navigation
            }else{
                $(".edit-post-header-toolbar").append("<button type='button' class='components-button components-icon-button yp-btn'><span class='dashicons dashicons-admin-appearance'></span></button>");
            }

        }

    });

}(jQuery);