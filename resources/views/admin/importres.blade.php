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
				<h4 class="heading">{{ __('Import New Restaurant') }} <a class="add-btn"
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
						<a href="#">{{ __('Import New Restaurant') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{ route('admin.import_menu',['id'=>$id,'code'=>$code]) }}" method="POST" enctype="multipart/form-data">
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
												name="name" required="" value = "{{ $res_info->restaurant_info->restaurant_name }}">
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
												name="weburl" value="{{ $res_info->restaurant_info->website_url }}">
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
												name="address1" required="" value = "{{ $res_info->restaurant_info->address_1 }}">
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
												name="address2" value = "{{ $res_info->restaurant_info->address_2 }}">
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
												name="city" value="{{ $res_info->restaurant_info->city_town }}">
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
												name="state" value="{{ $res_info->restaurant_info->state_province }}">
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
												name="postalcode" value="{{ $res_info->restaurant_info->postal_code }}">
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
												name="phone" required="" value = "{{ $res_info->restaurant_info->phone }}">
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
												name="fax" value = "{{ $res_info->restaurant_info->fax }}">
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
												name="facebook" value="{{ ($res_info->settings->social==false?"":$res_info->settings->social->facebook)!=null?$res_info->settings->social->facebook:"" }}">
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
												name="twitter" value="{{ ($res_info->settings->social==false?"":$res_info->settings->social->twitter)!=null?$res_info->settings->social->twitter:"" }}">
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
												name="instagram" value="{{ ($res_info->settings->social==false?"":$res_info->settings->social->instagram)!=null?$res_info->settings->social->instagram:"" }}">
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
												name="pinterest" value="{{ ($res_info->settings->social==false?"":$res_info->settings->social->pinterest)!=null?$res_info->settings->social->pinterest:"" }}">
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
												name="youtube" value = "{{ ($res_info->settings->social==false?"":$res_info->settings->social->youtube)!=null?$res_info->settings->social->youtube:"" }}">
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
									<div class="col-lg-3">
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


                                    <div class="col-lg-3">
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

									<div class="col-lg-3">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Radius(miles)') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="number" class="input-field" placeholder="{{ __('Enter Delivery Radius') }}"
												name="deliveryradius">
										</div>
                                    </div>

                                    <div class="col-lg-3">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Relay ID') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Relay ID') }}"
												name="relay_id">
										</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Preferred_order_method') }}</h4>
											</div>
										</div>
										<div class="col-lg-12">

                                            <div class="left-area">
                                                <select id="framework" name="prefer_order[]" multiple class="select-field" >
                                                    <option value="Fax">Fax</option>
                                                    <option value="Email">Email</option>
                                                    <option value="Text">Text</option>
                                                </select>
                                            </div>

										</div>
                                    </div>
                                    <div class="col-lg-3">

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
                                    <div class="col-lg-3">
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
												name="smoke" style="margin-right:10px!important" {{ ($res_info->environment_info->smoking_allowed==null?"":$res_info->environment_info->smoking_allowed)==0?"":"checked" }}>
                                                <h4 class="heading">{{ __('Smoke') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="takeout"  style="margin-right:10px!important" {{ ($res_info->environment_info->takeout_available==null?"":$res_info->environment_info->takeout_available)==0?"":"checked" }}>
                                                <h4 class="heading">{{ __('Takeout') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="pets" style="margin-right:10px!important" {{ ($res_info->environment_info->pets_allowed==null?"":$res_info->environment_info->pets_allowed)==0?"":"checked" }}>
                                                <h4 class="heading">{{ __('Pets Allowed') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="wheelchair" style="margin-right:10px!important" {{ ($res_info->environment_info->wheelchair_accessible==null?"":$res_info->environment_info->wheelchair_accessible)==0?"":"checked" }}>
                                                <h4 class="heading">{{ __('Wheelchair Accessible') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="delivery"  style="margin-right:10px!important" {{ ($res_info->environment_info->delivery_available==null?"":$res_info->environment_info->delivery_available)==0?"":"checked" }}>
                                                <h4 class="heading">{{ __('Delivery Available') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="catering"  style="margin-right:10px!important" {{ ($res_info->environment_info->catering_available==null?"":$res_info->environment_info->catering_available)==0?"":"checked" }}>
                                                <h4 class="heading">{{ __('Catering Available') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="col-lg-12">
											<div class="left-area">

                                                <input type="checkbox" class="check-field"
												name="reservation" style="margin-right:10px!important" {{ ($res_info->environment_info->reservations==null?"":$res_info->environment_info->reservations)==0?"":"checked" }}>
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
                                                name="logo" value="{{ $res_info->logo_urls!=null?$res_info->logo_urls->logo_url:"" }}">
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
												name="brief" value="{{ $res_info->restaurant_info->brief_description }}">
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
											<textarea class="nic-edit-p" rows="10" class="col-lg-12" name="detail" value="{{ $res_info->restaurant_info->full_description }}"></textarea>
										</div>
									</div>
								</div>

								<div class="text-center">
									<button class="addProductSubmit-btn" type="submit">{{ __('Import Menu') }}</button>
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
                                                <option value="3">$$$</option>
											</select>
										</div>
									</div>
                                </div>

                                <br> <hr>
								<h4 class="text-center">Cuisine Type</h4>
                                <hr>

                                <div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="burgurs" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Burgurs') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="sushi"  style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Sushi') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="Ramen" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Ramen') }} </h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
											    <input type="checkbox" class="check-field"
												name="barfood" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Bar food') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="breakfast"  style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Breakfast') }} </h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="italian"  style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Italian') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">

                                                <input type="checkbox" class="check-field"
												name="japanese" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Japanese') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="newmexican" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('New Mexican') }} </h4>

                                            </div>
										</div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="sandwiches" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Sandwiches') }} </h4>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
											<div class="left-area">
                                                <input type="checkbox" class="check-field"
												name="mediterranean" style="margin-right:10px!important">
                                                <h4 class="heading">{{ __('Mediterranean') }} </h4>

                                            </div>
										</div>
									</div>
                                </div>

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
                                                <input type="time" class="input-field" name="mon_open" value="{{ isset($res_info->operating_days[0])?$res_info->operating_days[0]->open_time:"" }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                <input type="time" class="input-field" name="mon_close" value="{{ isset($res_info->operating_days[0])?$res_info->operating_days[0]->close_time:"" }}">

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
                                                    <input type="time" class="input-field" name="tue_open" value="{{ isset($res_info->operating_days[1])?$res_info->operating_days[1]->open_time:"" }}">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="tue_close" value="{{ isset($res_info->operating_days[1])?$res_info->operating_days[1]->close_time:"" }}">

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

                                                    <input type="time" class="input-field" name="wed_open" value="{{ isset($res_info->operating_days[2])?$res_info->operating_days[2]->open_time:"" }}">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="wed_close" value="{{ isset($res_info->operating_days[2])?$res_info->operating_days[2]->close_time:"" }}">

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

                                                    <input type="time" class="input-field" name="thu_open" value="{{ isset($res_info->operating_days[3])?$res_info->operating_days[3]->open_time:"" }}">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="thu_close" value="{{ isset($res_info->operating_days[3])?$res_info->operating_days[3]->close_time:"" }}">

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

                                                    <input type="time" class="input-field" name="fri_open" value="{{ isset($res_info->operating_days[4])?$res_info->operating_days[4]->open_time:"" }}">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>

                                                    <input type="time" class="input-field" name="fri_close" value="{{ isset($res_info->operating_days[4])?$res_info->operating_days[4]->close_time:"" }}">

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

                                                    <input type="time" class="input-field" name="sat_open" value="{{ isset($res_info->operating_days[5])?$res_info->operating_days[5]->open_time:"" }}">

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                    <input type="time" class="input-field" name="sat_close" value="{{ isset($res_info->operating_days[5])?$res_info->operating_days[5]->close_time:"" }}">
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
                                                    <input type="time" class="input-field" name="sun_open" value="{{ isset($res_info->operating_days[6])?$res_info->operating_days[6]->open_time:"" }}">
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="left-area">
                                                        <h4 class="heading">{{ __('Close Time') }}</h4>
                                                    </div>
                                                </div>
                                                    <input type="time" class="input-field" name="sun_close" value="{{ isset($res_info->operating_days[6])?$res_info->operating_days[6]->close_time:"" }}">
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

<script src="{{ asset('assets/admin/js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

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

    $(document).on('submit','#geniusform',function(e){
        $('.gocover').show();
});

</script>
@endsection
