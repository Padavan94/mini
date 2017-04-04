

<?php echo $header; ?>

<div class="content">
  <div class="container special-offers">
    <div class="row">
      <div class="content__inner">  
        <div id="content" class="content__right">
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
          </ul>

          <div class="special-offers__container">
            <?php if(isset($blog) && $blog) : ?>
             
              <?php foreach ($blog as $key=>$post) : 
               if($key%2){ $class="look-h5-r";  }
               else { $class="look-h5-l";  }
              ?>

              <div class="panel-body special-offers__item special-offers__item--full-width">
                      <div class="title">
                          <h5 class="look-sp-title <?php echo $class; ?>"><?php echo ucfirst($post['name']); ?></h5>
                      </div>
                          <div class="info">                            
                            <div class="img">
                             <img src="/image/<?php echo $post['image']; ?>" alt="img">
                             <?php if(false) : ?>
                                <?php //if($post['images']) : ?>
                                <div class="collection-grid">
                                    <?php $i=0; ?>
                                    <?php foreach ($post['images'] as $image) : 
                                      $i++;
                                      if($i>4){
                                      break;
                                      }  ?> 
                                    <div class="no-padding col-md-3 look-main">                                          
                                        <img src="/image/<?php echo $image['image']; ?>" alt="img" >                                        
                                      </div>
                                    
                                    <?php endforeach; ?>
                                  </div>
                                </div>
                              <?php endif; ?>
                             <a href="<?php echo HTTP_SERVER; ?>index.php?route=blog/special_offers&amp;path=<?php echo $post['blog_id']; ?>" class="btn  <?php echo $class; ?>"><?php echo $text_button; ?></a>
                          </div>
                         
                          <div class="descr">
                             <!-- <p><?php echo ucfirst($post['description']); ?></p>
                              <div class="special-offers__date">
                                <p class="date"><span class="icon-calendar"></span><?php echo $post['date_added']; ?></p>
                                <p class="time"><span class="icon-clock"></span><?php echo $post['time_added']; ?></p>
                              </div>-->
                              
                          </div>
                      </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div id="blog-pagination">
              <?php echo $pagination; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>





<?php echo $footer; ?>