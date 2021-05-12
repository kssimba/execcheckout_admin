@extends('layouts.load') 
@section('content')
<div class="content-area">
	<div class="add-product-content1">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area"> 
					@include('includes.form-error')
						<form id="geniusformdata" action="{{ isset($data->id) ? route('admin.users.update', $data->id) : route('admin.users.save') }}" method="POST" enctype="multipart/form-data"> 
						{{csrf_field()}}
							<div class="row">
								<div class="col-lg-4">
									<div class="left-area">
										<h4 class="heading">{{ __('Name') }} *</h4>
									</div>
								</div>
								<div class="col-lg-7">
									<input type="text" class="input-field" name="name" placeholder="{{ __(" User Name ") }}" required="" value="{{isset($data->name) ? $data->name: ''}}">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="left-area">
										<h4 class="heading">{{ __("Email") }} *</h4>
									</div>
								</div>
								<div class="col-lg-7">
									<input type="text" class="input-field" name="email" placeholder="{{ __(" Email Address ") }}" required="" value="{{isset($data->email) ? $data->email: ''}}">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="left-area">
										<h4 class="heading">{{ __("Password") }} *</h4>
									</div>
								</div>
								<div class="col-lg-7">
									<input type="password" class="input-field" name="password" placeholder="{{ __(" Password ") }}" required="" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="left-area">
								</div>
								</div>
								<div class="col-lg-7">
									<button class="addProductSubmit-btn" type="submit">{{ __("Create User") }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
@endsection 
@section('scripts') 
{{-- DATA TABLE --}}
<script type="text/javascript">
</script> 
@endsection