<?php echo $header; ?>
<script type="text/javascript">
	$("li.home").addClass("current");
	$(".breadcrumb_wrapper").hide();
</script>
<?php echo $home_top_top; ?>
<!-- <div class="category-home">
      <div class="container category-home__container">
      <div class="category-home__col">
        <div class="category-home__img">
          <a href="<?php echo $girls; ?>"><img src="/image/girl.png" alt="main"></a>
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
          <a href="<?php echo $boys; ?>"><img src="/image/man.png" alt="main"></a>
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
    </div> -->
    
    <?php echo $content_bottom; ?>
    


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