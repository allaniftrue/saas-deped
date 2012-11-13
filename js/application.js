!function ($) {
    $(function(){
  
      var $win = $(window)
                            , $nav = $('.subnav')
                            , navTop = $('.subnav').length && $('.subnav').offset().top - 40
                            , isFixed = 0

       processScroll()

    // hack sad times - holdover until rewrite for 2.1
    $nav.on('click', function () {
      if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10)
    })

    $win.on('scroll', processScroll)

    function processScroll() {
      var i, scrollTop = $win.scrollTop()
      if (scrollTop >= navTop && !isFixed) {
        isFixed = 1
        $nav.addClass('subnav-fixed')
      } else if (scrollTop <= navTop && isFixed) {
        isFixed = 0
        $nav.removeClass('subnav-fixed')
      }
    } 

    $.extend({alert: function (message, title, callback) {
        $("<div></div>").dialog( {
            buttons: {"Ok": function () {jQuery(this).dialog("close");}},
            close: function (event, ui) { 
                jQuery(this).remove(); 
                if (typeof callback == 'function') { // make sure the callback is a function
                        callback.call(this); // brings the scope to the callback
                }
            },
            resizable: false,
            title: title,
            modal: true
        }).text(message);

        $('button').attr('class', 'btn').blur().addClass('bt-primary');
        //$('button').addClass('bt-primary');
        }
    });


    $.fn.clearForm = function() {
            return this.each(function() {
                    var type = this.type, tag = this.tagName.toLowerCase();
                    if (tag == 'form')
                            return $(':input',this).clearForm();
                            if (type == 'text' || type == 'password' || tag == 'textarea')
                                    this.value = '';
                            else if (type == 'checkbox' || type == 'radio')
                                    this.checked = false;
                            else if (tag == 'select')
                                    this.selectedIndex = -1;
                    });
    };

    function checker(formName){
        var isDirty = false;
        $('#'+formName+' :input').each(function () {
            if($(this).data('initialValue') != $(this).val()){
                isDirty = true;
            }
        });

        return isDirty;
    }

    function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                    vars[key] = value;
            });
            return vars;
    }

})
}(window.jQuery)