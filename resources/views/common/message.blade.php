@if(Session::has('flash_message'))
  	<div class="alert alert-{{ session('status_color') }} alert-dismissible fade show" role="alert">
		{!! session('flash_message') !!}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
@endif