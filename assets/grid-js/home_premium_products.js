// global variable
var manageAccessoryMemberTable;
$(document).ready(function() {
	managePremiumProductMemberTable = $("#PremiumProductMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		'ajax': './Premium_product/fetchMemberData/-2',
		'order': []
	});


});

$(function(){
    $('.tab-pane input, .tab-pane textarea').on('invalid', function(){
 
       // Find the tab-pane that this element is inside, and get the id
       var $closest = $(this).closest('.tab-pane'); 
       var id = $closest.attr('id'); 
 
       // Find the link that corresponds to the pane and have it show
       $('.nav a[href="#' + id + '"]').tab('show'); 
 
    });
});

function deletePremiumProduct(id = null) 
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

function checkPremiumProduct(id = null) 
{
	if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('#error_msg').html("");
		$("#checkMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: './Premium_product/set_premium_product_collection_code' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#checkPremiumProductModal").modal('hide');

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
					managePremiumProductMemberTable.ajax.reload(null, false); 

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
						managePremiumProductMemberTable.ajax.reload(null, false); 
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
	      url: './Premium_product/get_product_installation_way',
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
					managePremiumProductMemberTable.ajax.reload(null, false); 

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
						managePremiumProductMemberTable.ajax.reload(null, false); 
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

function update_color_series_photo(product_id) 
{
	if(product_id) {
		$('#blankModal .modal-title').html('Family color series');
		$.ajax({
	      async: true,
	      type: 'post',
	      url: './Premium_product/get_product_color_series/'+product_id,
	       success: function(result){
	       	var html='';
          	var obj=JSON.parse(result);
	        var url=obj['base_url'];
	        var Product_id = obj['Product_id'];
	        var color_series_photo_data= obj['color_series_photo_data'];
	        var index =1;

	        $.each(obj['color_series_data'], function (key1, value1) {
	        	html += '<div class="row"><div class="col-xs-6">'
	        	 +'<p class="section-subtitle">Color Series #'+ (index) +'</p>';

	        	$.each(value1, function (key, value) {
	        		html += '<p><img hight=20 width=20 style="border-radius: 50%;" src="'+url+'/upload_files/Texture/'+value['Texture_photo']+'" /> '+value['part'] + '-'+value['material'] + '-' +value['color'] + '</p>';
	        	});

	        	if (color_series_photo_data.length !=0) 
	        	{
	        		html += '</div><div class="col-xs-6">';
	        		if(color_series_photo_data[key1]) {
						html += '<div id="color_series_photo'+value1[0]['ID']+'"><img src="'+ url +'/upload_files/Product/Premium/'+ Product_id+'/'+color_series_photo_data[key1] +'" width="50%" >'
							+'<a onclick="delete_color_photo(\''+color_series_photo_data[key1] +'\','+value1[0]['ID']+','+ Product_id+',\''+url+'\')" >delete</a></div>';
					}
					else{
						html += '<img src="'+ url +'/upload_files/Product/gallery_default.png" width="50%" id="color_series_img_'+value1[0]['ID']+'" >'
							+'<input type="file" name="color_series_photo_'+value1[0]['ID']+'" onchange="save_color_photo(this,'+value1[0]['ID']+','+ Product_id+',\''+url+'\')"  accept="image/*"/>'
							;
							
					}
					html += '</div>';
	        	}
	        	html += '</div>';
				index++;
	        });
        	$('#blank_data')
		    .empty()
		    .append(html);
	       
	         }
	      });
	}
	else {
		alert('error');
	}
}

function save_color_photo(input ,color_series_id , Product_id,url){

	if (input.files && input.files[0]) {

		var reader = new FileReader();

	    var myFormData = new FormData();
		myFormData.append('file', input.files[0]);
	    $.ajax({
			url: './Premium_product/change_product_color_series_photo/'+Product_id+'/'+color_series_id,
			type: 'post',		
			data: myFormData,
			async: false,
			processData: false,
			contentType: false,
			cache:false,
			dataType: 'json',
			success:function(response) {

				if(response.success === true) {

				    reader.onload = function (e) {
				        $('#color_series_img_'+color_series_id).attr('src', e.target.result);
				    }

				    reader.readAsDataURL(input.files[0]);
				}
			} // /succes
		}); // /ajax
	}
}

function delete_color_photo(file_name ,color_series_id , Product_id,url){
	$.ajax({
			url: './Premium_product/delete_color_series_photo',
			type: 'post',				
			dataType: 'json',
			data: {'file_name':file_name,
					'color_series_id':color_series_id,
					'Product_id': Product_id
					},
			success:function(response) {
				if(response.success === true) {
					html = '<img src="'+ url +'/upload_files/Product/gallery_default.png" width="50%" id="color_series_img_'+color_series_id+'" >'
							+'<input type="file" name="color_series_photo_'+color_series_id+'" onchange="save_color_photo(this,'+color_series_id+','+ Product_id+',\''+url+'\')"  accept="image/*"/>'
							//+'<a onclick="save_color_photo('+value1[0]['ID'] +','+value1[0]['ID']+','+ Product_id+','+url+')" >save</a>';
							;
					$('#color_series_photo'+color_series_id)
					    .empty()
					    .append(html);
				} else {
					
				}
			} // /succes
		}); // /ajax
}

function change_family_order(premium_id) 
{
	if(premium_id) {
		$solution = $('[name="filter"]:checked').val();

		$("#change_premium_display_orderForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: './Premium_product/get_premium_product_info/'+premium_id+'/'+ $solution,
			type: 'post',
			dataType: 'json',
			success:function(response) {

				$("#family_order").val(response.display_order);

				$("#change_premium_display_orderForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' + premium_id+'/'+ $solution,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
								$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#premiumFamilyOrderModal").modal('hide');

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
									// hide the modal
									$("#premiumFamilyOrderModal").modal('hide');
								}
							}
						} // /succes
					}); // /ajax

					return false;
				});
				
			}
		});
	}
	else {
		alert('error');
	}
}

