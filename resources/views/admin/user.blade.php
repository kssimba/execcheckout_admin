@extends('layouts.admin') 
@section('content')
<input type="hidden" id="headerdata" value="{{ __('USER') }}">
<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Users') }}</h4>
				<ul class="links">
					<li> <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a> </li>
					<li> <a href="{{ route('admin.users') }}">{{ __('Manage Users') }}</a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="product-area">
		<div class="row">
			<div class="col-lg-12">
				<div class="mr-table allproduct"> 
        @include('includes.form-success')
					<div class="table-responsiv">
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ __('Name') }}</th>
									<th>{{ __('Email') }}</th>
									<th>{{ __('Email Verified At') }}</th>
									<th>{{ __('Password') }}</th>
                  <th>{{ __('Options') }}</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
{{-- ADD / EDIT MODAL --}}
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="submit-loader"> <img src="{{asset('assets/img/spinner.gif')}}" alt=""> </div>
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body"> </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
			</div>
		</div>
	</div>
</div> 
{{-- ADD / EDIT MODAL ENDS --}} 
{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header d-block text-center">
				<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<p class="text-center">{{ __('You are about to delete this Staff.') }}</p>
				<p class="text-center">{{ __('Do you want to proceed?') }}</p>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button> <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a> </div>
		</div>
	</div>
</div> 
{{-- DELETE MODAL ENDS --}} 
@endsection 
@section('scripts') 
{{-- DATA TABLE --}}
<script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
<script type="text/javascript">
var table = $('#geniustable').DataTable({
	ordering: false,
	processing: true,
	serverSide: true,
	ajax: '{{ route('admin.users.datatables') }}',
	columns: [{
		data: 'name',
		name: 'name'
	}, {
		data: 'email',
		name: 'email'
	}, {
		data: 'email_verified_at',
		name: 'email_verified_at'
	}, {
    data: 'password',
		name: 'password'
	}, {
		data: 'action',
		searchable: false,
		orderable: false
	}],
	language: {
		processing: '<img src="{{asset('assets/img/spinner.gif')}}">'
	}
});
$(function() {
	$(".btn-area").append('<div class="col-sm-4 text-right">' + '<a class="add-btn" data-href="{{route('admin.users.create')}}" id="add-data" data-toggle="modal" data-target="#modal1">' + '<i class="fas fa-plus"></i> {{ __('Add New Staff') }}' + '</a>' + '</div>');
});
$(document).on('click', '#add-data', function() {
	$('.submit-loader').show();
	$('#modal1').find('.modal-title').html('ADD NEW ' + $('#headerdata').val());
	$('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'), function(response, status, xhr) {
		if(status == "success") {
			$('.submit-loader').hide();
		}
	});
});
// ADD OPERATION END
// Attribute Modal
$(document).on('click', '.attribute', function() {
	$('.submit-loader').show();
	$('#attribute').find('.modal-title').html($('#attribute_data').val());
	$('#attribute .modal-content .modal-body').html('').load($(this).attr('data-href'), function(response, status, xhr) {
		if(status == "success") {
			$('.submit-loader').hide();
		}
	});
});
// Attribute Modal Ends
// EDIT OPERATION
$(document).on('click', '.edit', function() {
	$('.submit-loader').show();
	$('#modal1').find('.modal-title').html('EDIT ' + $('#headerdata').val());
	$('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'), function(response, status, xhr) {
		if(status == "success") {
			$('.submit-loader').hide();
		}
	});
});
// EDIT OPERATION END
// FEATURE OPERATION
$(document).on('click', '.feature', function() {
	$('.submit-loader').show();
	$('#modal2').find('.modal-title').html($('#headerdata').val() + ' Highlight');
	$('#modal2 .modal-content .modal-body').html('').load($(this).attr('data-href'), function(response, status, xhr) {
		if(status == "success") {
			$('.submit-loader').hide();
			var dateToday = new Date();
			$("#discount_date").datepicker({
				changeMonth: true,
				changeYear: true,
				minDate: dateToday,
			});
		}
	});
});
// EDIT OPERATION END
// SHOW OPERATION
$(document).on('click', '.view', function() {
	$('.submit-loader').show();
	$('#modal1').find('.modal-title').html($('#headerdata').val() + ' DETAILS');
	$('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'), function(response, status, xhr) {
		if(status == "success") {
			$('.submit-loader').hide();
		}
	});
});
// SHOW OPERATION END
// TRACK OPERATION
$(document).on('click', '.track', function() {
	$('.submit-loader').show();
	$('#modal1').find('.modal-title').html('TRACK ' + $('#headerdata').val());
	$('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'), function(response, status, xhr) {
		if(status == "success") {
			$('.submit-loader').hide();
		}
	});
});
$(document).on('submit', '#geniusformdata', function(e) {
	e.preventDefault();
	$('.submit-loader').show();
	$('button.addProductSubmit-btn').prop('disabled', true);
	//disablekey();
	$.ajax({
		method: "POST",
		url: $(this).prop('action'),
		data: new FormData(this),
		dataType: 'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success: function(data) {
			console.log(data);
			if((data.errors)) {
				$('.alert-danger').show();
				$('.alert-danger ul').html('');
				for(var error in data.errors) {
					$('.alert-danger ul').append('<li>' + data.errors[error] + '</li>');
				}
				$('.submit-loader').hide();
				$("#modal1 .modal-content .modal-body .alert-danger").focus();
				$('button.addProductSubmit-btn').prop('disabled', false);
				$('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
			} else {
				table.ajax.reload();
				$('.alert-success').show();
				$('.alert-success p').html(data);
				$('.submit-loader').hide();
				$('button.addProductSubmit-btn').prop('disabled', false);
				$('#modal1').modal('hide');
			}
			//enablekey();
		}
	});
});
$('#confirm-delete').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
$('#confirm-delete .btn-ok').on('click', function(e) {
	$('.submit-loader').show();
	$.ajax({
		type: "GET",
		url: $(this).attr('href'),
		success: function(data) {
			$('#confirm-delete').modal('toggle');
			table.ajax.reload();
			$('.alert-danger').hide();
			$('.alert-success').show();
			$('.alert-success p').html(data);
			$('.submit-loader').hide();
		}
	});
	return false;
});
</script> 
{{-- DATA TABLE --}} 
@endsection