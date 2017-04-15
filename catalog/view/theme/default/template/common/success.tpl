<?php echo $header; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
    <div class="confirm-message mfp-hide">
      <h1>Ваш заказ принят</h1>
      <p>В ближайшее время с Вами свяжется<br> менеджер для подтверждения заказа.</p>
      <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-suc">Продолжить покупки</a></div>
    </div>
</div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
  jQuery(document).ready(function($) {
    $.magnificPopup.open({
      modal: true,
    items: {
      src: '.confirm-message', // can be a HTML string, jQuery object, or CSS selector
      type: 'inline',
    }
  });
  });
</script>

<?php echo $footer; ?>