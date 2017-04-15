<?php if ($error_warning) { ?>
<div class="alert alert-danger"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<?php
$exists = false;
foreach ($shipping_methods as $shipping_method) {
	foreach ($shipping_method['quote'] as $quote) {
		if ($quote['code'] == $code) {
			$exists = true;
			break;
		}
	}
}
?>
<?php if ($shipping) { ?>
<table class="table">
  <?php foreach ($shipping_methods as $shipping_method) { ?>
  <tr>
    <td colspan="3"><b><?php echo $shipping_method['title']; ?></b></td>
  </tr>
  <?php if (!$shipping_method['error']) { ?>
  <?php foreach ($shipping_method['quote'] as $quote) { ?>
  <tr class="options-list">
    <td style="width:22px"><?php if ($quote['code'] == $code || !$code || !$exists) { ?>
	  <?php $code = $quote['code']; ?>
	  <?php $exists = true; ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
      <?php } else { ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" />
      <?php } ?></td>
    <td><label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>
    
    <?php if($quote['code']=='novaposhta.warehouse'){ ?>
            <div style="<?php if ($code != 'novaposhta.warehouse'):?> display:none; <?php endif; ?>" id="block-novaposhta" class="shipping_dop">
                <div class="required">
                    <label class="control-label">Город</label>
                    <select name="novaposhta_city_id" class="form-control" id="novaposhta_city_id">
                        <option value="" selected="selected"><?php echo $text_none; ?></option>
                        <?php if(isset($shipping_methods['novaposhta']['cities']) && count($shipping_methods['novaposhta']['cities']) > 0): ?>
                            <?php foreach($shipping_methods['novaposhta']['cities'] as $city): ?>
                                <option value="<?php echo $city['ref']; ?>"><?php echo $city['descr']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>    
                <div class="required">
                    <label class="control-label">Склад</label>
                    <select name="novaposhta_post_offices" class="form-control" id="novaposhta_post_offices">
                        <option value="" selected="selected"><?php echo $text_none; ?></option>
                    </select>
                </div>
            </div>
        <?php } ?>
    
    
    
    
    
    
    
    </td>
    <td style="text-align: right;" class="rtl-left"><label for="<?php echo $quote['code']; ?>"><span class="shipping-sum"><?php echo $quote['text']; ?></span></label></td>
  </tr>
  <?php } ?>
  <?php } else { ?>
  <tr>
    <td colspan="3"><div class="error"><?php echo $shipping_method['error']; ?></div></td>
  </tr>
  <?php } ?>
  <?php } ?>
</table>
<?php } else { ?>
  <select class="form-control" name="shipping_method">
   <?php foreach ($shipping_methods as $shipping_method) { ?>
     <?php if (!$shipping_method['error']) { ?>
		<?php foreach ($shipping_method['quote'] as $quote) { ?>
		  <?php if ($quote['code'] == $code || !$code || !$exists) { ?>
		    <?php $code = $quote['code']; ?>
			<?php $exists = true; ?>
			<option value="<?php echo $quote['code']; ?>" selected="selected">
		  <?php } else { ?>
			<option value="<?php echo $quote['code']; ?>">
		  <?php } ?>
		  <?php echo $quote['title']; ?>&nbsp;&nbsp;(<?php echo $quote['text']; ?>) </option>
		<?php } ?>
	 <?php } ?>
   <?php } ?>
  </select>
<?php } ?>

<?php } ?>
<?php if ($delivery && (!$delivery_delivery_time || $delivery_delivery_time == '1' || $delivery_delivery_time == '3')) { ?>
<div<?php echo $delivery_required ? ' class="required"' : ''; ?>><br />

  <label class="control-label"><?php echo $text_delivery; ?></label>
  <?php if ($delivery_delivery_time == '1') { ?>
  <input type="text" name="delivery_date" value="<?php echo $delivery_date; ?>" class="form-control date" data-date-format="DD-MM-YYYY HH:mm" />
  <?php } else { ?>
  <input type="text" name="delivery_date" value="<?php echo $delivery_date; ?>" class="form-control date" data-date-format="DD-MM-YYYY" />
  <?php } ?>
  <?php if ($delivery_delivery_time == '3') { ?><br />
    <select name="delivery_time" class="form-control"><?php foreach ($delivery_times as $quickcheckout_delivery_time) { ?>
    <?php if (!empty($quickcheckout_delivery_time[$language_id])) { ?>
      <?php if ($delivery_time == $quickcheckout_delivery_time[$language_id]) { ?>
	  <option value="<?php echo $quickcheckout_delivery_time[$language_id]; ?>" selected="selected"><?php echo $quickcheckout_delivery_time[$language_id]; ?></option>
	  <?php } else { ?>
	  <option value="<?php echo $quickcheckout_delivery_time[$language_id]; ?>"><?php echo $quickcheckout_delivery_time[$language_id]; ?></option>
      <?php } ?>
	<?php } ?>
    <?php } ?></select>
  <?php } ?>
</div>
<?php } elseif ($delivery_delivery_time && $delivery_delivery_time == '2') { ?>
  <input type="text" name="delivery_date" value="" class="hide" />
  <select name="delivery_time" class="hide"><option value=""></option></select>
  <strong><?php echo $text_estimated_delivery; ?></strong><br />
  <?php echo $estimated_delivery; ?><br />
  <?php echo $estimated_delivery_time; ?>
<?php } else { ?>
  <input type="text" name="delivery_date" value="" class="hide" />
  <select name="delivery_time" class="hide"><option value=""></option></select>
<?php } ?>

