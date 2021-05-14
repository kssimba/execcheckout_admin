@extends('layouts.admin')
@section('styles')

<link href="{{ asset('assets/admin/css/product.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/jquery.Jcrop.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/Jcrop-style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

<style type="text/css">
.btn{
    text-align: left!important;
    font-size: 14px;
    color: #5a6f84;
    font-weight: 600;
    border: none!important;
}
.btn:focus{
    box-shadow: none!important;
}
.checkbox{
    color: #5a6f84;
}
.btn-group{
    width: 100%!important;
    padding: 0px 20px 0px;
    /* border-radius: 0px; */
    color: #5a6f84;
    height: 35px !important;
    font-size: 14px;
    margin-bottom: 15px;
    border-radius: 4px;
    background: #fff!important;
    border: 1px solid rgba(0, 0, 0, 0.15);
}
</style>
@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Edit Category') }} <a class="add-btn"
						href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="#">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Categories') }} </a>
					</li>
					<li>
						<a href="#">{{ __('Edit Category') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{ route('admin-category-update',$data['id']) }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="col-lg-6 m-auto">
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
								<h4 class="text-center">Category Info</h4>
								<hr> <br>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Category Title') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Category Title') }}"
												name="title" value = "{{ $data['title'] }}" required="">
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Category Photo') }} </h4>
											</div>
										</div>

										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Category Photo Url') }}"
												name="photo" value="{{ $data['photo'] }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Category Order') }} </h4>
											</div>
										</div>

										<div class="col-lg-12">
											<input type="number" class="input-field" placeholder="{{ __('Enter Category Order Url') }}"
												name="order" value="{{ $data['order'] }}">
										</div>
									</div>
								</div>
								<div class="text-center">
									<button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
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

<script src="{{ asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>




<script type="text/javascript">
	// Gallery Section Insert

$(document).on('submit','#geniusform',function(e){
e.preventDefault();

$('.gocover').show();


  var fd = new FormData(this);


var geniusform = $(this);
$('button.addProductSubmit-btn').prop('disabled',true);
    $.ajax({
     method:"POST",
     url:$(this).prop('action'),
     data:fd,
     contentType: false,
     cache: false,
     processData: false,
     success:function(data)
     {
        console.log(data);
        if ((data.errors)) {
        geniusform.parent().find('.alert-success').hide();
        geniusform.parent().find('.alert-danger').show();
        geniusform.parent().find('.alert-danger ul').html('');
          for(var error in data.errors)
          {
            $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
          }
          geniusform.find('input , select , textarea').eq(1).focus();
        }
        else
        {
          geniusform.parent().find('.alert-danger').hide();
          geniusform.parent().find('.alert-success').show();
          geniusform.parent().find('.alert-success p').html(data);
          geniusform.find('input , select , textarea').eq(1).focus();
        }

        $('.gocover').hide();


        $('button.addProductSubmit-btn').prop('disabled',false);


        $(window).scrollTop(0);

     }

    });

});

</script>
@endsection
