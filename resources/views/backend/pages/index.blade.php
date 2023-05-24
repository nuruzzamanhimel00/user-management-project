
<x-layouts.guest >
	@section('title','Hhome- himel home section')
	@section('keywords','Aaa, Bbb. CCc')
	@section('desciption')
	Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora sint maxime saepe sit, voluptatem labore. Minus exercitationem, itaque consequatur perspiciatis eaque unde expedita rerum, enim aliquid vero, minima recusandae reprehenderit?
	@endsection
	@section('page-title')
	@include('backend.layouts.page-title-section')
	@endsection
	@push('stylesheet')
	<style>
		h1{
		background: red;
		}
	</style>
	@endpush
	
	<x-button />
	<x-form />
	<x-form.label />
	<x-input-button />
	@foreach ($users as $user )
	<x-post.index :user="$user" type="blue" />

	{{-- anonimyos component --}}
	{{--
	<x-posts :user="$user" type='blue' /> --}}

	@endforeach
	<hr>
	<div class="text-center">
		<x-button.primary name="Send me" class="btn-danger btn-lg" type="button" himel="nuruzzaman" />
	</div>
	<hr>
	<x-anonymus.link name="Link name" :active='false' />
	<hr>
	<h4>Anpnymus Slot button</h4>
	<x-anonymus.slot.button class="btn-light bg-dark p-4" type='submit'>
		Slot Button
	</x-anonymus.slot.button>
	<h4>Anonimys slot card</h4>
	<div class="text-center">
		<x-anonymus.slot.card class="bg-success">
			<x-slot name="image">
				<img src="https://picsum.photos/200/300" class="card-img-top" alt="">
			</x-slot>
			<x-slot name="title" class="text-danger text-uppercase font-weight-bold">
				This is card name
			</x-slot>
			<x-slot name="button">
				<a href="#" class="btn btn-primary">Go somewhere</a>
			</x-slot>

			<x-slot name="body" class="text-center bg-warning mb-2 p-2">
				Some quick example text to build on the card title and make up the bulk of the card's content.
			</x-slot>

		</x-anonymus.slot.card>
	</div>	

	@push('script')
	<script>
		$(document).ready(function(){
					console.log('hello world');
				})
	</script>
	@endpush
</x-layouts.guest>