$('.form-delete').click(function () {
  $('form').attr('action', $(this).attr('href')).submit();

  return false;
});

$('[name="tags"]').tagsInput();
