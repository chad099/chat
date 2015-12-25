$(document).ready(function(){
	
	$('.appsubmit').click(function(){
		$('.progress').show();
		 $('#errors').html('');	
		 var app_demo = CKEDITOR.instances['app_demo'].getData();
		 $('#app_demo').val(app_demo);
		 var app_install = CKEDITOR.instances['app_install'].getData();
		 $('#app_install').val(app_install);
		 var app_requirement = CKEDITOR.instances['app_requirement'].getData();
		 $('#app_requirement').val(app_requirement);
		$.ajax({
			url : '/admin/app/add',
			type: 'post',
			data : $('form#createpostform').serialize()+'&action='+$(this).val(),
			success : function(response){
				 $('.progress').hide();
				 if(response.status=='error'){
					 var Errors ='<p>Following errors have occurred:</p>';
					 $.each(response.message,function(key,value){
						 Errors +='<li style="color:#ee6e73;">'+value+'</li>';
						 });
						 $('.errors').html(Errors);				 
					 }else if(response.status=='success'){
						 Materialize.toast(response.message, 4000);
						 }else{
							 Materialize.toast('Something went wrong', 4000);
							 }
					
				}
			
			});
		});
$('body').on('click','.appedit',function(){
	$('ul.tabs').tabs('select_tab', 'create_app');
	app_id = $(this).attr('data-id');
	$.ajax({
			url : '/admin/app/edit',
			type: 'post',
			data : 'app_id='+app_id,
			beforeSend : function(){ $('.progress').show(); },
			success : function(response){
				$('.progress').hide();
				$('#appsubmitbutton').text('Update');
				$('#appsavebutton').attr('disable',true);
				$('#selectpost').val(response.post_id);
				$('#app_id_update').val(response.id);
				$('#app_title').val(response.app_title);
				$('#post_id').val(response.post_id);
				$('#app_description').val(response.app_description);
				//$('#app_demo').val(response.app_demo);
				CKEDITOR.instances['app_demo'].setData(response.app_demo);
				CKEDITOR.instances['app_install'].setData(response.app_installation);
				CKEDITOR.instances['app_requirement'].setData(response.app_requirement);
				$('select').material_select();
				}
		});
	
	});
	
$('body').on('click','.appdelete',function(){
	$this = $(this);
	if(!confirm('Are you sure you want to delete app !'))
		return false;
	var app_id  = $(this).attr('data-id');
	if(!app_id)
		return false;
	$.ajax({
		url : '/admin/app/softdelete',
		type: 'post',
		data : 'app_id='+app_id,
		beforeSend : function(){ $('.progress').show(); },
		success  : function(response){
					$('.progress').hide();
					if(response.status=='success'){
						$this.parent().parent().remove();
						Materialize.toast('App delete successfully',5000);
						}else if(response.status=='error'){
							Materialize.toast('App not delete successfully',5000);
							}else{
								Materialize.toast('Something went wrong please try again !',5000);
								}
			} 
		
		});	
	
	});	
	
$('body').on('click','.apprestore',function(){
	$this = $(this);
	$.post('/admin/app/restore',{app_id:$(this).attr('data-id')},function(response){
			if(response.status=='success'){
				$this.parent().parent().remove();
				Materialize.toast('App restore successfully',5000);
				}else if(response.status=='error'){
					Materialize.toast('App not restore please try again',5000);
					}else{
						Materialize.toast('Something went wrong',5000);
						}
		});
	
	});	
$('body').on('click','.appremove',function(){
	if(!confirm('Are you sure want to remove app ?')){
		return false;
		}
	$this = $(this);
	$.post('/admin/app/remove',{app_id:$(this).attr('data-id')},function(response){
			if(response.status=='success'){
				$this.parent().parent().remove();
				Materialize.toast('App remove from database successfully',5000);
				}else if(response.status=='error'){
					Materialize.toast('App not remove please try again',5000);
					}else{
						Materialize.toast('Something went wrong',5000);
						}
		});
	
	});
	
$('body').on('click','.checkappstatus',function(){
	var status = $(this).attr('data-status');
	$this = $(this)
	if(status=='published')
		status = 'unpublished';
	else
		status = 'published';

	$('.progress').show(); 
	$.post('/admin/app/changestatus',{app_id : $(this).attr('id'), status:status},function(response){
			$('.progress').hide();
			if(response.status=='success'){
				if(response.app_status=='published'){
					$this.attr('checked',true);
					}
				else{
					$this.attr('checked',false);
					}	
				$this.parent().find('label').text(status);	
				$this.attr('data-status',status);	
				Materialize.toast('App '+status+' successfully',5000);
				}else{
					Materialize.toast('Something went wrong please try again',5000);
					}
		});	
		
	});			
	
});
