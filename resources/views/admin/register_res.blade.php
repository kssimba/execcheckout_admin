@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
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
				<h4 class="heading">{{ __('Register New Restaurant') }} <a class="add-btn"
						href="{{route('admin.dashboard')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="#">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Restaurants') }} </a>
					</li>
					<li>
						<a href="#">{{ __('Add New Restaurant') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{ route('admin.register_menu') }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
								<div class="gocover"
									style="background: url('{{asset('assets/img/spinner.gif')}}') no-repeat scroll center center rgba(45, 45, 45, 0.5);">
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
												name="name" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Website URL') }} </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Website URL') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Address1') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Address2') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter City Town') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter State Province') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Postal Code') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Phone') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Fax') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Facebook Url') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Twitter Url') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Instagram Url') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Pinterest Url') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Youtube Url') }}"
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
											<input type="text" class="input-field" placeholder="{{ __('Enter Goolge Url') }}"
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
											<input type="number" class="input-field" placeholder="{{ __('Enter Seating Qty') }}"
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
											<input type="number" class="input-field" placeholder="{{ __('Enter Max Group') }}"
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
											<input type="number" step='0.01' class="input-field" placeholder="{{ __('Enter Delivery Radius') }}"
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
												name="relay_key">
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
												name="relay_site">
										</div>
                                    </div>
                                </div>
                                
								<div class="row">
                                    <div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Toast Id') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Toast Id') }}"
												name="toast_id">
										</div>
                                    </div>
                                    <div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Toast Secret') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Toast Secret') }}"
												name="toast_secret">
										</div>
                                    </div>
                                    <div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Toast Token') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Toast Token') }}"
												name="toast_token">
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
                                                    name="preptime" value="13">
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
                                                    name="delivery_fee">
                                            </div>
                                    </div>
                                </div>
                                
                                
                                

                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Delivery Share') }}</h4>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                  <select class="custom-select" id="delivery_share" name="delivery">
                                                    <option value="false">0</option>
                                                    <option value="true">2.5</option>
                                                  </select>
                                                  <div class="input-group-append">
                                                    <label class="input-group-text" for="inputGroupSelect02">$</label>
                                                  </div>
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
                                                  <input type="number" class="form-control"  name="delivery_trigger" placeholder="{{ __('Delivery Trigger') }}">
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
												name="order_email">
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
												name="order_fax">
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
												name="order_text">
										</div>
                                    </div>
                                </div>

                                <div class="row">
									<div class="col-lg-4">
										<div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="smoke" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Smoke') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="takeout"  style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Takeout') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="pets" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Pets Allowed') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="wheelchair" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Wheelchair Accessible') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="catering"  style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Catering Available') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
											<div class="left-area">

                                                <input type="checkbox" class="check-field"
												name="reservation" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Reservations') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="vegetarian" style="margin-right:10px!important">
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
                                                name="logo" >
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
												name="brief" >
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
											<textarea class="nic-edit-p" rows="10" class="col-lg-12" name="detail"></textarea>
										</div>
									</div>
								</div>

								<div class="text-center">
									<button class="addProductSubmit-btn" type="submit">{{ __('Add Menu') }}</button>
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
												<option value="0">$</option>
                                                <option value="1">$$</option>
                                                <option value="2">$$$</option>
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
								<!--				name="bakery" style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Bakery') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="bbq"  style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('BBQ') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="coffee_tea" style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Coffee & Tea') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
								<!--			    <input type="checkbox" class="check-field"-->
								<!--				name="comfort_food" style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Comfort Food') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                            <div class="col-lg-6">-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="icecream"  style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Ice Cream') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->

        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="mexican" style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Mexican') }} </h4>-->

        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="pizza" style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Pizza') }} </h4>-->

        <!--                                    </div>-->
								<!--		</div>-->
        <!--                                <div class="col-lg-12">-->
								<!--			<div class="left-area">-->
        <!--                                        <input type="checkbox" class="check-field"-->
								<!--				name="steakhouse" style="margin-right:10px!important">-->
        <!--                                        <h4 class="heading">{{ __('Steakhouse') }} </h4>-->

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
												name="monday" style="margin-right:10px!important" checked>
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
                                                <input type="time" class="input-field" name="mon_open">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="mon_close">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="tuesday" style="margin-right:10px!important" checked>
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
                                                    <input type="time" class="input-field" name="tue_open">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="tue_close">

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="wednesday" style="margin-right:10px!important" checked>
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

                                                    <input type="time" class="input-field" name="wed_open">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="wed_close">

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="thursday" style="margin-right:10px!important" checked>
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

                                                    <input type="time" class="input-field" name="thu_open">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="thu_close">

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="friday" style="margin-right:10px!important" checked>
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

                                                    <input type="time" class="input-field" name="fri_open">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="fri_close">

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="saturday" style="margin-right:10px!important" checked>
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

                                                    <input type="time" class="input-field" name="sat_open">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="sat_close">

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="sunday" style="margin-right:10px!important" checked>
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

                                                    <input type="time" class="input-field" name="sun_open">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="sun_close">

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

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>
<script src="{{asset('assets/admin/js/select2.min.js')}}"></script>
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
        $("#order_fax").hide();
        $("#order_email").hide();
        $("#order_text").hide();
    });

    $('#framework').multiselect({
        nonSelectedText: 'Select Prefer order method',
        enableFiltering: false,
        enableCaseInsensitiveFiltering: false,
        minimumResultsForSearch: -1,
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
