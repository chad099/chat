$(document).ready(function(){
	$('.add-favourite').click(function(){
		$this= $(this);
		$.ajax({
			url  : '/user/addfavourite',
			type : 'post',
			data : 'post_id='+$(this).attr('data-id'),
			success : function(response){
					if(response.status=='success'){
							$this.css('color','#EE6E73');
							Materialize.toast(response.msg, 500);
						}else if(response.status=='error'){
							Materialize.toast(response.msg, 500);
							}else{
								Materialize.toast('something went wrong please try again !', 500);
								}
					} 
			});
		});
	
	});
