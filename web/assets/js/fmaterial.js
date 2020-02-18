var mlabels = function() {
  function findCheckBoxes() {
    var labels = $("label.material");
    labels.each(function(index, el) {
      var e = $(this);
      var _for = e.attr('for');
      if (_for !== null){
        var ipn  = e.next("#" + _for );
        $(ipn)
          .focusin(function(event) {
            event.preventDefault();
            var el = $(this);
            var text = el.attr('placeholder');
            e.removeClass();
            e.addClass('fadeInUp animated')
            e.text(text);
          })
          .focusout(function(event) {
            event.preventDefault();
            var el = $(this);
            var value = $.trim(el.val());
            if(value == ''){
              e.removeClass();
              e.addClass('fadeOutDown animated')
              //e.html("&nbsp");
            }
            else{
              e.text();
            }
          });
      }
    });
  }

  return {
    init: findCheckBoxes
  };  
}();

mlabels.init();