function change_family_description(premium_id,type) 
{
	if(premium_id) {

		$("#change_premium_display_descriptionForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: './Premium_product/get_product_family_description/'+premium_id,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				var language_count = $("input[name='ProductFamily[]']").length;
				$.each(response, function(index, value) {
					for (var i = 0; i < language_count; i++) {
						if (value.Language_id == $("input[name='Language_id[]']")[i].value) {
							$("input[name='ProductFamily[]']")[i].value = value.Family_name;
							$("input[name='ProductFamily_language_id[]']")[i].value = value.ID;
							
						    var editor = CKEDITOR.instances['ProductFamilyDescription'+value.Language_id];
						    if (editor) { editor.destroy(true); }
							    
							if (type=="Family_description"){
								$("textarea[name='ProductFamilyDescription[]']")[i].value = value.Family_description;
								
							    CKEDITOR.replace('ProductFamilyDescription'+value.Language_id);
							}
							else{
								if (value.datasheet_description==null) {
									$("textarea[name='ProductFamilyDescription[]']")[i].value = value.Family_description;
								}
								else
									$("textarea[name='ProductFamilyDescription[]']")[i].value = value.datasheet_description;
							}
							
							break;
						}
					}

				});

				$("#change_premium_display_descriptionForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);
					for (instance in CKEDITOR.instances) {
				        CKEDITOR.instances[instance].updateElement();
				    }
					$.ajax({
						url: form.attr('action') + '/' + premium_id + '/' + type,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
								$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#premiumFamilyDescriptionModal").modal('hide');

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
									// hide the modal
									$("#premiumFamilyDescriptionModal").modal('hide');
								}
							}
						} // /succes
					}); // /ajax

					return false;
				});
				
			}
		});
	}
	else {
		alert('error');
	}
}

function family_filter(element,id = 0) {
	if ( $.fn.dataTable.isDataTable('#PremiumProductMemberTable') ) {
	    managePremiumProductMemberTable.destroy();
	    //$('#PremiumProductMemberTable').empty(); 
  	}
	managePremiumProductMemberTable = $("#PremiumProductMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		'ajax': './Premium_product/fetchMemberData/'+id,
		'order': []
	});	
}

