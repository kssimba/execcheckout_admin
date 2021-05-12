@extends('layouts.admin')

@section('content')
					<input type="hidden" id="headerdata" value="{{ __("PRODUCT") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
									<h4 class="heading">{{ __('Restaruants') }} <a class="add-btn"
                                        href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
                                    </h4>
									
									<ul class="links">
										<li>
											<a href="#">{{ __("Dashboard") }} </a>
										</li>
										<li>
											<a href="javascript:;">{{ __("Restaruants") }} </a>
										</li>
										<li>
											<a href="#">{{ __("All Restaruants") }}</a>
										</li>
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
                            <th>{{ __("Title") }}</th>
                            <th>{{ __("Image") }}</th>
                            <th>{{ __("Category Order") }}</th>
                            <th>{{ __("Created At") }}</th>
                            <th>{{ __("Updated At") }}</th>
                            <th>{{ __("Options") }}</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



{{-- HIGHLIGHT MODAL --}}

										<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">


										<div class="modal-dialog highlight" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/img/spinner.gif')}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
											</div>
										</div>
										</div>
</div>

{{-- HIGHLIGHT ENDS --}}

{{-- CATALOG MODAL --}}

<div class="modal fade" id="catalog-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Update Status") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>


      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to change the status of this Course.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-success btn-ok">{{ __("Proceed") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- CATALOG MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        
        <div class="submit-loader">
            <img  src="{{asset('assets/img/spinner.gif')}}" alt="">
        </div>

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to delete this Restaurant.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="confirm-transfer" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="submit-loader">
            <img  src="{{asset('assets/img/spinner.gif')}}" alt="">
        </div>

      <div class="modal-header d-block text-center">
          <h4 class="modal-title d-inline-block">{{ __("Confirm Transfer") }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
      </div>

        <!-- Modal body -->
        <div class="modal-body">
              <p class="text-center">{{ __("You are about to transfer this Restaurant to firestore.") }}</p>
              <p class="text-center">{{ __("Do you want to proceed?") }}</p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
              <a class="btn btn-danger btn-ok">{{ __("Transfer") }}</a>
        </div>

      </div>
    </div>
  </div>

{{-- DELETE MODAL ENDS --}}

@endsection



@section('scripts')
<script type="text/javascript">
{{-- DATA TABLE --}}
	var table = $('#geniustable').DataTable({
		    ordering: false,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.category.datatables') }}',
        columns: [
          { data: 'title', name: 'title' },
          { data: 'image', name: 'image' },
          { data: 'category_order', name: 'category_order' },
          { data: 'created_at', name: 'created_at' },
          { data: 'updated_at', name: 'updated_at' },
          { data: 'action', searchable: false, orderable: false }

        ],
        language : {
          processing: '<img src="../../assets/img/spinner.gif">'
        },
        drawCallback : function( settings ) {
        $('.select').niceSelect();
			}
    });

  	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" href="{{route('admin.add_category')}}">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New Category") }}<span>'+
          '</a>'+
          '</div>');
      });
      $(document).on('click','.godropdown .go-dropdown-toggle', function(){
  $('.godropdown .action-list').hide();
  var $this = $(this);
  $this.next('.action-list').toggle();
});

$(document).on('click', function(e)
{
    var container = $(".godropdown");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
      container.find('.action-list').hide();
    }
});
{{-- DATA TABLE ENDS--}}

// Droplinks Start
  $(document).on('change','.droplinks',function () {

var link = $(this).val();
var data = $(this).find(':selected').attr('data-val');
if(data == 0)
{
  $(this).next(".nice-select.process.select.droplinks").removeClass("drop-success").addClass("drop-danger");
}
else{
  $(this).next(".nice-select.process.select.droplinks").removeClass("drop-danger").addClass("drop-success");
}
$.get(link);
$.notify("Status Updated Successfully.","success");
});


$(document).on('change','.vdroplinks',function () {

var link = $(this).val();
var data = $(this).find(':selected').attr('data-val');
if(data == 0)
{
  $(this).next(".nice-select.process.select1.vdroplinks").removeClass("drop-success").addClass("drop-danger");
}
else{
  $(this).next(".nice-select.process.select1.vdroplinks").removeClass("drop-danger").addClass("drop-success");
}
$.get(link);
$.notify("Status Updated Successfully.","success");
});

$(document).on('change','.data-droplinks',function (e) {
  $('#confirm-delete1').modal('show');
  $('#confirm-delete1').find('.btn-ok').attr('href', $(this).val());
  table.ajax.reload();
  var data = $(this).children("option:selected").html();
  if(data == 'Pending') {
    $('#t-txt').addClass('d-none');
    $('#t-txt').val('');
  }
  else {
    $('#t-txt').removeClass('d-none');
  }
  $('#t-id').val($(this).data('id'));
  $('#t-title').val(data);
});

$(document).on('change','.vendor-droplinks',function (e) {
  $('#confirm-delete1').modal('show');
  $('#confirm-delete1').find('.btn-ok').attr('href', $(this).val());
  table.ajax.reload();
});

$(document).on('change','.order-droplinks',function (e) {
$('#confirm-delete2').modal('show');
$('#confirm-delete2').find('.btn-ok').attr('href', $(this).val());
});


// Droplinks Ends

$('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

      $('#confirm-delete .btn-ok').on('click', function(e) {


    $('.submit-loader').show();


        $.ajax({
         type:"GET",
         url:$(this).attr('href'),
         success:function(data)
         {
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

      $('#confirm-delete1 .btn-ok').on('click', function(e) {


        $('.submit-loader').show();


        $.ajax({
         type:"GET",
         url:$(this).attr('href'),
         success:function(data)
         {
              $('#confirm-delete1').modal('toggle');
              table.ajax.reload();
              $('.alert-danger').hide();
              $('.alert-success').show();
              $('.alert-success p').html(data[0]);


            $('.submit-loader').hide();



         }
        });

        if($('#t-txt').length > 0)
{

      var tdata =  $('#t-txt').val();

      if(tdata.length > 0) {

        var id = $('#t-id').val();
        var title = $('#t-title').val();
        var text = $('#t-txt').val();
        $.ajax({
          url: $('#t-add').val(),
          method: "GET",
          data: { id : id, title: title, text : text }
        });

      }

}
return false;
      });
      
      
            $('#confirm-transfer').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

$('#confirm-transfer .btn-ok').on('click', function(e) {

  $('.submit-loader').show();

        $.ajax({
         type:"GET",
         url:$(this).attr('href'),
         success:function(data)
         {
            $('#confirm-transfer').modal('toggle');
            $('.alert-danger').hide();
             if(data=='success'){
                $.notify("Transfered Successfully.","success");
             }
             else{
                $.notify("Updated Successfully.","danger");
             }

            $('.submit-loader').hide();
         },
         error: function(data){
            $('#confirm-transfer').modal('toggle');
            $('.submit-loader').hide();
            $.notify("Transfered Failed.","error");
         }
        });
        return false;
      });
</script>
@endsection
