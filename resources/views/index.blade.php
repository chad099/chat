@extends('layouts.default')

@section('content')

	@if($page=='dashboard')
		@include('pages.user.dashboard')

	@elseif($page == 'login')
		@include('auth.login')

	@elseif($page == 'index')
		@include('pages.main.home')

	@elseif($page == 'tutorial')
		@include('pages.main.home')

	@elseif($page == 'profile')
		@include('pages.main.profile')

	@elseif($page == 'player')
		@include('pages.main.player')

	@endif

@endsection
