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
				<h4 class="heading">{{ __('Clone Restaurant') }} <a class="add-btn"
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
						<a href="#">{{ __('Clone Restaurant') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{ route('admin-restaruant-clonemenu',$data->id) }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8">
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
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Restaurant Name') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Restaurant Name') }}"
												name="name" value = "{{ $data->name }}" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Website URL') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Website URL') }}" value = "{{ $data->weburl }}"
												name="weburl">
										</div>
									</div>
                                </div>

								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Address1') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Address1') }}" value = "{{ $data->address1 }}"
												name="address1" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Address2') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Address2') }}" value = "{{ $data->address2 }}"
												name="address2">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('City Town') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter City Town') }}" value = "{{ $data->city }}"
												name="city">
										</div>
									</div>
									<div class="col-lg-3">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('State Province') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter State Province') }}" value = "{{ $data->state }}"
												name="state">
										</div>
									</div>
									<div class="col-lg-3">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Postal Code') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Postal Code') }}" value = "{{ $data->postalcode }}"
												name="postalcode">
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Phone') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Phone') }}" value = "{{ $data->phone }}"
												name="phone" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Fax') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Fax') }}" value = "{{ $data->fax }}"
												name="fax" >
										</div>
									</div>
                                </div>


								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Facebook') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Facebook Url') }}" value = "{{ $data->facebook }}"
												name="facebook">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Twitter') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Twitter Url') }}" value = "{{ $data->twitter }}"
												name="twitter" >
										</div>
									</div>
                                </div>

								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Instagram') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Instagram Url') }}" value = "{{ $data->instagram }}"
												name="instagram">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Pinterest') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Pinterest Url') }}" value = "{{ $data->pinterest }}"
												name="pinterest" >
										</div>
									</div>
                                </div>

								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Youtube') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Youtube Url') }}" value = "{{ $data->youtube }}"
												name="youtube">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Google') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Goolge Url') }}" value = "{{ $data->google }}"
												name="google" >
										</div>
									</div>
                                </div>



								<div class="row">
									<div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Seating Qty') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="number" class="input-field" placeholder="{{ __('Enter Seating Qty') }}" value = "{{ $data->seat }}"
												name="seat">
										</div>
                                    </div>


                                    <div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Max Group') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="number" class="input-field" placeholder="{{ __('Enter Max Group') }}" value = "{{ $data->maxgroup }}"
												name="maxgroup">
										</div>
                                    </div>

									<div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Radius(miles)') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="number" class="input-field" placeholder="{{ __('Enter Delivery Radius') }}" value = "{{ $data->deliveryradius }}"
												name="deliveryradius">
										</div>
                                    </div>
                                </div>

								<div class="row">
                                    <div class="col-lg-8">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Relay Key') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Relay Key') }}"
												name="relay_key" value="{{$data->relay_key}}">
										</div>
                                    </div>
                                    <div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Relay Site') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Relay Site') }}"
												name="relay_site" value="{{$data->relay_site}}">
										</div>
                                    </div>
                                </div>
                                
                                              
                            	<div class = "row">
                            	    <div class = "col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Radius(Available Order Types)') }}</h4>
											</div>
										</div>
                            	        <div class = "col-lg-12" id = "orderTypearea">
                            	            @foreach($preferOrderType as $order)
                                                @if ($loop->last)
                                            		<div class="input-group mb-3 new-order-type">
                                                @else
                                            		<div class="input-group mb-3">
                                                @endif
                                        		  <div class="input-group-prepend">
                                        		  	<select class="form-control ordertypeselect" name = "orderTypes[]" style = "height : 35px !important" value="{{$order['orderMethod']}}">
                                        				<option value="E"  "{{ $order['orderMethod'] == 'E' ? 'selected' : '' }}">Email</option>
                                        				<option value="F"  "{{ $order['orderMethod'] == 'F' ? 'selected' : '' }}">Fax</option>
                                        				<option value="C"  "{{ $order['orderMethod'] == 'C' ? 'selected' : '' }}">Call</option>
                                        				<option value="T"  "{{ $order['orderMethod'] == 'T' ? 'selected' : '' }}">Text</option>
                                        		    </select>
                                        		  </div>
                                        		  <input type="Email" class="form-control orderTypeText" value = "{{$order['orderInfo']}}" name = "orderContent[]" aria-label="Text input with dropdown button"  style = "height : 35px !important">
                                              		<a class="input-group-text destroyCurrentOrder" style = "height : 35px !important"><i class = "fa fa-times"  ></i></a>
                                        		</div>
                                    		@endforeach
                                		</div>
                            		</div>
                            	</div>
                            	
                            	
                                <div class="row">
                                    <div class="col-lg-6">

                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Prep_time(mins)') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="number" class="input-field" placeholder="{{ __('Enter Prepare Time') }}"
                                                    name="preptime" value="{{ $data->prep_time }}">
                                            </div>

                                    </div>
                                    <div class="col-lg-6">

                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Delivery Fee') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="input-field" placeholder="{{ __('Delivery Fee') }}"
                                                    name="delivery_fee" value="{{ $data->delivery_fee }}">
                                            </div>

                                    </div>
                                </div>
                                
                                
                                

                                <div class="row">
                                    <div class="col-lg-6">

                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Delivery Share') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                  <select class="custom-select" id="inputGroupSelect02" name="delivery">
                                                    <option value="false" {{$data->delivery == false ? 'selected' : ''}}>0</option>
                                                    <option value="true"  {{$data->delivery == true ? 'selected' : ''}}>2.5</option>
                                                  </select>
                                                  <div class="input-group-append">
                                                    <label class="input-group-text" for="inputGroupSelect02">$</label>
                                                  </div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="col-lg-6">

                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Delivery Trigger') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                  <input type="number" class="form-control"  name="delivery_trigger" value="{{ $data->delivery_trigger }}" placeholder="{{ __('Delivery Trigger') }}">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">$</span>
                                                  </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                                
                                

                                <div class="row">
                                    <div class="col-lg-4" id="order_email">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Order_email') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter order email') }}"
												name="order_email" value="{{ $email ?? '' }}" id="id_order_email">
										</div>
                                    </div>
                                    <div class="col-lg-4" id="order_fax">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Order_fax') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter order fax') }}"
												name="order_fax" value="{{ $fax ?? ''}}" id="id_order_fax">
										</div>
                                    </div>
                                    <div class="col-lg-4" id="order_text">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Order_text') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter order text') }}"
												name="order_text" value="{{ $text ?? ''}}" id="id_order_text">
										</div>
                                    </div>
                                </div>

                                <div class="row">
									<div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="smoke" style="margin-right:10px!important" {{ $data->smoke=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Smoke') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="takeout"  style="margin-right:10px!important" {{ $data->takeout=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Takeout') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="pets" style="margin-right:10px!important" {{ $data->pets=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Pets Allowed') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="wheelchair" style="margin-right:10px!important" {{ $data->wheelchair=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Wheelchair Accessible') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="catering"  style="margin-right:10px!important" {{ $data->catering=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Catering Available') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
											<div class="left-area">

                                                <input type="checkbox" class="check-field"
												name="reservation" style="margin-right:10px!important" {{ $data->reservation=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Reservations') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="vegetarian" style="margin-right:10px!important" {{ $data->vegetarian=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Vegetarian Friendly') }} </h4>

                                            </div>
										</div>
									</div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Logo Image') }} </h4>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <input type="text" class="input-field" placeholder="{{ __('Enter Logo Image Url') }}"
                                                name="logo" value="{{ $data->logo }}">
                                        </div>
                                    </div>
								</div>
								
							

								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Brief Description') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Brief Description') }}"
												name="brief" value="{{ $data->brief }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Full Description') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<textarea class="nic-edit-p" rows="10" class="col-lg-12" name="detail" >{{ $data->detail }}</textarea>
										</div>
									</div>
								</div>

								<div class="text-center">
									<button class="addProductSubmit-btn" type="submit">{{ __('Go to Menu') }}</button>
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



								<br> <hr>
								<h4 class="text-center">Price Range</h4>
								<hr>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Price Range') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
                                            <select class="input-field" name="price">
												<option value="0" {{ $data->price=="$"?"selected":"" }}>$</option>
                                                <option value="1" {{ $data->price=="$$"?"selected":"" }}>$$</option>
                                                <option value="2" {{ $data->price=="$$$"?"selected":"" }}>$$$</option>
											</select>
										</div>
									</div>
                                </div>

        
        <!--                        <br> <hr>-->
								<!--<h4 class="text-center">Cuisine Type</h4>-->
        <!--                        <hr>-->

        <!--                        <div class="row">-->
								<!--	<div class="col-lg-6">-->
								<!--		<div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="burgurs" style="margin-right:10px!important" {{ $data->burgurs=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Burgurs') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="sushi"  style="margin-right:10px!important" {{ $data->sushi=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Sushi') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="Ramen" style="margin-right:10px!important" {{ $data->ramen=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Ramen') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="barfood" style="margin-right:10px!important" {{ $data->barfood=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Bar food') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="breakfast"  style="margin-right:10px!important" {{ $data->breakfast=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Breakfast') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="col-lg-6">-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="italian"  style="margin-right:10px!important" {{ $data->italian=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Italian') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->

        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="japanese" style="margin-right:10px!important" {{ $data->japanese=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Japanese') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="newmexican" style="margin-right:10px!important" {{ $data->newmexican=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('New Mexican') }} </h4>-->

        <!--                                    </div>-->
								<!--		</div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="sandwiches" style="margin-right:10px!important" {{ $data->sandwiches=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Sandwiches') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="mediterranean" style="margin-right:10px!important" {{ $data->mediterranean=='on'?"checked":"" }}>-->
        <!--                                        <h4 class="heading">{{ __('Mediterranean') }} </h4>-->

        <!--                                    </div>-->
								<!--		</div>-->
								<!--	</div>-->
        <!--                        </div>-->

                                <br> <hr>
								<h4 class="text-center">Days of Week</h4>
                                <hr>

                                <div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="monday" style="margin-right:10px!important" {{ $data->monday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Monday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="mon_open" value="{{ $data->mon_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="mon_close" value="{{ $data->mon_close }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="tuesday" style="margin-right:10px!important" {{ $data->tuesday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Tuesday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="tue_open" value="{{ $data->tue_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="tue_close" value="{{ $data->tue_close }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="wednesday" style="margin-right:10px!important" {{ $data->wednesday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Wednesday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="wed_open" value="{{ $data->wed_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="wed_close" value="{{ $data->wed_close }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="thursday" style="margin-right:10px!important" {{ $data->thursday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Thursday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="thu_open" value="{{ $data->thu_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="thu_close" value="{{ $data->thu_close }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="friday" style="margin-right:10px!important" {{ $data->friday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Friday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="fri_open" value="{{ $data->fri_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="fri_close" value="{{ $data->fri_close }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="saturday" style="margin-right:10px!important" {{ $data->saturday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Saturday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="sat_open" value="{{ $data->sat_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="sat_close" value="{{ $data->sat_close }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="sunday" style="margin-right:10px!important" {{ $data->sunday=='on'?"checked":"" }}>
                                                <h4 class="heading">{{ __('Sunday') }} </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Open Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="sun_open" value="{{ $data->sun_open }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="sun_close" value="{{ $data->sun_close }}">
                                            </div>
                                        </div>
									</div>
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

<script src="{{ asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>


<!-- script code for adding order input types -->
<script type = "text/javascript">
$(document).ready(function() {
    const appendInit = () => {
		$('.ordertypeselect').on('change', function() {
			let type = $(this).val()
			let parent = $(this).parent().parent()
			if (type == 'E') 
				parent.children("input").attr({type : 'email'})
			else if (type == "F")
				parent.children("input").attr({type : 'text'})
			else
				parent.children("input").attr({type : 'phone'})
		})

		$('.orderTypeText').on('change', function() {
			let parent = $(this).parent()
			if(parent.attr('class').indexOf("new-order-type") != -1){
				parent.attr({class:'input-group mb-3'})
				appendNewInput()
			}
			appendInit();
		})

		$('.destroyCurrentOrder').click(function() {
			if ( $(this).parent().attr('class').indexOf('new-order-type') != -1 ) {
				let parent = $(this).parent().remove();
				$('#orderTypearea').children().last().attr({class : 'input-group mb-3 new-order-type'});
			} else {
				let parent = $(this).parent().remove();
			}
			// If there is no order type
			if (!$('#orderTypearea').children().length){
				appendNewInput()
			}
			appendInit();
		})
	}

	const appendNewInput = () => {
		let html_content = `
			<div class="input-group mb-3 new-order-type">
			  <div class="input-group-prepend">
			  	<select class="form-control ordertypeselect" name = "orderTypes[]" style = "height : 35px !important">
					<option value="E">Email</option>
    				<option value="F">Fax</option>
    				<option value="C">Call</option>
    				<option value="T">Text</option>
			    </select>
			  </div>
			  <input type="Email" class="form-control orderTypeText" name = "orderContent[]" aria-label="Text input with dropdown button"  style = "height : 35px !important">
	      		<a class="input-group-text destroyCurrentOrder" style = "height : 35px !important"><i class = "fa fa-times"  ></i></a>
			</div>
		`;
		$('#orderTypearea').append(html_content);
	}

	appendInit()
});
</script>


<script type="text/javascript">
	// Gallery Section Insert
	var menus = [];
 var option_fax = $("#framework").children().eq(0);
    var option_email = $("#framework").children().eq(1);
    var option_text = $("#framework").children().eq(2);
	$(document).ready(function() {
        $('#course_list').select2();
		$('.cropme').simpleCropper();

    });
    $('#framework').multiselect({
  nonSelectedText: 'Select Prefer order method',
  enableFiltering: false,
  enableCaseInsensitiveFiltering: false,
  minimumResultsForSearch: -1,
 });


 $(document).ready(function() {
        $('#course_list').select2();
		$('.cropme').simpleCropper();
        var vals = [];
        if($("#id_order_fax").val() == '')
            $("#order_fax").hide();
        else{
            vals.push('Fax');
            $('.multiselect-container').children().eq(0).toggleClass("active");
            $('.multiselect-container').children().eq(0).children().eq(0).children().eq(0).children().eq(0).prop("checked",true);
            $('.multiselect').children().eq(0).text(vals);

        }
        if($("#id_order_email").val() == '')
            $("#order_email").hide();
        else{
            vals.push('Email');
            $('.multiselect-container').children().eq(1).toggleClass("active");
            $('.multiselect-container').children().eq(1).children().eq(0).children().eq(0).children().eq(0).prop("checked",true);
            $('.multiselect').children().eq(0).text(vals);
        }
        if($("#id_order_text").val() == '')
            $("#order_text").hide();
        else{
            vals.push('Text');
            $('.multiselect-container').children().eq(2).toggleClass("active");
            $('.multiselect-container').children().eq(2).children().eq(0).children().eq(0).children().eq(0).prop("checked",true);
            $('.multiselect').children().eq(0).text(vals);
        }
        $("#framework").val(vals);

    });

    $(document).ready(function(){
        $("#framework").change(function(){
            if(option_fax.prop("selected")){
                $("#order_fax").show();
            }
            else{
                $("#order_fax").hide();
            }
            if(option_email.prop("selected")){
                $("#order_email").show();
            }
            else{
                $("#order_email").hide();
            }
            if(option_text.prop("selected")){
                $("#order_text").show();
            }
            else{
                $("#order_text").hide();
            }

        });
    });

</script>
@endsection
