

$(document).ready(function() {
    $('.teste').popover({
      title: 'Título do Popover',
      content: "<?php echo 'Olá, mundo!';?>",
      placement: 'top',
      trigger: 'hover' // Você pode usar 'click', 'hover', 'focus' ou 'manual'
    });
  });

