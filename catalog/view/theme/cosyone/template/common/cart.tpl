<div id="cart" class="shortcut">
 <a class="shortcut_heading" href="<?php echo $cart; ?>" id="cart-total"><?php echo $text_items; ?></a>
  <div class="content">
    <?php if ($products || $vouchers) { ?>
    <div class="mini-cart-info">
      <table>
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="image border"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?></td>
          <td class="name border">
          <a class="contrast_font" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <div>
              <?php foreach ($product['option'] as $option) { ?>
              <?php echo $option['name']; ?>: <?php echo $option['value']; ?><br />
              <?php } ?>
              <?php if ($product['recurring']) { ?>
              <?php echo $text_recurring ?>: <?php echo $product['recurring']; ?><br />
              <?php } ?>
            </div></td>
            <td><?php echo $product['quantity']; ?>&nbsp;x&nbsp;<b><?php echo $product['price']; ?></td>
          <td class="remove border"><a title="<?php echo $button_remove; ?>" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"><span class="remove"><i class="fa fa-times"></i></span></a></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td colspan="2" class="voucher border"><span class="name" style="display:block; float:left">1&nbsp;x&nbsp;<?php echo $voucher['description']; ?></span></td>
          <td class="remove border"><a title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $voucher['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $voucher['key']; ?>' + ' #cart > *');"><span class="remove"><i class="fa fa-times"></i></span></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <div class="cont">
      <div class="checkoutbuttons">
        <a class="button" href="<?php echo $cart; ?>"><?php echo $text_cart; ?></a>
        <a class="button active" href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
        </div>
        <div class="mini-cart-total">
            <?php foreach ($totals as $total) { ?>
              <div ><?php echo $total['title']; ?>:</div>
              <div class="left-price"><?php echo $total['text']; ?></div>
            <?php } ?>
        </div>
    </div>
    <?php } else { ?>
    <div class="empty main_font"><?php echo $text_empty; ?></div>
    <?php } ?>
  </div>
  </div>