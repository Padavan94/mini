<?php echo $header; ?>
<script type="text/javascript">
	$("li.home").addClass("current");
	$(".breadcrumb_wrapper").hide();
</script>
<?php echo $home_top_top; ?>
<div class="category-home">
      <div class="container category-home__container">
      <div class="category-home__col">
        <div class="category-home__img">
          <a href="#"><img src="/image/girl.png" alt="main"></a>
          <div class="category-home__next-wrap">
            <span class="bubles">
              <i></i>
              <i></i>
              <i></i>
            </span>
            <div class="category-home__next">
              <div class="category-home__top">
                <i class="icon-girl"></i>
                <span>Для девочек</span>
              </div>
              <div class="category-home__bottom">
                  <a href="<?php echo $girls; ?>">Перейти <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="category-home__col">
        <div class="category-home__img">
          <a href="#"><img src="/image/man.png" alt="main"></a>
          <div class="category-home__next-wrap">
            <span class="bubles">
              <i></i>
              <i></i>
              <i></i>
            </span>
            <div class="category-home__next">
              <div class="category-home__top">
                <i class="icon-man"></i>
                <span>для мальчиков</span>
              </div>
              <div class="category-home__bottom">
                <a href="<?php echo $boys; ?>">Перейти <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="collections-home">
      <div class="container collections-home__container">
        <div class="collections-home__item">
          <div class="collections-home__item-img">
            <a href="#" style="background-image: url('/image/man.jpg');">
              <div class="go">
                <span>перейти</span>
              </div>
            </a>
          </div>
          <div class="collections-home__item-inf">
            <a href="#">новая коллекция ВЕСНА ЛЕТО 2017</a>
            <span>lorem ipsum</span>
          </div>
        </div>
        <div class="collections-home__item">
          <div class="collections-home__item-img">
            <a href="#" style="background-image: url('/image/man.jpg');">
              <div class="go">
                <span>перейти</span>
              </div>
            </a>
          </div>
          <div class="collections-home__item-inf">
            <a href="#">новая коллекция ВЕСНА ЛЕТО 2017</a>
            <span>lorem ipsum</span>
          </div>
        </div>
        <div class="collections-home__item">
          <div class="collections-home__item-img">
            <a href="#" style="background-image: url('/image/man.jpg');">
              <div class="go">
                <span>перейти</span>
              </div>
            </a>
          </div>
          <div class="collections-home__item-inf">
            <a href="#">новая коллекция ВЕСНА ЛЕТО 2017</a>
            <span>lorem ipsum</span>
          </div>
        </div>
        <div class="collections-home__item">
          <div class="collections-home__item-img">
            <a href="#" style="background-image: url('/image/man.jpg');">
              <div class="go">
                <span>перейти</span>
              </div>
            </a>
          </div>
          <div class="collections-home__item-inf">
            <a href="#">новая коллекция ВЕСНА ЛЕТО 2017</a>
            <span>lorem ipsum</span>
          </div>
        </div>
        <div class="collections-home__item">
          <div class="collections-home__item-img">
            <a href="#" style="background-image: url('/image/man.jpg');">
              <div class="go">
                <span>перейти</span>
              </div>
            </a>
          </div>
          <div class="collections-home__item-inf">
            <a href="#">новая коллекция ВЕСНА ЛЕТО 2017</a>
            <span>lorem ipsum</span>
          </div>
        </div>
      </div>
    </div>
    <?php echo $content_bottom; ?>
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


<?php if(false): ?>
<div class="container main">
  
  <div class="home_top_wrapper">
<?php echo $home_top_left; ?><?php echo $home_top_center; ?><?php echo $home_top_right; ?>
</div>
  <div><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="container <?php echo $class; ?> homepage">
    <?php echo $content_top; ?>
     <?php echo $content_bottom_half; ?>
     
     </div>
    <?php echo $column_right; ?>
    </div>
</div>
<?php endif; ?>

<?php echo $footer; ?> 