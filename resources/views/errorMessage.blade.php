<div>
<div style="margin-bottom: 50px; "></div>
@if( $errors and count($errors))
	<ul class="iconlist" data-username="envato" data-count="2">
    @foreach($errors -> all() as $err)
	<div class="alert bg-transparent text-danger border-danger">
		<i class="bi-x-circle-fill"></i> <strong>{{ $err }}</strong>
	</div>
	@endforeach
    </ul>
@endif
</div>
