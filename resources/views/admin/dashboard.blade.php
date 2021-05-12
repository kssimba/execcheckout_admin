@extends('layouts.admin')

@section('content')
<div class="content-area">
    @include('includes.form-success')


    @if(Session::has('cache'))

    <div class="alert alert-success validation">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <h3 class="text-center">{{ Session::get("cache") }}</h3>
    </div>


  @endif



    <div class="row row-cards-one">


        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg6">
                <div class="left">
                    <h5 class="title">{{ __('Add Restaruants') }}</h5>
                    <span class="number">0</span>
                    <a href="{{route('admin.add_restaruant')}}" class="link">{{ __('Go') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        
        @if(Auth::guard('admin')->user()->IsSuper())
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg5">
                <div class="left">
                    <h5 class="title">{{ __('Total Users!') }}</h5>
                    <span class="number">0</span>
                    <a href="{{ route('admin.staff.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-users-alt-5"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif
        

    </div>

    <div class="row row-cards-one">
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg4">
                <div class="left">
                    <h5 class="title">{{ __('Edit Restaruants!') }}</h5>
                    <span class="number">0</span>
                    <a href="{{route('admin.restaruant')}}" class="link">{{ __('Go') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-cart-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg3">
                <div class="left">
                    <h5 class="title">{{ __('Save Item Collections') }}</h5>
                    <span class="number">0</span>
                    <a href="javascript:void(0)" id="item_save" class="link">{{ __('Go') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-search-alt"></i>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

</div>

@endsection

@section('scripts')
<script>
    $('#item_save').on('click',function(){
        $.ajax({
         type:"GET",
         url:'{{ route("admin.save_item") }}',
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
    })
</script>
@endsection