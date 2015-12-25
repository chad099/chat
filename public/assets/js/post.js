$(document).ready(function(){
	$('#getnicescroll').niceScroll({
					cursorcolor:"#ee6e73", 
					cursorwidth:"10px",
					cursorborderradius: '0px',
					
					});
					
$('.publish_button').click(function(){
	$('.progress').show();
	 $('#errors').html('');	
	 var post_content = CKEDITOR.instances['post_content'].getData();
	 var post_title = $('#post_content').val(post_content);
	$.ajax({
		url : '/admin/post/add',
		type: 'post',
		data : $('form#postform').serialize()+'&action='+$(this).val(),
		success : function(response){
			 $('.progress').hide();
			 if(response.status=='error'){
				 var Errors ='<p>Following errors have occurred:</p>';
				 $.each(response.message,function(key,value){
					 Errors +='<li style="color:#ee6e73;">'+value+'</li>';
					 });
					 $('#errors').html(Errors);				 
				 }else if(response.status=='success'){
					 Materialize.toast(response.message, 4000);
					 }else{
						 Materialize.toast('Something went wrong', 4000);
						 }
				
			}
		
		});
	
	});			
	
$('#search').keyup(function(){
	var keyword =$(this).val();
	$this  = $('#getnicescroll').find('p').find('input');
	 $this.each(function(){
		 var kval = $(this).attr('data-name');
		 if(kval.indexOf(keyword)){
			 $(this).parent().appendTo('#getnicescroll');
			 }
		 });
	});			
	
	
	
$('.postedit').click(function(){
	
	$('ul.tabs').tabs('select_tab', 'create_post');
	$.ajax({
		url : '/admin/post/edit',
		type: 'post',
		data : 'post_id='+$(this).attr('data-id'),
		beforeSend : function(){ $('.progress').show(); },
		success : function(response){
				$('.progress').hide();
				if(response.status=='success'){
					$('#post_title').val(response.post.post_title);
					CKEDITOR.instances['post_content'].setData(response.post.post_content);
					$('#post_id').val(response.post.id);
					$.each(response.tags,function(){
						$('#getnicescroll').find('input[value="'+this.nav_id+'"]').attr('checked', true);
						});
					if(response.post.post_status=='publish'){
								$('#post_publish_button').attr('disabled', false);
								$('#post_publish_button').text('UPDATE');
								$('#draft').text('Save');
								$('#draft').attr('disabled', true);
								
						}else{
							$('#post_publish_button').text('Publish');
							$('#draft').attr('disabled', false);
							$('#draft').text('UPDATE');
							}
					
					}
			}
		
		});
	});	
	
$('.postdelete').click(function(){
	if(confirm('Are you sure you want to delete')){
		$this = $(this);
		$.ajax({
			url : '/admin/post/delete',
			type: 'post',
			data : 'post_id='+$(this).attr('data-id'),
			success : function(response){
					if(response.status=='success'){
						$this.parent().parent().remove();
						Materialize.toast('Post delete successfully',5000);
						}else if(response.status=='error'){
							}else{
								Materialize.toast('Something went wrong', 4000);
								}
				
				}
			});
		}
	});	

	
});
