// global variable
var manageMemberTable;
$(document).ready(function() {
	changeProductPowerType($("[name='ProductPowerTypeID']")[0])
	
});

function addEconomicProduct(){
		$("#add_productForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#add_productForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("add_productForm"));
		$.ajax({
			url: form.attr('action') ,
			type: form.attr('method'),
			//data: form.serialize(), // /converting the form data into array and sending it to server
			data:data,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#addEconomicProductModal").modal('hide');

					// update the manageMemberTable
					manageMemberTable.ajax.reload(null, false); 

				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("#"+index);

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);

						});
					} else {
						$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#addEconomicProductModal").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});
}

function LoadProductData(id)
{
	$.ajax({
		type: 'get',
		dataType:'json',
		url: '../Economic_product/get_product_data/'+id,
		success: function(response){
			$('#Edit_productForm input[type="checkbox"]').trigger('reset');
			$('#Edit_productForm input[type="radio"]').trigger('reset');
			$('#Edit_productForm input[type="text"]').trigger('reset');
			var product0 =response.product_data[0];
			var product1 =response.product_data[1];
			$('#Edit_productForm input[name="product_id"]').val(product0.ProductId);
			$('#EditEconomicProductModal #ProductTypeID'+product0.Product_Type).prop('checked','checked');
			changeEditProductType(product0.Product_Type);
			$('#EditEconomicProductModal #product_cat_edit ').val(product0.ProductCategoryID)
			$('#EditEconomicProductModal #product_cat_edit').trigger('chosen:updated')
			$('#EditEconomicProductModal #ManufacturingTechnique'+product0.manufacturing_technique).prop('checked','checked');
			$('#EditEconomicProductModal input[name="LuminaryMinWorkingTemperature"]').val(product0.MinWorkingTemperature)
			$('#EditEconomicProductModal input[name="LuminaryMaxWorkingTemperature"]').val(product0.MaxWorkingTemperature);
			$('#EditEconomicProductModal #EditProductPowerTypeID'+product0.PowerType).prop('checked','checked');
			changeProductPowerTypeInEdit($("#EditProductPowerTypeID"+product0.PowerType))
			$('#EditEconomicProductModal #led_type'+product0.led_type).prop('checked','checked');
			if(product0.driver_type)
			{
				$('#EditEconomicProductModal #DriverType'+product0.driver_type).prop('checked','checked');

			}
			if(product0.product_function)
			{
				$('#EditEconomicProductModal #ACProductFunction'+product0.driver_type).prop('checked','checked');

			}
			if(product0.Firerated==1)
			{
				$('#EditEconomicProductModal #firerated').prop('checked','checked');

			}
			$('#EditEconomicProductModal #FamilyShortcut').html("Family shortcut code : "+product0.family_shortcut_code);
			$('#EditEconomicProductModal #economic_product_language_id'+product0.Language_id).val(product0.economic_product_language_id);
			$('#EditEconomicProductModal #economic_product_language_id'+product1.Language_id).val(product1.economic_product_language_id);
			$('#EditEconomicProductModal #EditFamilyName'+product0.Language_id).val(product0.Family_name);
			$('#EditEconomicProductModal #EditFamilyName'+product0.Language_id).val(product0.Family_name);
			$('#EditEconomicProductModal #EditFamilyName'+product1.Language_id).val(product1.Family_name);
			CKEDITOR.instances['EditFamilyDesc'+product0.Language_id].setData(product0.Family_description);			
			CKEDITOR.instances['EditFamilyDesc'+product1.Language_id].setData(product1.Family_description);

			//certification
			$("#EditEconomicProductModal #certification option:selected").prop("selected", false);
			response.certifications.forEach(element => {
				$("#EditEconomicProductModal #certification").find("option[value="+element.CertificationID+"]").prop("selected", "selected");
			});
			$('#EditEconomicProductModal #certification').trigger('chosen:updated')
			//old_certification
			$("#EditEconomicProductModal #old_certification option:selected").prop("selected", false);
			response.certifications.forEach(element => {
				$("#EditEconomicProductModal #old_certification").find("option[value="+element.CertificationID+"]").prop("selected", "selected");
			});
			$('#EditEconomicProductModal #certification').trigger('chosen:updated')
			//installation_way
			$("#EditEconomicProductModal #installation_way option:selected").prop("selected", false);
			response.installation_ways.forEach(element => {
				$("#EditEconomicProductModal #installation_way").find("option[value="+element.installation_way_id+"]").prop("selected", "selected");
			});
			$('#EditEconomicProductModal #installation_way').trigger('chosen:updated')
			//old_installation_way
			$("#EditEconomicProductModal #old_installation_way option:selected").prop("selected", false);
			response.installation_ways.forEach(element => {
				$("#EditEconomicProductModal #old_installation_way").find("option[value="+element.installation_way_id+"]").prop("selected", "selected");
			});
			$('#EditEconomicProductModal #installation_way').trigger('chosen:updated')
			//application
			$("#EditEconomicProductModal #application option:selected").prop("selected", false);
			response.applications.forEach(element => {
				$("#EditEconomicProductModal #application").find("option[value="+element.ApplicationID+"]").prop("selected", "selected");
			});
			$('#EditEconomicProductModal #application').trigger('chosen:updated')
			//old_application
			$("#EditEconomicProductModal #old_application option:selected").prop("selected", false);
			response.applications.forEach(element => {
				$("#EditEconomicProductModal #old_application").find("option[value="+element.ApplicationID+"]").prop("selected", "selected");
			});
			$('#EditEconomicProductModal #old_application').trigger('chosen:updated')
		}

	});	
}


