<div class="checkout-heading box-heading"><?php echo $text_cart; ?></div>
<?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <table class="quickcheckout-cart contrast_font">
	<thead>
		<tr>
		  <td class="image mobile_hide"><?php echo $text_image; ?></td>
		  <td class="name"><?php echo $text_name; ?></td>
		  <td class="quantity"><?php echo $text_quantity; ?></td>
		  <td class="unit-price mobile_hide"><?php echo $text_price; ?></td>
		  <td class="total"><?php echo $text_total; ?></td>
		</tr>
	</thead>
    <?php if ($products || $vouchers) { ?>
	<tbody>
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="image mobile_hide"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?></td>
          <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php if (!$product['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
            <div>
              <?php foreach ($product['option'] as $option) { ?>
              <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
              <?php } ?>
			  
			  <?php if ($product['recurring']) { ?>
			  <small><?php echo $text_recurring_item; ?>: <?php echo $product['recurring']; ?></small>
			  <?php } ?>
            </div></td>
          <td class="quantity"><?php if ($edit_cart) { ?>

          <div class="quan">
            <div class="counter-price">
                  <button class="decrement1"><i class="fa fa-angle-left"></i></button>
                 <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" value="<?php echo $product['quantity']; ?>" />
                  <button class="increment1"><i class="fa fa-angle-right"></i></button>
                </div>
                <a data-tooltip="<?php echo $button_update; ?>" class="button-update sq_icon"><i class="fa fa-refresh"></i></a>
          </div>



            
            <?php } else { ?>
			x&nbsp;<?php echo $product['quantity']; ?>
			<?php } ?></td>
		  <td class="unit-price mobile_hide"><?php echo $product['price']; ?></td>
          <td class="total"><?php echo $product['total']; ?></td>
          <td><a href="<?php echo $product['cart_id']; ?>" data-tooltip="<?php echo $button_remove; ?>" class="button-remove sq_icon" data-remove="<?php echo $product['cart_id']; ?>"><i class="fa fa-times"></i></a></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td class="image mobile_hide"></td>
          <td class="name"><?php echo $voucher['description']; ?></td>
          <td class="quantity">x&nbsp;1</td>
		  <td class="price mobile_hide"><?php echo $voucher['amount']; ?></td>
          <td class="total"><?php echo $voucher['amount']; ?></td>
        </tr>
        </tbody>
        <?php } ?>
        </table>
        <div class="bottom-of-table">
		<?php foreach ($totals as $total) { ?>
      <div>
        <span><?php echo $total['title']; ?></span>
        <span class="bold"><?php echo $total['text']; ?></span>
      </div>
        <?php } ?>
    </div>
    <?php } ?>
</table>

<script>
$('.increment1').click(function(event) {
  /* Act on the event */
  event.preventDefault();
    var num = +$(this).parent().parent().find("input").val();
    console.log(typeof +num);
    $(this).parent().parent().find("input").val(++num);
});

$('.decrement1').click(function(event) {
  /* Act on the event */

  event.preventDefault();
    var num = +$(this).parent().parent().find("input").val();
    if(num > 1) {
      $(this).parent().parent().find("input").val(--num);
    }
    
});

</script>