@extends('layouts.admin')
@section('styles')

<link href="../assets/admin/css/product.css" rel="stylesheet" />
<link href="../assets/admin/css/jquery.Jcrop.css" rel="stylesheet" />
<link href="../assets/admin/css/Jcrop-style.css" rel="stylesheet" />

@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Course') }}
					<a class="add-btn" href="#"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="#">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Courses') }} </a>
					</li>
					<li>
						<a href="#">{{ __('All Courses') }}</a>
					</li>
					<li>
						<a href="#">{{ __('Edit Course') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{route('admin.menu.register')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">

								<div class="gocover"
									style="background: url('../assets/img/spinner.gif') no-repeat scroll center center rgba(45, 45, 45, 0.5);">
								</div>

									@include('includes.form-both')

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Course Title') }}* </h4>
												<p class="sub-heading">{{ __('(In Any Language)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Course Title') }}"
												name="title" required="" value="">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Course Sku') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Course Sku') }}"
												name="slug" required="" value="{{ $data->slug }}">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Course Type') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="course_type">
												<option value="basic" {{ $data->course_type == 'basic' ? 'selected' : '' }}>Basic Course</option>
												<option value="advanced" {{ $data->course_type == 'advanced' ? 'selected' : '' }}>Advanced Course</option>
											</select>
										</div>
									</div>

									<input type="hidden" name="category_id" value="{{ $data->category_id }}">

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Course Short Detail') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<input type="text" class="input-field" placeholder="{{ __('Short Detail') }}" name="detail_short" value="{{ $data->detail_short }}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Course Detail') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="detail">{{ $data->detail }}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Course Content') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="detail_learn">{{ $data->detail_learn }}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Course Requirement') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="requirement">{{ $data->requirement }}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12 text-center">
											<button class="addProductSubmit-btn"
												type="submit">{{ __('Edit Course') }}</button>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
								<div class="row">
									<div class="col-lg-12">
										<div class="left-area">
											<h4 class="heading">{{ __('Feature Image') }} *</h4>
										</div>
									</div>
									<div class="col-lg-12">
											<div class="panel panel-body">
												<div class="span4 cropme text-center" id="landscape"
													style="width: 100%; height: 160px; border: 1px dashed #ddd; background: #f1f1f1;">
													<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
														<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
													</a>
												</div>
											</div>
									</div>
								</div>

								<input type="hidden" id="feature_photo" name="photo" value="{{ $data->photo }}">

								<div class="row">
									<div class="col-lg-12">
										<div class="left-area">
											<h4 class="heading">{{ __('Preview Type') }}*</h4>
										</div>
									</div>
									<div class="col-lg-12">
										<select name="preview_type">
											<option value="url" {{ $data->preview_type=='url' ? 'selected' : '' }}>Url</option>
											<option value="video" {{ $data->preview_type=='video' ? 'selected' : '' }}>Upload Video</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="left-area">
											<h4 class="heading">{{ __('Preview Video URL') }}*</h4>
											<p class="sub-heading">{{ __('(Optional)') }}</p>
										</div>
									</div>
									<div class="col-lg-12">
										<input name="preview_url" type="text" class="input-field"
											placeholder="{{ __('Enter Preview Video URL') }}" value="{{ $data->preview_url }}">
									</div>
								</div>

								<input type="file" name="preview_video" class="hidden" id="uploadgallery" accept="video/*">

								<div class="row mb-4">
									<div class="col-lg-12 mb-2">
										<div class="left-area">
											<h4 class="heading">{{ __('Course Preview Video') }}*</h4>
											<p class="sub-heading">{{ __('(Optional)') }}</p>
										</div>
									</div>
									<div class="col-lg-12">
										<a href="#" class="set-gallery" id="setgallery">
											<i class="icofont-plus"></i> {{ __('Upload Video') }}
										</a>
										<span id="file_name">{{ $data->preview_video }}</span>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="checkbox-wrapper">
											<input type="checkbox" name="price_type" class="price_type" {{ $data->price_type == 1 ? "checked" : "" }} value="1">
											<label for="conditionCheck">{{ __('Free Course') }}</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="left-area">
											<h4 class="heading">
												{{ __('Course Current Price') }}*
											</h4>
											<p class="sub-heading">
												({{ __('In') }} {{$sign->name}})
											</p>
										</div>
									</div>
									<div class="col-lg-12">
										<input name="price_amount" type="number" class="input-field"
											placeholder="{{ __('e.g 20') }}" step="0.01" required="" min="0" value="{{round($data->price_amount * $sign->value , 2)}}">
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="left-area">
											<h4 class="heading">{{ __('Course Previous Price') }}*</h4>
											<p class="sub-heading">{{ __('(Optional)') }}</p>
										</div>
									</div>
									<div class="col-lg-12">
										<input name="price_disamount" step="0.01" type="number" class="input-field"
											placeholder="{{ __('e.g 20') }}" min="0" value="{{round($data->price_disamount * $sign->value , 2)}}">
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="checkbox-wrapper">
											<input type="checkbox" name="featured" class="checkclick" {{ $data->featured == 1 ? "checked" : "" }} value="1">
											<label for="conditionCheck">{{ __('Featured Course') }}</label>
										</div>
									</div>
								</div>
								@if(false)
								<div class="row">
									<div class="col-lg-12">
										<a class="set-gallery" href="{{ route('admin-class-index', $data->id) }}"><i class="fas fa-list"></i> {{ __('Class List') }}</a>
									</div>
								</div>
								@endif
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

<script type="text/javascript">

// Gallery Section Update

	$(document).on('click', '#setgallery', function () {
		$('#uploadgallery').click();
	});

	$(document).on('change', '#uploadgallery', function() {
		$("#file_name").text($("#uploadgallery").val());
	});
// Gallery Section Update Ends

</script>

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.courseCropper.js')}}"></script>

<script type="text/javascript">
	$('.cropme').simpleCropper();
  	$(document).ready(function() {

    	let html = `<img src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : (filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/courses/'.$data->photo)) }}" alt="">`;
    	$(".span4.cropme").html(html);

    	$.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
    	});
  	});


  	$('.ok').on('click', function () {
		setTimeout(
		    function() {
		  	var img = $('#feature_photo').val();

			$.ajax({
				url: "{{route('admin-course-upload-update',$data->id)}}",
				type: "POST",
				data: {"image":img},
				success: function (data) {
				  	if (data.status) {
				    	$('#feature_photo').val(data.file_name);
				  	}
				  	if ((data.errors)) {
				    	for(var error in data.errors)
				    	{
				      		$.notify(data.errors[error], "danger");
				    	}
				  	}
				}
			});

		    }, 1000);
	});
</script>
<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
