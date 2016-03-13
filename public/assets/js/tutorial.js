$(document).ready(function(){

	$('#tutorialForm select[name="std_class"]').change(function(){
		var std = $(this).val();
		resetOptions();
		$.ajax({
			url  : '/getsubjects',
			type : 'post',
			data : 'std_class='+std,
			success : function(response){
					if(response.status=='success'){
							$('#tutorialForm select[name="subject_id"] option').remove();
							var subjects = '<option value="" disabled selected>Choose your option</option>';
							Materialize.toast('subjects updated successfully', 5000);
							if(response.subjects){
								createOption($('#tutorialForm select[name="subject_id"]'),response.subjects);
								$('select').material_select();
							}
						}else if(response.status=='error'){
							Materialize.toast('something went wrong please try again !', 5000);
							}else{
								Materialize.toast('something went wrong please try again !', 5000);
								}
					}
			});
	});

	$('body').on('change','#tutorialForm select[name="subject_id"]',function(){
		var subject_id = $(this).val();
		$.ajax({
			url  : '/gettopics',
			type : 'post',
			data : 'subject_id='+subject_id,
			success : function(response){
					if(response.status=='success'){
							$('#tutorialForm select[name="topic_id"] option').remove();
							Materialize.toast('Topics updated successfully', 5000);
							if(response.topics){
								createOption($('#tutorialForm select[name="topic_id"]'),response.topics);
								$('select').material_select();
							}
						}else if(response.status=='error'){
							Materialize.toast('something went wrong please try again !', 5000);
							}else{
								Materialize.toast('something went wrong please try again !', 5000);
								}
					}
			});
	});


});

function createOption(_this, data){
	var subjects = '<option value="" disabled selected>Choose your option</option>';
	$.each(data,function (){
			subjects +='<option value="'+this.id+'">'+this.name+'</option>';
	});
	_this.append(subjects);
}

function resetOptions(){
	$('#tutorialForm select[name="subject_id"]').val('');
	$('#tutorialForm select[name="topic_id"]').val('');
	$('select').material_select();
}
