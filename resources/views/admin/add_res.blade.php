@extends('layouts.admin')

<style type="text/css">
.search-form {
  position: relative;
  top: 50px;
  left: 50%;
  width: 350px;
  height: 40px;
  border-radius: 40px;
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  background: #fff;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
.search-form.focus {
  box-shadow: 0 3px 4px rgba(0, 0, 0, 0.15);
}

.search-input {
  position: absolute;
  top: 10px;
  left: 38px;
  font-size: 14px;
  background: none;
  color: #5a6674;
  width: 195px;
  height: 20px;
  border: none!important;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: none;
}
.search-input::-webkit-search-cancel-button {
  -webkit-appearance: none;
          appearance: none;
}

.search-button {
  position: absolute;
  top: 10px;
  left: 15px;
  height: 20px;
  width: 20px;
  padding: 0;
  margin: 0;
  border: none;
  background: none;
  outline: none !important;
  cursor: pointer;
}
.search-button svg {
  width: 20px;
  height: 20px;
  fill: #5a6674;
}

.search-option {
  position: absolute;
  text-align: right;
  top: 10px;
  right: 15px;
}
.search-option div {
  position: relative;
  display: inline-block;
  margin: 0 1px;
  cursor: pointer;
}
.search-option div input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0.01;
  cursor: pointer;
}
.search-option div span {
  position: absolute;
  display: block;
  text-align: center;
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  opacity: 0;
  background: #929AA3;
  color: #fff;
  font-size: 9px;
  letter-spacing: 1px;
  line-height: 1;
  text-transform: uppercase;
  padding: 4px 7px;
  border-radius: 12px;
  top: -18px;
  -webkit-transition: all .2s ease-in-out;
  transition: all .2s ease-in-out;
}
.search-option div span::after {
  content: '';
  position: absolute;
  bottom: -3px;
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  border-top: 4px solid #929AA3;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  -webkit-transition: all .2s ease-in-out;
  transition: all .2s ease-in-out;
}
.search-option div:hover span {
  opacity: 1;
  top: -21px;
}
.search-option div label {
  display: block;
  cursor: pointer;
}
.search-option div svg {
  height: 20px;
  width: 20px;
  fill: #5a6674;
  opacity: 0.6;
  -webkit-transition: all .2s ease-in-out;
  transition: all .2s ease-in-out;
  pointer-events: none;
}
.search-option div:hover svg {
  opacity: 1;
}
.search-option div input:checked + label svg {
  fill: #e24040!important;
  opacity: .9;
}
.search-option div input:checked + label span {
  background: #e24040!important;
}
.search-option div input:checked + label span::after {
  border-top-color: #e24040!important;
}



