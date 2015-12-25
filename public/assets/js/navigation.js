$(document).ready(function(){
 $('select').material_select();
 $('ul.tabs').tabs();	
	
$('#addmenubutton').click(function(){
	var menuName = $('#menuname').val();
	if(menuName!='' || menuName!=null){
		$.ajax({
			url :'/admin/addmenu',
			type:'post',
			data : 'menu='+menuName, 
			success : function(response){
					if(response.status=='success'){
						var soption = '<option value="'+response.id+'" selected>'+response.menu+'</option>'; 
						$('#menuselectbox').append(soption);
							$('select').material_select();
						 $('.collapsible').collapsible({
							  accordion : false
							});
						var menucheck = '<p><input type="checkbox" id="'+response.id+'" value="'+response.id+'" /><label for="'+response.id+'">'+response.menu+' 1</label></p>';	
						$('#menucheckbox').append(menucheck);	
						}else if(response.status=='error'){
							Materialize.toast('Something went wrong', 5000);
							}else{
								alert('Something went wrong');
								}
				}
			});
		}else{
			return false;
			}
	
	});

$('body').on('click', '.addNavButton', function(){
	var formData = $('#addNavForm').serialize();
	var menu_id = $('#menuselectbox option:selected').val();
	if(menu_id=='' || menu_id==null){
		Materialize.toast('Select menu first',5000);
		return false;
		}
		
		$.ajax({
			url :'/admin/addnav',
			type:'post',
			data : formData+'&menu_id='+menu_id+'&type='+$(this).attr('id'), 
			success : function(response){
					if(response.status=='success'){
							var nav  ='<li><div class="collapsible-header"><i class="mdi-image-filter-drama"></i>'+response.nav.title+'</div><div class="collapsible-body"><div class="input-field col s8  m4 l4"><input type="text" name="link" id="link_'+response.nav.id+'" class="validate" value="'+response.nav.link+'"><label for="link_'+response.nav.id+'">Link</label></div><a href="javascript:void(0);" class="waves-effect waves-circle waves-light btn-floating secondary-content deletenav" data-id="'+response.nav.id+'"><i class="mdi-content-remove"></i></a><a data-title="'+response.nav.title+'" data-link="'+response.nav.link+'" data-type="'+response.nav.type+'" data-id="'+response.nav.id+'" href="javascript:void(0);" class="editnav waves-effect waves-circle waves-light btn-floating secondary-content"><i class="mdi-content-create"></i></a></div></li>';
						$('#navbar ul').append(nav);
						 $('.collapsible').collapsible({
							  accordion : false
							});
						}else if(response.status=='error'){
							Materialize.toast('Something went wrong', 5000);
							}else{
								alert('Something went wrong');
								}
				}
			});
			
	});
	

$('#menuselectbox').change(function(){
	var menu_id = $(this).val();
	
	if(menu_id=='' || menu_id==null){
		Materialize.toast('Please select menu', 5000);
		return false;
		}
			$.ajax({
				url :'/admin/getnavs',
				type: 'post',
				data : 'menu_id='+menu_id,
				success : function(response){
						if(response.status=='success'){
							var navs = '';
							$.each(response.navs,function(){
									navs +='<li><div class="collapsible-header"><i class="mdi-image-filter-drama"></i>'+this.title+'</div><div class="collapsible-body"><div class="input-field col s8  m4 l4"><input type="text" name="link" id="link_'+this.id+'" class="validate" value="'+this.link+'"><label for="link_'+this.id+'">Link</label></div><a href="javascript:void(0);" class="waves-effect waves-circle waves-light btn-floating secondary-content deletenav" data-id="'+this.id+'"><i class="mdi-content-remove"></i></a><a data-title="'+this.title+'" data-link="'+this.link+'" data-type="'+this.type+'" data-id="'+this.id+'" href="javascript:void(0);" class="editnav waves-effect waves-circle waves-light btn-floating secondary-content"><i class="mdi-content-create"></i></a></div></li>'; 
								});
							$('#navigation_holder').html(navs);
							$('.collapsible').collapsible({
								accordion : false
								});
								
							}else if(response.status=='notfound'){
								$('#navigation_holder').html('');
								Materialize.toast('No nav found', 5000);
								}else{
									Materialize.toast('Something went wrong', 5000);
									}
					}
				
				});
	
	});

$('body').on('click','.editnav',function(){
	var nav_id =$(this).attr('data-id');
	var link =$(this).attr('data-link');
	var title =$(this).attr('data-title');
	var type =$(this).attr('data-type');
	
	$this = $('#collapsible-addnav').next('.collapsible-body').find('form');
	$this.find("input[name='nav']").val(title);
	$this.find("input[name='link']").val(link);
	$this.find("a").text('update');
	$this.append('<input type="hidden" name="nav_id" value="'+nav_id+'"/>');
	$('#collapsible-addnav').click();

	});

$('body').on('click','.deletenav',function(){
	var nav_id = $(this).attr('data-id');
		if(nav_id=='' || nav_id==null){
			Materialize.toast('Nav id not found',5000);
			return false;
			}
		var $this = $(this);	
		if(confirm('Are you sure ')){
				$.ajax({
					url : '/admin/deletenav',
					type : 'post',
					data : 'nav_id='+nav_id,
					success  : function(response){
								if(response.status=='success'){
									$this.parent().parent().remove();
										Materialize.toast('Nav delete successfully',5000);
									}
						}
					});
			}	
	});
});
