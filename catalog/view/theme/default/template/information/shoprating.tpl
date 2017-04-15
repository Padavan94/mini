<?php echo $header; ?>
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
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="title-cs">
  <h1>Отзывы<br/>покупателей
    <div class="bubles">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </h1>
  
</div>
        

      <?php foreach($last_reviews as $rev){ ?>
      <div class="col-md-12">
          <strong><?php echo $rev['author']; ?> </strong>(<?php echo $rev['date_added']; ?>)
          
        <span class="rating r<?php echo $rev['rating']; ?>">
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        </span>
      <a href="/index.php?route=product/product&product_id=<?php echo $rev['product_id']; ?>"><?php echo $rev['name']; ?></a>
          <p><?php echo $rev['text']; ?></p>
      </div>
      <?php } ?>
      
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>