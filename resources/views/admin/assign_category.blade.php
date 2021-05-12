@extends('layouts.admin')
@section('styles')

<link href="{{ asset('assets/admin/css/product.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/jquery.Jcrop.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/Jcrop-style.css') }}" rel="stylesheet" />
<style type="text/css">
</style>
@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Assgin Categories') }} <a class="add-btn"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
                </h4>
				
				<ul class="links">
					<li>
						<a href="#">{{ __("Dashboard") }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __("Categories") }} </a>
					</li>
					<li>
						<a href="#">{{ __("Assign Categories") }}</a>
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
				    <div class="submit-loader">
                        <img  src="{{asset('assets/img/spinner.gif')}}" alt="">
                    </div>
					<div class="table-responsiv">
						<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
								    <th class="text-center">
                                        <input type="checkbox" class="" id="chk_all"/>
                                    </th>
								    <th>Actions</th>
								    <th></th>
			                        <th>{{ __("Name") }}</th>
			                        <th>{{ __("Address") }}</th>
			                        @foreach($vendors_category as $category)
    			                        @if($category["photo"])
    			                            <th>{{$category["title"]}}</th>
    			                        @endif
			                        @endforeach
								</tr>
							</thead>
							<tbody>
							    @foreach($vendors_restaurant as $restaurant)
							    <tr>
                                    <td class="text-center">
                                        @if(isset($restaurant['restaurant_id']))
                                        <input type="checkbox" data-id="{{$restaurant['id']}}" data-restaurant_id="{{$restaurant['restaurant_id']}}" class="check-all " />
                                        @else
                                        <input type="checkbox" data-id="{{$restaurant['id']}}" class="check-all " />
                                        @endif
                                    </td>
							        <td style="text-align: center;">
							            @if(isset($restaurant['restaurant_id']))
							            <i class="fa fa-pencil edit-column" style="padding-right: 11px; cursor: pointer;" id="edit_btn_{{$restaurant['id']}}_{{$restaurant['restaurant_id']}}" onclick="onEdit(this, '{{$restaurant['id']}}', '{{$restaurant['restaurant_id']}}')"></i>
							            <i class="fas fa-save save-column" style="cursor: pointer;" id="save_btn_{{$restaurant['id']}}_{{$restaurant['restaurant_id']}}" onclick="onSave('{{$restaurant['id']}}', '{{$restaurant['restaurant_id']}}')"></i>
							            @else
							            <i class="fa fa-pencil edit-column" style="padding-right: 11px; cursor: pointer;" id="edit_btn_{{$restaurant['id']}}" onclick="onEdit(this, '{{$restaurant['id']}}')"></i>
							            <i class="fas fa-save save-column" style="cursor: pointer;" id="save_btn_{{$restaurant['id']}}" onclick="onSave('{{$restaurant['id']}}')"></i>
							            @endif
							        </td>
							        <td>
							        </td>
							        <td>{{$restaurant["name"]}}</td>
							        <td>{{$restaurant["address"]}}</td>
							        @foreach($vendors_category as $category)
    			                        @if($category["photo"])
    			                            <td style="text-align: center">
    			                                <!--<input type="checkbox">-->
    			                                @if(isset($restaurant['restaurant_id']))
        			                                @if(isset($restaurant["cuisine_type"][$category["title"]]) && $restaurant["cuisine_type"][$category["title"]] == true)
        			                                    <input type="checkbox" id="chk_{{$restaurant['id']}}_{{$category['id']}}_{{$restaurant['restaurant_id']}}" checked disabled>
            			                            @else
            			                                <input type="checkbox" id="chk_{{$restaurant['id']}}_{{$category['id']}}_{{$restaurant['restaurant_id']}}" disabled>
            			                            @endif
            			                        @else
            			                            @if(isset($restaurant["cuisine_type"][$category["title"]]) && $restaurant["cuisine_type"][$category["title"]] == true)
        			                                    <input type="checkbox" id="chk_{{$restaurant['id']}}_{{$category['id']}}" checked disabled>
            			                            @else
            			                                <input type="checkbox" id="chk_{{$restaurant['id']}}_{{$category['id']}}" disabled>
            			                            @endif
            			                        @endif
    			                            </td>
    			                        @endif
			                        @endforeach
							    </tr>
							    @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('assets/admin/js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

<style>
.godropdown .action-list {
    right: auto;
    left: 0px;
}
#geniustable .control:before {
    right: 0px;
    left: auto;
}
</style>

