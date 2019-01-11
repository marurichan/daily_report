$(function(){
  $('.category-wrap .btn').on('click', function(){
    var category_id = $(this).attr('id');
    $('#category-val').val(category_id);
    $('form').submit();
  });

});