</style>

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
											<a href="#">{{ __("Add New Restaruant") }}</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
                            <div class="row">
                                <div class="gocover" style="background: url('{{asset('../assets/img/spinner.gif')}}') no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                                <div class="col-lg-12" style = "min-height:500px!important">

                                        {{-- @include('includes.form-both') --}}

                                    <form class="search-form" id="geniusform" action = "{{ url('/checkout/admin/restaurant/search') }}" method = "POST" enctype="multipart/form-data">
                                        {{-- @csrf --}}

                                        {{ csrf_field() }}

                                        <input type="search" name= "search" value="" placeholder="Search" class="search-input">
                                        <button type="submit" class="search-button">
                                          <svg class="submit-button">
                                            <use xmlns:xlink="" xlink:href="#search"></use>
                                          </svg>
                                        </button>
                                        <div class="search-option">
                                          <div>
                                            <input name="type" type="radio" value="restaurant_name" id="type-users" checked="">
                                            <label for="type-users">
                                              <svg class="edit-pen-title">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                              </svg>
                                              <span>Name</span>
                                            </label>
                                          </div>

                                          <div>
                                            <input name="type" type="radio" value="restaurant_phone" id="type-posts">
                                            <label for="type-posts">
                                              <svg class="edit-pen-title">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#post"></use>
                                              </svg>
                                              <span>Phone</span>
                                            </label>
                                          </div>
                                          <div>
                                            <input name="type" type="radio" value="address" id="type-images">
                                            <label for="type-images">
                                              <svg class="edit-pen-title">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#images"></use>
                                              </svg>
                                              <span>Address</span>
                                            </label>
                                          </div>
                                        
                                        </div>
                                      </form>

                                      <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
                                        <symbol id="search" viewBox="0 0 32 32">
                                          <path d="M 19.5 3 C 14.26514 3 10 7.2651394 10 12.5 C 10 14.749977 10.810825 16.807458 12.125 18.4375 L 3.28125 27.28125 L 4.71875 28.71875 L 13.5625 19.875 C 15.192542 21.189175 17.250023 22 19.5 22 C 24.73486 22 29 17.73486 29 12.5 C 29 7.2651394 24.73486 3 19.5 3 z M 19.5 5 C 23.65398 5 27 8.3460198 27 12.5 C 27 16.65398 23.65398 20 19.5 20 C 15.34602 20 12 16.65398 12 12.5 C 12 8.3460198 15.34602 5 19.5 5 z" />
                                        </symbol>
                                        <symbol id="user" viewBox="0 0 32 32">
                                          <path d="M 16 4 C 12.145852 4 9 7.1458513 9 11 C 9 13.393064 10.220383 15.517805 12.0625 16.78125 C 8.485554 18.302923 6 21.859881 6 26 L 8 26 C 8 21.533333 11.533333 18 16 18 C 20.466667 18 24 21.533333 24 26 L 26 26 C 26 21.859881 23.514446 18.302923 19.9375 16.78125 C 21.779617 15.517805 23 13.393064 23 11 C 23 7.1458513 19.854148 4 16 4 z M 16 6 C 18.773268 6 21 8.2267317 21 11 C 21 13.773268 18.773268 16 16 16 C 13.226732 16 11 13.773268 11 11 C 11 8.2267317 13.226732 6 16 6 z" /></symbol>
                                        <symbol id="images" viewbox="0 0 32 32">
                                          <path d="M 2 5 L 2 6 L 2 26 L 2 27 L 3 27 L 29 27 L 30 27 L 30 26 L 30 6 L 30 5 L 29 5 L 3 5 L 2 5 z M 4 7 L 28 7 L 28 20.90625 L 22.71875 15.59375 L 22 14.875 L 21.28125 15.59375 L 17.46875 19.40625 L 11.71875 13.59375 L 11 12.875 L 10.28125 13.59375 L 4 19.875 L 4 7 z M 24 9 C 22.895431 9 22 9.8954305 22 11 C 22 12.104569 22.895431 13 24 13 C 25.104569 13 26 12.104569 26 11 C 26 9.8954305 25.104569 9 24 9 z M 11 15.71875 L 20.1875 25 L 4 25 L 4 22.71875 L 11 15.71875 z M 22 17.71875 L 28 23.71875 L 28 25 L 23.03125 25 L 18.875 20.8125 L 22 17.71875 z" />
                                        </symbol>
                                        <symbol id="post" viewbox="0 0 32 32">
                                          <path d="M 3 5 L 3 6 L 3 23 C 3 25.209804 4.7901961 27 7 27 L 25 27 C 27.209804 27 29 25.209804 29 23 L 29 13 L 29 12 L 28 12 L 23 12 L 23 6 L 23 5 L 22 5 L 4 5 L 3 5 z M 5 7 L 21 7 L 21 12 L 21 13 L 21 23 C 21 23.73015 21.221057 24.41091 21.5625 25 L 7 25 C 5.8098039 25 5 24.190196 5 23 L 5 7 z M 7 9 L 7 10 L 7 13 L 7 14 L 8 14 L 18 14 L 19 14 L 19 13 L 19 10 L 19 9 L 18 9 L 8 9 L 7 9 z M 9 11 L 17 11 L 17 12 L 9 12 L 9 11 z M 23 14 L 27 14 L 27 23 C 27 24.190196 26.190196 25 25 25 C 23.809804 25 23 24.190196 23 23 L 23 14 z M 7 15 L 7 17 L 12 17 L 12 15 L 7 15 z M 14 15 L 14 17 L 19 17 L 19 15 L 14 15 z M 7 18 L 7 20 L 12 20 L 12 18 L 7 18 z M 14 18 L 14 20 L 19 20 L 19 18 L 14 18 z M 7 21 L 7 23 L 12 23 L 12 21 L 7 21 z M 14 21 L 14 23 L 19 23 L 19 21 L 14 21 z" />
                                        </symbol>
                                        <symbol id="special" viewbox="0 0 32 32">
                                          <path d="M 4 4 L 4 5 L 4 27 L 4 28 L 5 28 L 27 28 L 28 28 L 28 27 L 28 5 L 28 4 L 27 4 L 5 4 L 4 4 z M 6 6 L 26 6 L 26 26 L 6 26 L 6 6 z M 16 8.40625 L 13.6875 13.59375 L 8 14.1875 L 12.3125 18 L 11.09375 23.59375 L 16 20.6875 L 20.90625 23.59375 L 19.6875 18 L 24 14.1875 L 18.3125 13.59375 L 16 8.40625 z M 16 13.3125 L 16.5 14.40625 L 17 15.5 L 18.1875 15.59375 L 19.40625 15.6875 L 18.5 16.5 L 17.59375 17.3125 L 17.8125 18.40625 L 18.09375 19.59375 L 17 19 L 16 18.40625 L 15 19 L 14 19.59375 L 14.3125 18.40625 L 14.5 17.3125 L 13.59375 16.5 L 12.6875 15.6875 L 13.90625 15.59375 L 15.09375 15.5 L 15.59375 14.40625 L 16 13.3125 z" />
                                        </symbol>
                                      </svg>
                                      @if(session()->get('nothing'))
                                        <h2 class="u-h4 c-opus__title  u-margin-bottom-small" style="text-align: center!important; margin-top:180px!important">No results!</h2>
                                        <div class="" style="text-align:center!important; margin-top: 130px!important">
                                            <a class="add-btn" href="{{ route('admin.show_register_restaruant',['param'=>'null','id'=>'null']) }}">
                                                <i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New Restaruant") }}<span>
                                            </a>
                                        </div>
                                      @endif
                                      @if(!session()->get('nothing') && session()->get('success'))
                                      <div class="c-grid  c-grid__compositions">
                                        <div class="c-grid--sizer"></div>


                                        @foreach(session()->get('success')[0]  as $value)
                                        <a href="{{ route('admin.show_register_restaruant',['param'=>$value->restaurant_name,'id'=>$value->restaurant_id]) }}" class="c-opus  solo">
                                          <div class="c-opus__box  u-box-shadow">
                                            <h2 class="u-h4 c-opus__title  u-margin-bottom-small">{{ $value->restaurant_name }}</h2>
                                            <h3 class="u-h6 c-opus__subtitle  u-margin-bottom-small" style="font-size: 15px!important">{{ $value->address->formatted }}</h3>
                                            <div class="o-layout">
                                              <div class="o-layout__item  u-1/2  c-opus__year">{{ $value->restaurant_id }}</div>
                                              <div class="o-layout__item  u-1/2  c-opus__category">{{ $value->price_range }}</div>
                                            </div>
                                          </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif
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
    $('.search-input').focus(function(){
        $(this).parent().addClass('focus');
    }).blur(function(){
        $(this).parent().removeClass('focus');
    })

