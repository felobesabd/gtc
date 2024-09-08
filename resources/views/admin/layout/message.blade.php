@if ($message = Session::get('success'))
<div class="alert alert-success alert-block message" style="z-index: 99999;">
	<button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block message">
	<button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block message">
	<button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block message">
	<button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-block message">
	<button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
	{{$errors->first()}}
</div>
@endif