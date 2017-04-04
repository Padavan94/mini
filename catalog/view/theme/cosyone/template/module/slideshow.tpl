<div id="slideshow<?php echo $module; ?>" class="owl-carousel custom home-banner" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />

    <div class="slide-info">
      <div class="slide-info__title"><?php echo $banner['title']; ?><span class="bbls">
        <i></i><i></i><i></i>
      </span></div>
      <p class="slide-info__descr"><?php echo $banner['description']; ?></p>
      <a href="<?php echo $banner['link']; ?>" class="slide-info__link">Смотреть</a>
    </div>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#slideshow<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 9000,
	singleItem: true,
	navigation: true,
	slideSpeed:750,
	navigationText: ['<i class="fa fa-angle-left fa-5x"></i>', '<i class="fa fa-angle-right fa-5x"></i>'],
	pagination: true
});
--></script>