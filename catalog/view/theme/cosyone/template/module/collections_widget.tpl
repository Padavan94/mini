<div class="collections-home">
      <div class="container collections-home__container">
          
          
        <?php foreach ($collections as $special_offer) { ?>  
        
        <div class="collections-home__item">
          <div class="collections-home__item-img">
            <a href="<?php echo $special_offer['link']; ?>" style="background-image: url(<?php echo $special_offer['image']; ?>);">
              <div class="go">
                <span>перейти</span>
              </div>
            </a>
          </div>
          <div class="collections-home__item-inf">
            <a href="<?php echo $special_offer['link']; ?>"><?php echo $special_offer['title']; ?></a>
            <span><?php echo $special_offer['description']; ?></span>
          </div>
        </div>
        
        <?php } ?>
        
        
      </div>
    </div>



<?php if(false){ ?>
<div id="collections<?php echo $module; ?>" class="special-offers">
    <div class="special-offers__title">
        <span>Акции и спецпредложения</span>
    </div>
    <div class="special-offers__container">
        <?php foreach ($collections as $special_offer) { ?>

        <div class="panel-body special-offers__item">
                <div class="title">
                    <h5><?php echo $special_offer['title']; ?></h5>
                </div>
                <div class="info">
                    <div class="img">
                        <img src="<?php echo $special_offer['image']; ?>" />
                    </div>
                    <div class="descr">
                        <p><?php echo $special_offer['description']; ?></p>
                        <a href="<?php echo $special_offer['link']; ?>">Подробнее</a>
                    </div>
                </div>
        </div>
        <?php } ?>
    </div>
    <div class="special-offers__show-more">
        <a  class="text-medium" href="/index.php?route=blog/collections">Просмотреть все акции и спецпредложения</a>
    </div>
</div>
<?php } ?>