@extends('layouts.admin')

@section('content')
					<input type="hidden" id="headerdata" value="{{ __("PRODUCT") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
									<h4 class="heading">{{ __("Restaruants") }}</h4>
									<ul class="links">
										<li>
											<a href="#">{{ __("Dashboard") }} </a>
										</li>
										<li>
											<a href="javascript:;">{{ __("Restaruants") }} </a>
										</li>
										<li>
											<a href="#">{{ __("View Restaruants") }}</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
							<div class="gocover" style="background: url({{asset('assets/img/spinner.gif')}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
								<div class="col-lg-12">
									<div class="mr-table allproduct">
										<div class="table-responsiv">
											<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
								                        <th>{{ __("Name") }}</th>
														<th>{{ __("ZipCode") }}</th>
								                        <th>{{ __("Address1") }}</th>
								                        <th>{{ __("Address2") }}</th>
								                        <th>{{ __("Phone") }}</th>
								                        <th>{{ __("Images") }}</th>
								                        <th>{{ __("Imported") }}</th>
                                                        <th>{{ __("Action") }}</th>
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

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to delete this Course.") }}</p>
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

{{-- DELETE MODAL ENDS --}}

@endsection



@section('scripts')
<script type="text/javascript">
{{-- DATA TABLE --}}
	var table = $('#geniustable').DataTable({
		   ordering: false,
           processing: true,
           serverSide: true,
           ajax: '{{ route('admin.restaruants.results',$code) }}',
           columns: [
                    { data: 'name', name: 'name' },
					{ data: 'zipcode', name: 'zipcode' },
                    { data: 'address1', name: 'address1' },
                    { data: 'address2', name: 'address2' },
                    { data: 'phone', name:'phone'},
        			{ data: 'images', name: 'images' },
        			{ data: 'status', name: 'status' },
                    { data: 'action', name: 'action' }

                 ],
            language : {
            	processing: '<img src="{{asset('assets/img/spinner.gif')}}">'
            },
			drawCallback : function( settings ) {
    				$('.select').niceSelect();
			}
        });

  	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" href="{{route('admin.find_restaruant')}}">'+
          '<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Find New Restaruants") }}<span>'+
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

function dosearch(){
	$('.gocover').show();
}
{{-- DATA TABLE ENDS--}}
</script>
@endsection