//     $(document).on('submit','#geniusform',function(e){
//         e.preventDefault();

//         $('.gocover').show();

//         var fd = new FormData(this);

//         if ($('.attr-checkbox').length > 0) {
//             $('.attr-checkbox').each(function() {

//             // if checkbox checked then take the value of corresponsig price input (if price input exists)
//             if($(this).prop('checked') == true) {

//                 if ($("#"+$(this).attr('id')+'_price').val().length > 0) {
//                 // if price value is given
//                 fd.append($("#"+$(this).attr('id')+'_price').data('name'), $("#"+$(this).attr('id')+'_price').val());
//                 } else {
//                 // if price value is not given then take 0
//                 fd.append($("#"+$(this).attr('id')+'_price').data('name'), 0.00);
//                 }

//                 // $("#"+$(this).attr('id')+'_price').val(0.00);
//             }
//             });
//         }

//         var geniusform = $(this);
//     $('button.addProductSubmit-btn').prop('disabled',true);
//         $.ajax({
//         method:"POST",
//         url:$(this).prop('action'),
//         data:fd,
//         contentType: false,
//         cache: false,
//         processData: false,
//         success:function(data)
//         {
//             console.log(data);
//             if ((data.errors)) {
//                 geniusform.parent().find('.alert-success').hide();
//                 geniusform.parent().find('.alert-danger').show();
//                 geniusform.parent().find('.alert-danger ul').html('');
//                 for(var error in data.errors)
//                 {
//                     $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
//                 }
//                 geniusform.find('input , select , textarea').eq(1).focus();
//                 }
//             else
//             {
//             geniusform.parent().find('.alert-danger').hide();
//             geniusform.parent().find('.alert-success').show();
//             geniusform.parent().find('.alert-success p').html(data);
//             geniusform.find('input , select , textarea').eq(1).focus();
//             }

//             $('.gocover').hide();


//             $('button.addProductSubmit-btn').prop('disabled',false);


//             $(window).scrollTop(0);

//         }

//     });
// });


</script>
@endsection
