@extends('layouts.admin')
@section('styles')

<link href="{{ asset('assets/admin/css/product.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/jquery.Jcrop.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/Jcrop-style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

<style type="text/css">

</style>
@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Change Image') }} <a class="add-btn"
						href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="#">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Restaurants') }} </a>
					</li>
					<li>
						<a href="#">{{ __('Change Image') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{ route('admin.changeimage', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
	<div class="row">
		<div class="col-lg-12">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
								<div class="gocover"
									style="background: url('{{ asset('assets/img/spinner.gif') }}') no-repeat scroll center center rgba(45, 45, 45, 0.5);">
								</div>
								@include('includes.form-both')
								<br> <hr>
								<h4 class="text-center">Restaurant Info</h4>
								<hr> <br>
								<div class="row">
									<div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Restaurant Name') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Restaurant Name') }}"
												name="name" value="{{ $restaurant->name }}" readonly>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Address') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Address') }}"
												name="address" value="{{ $restaurant->address1 }}" readonly>
										</div>
                                    </div>
                                    <div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Image') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Image URL') }}"
												name="oldimage" value="{{ $restaurant->logo }}" readonly>
										</div>
									</div>
                                </div>

                                <div class="row">
									
								</div>

								
								
								<div class="row">
								    <div class="col-lg-6">
    									<div class="col-lg-12">
										<div class="left-area">
											<h4 class="heading">{{ __('Logo Image') }} *</h4>
										</div>
									</div>
									<div class="col-lg-12">
											<div class="panel panel-body">
												<div class="span4 cropme text-center" id="landscape"
													style="width: 255px!important; height: 150px!important; border: 1px dashed #ddd; background: #f1f1f1;">
													<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
														<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
													</a>
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-6">
									    <div class="col-lg-12">
    										<div class="left-area">
    											<h4 class="heading">{{ __('Banner Image') }} *</h4>
    										</div>
    									</div>
    									<div class="col-lg-12">
    											<div class="panel panel-body">
    												<div class="span4 cropme text-center" id="mylandscape"
    													style="width: 255px!important; height: 150px!important; border: 1px dashed #ddd; background: #f1f1f1;">
    													<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
    														<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
    													</a>
    												</div>
    											</div>
    									</div>
									</div>
								</div>
                                <input type="hidden" id="feature_photo" name="newimage">
								<input type="hidden" id="banner_photo" name="bannerimage">


                                <div class="text-center">
                                    <button class="addProductSubmit-btn" type="submit">{{ __('Change Image') }}</button>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>

</div>


@endsection

@section('scripts')

<script src="{{ asset('assets/admin/js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.BannerSimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>


<script type="text/javascript">
	// Gallery Section Insert

	$(document).ready(function() {
        $('#course_list').select2();
		$('#landscape').simpleCropper();
        $('#mylandscape').bannerCropper();
    });

</script>
@endsection
