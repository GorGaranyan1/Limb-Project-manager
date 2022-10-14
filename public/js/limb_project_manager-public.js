(function ($) {
    jQuery(function (){
        $(".inpp").dblclick(function(){
            $(this).html($(this).children());
            $(this).children().css('display','block');

        });
        $("#ajax_btn").click(function(e){
            e.preventDefault();
            var arr_ids = $("#hidden_ids").val().split("**");
            var arr_names = new Array();
            var arr_desc =new Array()
            var arr_users = new Array();
            var arr_date = new Array();

            for (var i = 0; i<arr_ids.length; i++)
            {
                var first = arr_ids[i];
                arr_names[i] = jQuery("input[name=pr_name" + first + "]").val();
                arr_desc[i] = jQuery("input[name=pr_desc" + first + "]").val();
                arr_users[i] = jQuery("input[name=pr_user" + first + "]").val();
                arr_date[i] = jQuery("input[name=pr_date" + first + "]").val();
            }


            var data = {
                action: 'my_action',
                names: arr_names,
                descriptions: arr_desc,
                ids: arr_ids,
                users: arr_users,
                date: arr_date
            };
            jQuery.post(ajaxurl, data, function (response){});
        });
    })
    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

})(jQuery);
