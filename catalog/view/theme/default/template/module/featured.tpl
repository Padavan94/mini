<div class="can-like">
<div class="hits clearfix">
<div class="container hits__container">
  <h3 class="hits__title"><?php //echo $heading_title; ?>
  <span>
  <?php echo $heading_title; ?>
  <div class="bubles">
    <span></span>
    <span></span>
    <span></span>
  </div>
  </span>
  
  </h3>
  <div class="hits__carousel-inner">
  <div class="hits__carousel">
      
  <?php foreach ($products as $product) { ?>
  <div class="product-layout">
    <?php if ($product['label']) { ?>
    <img src="/image/<?php echo $product['label']['label_image']; ?>" alt="<?php echo $product['label']['label_name']; ?>" class="product-layout__bage">
    <?php if ($product['label2']) { ?>
    <?php } ?>
    <img src="/image/<?php echo $product['label2']['label_image']; ?>" alt="<?php echo $product['label2']['label_name']; ?>" class="product-layout__flag">
    <?php } ?>
    <div class="product-thumb transition">
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
      <div class="caption">
        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>

        <?php if ($product['price']) { ?>
        <p class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
          <?php if ($product['tax']) { ?>
          <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
          <?php } ?>
        </p>
        <?php } ?>
      </div>
      <div class="button-group">
        <button type="button" class="buy" onclick="cart.add('<?php echo $product['product_id']; ?>');"> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span><i class="icon-cart"></i></button>
      </div>
    </div>
  </div>
  <?php } ?>
  </div>
  </div>
</div>

</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
$('.hits__carousel').owlCarousel({
  items: 3,
  autoPlay: true,
  navigation: true,
  navigationText: ["<span><i class='fa fa-angle-left'></i></span>","<span><i class='fa fa-angle-right'></i></span>"],
  dots: true,
  transitionStyle:"backSlide",
  itemsDesktop:[1199,3],
  itemsDesktopSmall:[990,2],  
  itemsTablet:[768,1],
  itemsMobile:[479,1],

});
});
</script> 