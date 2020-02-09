jQuery(document).ready(function()
{
	/*### set popup position ###*/
	function popup_dv_position_set(dv_id)
	{
		var win_width = jQuery(window).width();
		var win_height = jQuery(window).height();
		var div_width = jQuery('#'+dv_id).width();
		var div_height = jQuery('#'+dv_id).height();
		var cal_left = (win_width/2) - (div_width/2);
		var cal_top = (win_height/2) - (div_height/2);
		jQuery('#'+dv_id).css({'left':cal_left, 'top':cal_top, 'position':'fixed'});
	}
	

	/*### close popup window ###*/
	jQuery('#cboxClose').on('click', function()
	{
		jQuery('#cboxPopup').remove();
		//jQuery('#adiAdrsBox').hide();
		//jQuery('#confirmAlertBox').hide();
		//jQuery('#adiAdrsEditBox').hide();
		jQuery(this).parent().hide();
	});
	
	
	/*### checkout ###*/
	jQuery('form#checkout input[name=ship_to_billing]').change(function()
	{
		if(jQuery('form#checkout input[name=ship_to_billing]').is(':checked'))
		{
			var shipping_address1 = jQuery('form#checkout #shipping_address1').val();
			jQuery('form#checkout #billing_address1').val(shipping_address1);
		}
		else
		{
			jQuery('form#checkout #billing_address1').val('');
		}
	});
	jQuery('form#checkout').on('click', function()
	{
		if(jQuery('form#checkout input[name=ship_to_billing]').is(':checked'))
		{
			var shipping_address1 = jQuery('form#checkout #shipping_address1').val();
			jQuery('form#checkout #billing_address1').val(shipping_address1);
		}
	});
	jQuery('form#checkout #product_ids, form#order_update #product_ids').change(function()
	{
		var product_ids = [];
        jQuery.each(jQuery("form#checkout #product_ids option:selected, form#order_update #product_ids option:selected"), function()
		{            
            product_ids.push(jQuery(this).val());
        });
		
		product_ids = product_ids.join(",");
		//var product_quantity = jQuery('form#checkout #product_quantity').val();
		//alert('product_ids: '+product_ids);
		//alert('product_quantity: '+product_quantity);
		
		jQuery.ajax({
			type: 'POST',
			data: {
				"product_ids" : product_ids,
				"product_quantity" : 1
			},
			url: '<?php echo base_url();?>adminajax/generate_order_review_html',
			success: function(result)
			{
				//alert('success');
				var response = JSON.parse(result);
				jQuery('form#checkout #product_html, form#order_update #product_html').html(response.html);
			}
		});
	});
	jQuery('body').on('click', 'form#checkout .update_items, form#order_update .update_items', function()
	{
		var product_ids = [];
		var product_qtys = [];

        jQuery.each(jQuery("form#checkout .item_qty, form#order_update .item_qty"), function()
		{            
            product_ids.push(jQuery(this).attr('data-item-id'));
            product_qtys.push(jQuery(this).val());
        });
	var size=jQuery("form#checkout #productSize option:selected").text();
		product_ids = product_ids.join(",");
		product_qtys = product_qtys.join(",");
		
		jQuery.ajax({
			type: 'POST',
			data: {
				"product_ids" : product_ids,
				"product_qtys" : product_qtys,
				"size":size
			},
			url: '<?php echo base_url();?>adminajax/generate_order_review_update_html',
			success: function(result)
			{
				//alert('success');
				var response = JSON.parse(result);
				jQuery('form#checkout #product_html, form#order_update #product_html').html(response.html);
			}
		});
	});


	/*### edit order data ###*/
	jQuery('a.change_order_data').on('click', function()
	{
		jQuery(this).parent().parent().find('span.order_data').toggle();
	});

	jQuery('body').on('click', '.apply_cost', function()
	{
		var product_ids = [];
		var product_qtys = [];

        jQuery.each(jQuery("form#checkout .item_qty, form#order_update .item_qty"), function()
		{            
            product_ids.push(jQuery(this).attr('data-item-id'));
            product_qtys.push(jQuery(this).val());
        });
		
		product_ids = product_ids.join(",");
		product_qtys = product_qtys.join(",");

		var service_cost = jQuery("form#checkout #service_cost, form#order_update #service_cost").val();
		var discount = jQuery("form#checkout #service_cost, form#order_update #discount").val();
		
		jQuery.ajax({
			type: 'POST',
			data: {
				"product_ids" : product_ids,
				"product_qtys" : product_qtys,
				"service_cost" : service_cost,
				"discount" : discount,
			},
			url: '<?php echo base_url();?>adminajax/generate_order_review_update_html_by_cost',
			success: function(result)
			{
				//alert('success');
				var response = JSON.parse(result);
				jQuery('form#checkout #product_html, form#order_update #product_html').html(response.html);
			}
		});
	});


	/*### change courier service list on change order area ###*/
	jQuery('#order_area input').on('change', function()
	{
		var order_area = jQuery('input[name=order_area]:checked', '#order_area').val();

		var subtotal_cost = parseFloat(jQuery('form#checkout #subtotal_cost').text().replace(',', ''));
		var shipping_charge_in_dhaka =  jQuery('form#checkout input[name=shipping_charge_in_dhaka]').val();
		var shipping_charge_out_of_dhaka =  jQuery('form#checkout input[name=shipping_charge_out_of_dhaka]').val();

		if(order_area=='inside_dhaka')
		{
			delivery_cost = shipping_charge_in_dhaka;
		}
		else if(order_area=='outside_dhaka')
		{
			delivery_cost = shipping_charge_out_of_dhaka;
		}

		//alert('subtotal_cost: '+subtotal_cost);
		//alert('delivery_cost: '+delivery_cost);

		delivery_cost = parseFloat(delivery_cost);
		total_cost = parseFloat(subtotal_cost + delivery_cost);
		total_cost = $.number(total_cost, 2);

		//alert('total_cost: '+total_cost);
		//alert('order_area: '+order_area);
		//alert('delivery_cost: '+delivery_cost);

		jQuery('form#checkout #delivery_cost').text(delivery_cost);
		jQuery('form#checkout input[name=shipping_charge]').val(delivery_cost);
		jQuery('form#checkout #total_cost').text(total_cost);
		jQuery('form#checkout input[name=order_total]').val(total_cost);

		jQuery.ajax({
			type: 'POST',
			data: {
				"order_area" : order_area
			},
			url: '<?php echo base_url();?>adminajax/order_area_based_courier_service_option',
			success: function(result)
			{
				//alert('success');
				var response = JSON.parse(result);
				//alert(response.html);
				jQuery('.courier_service_option_area').html(response.html);
			}
		});
	});
	
	
	/*### make order completed by ajax ###*/
	jQuery('.make_order_done').on('click', function()
	{
		var row_id=jQuery(this).attr('data-row_id');
		
		jQuery.ajax({
			type: 'POST',
			data: {"row_id" : row_id},
			url: '<?php echo base_url();?>ajax/make_order_done',
			success: function(result){
				/*alert('result: '+result);*/
				window.location.href = '?q=true&msg=successfully+completed+order';
			}
		});
		
		return false;
	});


	/*### delete multi row ###*/
	jQuery('#send_order_mail_to_courier').on('click', function()
	{
		var row_ids = "";
		$('input[type=checkbox]').each(function ()
		{
			if(this.checked)
			{
				row_ids += $(this).val()+",";
			}
			
		});
		
		/*alert('table: '+table);
		alert(row_ids);*/
		
		jQuery('body').append('<div id="cboxPopup"></div>');
		popup_dv_position_set('confirmAlertBox');
		jQuery('#confirmAlertBox').show();
		jQuery('#yesConfirm').attr('data-row_id', row_ids);
		jQuery('#yesConfirm').addClass('send_order_mail_to_courier');
		return false;
	});
	
	
	/*
	### delete table row ###
	*/
	/*# delete multi row #*/
	jQuery('#del_all').on('click', function()
	{
		var table=jQuery(this).attr('data-table');
		var row_ids = "";
		$('input[type=checkbox]').each(function ()
		{
			if(this.checked)
			{
				row_ids += $(this).val()+",";
			}
			
		});
		
		/*alert('table: '+table);
		alert(row_ids);*/
		
		jQuery('body').append('<div id="cboxPopup"></div>');
		popup_dv_position_set('confirmAlertBox');
		jQuery('#confirmAlertBox').show();
		jQuery('#yesConfirm').attr('data-row_id', row_ids);
		jQuery('#yesConfirm').attr('data-table', table);
		jQuery('#yesConfirm').attr('data-del', 'all');
		return false;
	});
	/*# delete single row #*/
	jQuery('.lnr.lnr-trash.delete').on('click', function()
	{
		var row_id=jQuery(this).attr('data-row_id');
		var table=jQuery(this).attr('data-table');
		
		/*alert('table_row_id: '+row_id);
		alert('table_name: '+table);*/
		
		jQuery('body').append('<div id="cboxPopup"></div>');
		popup_dv_position_set('confirmAlertBox');
		jQuery('#confirmAlertBox').show();
		jQuery('#yesConfirm').attr('data-row_id', row_id);
		jQuery('#yesConfirm').attr('data-table', table);
		jQuery('#yesConfirm').attr('data-del', 'single');
	});
	/*# confirm box #*/
	jQuery('#yesConfirm').on('click', function()
	{
		if(jQuery(this).hasClass('send_order_mail_to_courier'))
		{
			var row_ids = jQuery(this).attr('data-row_id');
			
			jQuery.ajax({
				type: 'POST',
				data: {"row_ids" : row_ids},
				url: '<?php echo base_url();?>adminajax/send_order_mail_to_courier',
				beforeSend: function()
				{
					jQuery('#yesConfirm').prepend('<span class="ajax-loader"></span>');
				},
				success: function(result)
				{
					jQuery('span.ajax-loader').remove();
					jQuery('#cboxPopup').remove();
					jQuery('#confirmAlertBox').hide();

					var response = JSON.parse(result);
					if(response.return==true)
					{
						window.location.href = '?q=success&msg=email+has-sent-to-courier-successflly';
					}
					else
					{
						window.location.href = '?q=failed&msg=sorry+email+not+sent+to+courier';
					}
				}
			});
		}
		else
		{
			var table_row_id = jQuery(this).attr('data-row_id');
			var table_name = jQuery(this).attr('data-table');
			var del_type = jQuery(this).attr('data-del');
			
			var ajax_url = '<?php echo base_url();?>ajax/delete_row_by_id';
			if(del_type == 'all')
			{
				ajax_url = '<?php echo base_url();?>ajax/delete_all_row';
			}
			
			jQuery.ajax({
				type: 'POST',
				data: {"table" : table_name, "row_id" : table_row_id},
				url: ajax_url,
				beforeSend: function()
				{
					jQuery('#yesConfirm').prepend('<span class="ajax-loader"></span>');
				},
				success: function(result)
				{
					jQuery('span.ajax-loader').remove();
					jQuery('#cboxPopup').remove();
					jQuery('#confirmAlertBox').hide();
					window.location.href = '?q=false&msg=successfully+deleted';
				}
			});
		}
	});
	/*# deny delete #*/
	jQuery('#noConfirm').on('click', function(){
		jQuery('#cboxPopup').remove();
		jQuery('#confirmAlertBox').hide();
	});
	
	var on_ready_category_id = $('#category_id').val();
	/*alert(on_ready_category_id);*/
	if(on_ready_category_id != '')
	{
		var on_ready_sub_cat = jQuery('input[name=sub_cat]').val();
		/*alert(on_ready_sub_cat);*/
		
		$.ajax({
			type: 'POST',
			data: {
				"category_id" : on_ready_category_id,
				"sub_cat" : on_ready_sub_cat
			},
			url: '<?php echo base_url();?>ajax/get_option_formate_sub_cat_by_cat_id',
			success: function(data){
				$('#sub_category_id').html(data);
			}
		});
	}
	$('#category_id').on('change',function(){
		var on_ready_sub_cat = jQuery('input[name=sub_cat]').val();
		/*alert(on_ready_sub_cat);*/
		
		$('#sub_category_id').html('<option selected>-- choose --</option>');
		var _val=$(this).val();
		$.ajax({
			type: 'POST',
			data: {
				"category_id" : _val,
				"sub_cat" : on_ready_sub_cat
			},
			url: '<?php echo base_url();?>ajax/get_option_formate_sub_cat_by_cat_id',
			success: function(data){
				$('#sub_category_id').html(data);
			}
		});
	});
	
	
	/*
	### copy to clipboard ###
	*/
	jQuery('.copyrefurl').on('click', function(){
		jQuery(this).parents('span').find('.select_text').focus().select();
		document.execCommand('copy');
		return false;
	});
	
	
	/*
	### remove gallery img ###
	*/
	jQuery('a.remove_gallery_img').on('click', function()
	{
		var product_id = jQuery(this).attr('data-product_id');
		var gallery_img_id = jQuery(this).attr('data-gallery_img');
		//alert('product_id: '+product_id);
		//alert('gallery_img_id: '+gallery_img_id);
		
		$.ajax({
			type: 'POST',
			data: {
				"product_id" : product_id,
				"gallery_img_id" : gallery_img_id
			},
			url: '<?php echo base_url();?>ajax/remove_gallery_img',
			success: function(data)
			{
				location.reload();
			}
		});
		
		return false;
	});
	
});


/*
### current link make active ###
// */
// jQuery(".main-sidebar a").each(function()
// {
// 	var path = window.location.href;
//     path = path.replace(/\/$/,"");
//     path = decodeURIComponent(path);
// 	var href = jQuery(this).attr('href');
//
// 	if(path.substring(0, href.length) === href)
// 	{
// 		jQuery(this).parent().parent().addClass('menu-open');
// 		jQuery(this).parent().parent().css({'display':'block'});
// 		jQuery(this).parent().parent().parent().addClass('active');
// 	}
// });
