<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/cosyone/stylesheet/stylesheet.css" />

<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


<link href="catalog/view/theme/default/css/main.css" rel="stylesheet">

<script type="text/javascript" src="catalog/view/theme/cosyone/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="catalog/view/theme/cosyone/js/cosyone_common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/cosyone/stylesheet/ie8.css" />
<![endif]-->
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>

<script>
  //checking cart for empty
  jQuery(document).ready(function($) {
    if($("div").is(".empty")) {
      $("#cart .shortcut_heading").css({"pointer-events" : "none"});
    }
    var path = window.location.pathname + window.location.search;
    console.log(path);
    $("#menu>ul>li").each(function(index, el) {
      if($(el).find("a").attr('href') == window.location.href || $(el).find("a").attr('href') == path) {
        $(el).addClass('current');
      }
    });

    $(".trigger-btn").click(function(event) {
      event.preventDefault();
      $(this).next().slideToggle("fast");
    });
  });
</script>

</head>
<body class="<?php echo $class; ?>">
<div class="outer_container <?php echo $cosyone_default_product_style; ?> <?php if($cosyone_use_custom){ echo $cosyone_container_layout; } ?> <?php echo $cosyone_use_breadcrumb; ?>">

<div class="header_main header">
    <div class="header__top">
        <div class="container header__top-container">
            <div class="header__row">
              <div class="header__socials">
                <a target="_blank" href="https://vk.com/minny.shopping" class="header__socials-icon"><i class="fa fa-vk"></i></a>
                <a target="_blank" href="https://www.instagram.com/minny_for_kids/" class="header__socials-icon"><i class="fa fa-instagram"></i></a>
                <a target="_blank" href="https://www.facebook.com/shopping.minny/?ref=bookmarks" class="header__socials-icon"><i class="fa fa-facebook"></i></a>
              </div>
              <div class="header__shares">
                <div class="header__share _share1">
                  <span>при заказе на сумму от 1700 грн</span>
                  <strong class="flex"><i class="icon-car"></i>бесплатная доставка</strong>
                </div>
                <div class="header__share _share2">
                  <a class="flex" href="/sert"><i class="icon-prize"></i>Подарочный сертификат</a>
                </div>
              </div>
            </div>
            <div class="header__row">
              <div class="header__contacts">
                <a class="flex header__contacts-icon-mail" href="mailto:<?php echo $email; ?>"><i class="icon-mail"></i><?php echo $email; ?></a>
                <a class="flex header__contacts-icon-mobile" href="tel:<?php echo $telephone; ?>"><i class="icon-mobile"></i><?php echo $telephone; ?></a>
              </div>
              <div class="header__logo">
                <?php if ($logo) { ?>
                <div class="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
                <?php } ?>
              </div>
              <div class="header__cart">
                <?php if($cosyone_header_style == 'header2') { ?>
                    <?php } else { ?>
                      <div class="shortcuts_wrapper">
                      <?php if ($cosyone_header_cart) { echo $cart; } ?>
                      </div>
               <?php } ?>
              </div>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="header__container">
            <div class="menu_wrapper">
              <div class="container menu_border"></div>
              <div class="container menu_holder">
              <div id="menu">
                <a href="#" class="trigger-btn visible-xs">
                      меню
                    </a>
                <ul class="only_desktop">
                <li class="home only_desktop <?php echo $cosyone_show_home_icon; ?>"><a href="<?php echo $home; ?>"><?php //echo $text_home; ?>Новинки</a></li>
                     <?php if ($categories) { ?>
                     <?php foreach ($categories as $category_1) { ?>
                      <?php if ($category_1['category_1_id'] == $category_1_id) { ?>
                  <li class="col<?php echo $category_1['column']; ?> current"><a href="<?php echo $category_1['href']; ?>" ><?php echo $category_1['name']; ?><i class="fa fa-sort-desc"></i></a>
                       <?php } else { ?>
                       <li class="col<?php echo $category_1['column']; ?>"><a href="<?php echo $category_1['href']; ?>" ><?php echo $category_1['name']; ?><i class="fa fa-sort-desc"></i></a>
                       <?php } ?>
                        <?php if ($category_1['children']) { ?>
                        <div class="menu_drop_down" style="width: <?php echo ((($category_1['column']) * (195)) + (10)); ?>px">
                        <div class="wrapper">
                        <ul><?php foreach ($category_1['children'] as $category_2) { ?>
                        <li class="column level2">
                          <a href="<?php echo $category_2['href']; ?>"><?php echo $category_2['name']; ?><i class="fa fa-caret-right"></i></a>
                          <?php if($cosyone_menu_mega_second_thumb == 'enabled' && $category_2['thumb']) { ?>
                        <a href="<?php echo $category_2['href']; ?>" class="sub_thumb"><img src="<?php echo $category_2['thumb']; ?>" alt="<?php echo $category_2['name']; ?>"/></a>
                        <?php } ?>
                            <?php if ($category_2['children']) { ?>
                            <div class="third">
                            <ul>
                             <?php foreach ($category_2['children'] as $category_3) { ?>
                             <li><a href="<?php echo $category_3['href']; ?>"><?php echo $category_3['name']; ?></a></li>
                             <?php } ?>
                            </ul>
                            </div>
                            <?php } ?>
                          </li>
                          <?php } ?>
                        </ul>
                        </div><!-- wrapper ends -->
                        </div>
                        <?php } ?>
                      </li>
                      <?php } ?>
                      <?php } ?>
                      <?php if($cosyone_custom_menu_block == 'enabled'){ ?>
                  <li class="withsubs custom_block"><a><?php echo $cosyone_custom_menu_block_title; ?><i class="fa fa-sort-desc"></i></a>
                      <div class="menu_drop_down" style="width:<?php echo $cosyone_menu_block_width; ?>px">
                      <?php echo $cosyone_menu_custom_block_content; ?>
                      </div></li>
                  <?php } ?>
                      <?php if($cosyone_custom_menu_title1){ ?>
                  <li><a href="<?php echo $cosyone_custom_menu_url1 ?>"><?php echo $cosyone_custom_menu_title1; ?></a></li>
                      <?php } ?>
                      <?php if($cosyone_custom_menu_title2){ ?>
                  <li><a href="<?php echo $cosyone_custom_menu_url2 ?>"><?php echo $cosyone_custom_menu_title2; ?></a></li>
                      <?php } ?>
                      <?php if($cosyone_custom_menu_title3){ ?>
                  <li><a href="<?php echo $cosyone_custom_menu_url3; ?>"><?php echo $cosyone_custom_menu_title3; ?></a></li>
                      <?php } ?>
                      <?php if($cosyone_custom_menu_title4){ ?>
                  <li><a href="<?php echo $cosyone_custom_menu_url4; ?>"><?php echo $cosyone_custom_menu_title4; ?></a></li>
                      <?php } ?>
                      <?php if($cosyone_custom_menu_title5){ ?>
                  <li><a href="<?php echo $cosyone_custom_menu_url5; ?>"><?php echo $cosyone_custom_menu_title5; ?></a></li>
                      <?php } ?>
                      <?php if($cosyone_custom_menu_title6){ ?>
                  <li><a href="<?php echo $cosyone_custom_menu_url6; ?>"><?php echo $cosyone_custom_menu_title6; ?></a></li>
                      <?php } ?>
                    </ul>
                    
                    <?php if($cosyone_header_style == 'header3') { ?>
                     <?php } else { ?>
                     <?php if($cosyone_header_search == 'enabled') { ?>
                     <?php echo $search; ?>
                     <?php } ?>
                     <?php } ?>
                  </div> <!-- menu_holder ends -->
              </div> <!-- menu ends -->
              </div> <!-- menu_wrapper ends -->
        </div>
    </div>
