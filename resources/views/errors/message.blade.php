@if(Session::has('success'))

<script>
$(document).ready(function(){
	Materialize.toast("{{ Session::get('success') }}", 5000);
});
</script>

@endif