//update IES files
function update_ies_file(Product_id) 
{
	if(Product_id) {
		$('#blankModal .modal-title').html('Family beam angle values');
		$.ajax({
	      async: true,
	      type: 'post',
	      url: './Premium_product/get_premium_beamangle/'+Product_id,
	       success: function(result){
	       	var html='';
          	var obj=JSON.parse(result);
	        var url=obj['base_url'];
	        var Product_id = obj['Product_id'];
			var beamangle_data= obj['beamangle_data'];
			$('#blank_data').empty().append('<div class="tableFixHead_beamangle" ><table id="beam_angle_data" class="table table-striped table-bordered">'
				+'<tr><td>Beam angle</td><td>Power</td><td>IES file</td><td>Photo</td></tr>');
			var BeamAngleValue = null,
				BeamAngleH = null,
				BeamAngleV = null,
				tr_count = 0,
				is_new_row = true;
	        $.each(obj['beamangle_data'], function (key1, value1) {
				html = '<tr>';
				//new row for beam angle
				if (!((value1['BeamAngleH'] == BeamAngleH) && (value1['BeamAngleV'] == BeamAngleV) && (value1['BeamAngleValue'] == BeamAngleValue))) {
					tr_count = 1;
					if (value1['SymmetricBeam'] == "1") {
						html += '<td class="BA_cell" rowspan=1>' + value1['BeamAngleValue'] + '</td>';
					}
					else
						html += '<td class="BA_cell" rowspan=1>' + value1['BeamAngleH'] + " x " + value1['BeamAngleV'] +'</td>';
					is_new_row = true;
				}
				else{
					is_new_row = false;
				}

				html += '<td>'+ (value1['Power_up']+'/'+value1['Power']) +'</td>';
				if (value1['IES_file']) 
				{
					html += '<td>'
						+'<a id="ies_link_'+key1+'" href="'+ url +'/upload_files/Product/Premium/'+ Product_id+'/'+value1['IES_file'] +'" download>'+value1['IES_file']+'</a>';
				}
				else{
					html += '<td><a id="ies_link_'+key1+'" download>empty</a>';
				}
				html += '<input type="file" name="ies_file_" onchange="save_ies_file(this,\'ies_link_'+key1+'\','+ Product_id+',\'IES_file\','+value1['SymmetricBeam']+','+ value1['BeamAngleH']+','+value1['BeamAngleV']+','+value1['BeamAngleValue']+','+value1['Power']+','+value1['Power_up']+',\''+url +'/upload_files/Product/Premium/'+ Product_id+'/\')"  accept=".ies"/></td>'
						;
				if(value1['photometric_photo']) {
					html += '<td><img id="photometric_'+key1+'" src="'+ url +'/upload_files/Product/Premium/'+ Product_id+'/'+value1['photometric_photo'] +'" width="120px" >';
				}
				else{
					html += '<td><img id="photometric_'+key1+'" src="'+ url +'/upload_files/Product/photometric_default.jpg" width="120px">';
				}
				html += '<input type="file" name="" onchange="save_ies_file(this,\'photometric_'+key1+'\','+ Product_id+',\'photometric_photo\','+value1['SymmetricBeam']+','+ value1['BeamAngleH']+','+value1['BeamAngleV']+','+value1['BeamAngleValue']+','+value1['Power']+','+value1['Power_up']+',\''+url+'\')"  accept="image/*"/></td>'
						;
				
				html += '</tr>';
				$('#beam_angle_data').append(html);
				if(!is_new_row){
					tr_count ++;
					//get last row added
					$('#beam_angle_data .BA_cell:last').attr('rowspan',tr_count);
				}
				BeamAngleV = value1['BeamAngleV'];
				BeamAngleH = value1['BeamAngleH'];
				BeamAngleValue = value1['BeamAngleValue'];
			});
			$('#beam_angle_data').append('</table></div>');
	       
	         }
	      });
	}
	else {
		alert('error');
	}
}

//save iesfile
function save_ies_file(input ,id, product_id, file_type, SymmetricBeam, BeamAngleH, BeamAngleV, BeamAngleValue, power, power_up,url){
	if (input.files && input.files[0]) {

		var reader = new FileReader();
		var myFormData = new FormData();
		myFormData.append('file', input.files[0]);
		reader.fileName = url+input.files[0].name;
		$.ajax({
			url: './Premium_product/change_premium_beamangle_file/'+product_id+'/'+ file_type+'/'+ SymmetricBeam+ '/'+ BeamAngleH +'/'+ BeamAngleV +'/'+ BeamAngleValue+ '/'+ power+ '/'+ power_up,
			type: 'post',		
			data: myFormData,
			async: false,
			processData: false,
			contentType: false,
			cache:false,
			dataType: 'json',
			success:function(response) {

				if(response.success === true) {
					
					reader.onload = function (e) {
						if (response.file_type == "IES_file") {
							$('#'+id).attr('href', e.target.fileName);
							$('#'+id).text(input.files[0].name);
						}
						else
							$('#'+id).attr('src', e.target.result);
						input.value="";
					}

					reader.readAsDataURL(input.files[0]);
				}
			} // /succes
		}); // /ajax
	}
}