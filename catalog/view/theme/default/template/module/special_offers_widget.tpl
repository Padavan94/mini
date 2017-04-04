<div id="special_offers<?php echo $module; ?>" class="special-offers">
    <div class="special-offers__title">
        <span>Акции и спецпредложения</span>
    </div>
    <div class="special-offers__container">
        <?php foreach ($special_offers as $special_offer) { ?>

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
                        <!--<a href="<?php echo $special_offer['link']; ?>">Подробнее</a>-->
                    </div>
                </div>
        </div>
        <?php } ?>
    </div>
    <div class="special-offers__show-more">
        <a  class="text-medium" href="/index.php?route=blog/special_offers">Просмотреть все акции и спецпредложения</a>
    </div>
</div>
