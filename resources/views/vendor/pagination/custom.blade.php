<!DOCTYPE html> 
<html> 

<head> 
	<title>Page Title</title> 
</head> 

<body> 
	

</body> 
<!-- resources/views/vendor/pagination/custom.blade.php -->

@if ($paginator->hasPages()) 
<nav aria-label="Page navigation example" id="pagination"> 
	<ul class="pagination justify-content-center"> 
		@if ($paginator->onFirstPage()) 
		<li class="page-item disabled "> 
			<a class="page-link lil_page_text" href="#"
			tabindex="-1">Назад</a> 
		</li> 
		@else 
		<li class="page-item"><a class="page-link lil_page_text_now"
			href="{{ $paginator->previousPageUrl() }}"> 
				Назад</a> 
		</li> 
		@endif 

		@foreach ($elements as $element) 
		@if (is_string($element)) 
		<li class="page-item disabled one_page">{{ $element }}</li> 
		@endif 

		@if (is_array($element)) 
		@foreach ($element as $page => $url) 
		@if ($page == $paginator->currentPage()) 
		<li class="page-item active"> 
			<a class="page-link simple2">{{ $page }}</a> 
		</li> 
		@else 
		<li class="page-item"> 
			<a class="page-link simple1"
			href="{{ $url }}">{{ $page }}</a> 
		</li> 
		@endif 
		@endforeach 
		@endif 
		@endforeach 

		@if ($paginator->hasMorePages()) 
		<li class="page-item"> 
			<a class="page-link lil_page_text_now"
			href="{{ $paginator->nextPageUrl() }}" 
			rel="next ">Далее</a> 
		</li> 
		@else 
		<li class="page-item disabled"> 
			<a class="page-link lil_page_text" href="#">Далее</a> 
		</li> 
		@endif 
	</ul> 
</nav> 
	@endif 

</html>
