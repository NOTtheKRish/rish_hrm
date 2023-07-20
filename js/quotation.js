$(document).ready(function(){
	//Getting Description and Price by selecting Item
	$(document).on('input','#item_1',function(){
		var item=$('#item_1 :selected').val();
		$.ajax({
			url: "invoice-getdata.php",
			method: "POST",
			dataType: "JSON",
			data:{id:item},
			success:function(response){
				$('#description_1').val(response.description);
				$('#price_1').val(response.price);
				$('#taxRate_1').val(response.tax);
			}
		});
	});


	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		var items=$('#item_1 :selected').text();
		var description=$('#description_1').val();
		var quantity=$('#quantity_1').val();
		var price=$('#price_1').val();
		var taxRate=$('#taxRate_1').val();
		var Total=$('#total_1').val();
		var taxTotal=$('#taxTot_1').val();
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
        htmlRows+='<td><input class="itemRow" type="checkbox"></td>';
        // htmlRows+='<td><input type="text" name="item[]" id="item_'+count+'" class="form-control" autocomplete="off" value="'+items+'"></td>';
        htmlRows+='<td><input type="text" name="item[]" id="item_'+count+'" class="form-control" hidden autocomplete="off" value="'+items+'"><textarea class="form-control mt-2" hidden name="description[]" id="description_'+count+'" cols="30" rows="1">'+description+'</textarea><h6><strong>'+items+'</strong></h6><h6 class="mt-2">'+description+'</h6></td>';
		// htmlRows+='<td><textarea class="form-control" name="description[]" id="description_'+count+'" cols="30" rows="1">'+description+'</textarea></td>';
        htmlRows+='<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" hidden autocomplete="off" style="max-width:100px;" value="'+quantity+'"><h6><strong>'+quantity+'</strong></h6></td>';
        htmlRows+='<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" hidden autocomplete="off" style="max-width:150px;" value="'+price+'"><h6><strong>'+price+'</strong></h6></td>';
        htmlRows+='<td><input type="number" name="taxRate[]" id="taxRate_'+count+'" class="form-control taxRate" hidden autocomplete="off" style="max-width:150px;" value="'+taxRate+'"><h6><strong>'+taxRate+'</strong></h6></td>';
        htmlRows+='<td><input type="number" name="taxTot[]" id="taxTot_'+count+'" class="form-control taxTot" hidden autocomplete="off" value="'+taxTotal+'"><h6><strong>'+taxTotal+'</strong></h6></td>';
        htmlRows+='<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" hidden autocomplete="off" value="'+Total+'"><h6><strong>'+Total+'</strong></h6></td>';
		htmlRows += '</tr>';

		$('#quotationItem').append(htmlRows);
		//emptying top row for next item
		$('#item_1').prop('selectedIndex',0);
		$('#description_1').val('');
		$('#quantity_1').val('');
		$('#price_1').val('');
		$('#taxRate_1').val('');
		$('#total_1').val('');
		$('#taxTot_1').val('');
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('input', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('input', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('input', "[id^=taxRate_]", function(){		
		calculateTotal();
	});	
});	
/*function calculateTotal(){
	var totalAmount=0; //subtotal
    var gst=0; //total tax amount
    var totalFinalAmount=0; //final amount with tax
	$("[id^='taxRate_']").each(function() {
		var id=$(this).attr('id');
		id=id.replace("taxRate_",'');
        var tax=$('#taxRate_'+id).val();
		var price=$('#price_'+id).val();
		var quantity=$('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
        var totTax=(total*tax)/100;
		$('#taxTot_'+id).val(totTax);
        // var gst=parseFloat(totTax)/2;
        var totalAmt=(parseFloat(total)+parseFloat(totTax));
        //Adding tax amt to total amount
		$('#total_'+id).val(total);
        totalAmount+=total;
		totalFinalAmount += totalAmt;
        gst+=totTax;
        $('#totalAfterTax').val(totalFinalAmount);
        $('#CGSTtaxAmount').val(gst/2);
        $('#SGSTtaxAmount').val(gst/2);
		// $('#total_'+id).val((parseFloat(total)+parseFloat(totWithTax)));
		$('#subTotal').val(parseFloat(totalAmount));	
	});
	// var taxRate = $("#taxRate").val();
	// var subTotal = $('#subTotal').val();
    
	// if(subTotal) {
	// 	var taxAmount = subTotal*taxRate/100;
	// 	$('#taxAmount').val(taxAmount);
	// 	subTotal = parseFloat(subTotal)+parseFloat(totWithTax);
	// 	$('#totalAftertax').val(subTotal);		
	// 	var amountPaid = $('#amountPaid').val();
	// 	var totalAftertax = $('#totalAftertax').val();	
	// 	if(amountPaid && totalAftertax) {
	// 		totalAftertax = totalAftertax-amountPaid;			
	// 		$('#amountDue').val(totalAftertax);
	// 	} else {		
	// 		$('#amountDue').val(subTotal);
	// 	}
	// }
}*/

function calculateTotal(){
	var count = $(".itemRow").length;
	if(count>=0){
		var totalAmount=0; // total amount w/o tax
		var gst=0; //total tax amount
		var totalFinalAmount=0; //final amount with tax
		$("[id^='taxRate_']").each(function() {
			var id=$(this).attr('id');
			id=id.replace("taxRate_",'');
			var price=$('#price_'+id).val();
			var tax=$('#taxRate_'+id).val();
			var quantity=$('#quantity_'+id).val();
			var total = parseFloat(price)*parseFloat(quantity);
			var totTax=(total*tax)/100;
			$('#taxTot_'+id).val(parseFloat(totTax));
			total = parseFloat(total)+parseFloat(totTax);
			$('#total_'+id).val(parseFloat(total));	
			//Adding tax amt to total amount
			
			totalAmount+=total;
			gst+=totTax;
		});
	}
}