function editEconomicProduct(id) {
	LoadProductData(id);
	$("#Edit_productForm").unbind('submit').bind('submit', function() {
	var form = $(this);
	// remove the text-danger
	$(".text-danger").remove();
	var data = new FormData(document.getElementById("Edit_productForm"));
	$.ajax({
		url: form.attr('action') ,
		type: form.attr('method'),
		data:data,
		async: false,
		processData: false,
		contentType: false,
		dataType: 'json',
		success:function(response) {
			if(response.success === true) {
				$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
				  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
				  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
				  '</div>');

				// hide the modal
				$("#EditEconomicProductModal").modal('hide');

				// update the manageMemberTable
				manageMemberTable.ajax.reload(null, false); 

			} else {
				if(response.messages instanceof Object) {
					$.each(response.messages, function(index, value) {
						var id = $("#"+index);

						id
						.closest('.form-group')
						.removeClass('has-error')
						.removeClass('has-success')
						.addClass(value.length > 0 ? 'has-error' : 'has-success')
						.after(value);

					});
				} else {
					$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
					'</div>');
					// hide the modal
					$("#EditEconomicProductModal").modal('hide');
					// update the manageMemberTable
					manageMemberTable.ajax.reload(null, false); 
				}
			}
		}
	});	

	return false;
});

}
function deleteEconomicProduct(id = null) 
{
	if(id) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: './Premium_product/delete_premium_product' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#deletePremiumProductModal").modal('hide');

						// update the manageMemberTable
						managePremiumProductMemberTable.ajax.reload(null, false); 
					} else {
						$('.text-danger').remove()
						if(response.messages instanceof Object) {
							$.each(response.messages, function(index, value) {
								var id = $("#"+index);

								id
								.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')										
								.after(value);										

							});
						} else {
							$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
						}
					}
				} // /succes
			}); // /ajax
		});
	}
}

function changeProductType(val) 
  {
      //has subcategory
      $.ajax({
      async: false,
      type: 'post',
      url: '../indexes/Product_category/get_subcategory',
      data: {'id':val},
       success: function(result){

          $('#product_cat').empty(); //remove all child nodes
          var obj=JSON.parse(result);
          $.each(obj, function () {
              var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
             $('#product_cat').append(newOption);
          });
          $('#product_cat').trigger("chosen:updated");
          
       }
      });
  }

  function changeEditProductType(val) 
  {
      //has subcategory
      $.ajax({
      async: false,
      type: 'post',
      url: '../indexes/Product_category/get_subcategory',
      data: {'id':val},
       success: function(result){

          $('#product_cat_edit').empty(); //remove all child nodes
          var obj=JSON.parse(result);
          $.each(obj, function () {
              var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
             $('#product_cat_edit').append(newOption);
          });
          $('#product_cat_edit').trigger("chosen:updated");
       }
      });
  }
  function change_family(elm){
    //alert( "Handler for .change() called."+elm.value );
     $.ajax({
        async: false,
        type: 'post',
        url: '../Economic_product/family_exist',
        data: {'Family_name':elm.value},
         success: function(result){
            if(result=='true')
            {
                sweetAlert("Oops...", "this family exist !!", "error");
                elm.value='';
            }
         }
     });
   }

   function upload_photos(product_id = null) 
{
	if(product_id) {

		$("#change_product_photoForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#change_product_photoForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("change_product_photoForm"));
		$.ajax({
			url: form.attr('action') + '/' + product_id ,
			type: form.attr('method'),
			//data: form.serialize(), // /converting the form data into array and sending it to server
			data:data,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#uploadPhotosModal").modal('hide');

					// update the manageMemberTable
					manageMemberTable.ajax.reload(null, false); 

				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("#"+index);

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);

						});
					} else {
						$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#uploadPhotosModal").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});
	}
	else {
		alert('error');
	}
}

