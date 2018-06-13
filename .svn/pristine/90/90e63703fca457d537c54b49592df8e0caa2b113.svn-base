$(function() {

    $("#table").delegate('td','mouseover mouseleave', function(e) {
        if (e.type == 'mouseover') {
          $(this).parent().addClass("hover");
          $("colgroup").eq($(this).index()).addClass("hover");
        } else {
          $(this).parent().removeClass("hover");
          $("colgroup").eq($(this).index()).removeClass("hover");
        }
    });

});