<?php echo $header; ?>
<div class="clearfix page404">
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
    <div id="content" class="<?php echo $class; ?> page404__content"><?php echo $content_top; ?>
      <!--<h1><?php echo $heading_title; ?></h1>-->
      <p><?php echo $heading_title; ?></p>
      <span><?php echo $text_error; ?></span>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary">НА ГЛАВНУЮ</a></div>
      </div>
      </div>
    <?php echo $column_right; ?></div>
</div>
</div>
<?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>