$('.form-delete').click(() => {
  $('form').attr('action', $(this).attr('href')).submit();

  return false;
});

$('[name="tags"]').tagsInput();
