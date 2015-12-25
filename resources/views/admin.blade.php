@extends('layouts.admin')

@section('content')
	
	@if($page=='dashboard')
		@include('pages.admin.dashboard')
		
	@elseif($page=='nav')	
	
		@include('pages.admin.nav')
		
	@elseif($page=='post')
		
		@include('pages.admin.post.index')
		
	@elseif($page=='app')
		@include('pages.admin.apps.app')
		
	@elseif($page=='footer')
		@include('pages.admin.footer.index')
	
	@endif	

@endsection
