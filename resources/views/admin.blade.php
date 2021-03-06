@extends('layouts.default')

@section('content')

	@if($page=='admin')
		@include('pages.admin.dashboard')

	@elseif($page=='tutorial')

		@include('pages.admin.tutorial')

	@elseif($page=='tutorial_create_edit')

		@include('pages.admin.tutorial_create_edit')

	@elseif($page=='subjectlist')
		@include('pages.admin.subjectlist')

	@elseif($page=='create_edit_subject')
		@include('pages.admin.create_edit_subject')

	@elseif($page=='topic')
		@include('pages.admin.topiclist')

	@elseif($page=='topic_create')
			@include('pages.admin.topic_create')

	@elseif($page=='user')
			@include('pages.admin.user')

	@elseif($page == 'user_create')
			@include('pages.admin.user_create_edit')

	@elseif($page == 'school')
			@include('pages.admin.school')

	@elseif($page == 'school_create_edit')
			@include('pages.admin.school_create_edit')

	@endif

@endsection