function updateApplicationPhoto(product_id = null) 
{
	if(product_id) {
		$('#power_table').find('tr').remove();
		$.ajax({
	      async: true,
	      type: 'post',
	      url: '../Premium_product/get_product_installation_way',
	      data: {'id':product_id},
	       success: function(result){
	       	var html='';
          	var obj=JSON.parse(result);
	          $.each(obj, function (key, value) {
	      		html+= '<option value='+this['ID']+'>'+this['Name']+'</option>';
	          });

	       	$('#Installation_way_id')
			    .empty()
			    .append(html);
	       }
	      });

		$("#change_application_photoForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#change_application_photoForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("change_application_photoForm"));
		$.ajax({
			url: form.attr('action') + '/' + product_id ,
			type: form.attr('method'),
			data:data,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#uploadApplicationPhotosModal").modal('hide');

					// update the manageMemberTable
					manageMemberTable.ajax.reload(null, false); 

				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("#"+index);

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);

						});
					} else {
						$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#uploadApplicationPhotosModal").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});
	}
	else {
		alert('error');
	}
}

function checkEconomicProduct(id = null) 
{
	if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('#error_msg').html("");
		$("#checkMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: './set_economic_product_collection_code' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#checkEconomicProductModal").modal('hide');

						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					} else {
						$('.text-danger').remove()
						if(response.messages instanceof Object) {
							$.each(response.messages, function(index, value) {
								var id = $("#"+index);

								id
								.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')										
								.html(value);										

							});
						} else {
							$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
						}
					}
				} // /succes
			}); // /ajax
		});
	}
}

function changeLightSourceType(sel) 
{
  var res =sel.labels[0].textContent.toLowerCase();
  if(res== "led")
      	$("#led_type_div").removeClass("hide");
    else
  		$("#led_type_div").addClass("hide");
  
}

function changeProductPowerType(sel) {
	var res =sel.value;
	switch(res){
		case "1":
			$("#AC_row").addClass("hide");
			$("#DriverType").removeClass("hide");
			$($("[name='DriverType']")[0]).parent().parent().addClass('hide');
			$($("[name='DriverType']")[3]).parent().parent().addClass('hide');
			$($("[name='DriverType']")[1]).parent().parent().removeClass('hide');
			$($("[name='DriverType']")[2]).parent().parent().removeClass('hide');
			break;
		case "2":
			$("#AC_row").addClass("hide");
			$("#DriverType").addClass("hide");
			break;
		case "3":
			$("#AC_row").removeClass("hide");
			$("#DriverType").removeClass("hide");
			$($("[name='DriverType']")[1]).parent().parent().addClass('hide');
			$($("[name='DriverType']")[2]).parent().parent().addClass('hide');
			$($("[name='DriverType']")[0]).parent().parent().removeClass('hide');
			$($("[name='DriverType']")[3]).parent().parent().removeClass('hide');
			break;
	}
}

function changeProductPowerTypeInEdit(sel) {
	
	
	var res ;
	if(sel.value)
	{
		res = sel.value;
	}
	else{
		res=sel.val();
	}
	switch(res){
		case "1":
			$("#AC_row_edit").addClass("hide");
			$("#DriverTypeEdit").removeClass("hide");
			$($("#DriverTypeEdit [name='DriverType']")[0]).parent().parent().addClass('hide');
			$($("#DriverTypeEdit [name='DriverType']")[3]).parent().parent().addClass('hide');
			$($("#DriverTypeEdit [name='DriverType']")[1]).parent().parent().removeClass('hide');
			$($("#DriverTypeEdit [name='DriverType']")[2]).parent().parent().removeClass('hide');
			break;
		case "2":
			$("#AC_row_edit").addClass("hide");
			$("#DriverTypeEdit").addClass("hide");
			break;
		case "3":
			$("#AC_row_edit").removeClass("hide");
			$("#DriverTypeEdit").removeClass("hide");
			$($("#DriverTypeEdit [name='DriverType']")[1]).parent().parent().addClass('hide');
			$($("#DriverTypeEdit [name='DriverType']")[2]).parent().parent().addClass('hide');
			$($("#DriverTypeEdit [name='DriverType']")[0]).parent().parent().removeClass('hide');
			$($("#DriverTypeEdit [name='DriverType']")[3]).parent().parent().removeClass('hide');
			break;
	}
}