</div>

<?php if(false): ?>
<div class="header_wrapper 
<?php echo $cosyone_menu_sticky; ?> 
<?php echo $cosyone_menu_border; ?> 
<?php echo $cosyone_header_style; ?>">
<div class="header_top_line_wrapper">
<div class="header_top_line container">
<?php if($cosyone_header_style == 'header1'){ ?>
    <?php } else { ?>
    <div class="drop_downs_wrapper">
    <?php echo $header_login; ?>
	<?php echo $language; ?>
  	<?php echo $currency; ?>
    </div>
    <?php } ?>
  <div class="promo_message"><?php echo $cosyone_top_promo_message; ?></div>
  <div class="links contrast_font">
  <a href="<?php echo $account; ?>"><?php echo $text_account; ?></a>
  <a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a>
  <a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a>
  <a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
  </div>
  <div class="clearfix"></div>
</div>
</div>
<div class="container header">
<div class="header_main">
  <div class="header_right"> 
  <?php if ($logo) { ?>
  <div class="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
 <?php if($cosyone_header_style == 'header3') { ?>
 <?php } else { ?>
 <?php if($cosyone_header_search == 'enabled') { ?>
 <?php echo $search; ?>
 <?php } ?>
 <?php } ?>
 <div class="mobile_clear"></div>
  <!-- Position for header login, lang, curr, in the header main -->
	<?php if($cosyone_header_style == 'header1'){ ?>
    <?php echo $header_login; ?>
	<?php echo $language; ?>
  	<?php echo $currency; ?>
    <?php } ?>
  <?php if($cosyone_header_style == 'header2') { ?>
    	<div class="shortcuts_wrapper">
       	<?php echo $header_wishlist_compare; ?>
        <?php if ($cosyone_header_cart) { echo $cart; } ?>
        </div>
    	<?php } else { ?>
    <?php } ?>
  <?php if($cosyone_header_style == 'header3'){ ?>
    <?php } else { ?>
      </div> <!-- header_right ends -->
	</div> <!-- header ends -->
    <?php } ?>



<?php if($cosyone_header_style == 'header3'){ ?>
      </div> <!-- header_right ends -->
	</div> <!-- header ends -->
    <?php } else { ?><?php } ?>
<div class="clearfix"></div>
<div class="mobile_menu_wrapper">

<div class="mobile_menu">

	<ul>
    <?php if ($categories) { ?>
       <?php foreach ($categories as $category_1) { ?>
         <li><a href="<?php echo $category_1['href']; ?>" ><?php echo $category_1['name']; ?></a>
          <?php if ($category_1['children']) { ?>
          <span class="plus"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
          <ul>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <li>
            <a href="<?php echo $category_2['href']; ?>"><?php echo $category_2['name']; ?></a>
              <?php if ($category_2['children']) { ?>
              <span class="plus"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
              <ul>
                <?php foreach ($category_2['children'] as $category_3) { ?>
                <li><a href="<?php echo $category_3['href']; ?>"><?php echo $category_3['name']; ?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </li>
        <?php } ?>
        <?php } ?>
        <?php if($cosyone_custom_menu_title1){ ?>
		<li><a href="<?php echo $cosyone_custom_menu_url1; ?>"><?php echo $cosyone_custom_menu_title1; ?></a></li>
        <?php } ?>
        <?php if($cosyone_custom_menu_title2){ ?>
		<li><a href="<?php echo $cosyone_custom_menu_url2; ?>"><?php echo $cosyone_custom_menu_title2; ?></a></li>
        <?php } ?>
        <?php if($cosyone_custom_menu_title3){ ?>
		<li><a href="<?php echo $cosyone_custom_menu_url3; ?>"><?php echo $cosyone_custom_menu_title3; ?></a></li>
        <?php } ?>
        <?php if($cosyone_custom_menu_title4){ ?>
		<li><a href="<?php echo $cosyone_custom_menu_url4; ?>"><?php echo $cosyone_custom_menu_title4; ?></a></li>
        <?php } ?>
        <?php if($cosyone_custom_menu_title5){ ?>
		<li><a href="<?php echo $cosyone_custom_menu_url5; ?>"><?php echo $cosyone_custom_menu_title5; ?></a></li>
        <?php } ?>
        <?php if($cosyone_custom_menu_title6){ ?>
		<li><a href="<?php echo $cosyone_custom_menu_url6; ?>"><?php echo $cosyone_custom_menu_title6; ?></a></li>
        <?php } ?>
      </ul>

</div>
</div>
</div> <!-- header_wrapper ends -->
<?php endif; ?>


</div> <!-- inner conainer ends -->
<!-- <div class="breadcrumb_wrapper"></div> -->
<div id="notification" class="container"></div>