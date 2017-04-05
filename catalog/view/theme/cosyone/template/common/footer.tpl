<div class="clearfix"></div>
<div class="advantages">
  <div class="container advantages__container">
    <div class="advantages__item">
      <i class="icon-dress"></i>
      <span>Качественные и<br> оригинальные изделия</span>
    </div>
    <div class="advantages__item">
      <i class="icon-buss"></i>
      <span>доставка <br>по всей украине</span>
    </div>
    <div class="advantages__item">
      <i class="icon-percents"></i>
      <span>система<br> акций и скидок</span>
    </div>
    <div class="advantages__item">
      <i class="icon-card"></i>
      <span>Удобная система<br> возврата</span>
    </div>
  </div>
</div>


<div id="footer" class="footer">
	<div class="container footer__container">
   <div class="column footer__column">
    <div class="footer__logo">
      <a href="/"><img src="/image/logog.png" alt="logo"></a>
    </div>

    <div class="custom_block">
    <p>Minny © 2017. <br> Все права защищены</p>
    <?php // echo $cosyone_footer_custom_block; ?>
    </div>
    </div><!--
  --><div class="column footer__column">
    <div class="footer__heding"><?php //echo $text_information; ?>полезно</div>
    <ul class="contrast_font">
    <?php if ($informations) { ?>
      <?php foreach ($informations as $information) { ?>
      <li><i class="fa fa-angle-right"></i><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
      <?php } ?>
      <li><i class="fa fa-angle-right"></i><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
    </ul>
  </div><!--
  --><div class="column footer__column">
    <div class="footer__heding"><?php //echo $text_extra; ?>контакты</div>
    <div class="footer__info">
      <div class="footer__set">
        <div class="footer__text">
          Напишите нам:
        </div>
        <div class="footer__mail">
          <a class="flex" href="mailto:<?php echo $email; ?>"><i class="icon-mail"></i><?php echo $email; ?></a>
        </div>
      </div>
      <div class="footer__set">
        <div class="footer__text">
          Позвоните нам
        </div>
        <div class="footer__phone">
          <a class="flex" href="tel:<?php echo $telephone; ?>"><i class="icon-mobile"></i><?php echo $telephone; ?></a>
        </div>
      </div>
    </div>
  </div><!--
  --><div class="column footer__column">
    <div class="footer__heding"><?php //echo $text_account; ?>мы в соц. сетях</div>
    <div class="footer__socials">
      <a href="#" class="footer__socials-icon"><i class="fa fa-vk"></i></a>
      <a href="#" class="footer__socials-icon"><i class="fa fa-instagram"></i></a>
      <a href="#" class="footer__socials-icon"><i class="fa fa-facebook"></i></a>
    </div>
  </div> 
  </div>
</div> <!-- #footer ends --> 

<?php if(false): ?>
  <div class="bottom_line"> <div class="scroll_to_top"><a class="scroll_top icon tablet_hide"><i class="fa fa-angle-up"></i></a></div>
  <div id="powered"><?php echo $powered; ?></div>
  <?php if ($cosyone_footer_payment_icon) { ?>
   <div id="footer_payment_icon"><img src="image/<?php echo $cosyone_footer_payment_icon; ?>" alt="" /></div>
   <?php } ?>
   <div class="clearfix"></div>
  </div>

<?php endif; ?>
<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

</div>  <!-- .outer_container ends -->
<script type="text/javascript" src="catalog/view/theme/cosyone/js/jquery.cookie.js"></script>

<script type="text/javascript" src="catalog/view/theme/cosyone/js/colorbox/jquery.colorbox-min.js"></script>
<link href="catalog/view/theme/cosyone/js/colorbox/custom_colorbox.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="catalog/view/theme/cosyone/js/quickview.js"></script>
<?php if($cosyone_use_retina) { ?>
<script type="text/javascript" src="catalog/view/theme/cosyone/js/retina.min.js"></script>
<?php } ?>
<?php echo $live_search; ?>
<?php echo $cosyone_cookie; ?>
</body></html>