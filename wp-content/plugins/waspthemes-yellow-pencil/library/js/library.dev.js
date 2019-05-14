/*
	A Helper javascript function for YellowPencil Editor;
	CSS Animation trigger and Custom CSS Engine.
	Visit the plugin website to the details: https://yellowpencil.waspthemes.com

	By WaspThemes / All Rights Reserved.
*/
(function($) {

    "use strict";

    // jQuery Visible Plugin
    !function(t){var i=t(window);t.fn.visible=function(t,e,o){if(!(this.length<1)){var r=this.length>1?this.eq(0):this,n=r.get(0),f=i.width(),h=i.height(),o=o?o:"both",l=e===!0?n.offsetWidth*n.offsetHeight:!0;if("function"==typeof n.getBoundingClientRect){var g=n.getBoundingClientRect(),u=g.top>=0&&g.top<h,s=g.bottom>0&&g.bottom<=h,c=g.left>=0&&g.left<f,a=g.right>0&&g.right<=f,v=t?u||s:u&&s,b=t?c||a:c&&a;if("both"===o)return l&&v&&b;if("vertical"===o)return l&&v;if("horizontal"===o)return l&&b}else{var d=i.scrollTop(),p=d+h,w=i.scrollLeft(),m=w+f,y=r.offset(),z=y.top,B=z+r.height(),C=y.left,R=C+r.width(),j=t===!0?B:z,q=t===!0?z:B,H=t===!0?R:C,L=t===!0?C:R;if("both"===o)return!!l&&p>=q&&j>=d&&m>=L&&H>=w;if("vertical"===o)return!!l&&p>=q&&j>=d;if("horizontal"===o)return!!l&&m>=L&&H>=w}}}}(jQuery);



    // Getting All Selectors from CSS Output
    function get_all_selectors(source){

        // if no source, stop.
        if (source == '') {
            return false;
        }

        // Delete media close
        source = source.replace(/\}\}/g, "}");

        // if have a problem in source, stop.
        if (source.split('{').length != source.split('}').length) {
            return false;
        }

        // Replaces
        source = source.toString().replace(/\}\,/g, "}");

        // Getting All CSS Selectors.
        var allSelectors = array_cleaner(source.replace(/\{(.*?)\}/g, '|BREAK|').split("|BREAK|"));

        return allSelectors;

    }


    // Minify Output CSS
    function get_minimized_css(data, media){

        // Checks
        if(data == false || data == true){
            return '';
        }

        // Clean.
        data = data.replace(/(\r\n|\n|\r)/g, "").replace(/\t/g, '');

        // Don't care rules in comment.
        data = data.replace(/\/\*(.*?)\*\//g, "");

        // clean.
        data = data.replace(/\}\s+\}/g, '}}').replace(/\s+\{/g, '{');

        // clean.
        data = data.replace(/\s+\}/g, '}').replace(/\{\s+/g, '{');
        data = filter_bad_queries(data);

        // Don't care rules in media query
        if (media === true) {
            data = data.replace(/@media(.*?)\}\}/g, '').replace(/@?([a-zA-Z0-9_-]+)?keyframes(.*?)\}\}/g, '').replace(/@font-face(.*?)\}\}/g, '').replace(/@import(.*?)\;/g, '').replace(/@charset(.*?)\;/g, '');
        }

        // data
        return data;

    }


    // Filtering bad queries
    function filter_bad_queries(data) {
        return data.replace(/[\u2018\u2019\u201A\u201B\u2032\u2035\u201C\u201D]/g, '');
    }


    // Delete the empty array items
    function array_cleaner(actual) {

        var uniqueArray = [];
        $.each(actual, function(i, el) {
            if ($.inArray(el, uniqueArray) === -1) uniqueArray.push(el);
        });

        return uniqueArray;

    }



    // Getting CSS Data from Live Preview, external CSS etc.
    function get_css_data(){

    	// Stop if not CSS Output.
        if ($("style#yellow-pencil,style#yp-live-preview,link#yp-custom-css").length === 0) {
            return false;
        }

        // CSS Data
        var data = '';

        // Check if not external CSS
        if ($("link#yp-custom-css").length == 0) {

            // Adds Default CSS
            if ($("style#yellow-pencil").length > 0) {
                data = data + $("style#yellow-pencil").html();
            }

            // Adds live preivew CSS
            if ($("style#yp-live-preview").length > 0) {
                data = data + $("style#yp-live-preview").html();
            }

        } else { // else external

        	// Adds Default CSS
            data = get_custom_CSS();

            // Adds live preivew CSS
            if ($("style#yp-live-preview").length > 0) {
                data = data + $("style#yp-live-preview").html();
            }

        }

        return data;

    }


    // Search and finds All selectors by filter
    function get_matches_selectors(filter) {

    	// CSS Data
    	var data = get_css_data();

    	// minData
    	var minData = get_minimized_css(data,true);

    	// Getting all selectors by data
    	var selectors = get_all_selectors(minData);

    	// Array
        var array = [];

        // Each all selectors
        $.each(selectors, function(i, v) {

        	// Skip if not valid
            if (v.match(/\:|\}|\{|\;/)) {
                return true;
            }

            // if filter has and selector valid empty
            if(v.indexOf(filter) >= 0 && v != '') {

            	// Replace filter and push the selector to array.
                array.push(v.replace(filter, ""));

            }

        });


        // Getting all CSSOut, not filtering media queries.
        var dataWithMedia = get_minimized_css(data,false);

        // Getting all media contents
        var mediaAll = dataWithMedia.match(/@media(.*?){(.*?)}}/g);

        // Variables
        var content = '';
        var condition = '';
        var mediaSelectors = '';

        // Each all media Queries
        $.each(mediaAll, function(index, media) {

        	// Media condition
        	condition = media.match(/@media(.*?){/g).toString().replace(/\{/g, '').replace(/@media /g, '').replace(/@media/g, '');

        	// Media Content
        	content = media.toString().replace(/@media(.*?){/g,'');

        	// All selectors of media
        	mediaSelectors = get_all_selectors(content);

        	// Eaching all selectors of media
        	$.each(mediaSelectors, function(childIndex, v) {

	        	// Skip if not valid
	            if (v.match(/\:|\}|\{|\;/)) {
	                return true;
	            }

	        	// if media works current screen size and selector has the filter
	        	if(window.matchMedia(condition).matches && v.indexOf(filter) >= 0 && v != ''){

	        		// Replace filter and push the selector to array.
					array.push(v.replace(filter,""));

				}

			});

        });


        // Return
        return array.toString();

    }


    // Click event support for animations
    function click_detect() {

        // Each all
        $(get_matches_selectors(".yp_click")).each(function() {

        	// Adds event
            $(this).click(function() {

                var el = $(this);

            	// yp_click class will trigger the defined animation.
                el.addClass("yp_click");

                // Animation will return to back after play
                if(el.css("animation-fill-mode") == "backwards"){

                    // remove yp_click when animationEnd
                    el.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
                    	el.removeClass("yp_click");
                    });

                }


            });

        });

    }


    // Hover event support for animations
    function hover_detect() {

        // Each all
        $(get_matches_selectors(".yp_hover")).each(function() {

        	// Adds event
            $(this).mouseenter(function() {

            	var el = $(this);

            	// yp_hover class will trigger the defined animation.
                el.addClass("yp_hover");

                // Animation will return to back after play
                if(el.css("animation-fill-mode") == "backwards"){

                    // remove yp_hover when animationEnd
                    el.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
                    	el.removeClass("yp_hover");
                    });

                }

            });

        });

    }


    // Focus event support for animations
    function focus_detect() {

        // Each all
        $(get_matches_selectors(".yp_focus")).each(function() {

        	// Adds event
            $(this).focus(function(){

            	// yp_focus class will trigger the defined animation.
                $(this).addClass("yp_focus");

            }).blur(function(){

                // Animation will return to back after play
                if(el.css("animation-fill-mode") == "backwards"){

                    // remove animate class.
                    $(this).removeClass("yp_focus");

                }

            });

        });

    }


    // Visible event support for animations
    function onscreen_detect() {

    	// Finds all onScreen elements
        $(get_matches_selectors(".yp_onscreen")).each(function() {

        	// Add visible event
            if ($(this).visible(true)) {

            	// yp_onscreen will trigger the defined animation.
                $(this).addClass("yp_onscreen");

            }

        });

    }

	

	// Setup YP Animation functions
	function setAnimTriggers(){

        // Check after resize
        $(window).resize(function() {
            onscreen_detect();
        });

        // Check after document ready
        $(document).ready(function() {
            onscreen_detect();
            click_detect();
            hover_detect();
            focus_detect();
        });

        // Check while scroll for onScreen event
        $(document).scroll(function() {
            onscreen_detect();
        });
	
	}



    /* ---------------------------------------------------- */
    /* Getting custom-xx.css content                        */
    /* ---------------------------------------------------- */
    function get_custom_CSS() {

        // vars
        var sheet, t, i, c, code = "";

        // For
        for(i = 0; i < document.styleSheets.length; i++) {

        // Get sheet
        sheet = document.styleSheets[i];

        // if is link
        if(sheet.href != null){

            // get node
            t = sheet.ownerNode.outerHTML;

            // if yp custom css
            if(t.indexOf("yp-custom-css") != -1){

                // get all css text
                for(c = 0; c < sheet.cssRules.length; c++){
                    code += sheet.cssRules[c].cssText;
                }

            }

        }

      }

      // return the code if have
      return code;

    }



	/* ---------------------------------------------------- */
    /* Setup                                                */
    /* ---------------------------------------------------- */
    
    // Calls CSS Engine
    setAnimTriggers();


}(jQuery));