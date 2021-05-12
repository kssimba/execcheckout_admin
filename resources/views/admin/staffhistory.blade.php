@extends('layouts.admin')

@section('content')
					<input type="hidden" id="headerdata" value="{{ __("PRODUCT") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
                                    <h4 class="heading">{{ __('Staffs History') }} <a class="add-btn"
                                        href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
                                    </h4>

									<ul class="links">
										<li>
											<a href="#">{{ __("Dashboard") }} </a>
										</li>
										<li>
											<a href="javascript:;">{{ __("Staffs") }} </a>
										</li>
										<li>
											<a href="#">{{ __("History") }}</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
										<div class="table-responsiv">
											<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
								                        <th>{{ __("Restaurant Name") }}</th>
								                        <th>{{ __("Sales Person") }}</th>
								                        <th>{{ __("Date") }}</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

@endsection



@section('scripts')
<script type="text/javascript">
{{-- DATA TABLE --}}
	var table = $('#geniustable').DataTable({
		   ordering: false,
           processing: true,
           serverSide: true,
           ajax: '{{ route('admin.staffhistory.datatables') }}',
           columns: [
                    { data: 'name', name: 'name' },
                    { data: 'person', name: 'person' },
                    { data: 'date', name: 'date' }
                 ],
            language : {
            	processing: '<img src="{{ asset('assets/img/spinner.gif') }}">'
            },
			drawCallback : function( settings ) {
    				$('.select').niceSelect();
			}
        });
</script>
@endsection