<script type="text/javascript"><!--
$('#shipping-method input[name=\'shipping_method\'], #shipping-method select[name=\'shipping_method\']').on('change', function() {
	<?php if (!$logged) { ?>
		if ($('#payment-address input[name=\'shipping_address\']:checked').val()) {
			var post_data = $('#payment-address input[type=\'text\'], #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select, #shipping-method input[type=\'text\'], #shipping-method input[type=\'checkbox\']:checked, #shipping-method input[type=\'radio\']:checked, #shipping-method input[type=\'hidden\'], #shipping-method select');
		} else {
			var post_data = $('#shipping-address input[type=\'text\'], #shipping-address input[type=\'checkbox\']:checked, #shipping-address input[type=\'radio\']:checked, #shipping-address input[type=\'hidden\'], #shipping-address select, #shipping-method input[type=\'text\'], #shipping-method input[type=\'checkbox\']:checked, #shipping-method input[type=\'radio\']:checked, #shipping-method input[type=\'hidden\'], #shipping-method select');
		}

		$.ajax({
			url: 'index.php?route=quickcheckout/shipping_method/set',
			type: 'post',
			data: post_data,
			dataType: 'html',
			cache: false,
			success: function(html) {
				<?php if ($cart) { ?>
				loadCart();
				<?php } ?>
			},
			<?php if ($debug) { ?>
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
			<?php } ?>
		});

		<?php if ($shipping_reload) { ?>
			reloadPaymentMethod();
		<?php } ?>
	<?php } else { ?>
		if ($('#shipping-address input[name=\'shipping_address\']').val() == 'new') {
			$.ajax({
				url: 'index.php?route=quickcheckout/shipping_method/set',
				type: 'post',
				data: $('#shipping-address input[type=\'text\'], #shipping-address input[type=\'checkbox\']:checked, #shipping-address input[type=\'radio\']:checked, #shipping-address input[type=\'hidden\'], #shipping-address select, #shipping-method input[type=\'text\'], #shipping-method input[type=\'checkbox\']:checked, #shipping-method input[type=\'radio\']:checked, #shipping-method input[type=\'hidden\'], #shipping-method select'),
				dataType: 'html',
				cache: false,
				success: function(html) {
					<?php if ($cart) { ?>
					loadCart();
					<?php } ?>
				},
				<?php if ($debug) { ?>
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
				<?php } ?>
			});
		} else {
			$.ajax({
				url: 'index.php?route=quickcheckout/shipping_method/set&address_id=' + $('#shipping-address select[name=\'address_id\']').val(),
				type: 'post',
				data: $('#shipping-method input[type=\'text\'], #shipping-method input[type=\'checkbox\']:checked, #shipping-method input[type=\'radio\']:checked, #shipping-method input[type=\'hidden\'], #shipping-method select'),
				dataType: 'html',
				cache: false,
				success: function(html) {
					<?php if ($cart) { ?>
					loadCart();
					<?php } ?>
				},
				<?php if ($debug) { ?>
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
				<?php } ?>
			});
		}

		<?php if ($shipping_reload) { ?>
			if ($('#payment-address input[name=\'payment_address\']').val() == 'new') {
				reloadPaymentMethod();
			} else {
				reloadPaymentMethodById($('#payment-address select[name=\'address_id\']').val());
			}
		<?php } ?>
	<?php } ?>
});

$(document).ready(function() {
	$('#shipping-method input[name=\'shipping_method\']:checked, #shipping-method select[name=\'shipping_method\']').trigger('change');
});

<?php if ($delivery && $delivery_delivery_time == '1') { ?>
$(document).ready(function() {
	$('input[name=\'delivery_date\']').datetimepicker({
		minDate: '+<?php echo $delivery_min; ?>',
		maxDate: '+<?php echo $delivery_max; ?>',
		disabledDates: [<?php echo $delivery_unavailable; ?>],
		<?php if ($delivery_days_of_week) { ?>
		daysOfWeekDisabled: [<?php echo $delivery_days_of_week; ?>]
		<?php } ?>
	});
});
<?php } elseif ($delivery && ($delivery_delivery_time == '3' || $delivery_delivery_time == '0')) { ?>
	$('.date').datetimepicker({
		pickDate: true,
		pickTime: false,
		minDate: '+<?php echo $delivery_min; ?>',
		maxDate: '+<?php echo $delivery_max; ?>',
		disabledDates: [<?php echo $delivery_unavailable; ?>],
		<?php if ($delivery_days_of_week) { ?>
		daysOfWeekDisabled: [<?php echo $delivery_days_of_week; ?>]
		<?php } ?>
	});
<?php } ?>

    $('#shipping-method').on('change', '#novaposhta_city_id', function () {
        $.ajax({
            url: 'index.php?route=quickcheckout/shipping_method/novaposhta_offices&cityref=' + this.value,
            dataType: 'json',
            beforeSend: function () {
                $('select[name=\'novaposhta_post_offices\']').html('<option value="">Loading...</option>')
            },
            complete: function () {
                set_shipping_method();
            },
            success: function (json) {
                html = '<option value=""><?php echo $text_none; ?></option>';

                if (json['offices'] && json['offices'] != '') {
                    var text = $( "select[name='novaposhta_city_id'] option:selected" ).text();
                    for(key in json['offices']){
                        html += '<option value="'+text+', '+json['offices'][key][0]+'">'+json['offices'][key][0]+'</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                }
    
                $('select[name=\'novaposhta_post_offices\']').html(html).val("");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }); 
    $('#shipping-method').on('change', '#novaposhta_post_offices', function () {
        set_shipping_method();
    });     
//--></script>