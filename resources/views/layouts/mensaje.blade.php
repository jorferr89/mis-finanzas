@if ($errors->any()) 
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{$errors->first()}}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@elseif (session('message'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('message')}}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif