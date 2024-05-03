@props(['client_id'])
@php
	$page = MyUtil::get_page_current();
@endphp

<div class="py-1 mb-3 border-bottom border-primary fw-bold d-flex">
	<div class="bdcb">{{ $page->small_group->big_group->title }}</div>
	<div class="bdcb"><i class="fa-solid fa-angle-right"></i></div>
	<div class="bdcb">{{ $page->small_group->title }}</div>
	<div class="bdcb"><i class="fa-solid fa-angle-right"></i></div>
	@foreach ($page->small_group->pages as $item)
		@if ($item->id == $page->id)
			<a href="/clients/{{ $client_id }}/{{ $item->path }}" class="bdcb bdcb-child active">{{ $item->title }}</a>				
		@else
			<a href="/clients/{{ $client_id }}/{{ $item->path }}" class="bdcb bdcb-child">{{ $item->title }}</a>				
		@endif
	@endforeach
</div>