<script type="text/javascript">

    var vendors_restaurant = <?php echo json_encode($vendors_restaurant)?>;
    var vendors_category = <?php echo json_encode($vendors_category)?>;
    var check_vendor_id = "";
    var check_id = "";
    var flg = 0;
    
    
    
   $('#geniustable').DataTable({
       responsive: {
            details: {
                type: 'column',
                target: 1
            }
        },
        columnDefs: [ {
            className: 'control',
            targets:   [1]
        },
        {
            orderable: false,
            targets:   [0,1]
        } ]
   });
    $('td').each(function (i, el){
        if(el.style.display == "none"){
            el.children[0].id = "noDisplay";
        }
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
  	$(function() {
        $('#geniustable_length').parent().append('<div class="godropdown bulk-action  add-btn ml-4 float-left"><a class="go-dropdown-toggle">Bulk Actions<i class="fas fa-chevron-down"></i></a><div class="action-list"><a href="javascript:;" class="edit" > <i class="fas fa-edit"></i> Edit</a><a href="javascript:;" class="save"><i class="fas fa-save"></i> Save</a></div></div>');
        $('#geniustable_info').parent().append('<div class="godropdown bulk-action  add-btn ml-4 float-left"><a class="go-dropdown-toggle">Bulk Actions<i class="fas fa-chevron-down"></i></a><div class="action-list"><a href="javascript:;" class="edit" > <i class="fas fa-edit"></i> Edit</a><a href="javascript:;" class="save"><i class="fas fa-save"></i> Save</a></div></div>');

        $(document).on('change', '#chk_all', function () {
            $('.check-all').prop('checked', this.checked);
        });

        $(document).on('click', '.bulk-action .edit', function() {
            $('.check-all:checked').parent().next().attr('bulk', 1).click();
            $('.check-all:checked').each(function(i, e){
                var id = $(e).data('id');
                var res_id = $(e).data('restaurant_id');
                for(var i = 0; i < vendors_category.length; i ++){
                    if(res_id)
                    {
                        $(`#chk_${id}_${vendors_category[i]['id']}_${res_id}`).prop( "disabled", false );
                    }
                    else{
                        $(`#chk_${id}_${vendors_category[i]['id']}`).prop( "disabled", false );
                    }
                }
            })
        });
        $(document).off('click', '.bulk-action .save')
        $(document).on('click', '.bulk-action .save', function() {
            var result = [];
            $('.submit-loader').show();
            $('.check-all:checked').each(function(i, e) {
                row = {}
                row.restaurant_vendorId = $(e).data('id');
                row.restaurant_id = $(e).data('restaurant_id');
                row.category_status = [];
                for(var i = 0; i < vendors_category.length; i ++){
                    if(row.restaurant_id)
                    {
                        var isChecked;
                        if($(`#chk_${row.restaurant_vendorId}_${vendors_category[i]['id']}_${row.restaurant_id}`).is(":checked"))
                            isChecked = "true";
                        else{
                            isChecked = "false";
                        }
                        
                        row.category_status[i] = {
                            category_title: vendors_category[i]["title"],
                            status: isChecked
                        }
                        
                    }
                    else{
                        $(`#chk_${row.restaurant_vendorId}_${vendors_category[i]['id']}`).prop( "disabled", false );
                        var isChecked;
                        if($(`#chk_${row.restaurant_vendorId}_${vendors_category[i]['id']}`).is(":checked"))
                            isChecked = "true";
                        else{
                            isChecked = "false";
                        }

                        row.category_status[i] = {
                            category_title: vendors_category[i]["title"],
                            status: isChecked
                        }
                    }
                }
                result.push(row);
            })
            $.ajax({
                type:'POST',
                url:"{{ route('admin-bulk-change-category-status') }}",
                data:{
                    data: result,
                    "_token": "{{ csrf_token() }}",
                },
                success:function(data){
                    $('.submit-loader').hide();
                    if(data.status == 200) {
                        $.notify("Changed Successfully","success");
                    } else {
                        $.notify(data.msg);
                    }
                }
            });
        });
      });
    // $('.edit-column').click(function() {
    //     var str_arr = $(this).attr("id").split("_");
    //     var restaurant_vendorId = str_arr[2];
    //     for(var i = 0; i < vendors_category.length; i ++){
    //         if(check_vendor_id){
    //             if(flg == 1)
    //             {
    //                 console.log('aaa');
    //                 $(`#chk_${check_vendor_id}_${vendors_category[i]['id']}_${check_id}`).prop( "disabled", true );
    //             }
    //             else
    //                 $(`#chk_${check_vendor_id}_${vendors_category[i]['id']}`).prop( "disabled", true );
    //         }
    //         if(str_arr[3])
    //         {
    //             $(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}_${str_arr[3]}`).prop( "disabled", false );
    //         }
    //         else{
    //             $(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}`).prop( "disabled", false );
    //         }
    //     }
        
    //     console.log(restaurant_vendorId);
    //     check_vendor_id = restaurant_vendorId;
    //     if(str_arr[3])
    //     {
    //         flg = 1;
    //         check_id = str_arr[3];
    //     }
    //     else
    //         flg = 0;
    // });
    function onEdit(target, vendor_id, restaurant_id){
        // var str_arr = $(this).attr("id").split("_");
        if(target) {
            if($(target).parent().attr('bulk') == '1') {
                $(target).parent().removeAttr('bulk');
                return
            }
        }
        var restaurant_vendorId = vendor_id;
        for(var i = 0; i < vendors_category.length; i ++){
            if(check_vendor_id){
                if(flg == 1)
                {
                    $(`#chk_${check_vendor_id}_${vendors_category[i]['id']}_${check_id}`).prop( "disabled", true );
                }
                else
                    $(`#chk_${check_vendor_id}_${vendors_category[i]['id']}`).prop( "disabled", true );
            }
            if(restaurant_id)
            {
                $(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}_${restaurant_id}`).prop( "disabled", false );
            }
            else{
                $(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}`).prop( "disabled", false );
            }
        }
        
        check_vendor_id = restaurant_vendorId;
        if(restaurant_id)
        {
            flg = 1;
            check_id = restaurant_id;
        }
        else
            flg = 0;
    }
    
    $('#geniustable').on('click', 'td.control', function () {
        if($(this).attr('bulk') == '1') {
            $(this).removeAttr('bulk')
            return
        }
        $('td').each(function (i, el){
            if(el.style.display == "none"){
                el.children[0].id = "noDisplay";
            }
        });
        
        var checkbox_id = $(this).parent().children()[6].children[0].id;
        var str_arr = checkbox_id.split("_");
        if(check_vendor_id == str_arr[1])
        {
            
            onEdit(null, str_arr[1], str_arr[3]);
            
        }
    } );
    
    function onSave(vendor_id, restaurant_id) {
        var category_status = new Array();
        var restaurant_vendorId = vendor_id;
        
        $('.submit-loader').show();
        
        for(var i = 0; i < vendors_category.length; i ++){
            if(restaurant_id)
            {
                var isChecked;
                if($(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}_${restaurant_id}`).is(":checked"))
                    isChecked = "true";
                else
                    isChecked = "false";
                category_status[i] = {
                    category_title: vendors_category[i]["title"],
                    status: isChecked
                }
                
            }
            else{
                $(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}`).prop( "disabled", false );
                var isChecked;
                if($(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}`).is(":checked"))
                    isChecked = "true";
                else
                    isChecked = "false";
                category_status[i] = {
                    category_title: vendors_category[i]["title"],
                    status: isChecked
                }
            }
        }
        if(restaurant_id)
        {
            $.ajax({
                type:'POST',
                url:"{{ route('admin-change-category-status') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                  restaurant_vendorId: restaurant_vendorId,
                  restaurant_id: restaurant_id,
                  category_status: category_status
                },
                success:function(data){
                    $('.submit-loader').hide();
                    if(data.status == 200) {
                        $.notify("Changed Successfully","success");
                    } else {
                        $.notify(data.msg);
                    }
                }
              });
        }
        else{
            $.ajax({
                type:'POST',
                url:"{{ route('admin-change-category-status') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                  restaurant_vendorId: restaurant_vendorId,
                  category_status: category_status
                },
                success:function(data){
                    $('.submit-loader').hide();
                    if(data.status == 200) {
                        $.notify("Changed Successfully","success");
                    } else {
                        $.notify(data.msg);
                    }
                }
              });
        }
    }
    // $('.save-column').click(function() {
    //     var category_status = new Array();
    //     var str_arr = $(this).attr("id").split("_");
    //     var restaurant_vendorId = str_arr[2];
        
    //     $('.submit-loader').show();
        
    //     for(var i = 0; i < vendors_category.length; i ++){
    //         if(str_arr[3])
    //         {
    //             var isChecked;
    //             if($(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}_${str_arr[3]}`).is(":checked"))
    //                 isChecked = "true";
    //             else
    //                 isChecked = "false";
    //             category_status[i] = {
    //                 category_title: vendors_category[i]["title"],
    //                 status: isChecked
    //             }
                
    //         }
    //         else{
    //             $(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}`).prop( "disabled", false );
    //             var isChecked;
    //             if($(`#chk_${restaurant_vendorId}_${vendors_category[i]['id']}`).is(":checked"))
    //                 isChecked = "true";
    //             else
    //                 isChecked = "false";
    //             category_status[i] = {
    //                 category_title: vendors_category[i]["title"],
    //                 status: isChecked
    //             }
    //         }
    //     }
    //     if(str_arr[3])
    //     {
    //         $.ajax({
    //             type:'get',
    //             url:"{{ route('admin-change-category-status') }}",
    //             data:{
    //               restaurant_vendorId: restaurant_vendorId,
    //               restaurant_id: str_arr[3],
    //               category_status: category_status
    //             },
    //             success:function(data){
    //                 $('.submit-loader').hide();
    //               $.notify("Changed Successfully","success");
    //             }
    //           });
    //     }
    //     else{
    //         $.ajax({
    //             type:'get',
    //             url:"{{ route('admin-change-category-status') }}",
    //             data:{
    //               restaurant_vendorId: restaurant_vendorId,
    //               category_status: category_status
    //             },
    //             success:function(data){
    //                 $('.submit-loader').hide();
    //               $.notify("Changed Successfully","success");
    //             }
    //           });
    //     }
    // })
    function category_change(category_title, restaurant_vendor_id, restaurant_id, category_id){
        var isChecked;
        var old_id = restaurant_vendor_id;
        if($(`#chk_category_${restaurant_vendor_id}_${category_id}`).is(":checked"))
            isChecked = "true";
        else
            isChecked = "false";
        $('.submit-loader').show();
        
        $.ajax({
            type:'get',
            url:"{{ route('admin-change-category-status') }}",
            data:{
              restaurant_vendorId: restaurant_vendor_id,
              restaurant_id: restaurant_id,
              category_title: category_title,
              status: isChecked,
            },
            success:function(data){
                $('.submit-loader').hide();
              $.notify("Changed Successfully","success");
            }
          });
    }
</script>
@endsection
