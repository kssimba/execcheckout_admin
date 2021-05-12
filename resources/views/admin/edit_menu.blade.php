@extends('layouts.admin')
@section('styles')

<link href="{{ asset('assets/admin/css/product.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/jquery.Jcrop.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/Jcrop-style.css') }}" rel="stylesheet" />
<style type="text/css">
    .treeview .btn-default {
  border-color: #e3e5ef;
}
.treeview .btn-default:hover {
  background-color: #f7faea;
  color: #bada55;
}
.treeview ul {
  list-style: none;
  padding-left: 32px;
}
.treeview ul li {
  padding: 50px 0px 0px 35px;
  position: relative;
}
.treeview ul li:before {
  content: "";
  position: absolute;
  top: -26px;
  left: -31px;
  border-left: 2px dashed #a2a5b5;
  width: 1px;
  height: 100%;
}
.treeview ul li:after {
  content: "";
  position: absolute;
  border-top: 2px dashed #a2a5b5;
  top: 70px;
  left: -30px;
  width: 65px;
}
.treeview ul li:last-child:before {
  top: -22px;
  height: 90px;
}
.treeview > ul > li:after, .treeview > ul > li:last-child:before {
  content: unset;
}
.treeview > ul > li:before {
  top: 90px;
  left: 36px;
}
.treeview > ul > li:not(:last-child) > ul > li:before {
  content: unset;
}
.treeview > ul > li > .treeview__level:before {
  height: 60px;
  width: 60px;
  top: -9.5px;
  background-color: #54a6d9;
  border: 7.5px solid #d5e9f6;
  font-size: 22px;
}
.treeview > ul > li > ul {
  padding-left: 34px;
}
.treeview__level {
  padding: 7px;
  padding-left: 42.5px;
  display: inline-block;
  border-radius: 5px;
  font-weight: 700;
  border: 1px solid #e3e5ef;
  position: relative;
  z-index: 1;
}
.treeview__level:before {
  content: attr(data-level);
  position: absolute;
  left: -27.5px;
  top: -6.5px;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 55px;
  width: 55px;
  border-radius: 50%;
  border: 7.5px solid #eef6d5;
  background-color: #bada55;
  color: #fff;
  font-size: 20px;
}
.treeview__level-btns {
  margin-left: 15px;
  display: inline-block;
  position: relative;
}
/*.treeview__level .level-clone, .treeview__level .level-collapse, .treeview__level .level-sub {*/
/*  position: absolute;*/
/*  display: none;*/
/*  transition: opacity 250ms cubic-bezier(0.7, 0, 0.3, 1);*/
/*}*/

.treeview__level .level-collapse, .treeview__level .level-sub {
  position: absolute;
  display: none;
  transition: opacity 250ms cubic-bezier(0.7, 0, 0.3, 1);
}

.treeview__level .level-collapse.in, .treeview__level .level-sub.in {
  display: block;
}

/*.treeview__level .level-clone.in, .treeview__level .level-collapse.in, .treeview__level .level-sub.in, {*/
/*  display: block;*/
/*}*/

.treeview__level .level-collapse.in .btn-default, .treeview__level .level-sub.in .btn-default {
  background-color: #faeaea;
  color: #da5555;
}
.treeview__level .level-sub {
  top: 0;
  left: 85px;
  width: 200px;
}
.treeview__level .level-collapse {
  top: 0px!important;
  left: 300px;
  width: 100px;
}

.treeview__level .level-clone {
  top: 0px!important;
  left: 400px;
  width: 100px;
}

.treeview__level .level-remove {
  /* display: none; */
}
.treeview__level.selected {
  background-color: #f9f9fb;
  box-shadow: 0px 3px 15px 0px rgba(0, 0, 0, 0.1);
}
.treeview__level.selected .level-remove {
  display: inline-block;
}
.treeview__level.selected .level-add {
  /* display: none; */
}
.treeview__level.selected .level-collapse, .treeview__level.selected .level-sub {
  display: none;
}
.treeview .level-title {
  cursor: pointer;
  user-select: none;
}
.treeview .level-title:hover {
  text-decoration: underline;
}
.treeview--mapview ul {
  justify-content: center;
  display: flex;
}
.treeview--mapview ul li:before {
  content: unset;
}
.treeview--mapview ul li:after {
  content: unset;
}



</style>
@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Edit Menu') }} <a class="add-btn"
						href="{{route('admin.restaruant')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="#">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Restaurants') }} </a>
					</li>
					<li>
						<a href="#">{{ __('Edit Menu') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform">
		{{csrf_field()}}
	<div class="row">
		<div class="col-lg-12">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
								<div class="gocover"
									style="background: url('{{ asset('assets/img/spinner.gif') }}') no-repeat scroll center center rgba(45, 45, 45, 0.5);">
								</div>
								@include('includes.form-both')

								<br> <br> <hr>
								<h4 class="text-center">Menu</h4>
								<hr> <br>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
                      <div class="text-left" style="padding-left:67px;">
                        <button class="addProductSubmit-btn" id= "new-button" type="button" style="background-color:green; border-radius:20px"><span class="fa fa-plus"></span>   {{ __('Create New Menu') }}</button>
                      </div>

                      <div class="treeview js-treeview" id="first_node">
                        <ul>
                          @foreach($menu_datas as $menu)
                            <li>
                                <div class="treeview__level" data-level="M">
                                  <span class="level-title">{{ $menu['name'] }}</span>
                                  <div class="treeview__level-btns">
                                    <div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div>
                                    <div class="btn btn-default btn-sm level-sub in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Section</span></div>
                                    <div class="btn btn-default btn-sm level-collapse in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Expand</span></div>
                                    <span id="myid" hidden>{{ $menu['id'] }}</span>
                                    <span id="mylevel" hidden>0</span>
                                  </div>
                                </div>
                                <ul hidden>
                                  @foreach($menu['menu_group'] as $section)
                                    <li>
                                      <div class="treeview__level" data-level="S">
                                        <span class="level-title">{{ $section['name'] }}</span>
                                        <div class="treeview__level-btns">
                                          <div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div>
                                          <div class="btn btn-default btn-sm level-sub in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Item</span></div>
                                          <div class="btn btn-default btn-sm level-collapse in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Expand</span></div>
                                          <span id="myid" hidden>{{ $section['id'] }}</span>
                                          <span id="mylevel" hidden>1</span>
                                        </div>
                                      </div>
                                      <ul hidden>
                                        @foreach($section['menu_items'] as $item)
                                          <li>
                                            <div class="treeview__level" data-level="I">
                                                <span class="level-title">{{ $item['name'] }}</span>
                                                <div class="treeview__level-btns">
                                                <div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div>
                                                <div class="btn btn-default btn-sm level-sub in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Option Group</span></div>
                                                <div class="btn btn-default btn-sm level-collapse in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Expand</span></div>
                                                <!--<div class="btn btn-default btn-sm level-clone in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Clone</span></div>-->
                                                <span id="myid" hidden>{{ $item['id'] }}</span>
                                                <span id="mylevel" hidden>2</span>
                                                </div>
                                            </div>
                                            <ul hidden>
                                              @foreach($item['menu_item_options'] as $group)
                                                <li>
                                                  <div class="treeview__level" data-level="O">
                                                    <span class="level-title">{{ $group['name'] }}</span>
                                                    <div class="treeview__level-btns">
                                                    <div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div>
                                                    <div class="btn btn-default btn-sm level-sub in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Option</span></div>
                                                    <div class="btn btn-default btn-sm level-collapse in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Expand</span></div>
                                                    <span id="myid" hidden>{{ $group['id'] }}</span>
                                                    <span id="mylevel" hidden>3</span>
                                                    </div>
                                                  </div>
                                                  <ul hidden>
                                                      @foreach($group['menu_option_options'] as $option)
                                                          <li>
                                                              <div class="treeview__level" data-level="V">
                                                                  <span class="level-title">{{ $option['name'] }}</span>
                                                                  <div class="treeview__level-btns">
                                                                  <div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div>
                                                                  <span id="myid" hidden>{{ $option['id'] }}</span>
                                                                  <span id="mylevel" hidden>4</span>
                                                                  </div>
                                                              </div>
                                                              <ul>

                                                              </ul>
                                                          </li>
                                                      @endforeach
                                                  </ul>
                                                </li>
                                              @endforeach
                                            </ul>
                                          </li>
                                        @endforeach
                                      </ul>
                                    </li>
                                  @endforeach
                                </ul>
                            </li>
                          @endforeach
                        </ul>
                      </div>

                      <template id="levelMarkup">
                          <li>
                            <div class="treeview__level" data-level="M">
                              <span class="level-title">Level A</span>
                              <div class="treeview__level-btns">
                                <div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div>
                                <div class="btn btn-default btn-sm level-sub in"><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Section</span></div>
                                <div class="btn btn-default btn-sm level-collapse in"><span><span class="fa fa-minus">&nbsp;&nbsp;</span>Collapse</span></div>
                                <span id="myid" hidden></span>
                                <span id="mylevel" hidden></span>
                              </div>
                            </div>
                            <ul>
                            </ul>
                        </li>
                      </template>
										</div>
									</div>
								</div>
                <!--<div class="text-center">-->
                <!--    <button class="addProductSubmit-btn" id="save-menu" type="button">{{ __('Save Menu') }}</button>-->
                <!--</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>

</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">Create Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-white bg-dark mb-0">
            <div class="card-header">
              <h2 class="m-0" style="color:white">Menu</h2>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Menu Name</label>
                <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required="">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-description">Menu Description</label>
                <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required autofocus>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-note">Menu Note</label>
                <input type="text" name="modal-input-note" class="form-control" id="modal-input-note" required>
              </div>
			  <div class="form-group">
                <label class="col-form-label" for="modal-input-duration">Menu Duration Name</label>
                <input type="text" name="modal-input-duration" class="form-control" id="modal-input-duration" required>
              </div>
			  <div class="form-group">
                <label class="col-form-label" for="modal-input-start">Menu Duration Time Start</label>
                <input type="time" name="modal-input-start" class="form-control" id="modal-input-start" required>
              </div>
			  <div class="form-group">
                <label class="col-form-label" for="modal-input-end">Menu Duration Time End</label>
                <input type="time" name="modal-input-end" class="form-control" id="modal-input-end" required>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal_done">Done</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_close">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-group-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-group-modal-label">Create Menu Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="group-attachment-body-content">
        <form id="group-edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-white bg-dark mb-0">
            <div class="card-header">
              <h2 class="m-0" style="color:white">Menu Section</h2>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Menu Section Name</label>
                <input type="text" name="modal-input-name" class="form-control" id="group-modal-input-name" required="">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-description">Menu Section Description</label>
                <input type="text" name="modal-input-description" class="form-control" id="group-modal-input-description" required autofocus>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-orderNumber">Order Number</label>
                <input type="number" name="modal-input-orderNumber" class="form-control" id="group-modal-input-orderNumber" required autofocus>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="group-modal_done">Done</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="group-modal_close">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-item-modal-label">Create Menu Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="item-attachment-body-content">
        <form id="item-edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-white bg-dark mb-0">
            <div class="card-header">
              <h2 class="m-0" style="color:white">Menu Item</h2>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Menu Item Name</label>
                <input type="text" name="modal-input-name" class="form-control" id="item-modal-input-name" required="">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-description">Menu Item Description</label>
                <input type="text" name="modal-input-description" class="form-control" id="item-modal-input-description" required autofocus>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-price">Menu Item Price</label>
                <input type="text" name="modal-input-price" class="form-control" id="item-modal-input-price" required>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-input-image">Menu Item Images</label>
                <input type="text" name="modal-input-image" class="form-control" id="item-modal-input-image" required>
              </div>
	
              <div style= "display:flex; flex-direction:row;">
                  <div style="width:50%">
                    <div class="form-group" style= "display:flex; flex-direction:row; align-items: center">
                        <input type="checkbox" style = "width:18px; height:18px; margin-right:20px"name="modal-input-vegetarian" class="form-control" id="item-modal-input-vegetarian" required>
                        <label class="col-form-label" for="modal-input-vegetarian">Vegetarian</label>
                      </div>
                      <div class="form-group" style= "display:flex; flex-direction:row; align-items: center">
                        <input type="checkbox" style = "width:18px; height:18px; margin-right:20px"name="modal-input-vegan" class="form-control" id="item-modal-input-vegan" required>
                        <label class="col-form-label" for="modal-input-vegan">Vegan</label>
                      </div>
                      <div class="form-group" style= "display:flex; flex-direction:row; align-items: center">
                        <input type="checkbox" style = "width:18px; height:18px; margin-right:20px"name="modal-input-kosher" class="form-control" id="item-modal-input-kosher" required>
                        <label class="col-form-label" for="modal-input-kosher">Kosher</label>
                      </div>
                  </div>
                  <div style="width:50%">
                    <div class="form-group" style= "display:flex; flex-direction:row; align-items: center">
                        <input type="checkbox" style = "width:18px; height:18px; margin-right:20px"name="modal-input-halal" class="form-control" id="item-modal-input-halal" required>
                        <label class="col-form-label" for="modal-input-halal">Halal</label>
                      </div>
                      <div class="form-group" style= "display:flex; flex-direction:row; align-items: center">
                        <input type="checkbox" style = "width:18px; height:18px; margin-right:20px"name="modal-input-gluten" class="form-control" id="item-modal-input-gluten" required>
                        <label class="col-form-label" for="modal-input-gluten">Gluten Free</label>
                      </div>
                      
                      <div class="form-group" style= "display:flex; flex-direction:row; align-items: center">
                        <input type="checkbox" style = "width:18px; height:18px; margin-right:20px"name="modal-input-alcohol" class="form-control" id="item-modal-input-alcohol" required>
                        <label class="col-form-label" for="modal-input-alcohol">Alcohol</label>
                      </div>

                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="item-modal_clone">Clone Item</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="item-modal_done">Done</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="item-modal_close">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-option-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-option-modal-label">Create Option Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="option-attachment-body-content">
        <form id="option-edit-form" class="form-horizontal" method="POST" action="">
          <div class="card text-white bg-dark mb-0">
            <div class="card-header">
              <h2 class="m-0" style="color:white">Item Option Group</h2>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label" for="modal-input-name">Option Group Name</label>
                <input type="text" name="modal-input-name" class="form-control" id="option-modal-input-name" required="">
              </div>
              <!--<div class="form-group">-->
              <!--  <label class="col-form-label" for="modal-input-name">Yes/No Limit</label>-->
              <!--  <input type="text" name="modal-input-name" class="form-control" id="option-modal-input-name" required="">-->
              <!--</div>-->
              <div class="form-group">
                <label class="col-form-label" for="modal-input-type">Option Group  Type</label>
                <select class="form-control" name="modal-input-type" id="option-modal-input-type">
					<option value="0">Yes or No</option>
					<option value="1">Quantity</option>
                    <option value="2">Radio</option>
				</select>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal-option-trigger">Option Trigger</label>
                <input type="number" name="modal-option-trigger" class="form-control" id="option-modal-trigger" value="0"> </input>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="option-modal_done">Done</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="option-modal_close">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-suboption-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-suboption-modal-label">Create New Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="suboption-attachment-body-content">
          <form id="suboption-edit-form" class="form-horizontal" method="POST" action="">
            <div class="card text-white bg-dark mb-0">
              <div class="card-header">
                <h2 class="m-0" style="color:white"> Option</h2>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label class="col-form-label" for="modal-input-name">Option Name</label>
                  <input type="text" name="modal-input-name" class="form-control" id="suboption-modal-input-name" required="">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="modal-input-value">Option Value</label>
                  <input type="text" name="modal-input-value" class="form-control" id="suboption-modal-input-value" required="">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="suboption-modal_done">Done</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="suboption-modal_save">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="suboption-modal_close">Close</button>
        </div>
      </div>
    </div>
  </div>







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

@endsection

@section('scripts')

<script src="{{ asset('assets/admin/js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.SimpleCropper.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>


<script type="text/javascript">
	// Gallery Section Insert

	$(document).ready(function() {
    $('#course_list').select2();
		$('.cropme').simpleCropper();
    });
    var menus = {!! json_encode($menu_datas) !!};
    console.log(menus);
    var menu_count = {{ $menu_count }};
    console.log(menus);
    var current;
    var current_menu_id = 0;
    var current_group_id = 0;
    var current_item_id = 0;
    var current_option_id = 0;
    var current_suboption_id = 0;
    var current_name = '';
    var level = 0;
    var edit = 0;
    var is_sub = 0;
    
    var savecount = 3;

    var savedGroup = [];
    


    let treeview = {
            resetBtnToggle: function() {
                // $(".js-treeview")
                //     .find(".level-add")
                //     .find("span")
                //     .removeClass()
                //     .addClass("fa fa-plus");
                // $(".js-treeview")
                //     .find(".level-add")
                //     .siblings()
                //     .removeClass("in");
            },
            addSameLevel: function(target) {

            },
            addSubLevel: function(target) {
                let liElm = target.closest("li");
                let nextLevelCodeASCII = liElm.find("[data-level]").attr("data-level").charCodeAt(0) + 1;
                liElm.children().eq(1).append($("#levelMarkup").html());
                if(level == 1){
                    liElm.children().eq(1).children().last().find("[data-level]")
                    .attr("data-level", 'S');
                }
                else if(level == 2){
                    liElm.children().eq(1).children().last().find("[data-level]")
                    .attr("data-level", 'I');
                }
                else if(level == 3){
                    liElm.children().eq(1).children().last().find("[data-level]")
                    .attr("data-level", 'O');
                }
                else if(level == 4){
                    liElm.children().eq(1).children().last().find("[data-level]")
                    .attr("data-level", 'V');
                }

                if(level == 1){
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#myid").text(menus[current_menu_id].group_count);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#mylevel").text(level);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").children().eq(1).children().eq(0).html('<span class="fa fa-plus">&nbsp;&nbsp;</span>Add Item');
                    liElm.children().eq(1).children().last().find(".level-title").text(current_name);
                }
                else if(level == 2){
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#myid").text(menus[current_menu_id].menu_group[current_group_id].item_count);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#mylevel").text(level);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").children().eq(1).children().eq(0).html('<span class="fa fa-plus">&nbsp;&nbsp;</span>Add Option Group');
                    liElm.children().eq(1).children().last().find(".level-title").text(current_name);
                }
                else if(level == 3){
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#myid").text(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].option_count);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#mylevel").text(level);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").children().eq(1).children().eq(0).html('<span class="fa fa-plus">&nbsp;&nbsp;</span>Add Option');
                    liElm.children().eq(1).children().last().find(".level-title").text(current_name);
                }
                else if(level == 4){
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#myid").text(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].suboption_count);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").find("#mylevel").text(level);
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").children().eq(1).remove();
                    liElm.children().eq(1).children().last().find(".treeview__level-btns").children().eq(1).remove();
                    liElm.children().eq(1).children().last().find(".level-title").text(current_name);
                }

            },
            removeLevel: function(target) {
                target.closest("li").remove();
            }
        };

	$(document).ready(function() {
      if(menu_count == 0)
          $("#save-menu").hide();

      // $(".js-treeview").on("click", ".level-add", function() {
      //     $(this).find("span").toggleClass("fa-plus").toggleClass("fa-times text-danger");
      //     $(this).siblings().toggleClass("in");
      // });

      $(".js-treeview").on("click", ".level-collapse", function() {
          var classname = $(this).children().eq(0).children().eq(0).attr('class');

          if(classname == 'fa fa-minus'){
              $(this).parent().parent().parent().children().eq(1).attr("hidden",true);
              $(this).children().eq(0).html('<span class="fa fa-plus">&nbsp;&nbsp;</span>Expand');
          }
          else if(classname == 'fa fa-plus'){
              $(this).parent().parent().parent().children().eq(1).removeAttr('hidden');
              $(this).children().eq(0).html('<span class="fa fa-minus">&nbsp;&nbsp;</span>Collapse');
          }

      });

      // Add sub level
      $(".js-treeview").on("click", ".level-sub", function() {

          current = $(this);
          level = parseInt($(this).parent().find("#mylevel").text())+1;

          current_menu_id = parseInt($(this).parent().find("#myid").text());
          if(level == 2){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().find("#myid").text());
          }
          else if(level == 3){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_item_id = parseInt($(this).parent().find("#myid").text());
          }
          else if(level == 4){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_item_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_option_id = parseInt($(this).parent().find("#myid").text());
          }
          var options = {
              'backdrop': 'static'
          };
          if(level == 1)
              $('#edit-group-modal').modal(options)
          else if(level == 2)
              $('#edit-item-modal').modal(options)
          else if(level == 3)
              $('#edit-option-modal').modal(options)
          else if(level == 4)
              $('#edit-suboption-modal').modal(options)
      });
          // Remove Level
      $(".js-treeview").on("click", ".level-remove", function() {

          level = parseInt($(this).parent().find("#mylevel").text());
          let self = $(this);
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              }
          });

          if(level == 0){
            menu_index = parseInt($(this).parent().find("#myid").text());
            
            swal({
              text: "You are about remove this menu!", 
              type: "warning",
              confirmButtonText: "Remove",
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                  $.ajax({
                    type:'delete',
                    url:"{{ route('admin-deleteMenu') }}",
                    data:{
                      id : menus[menu_index].menu_id,
                    },
                    success:function(data){
                      $.notify("Removed Successfully.","success");
                      menus[menu_index] = null;
                      treeview.removeLevel(self);
                    }
                  });
                  return;
              } else if (result.dismiss === 'cancel') {
              }
            })
          }
          else if(level == 1){
            current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
            current_group_id = parseInt($(this).parent().find("#myid").text());
            swal({
              text: "Youe are about remove this section!", 
              type: "warning",
              confirmButtonText: "Remove",
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                  $.ajax({
                    type:'delete',
                    url:"{{ route('admin-deleteSection') }}",
                    data:{
                      id : menus[current_menu_id].menu_group[current_group_id].section_id,
                    },
                    success:function(data){
                      $.notify("Removed Successfully.","success");
                      menus[current_menu_id].menu_group[current_group_id] = null;
                      treeview.removeLevel(self);
                    }
                  });
                  return;
              } else if (result.dismiss === 'cancel') {
              }
            });
          }
          else if(level == 2){
            current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
            current_group_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
            current_item_id = parseInt($(this).parent().find("#myid").text());
            
            swal({
              text: "You are about remove this item!", 
              type: "warning",
              confirmButtonText: "Remove",
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                  $.ajax({
                    type:'delete',
                    url:"{{ route('admin-deleteMenuItem') }}",
                    data:{
                      id : menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].item_id,
                    },
                    success:function(data){
                      menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id] = null;
                      $.notify("Removed Successfully.","success");
                      treeview.removeLevel(self);
                    }
                  });
                  return;
              } else if (result.dismiss === 'cancel') {
              }
            })
          }
          else if(level == 3){
            current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
            current_group_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
            current_item_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
            current_option_id = parseInt($(this).parent().find("#myid").text());
            
            swal({
              text: "Are you about remove this optiongroup!", 
              type: "warning",
              confirmButtonText: "Remove",
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                  $.ajax({
                    type:'delete',
                    url:"{{ route('admin-deleteItemOption') }}",
                    data:{
                      id : menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].optiongroup_id
                    },
                    success:function(data){
                      $.notify("Removed Successfully.","success");
                      menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id] = null;
                      treeview.removeLevel(self);
                    }
                  });
                  return;
              } else if (result.dismiss === 'cancel') {
              }
            })
          }
          else if(level == 4){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_item_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_option_id = parseInt($(this).parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_suboption_id = parseInt($(this).parent().find("#myid").text());

            
            swal({
              text: "Are you about remove this suboption!", 
              type: "warning",
              confirmButtonText: "Remove",
              showCancelButton: true
            }).then((result) => {
              if (result.value) {
                  $.ajax({
                    type:'delete',
                    url:"{{ route('admin-deleteSuboption') }}",
                    data:{
                      id : menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].menu_option_options[current_suboption_id].option_id
                    },
                    success:function(data){
                      $.notify("Removed Successfully.","success");
                      menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].menu_option_options[current_suboption_id] = null;
                      treeview.removeLevel(self);
                    }
                  });
                  return;
              } else if (result.dismiss === 'cancel') {
              }
            })
          }

      });
      // Selected Level
      $(".js-treeview").on("click", ".level-title", function() {
          edit = 1;
          level = parseInt($(this).parent().find("#mylevel").text());
          if(level == 0)
              current_menu_id = parseInt($(this).parent().find("#myid").text());
          else if(level == 1){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().find("#myid").text());
          }
          else if(level == 2){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_item_id = parseInt($(this).parent().find("#myid").text());
          }
          else if(level == 3){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_item_id = parseInt($(this).parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_option_id = parseInt($(this).parent().find("#myid").text());
          }
          else if(level == 4){
              current_menu_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_group_id = parseInt($(this).parent().parent().parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_item_id = parseInt($(this).parent().parent().parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_option_id = parseInt($(this).parent().parent().parent().parent().find("div:first-child").find("#myid").eq(0).text());
              current_suboption_id = parseInt($(this).parent().find("#myid").text());
          }

          current = $(this);

          var options = {
              'backdrop': 'static'
          };
          if(level == 0)
              $('#edit-modal').modal(options)
          else if(level == 1)
              $('#edit-group-modal').modal(options)
          else if(level == 2)
              $('#edit-item-modal').modal(options)
          else if(level == 3)
              $('#edit-option-modal').modal(options)
          else if(level == 4)
              $('#edit-suboption-modal').modal(options)
      });

      // on modal show
      $('#edit-modal').on('show.bs.modal', function() {
          if(edit == 1){
              $("#modal-input-name").val(menus[current_menu_id].name);
              $("#modal-input-description").val(menus[current_menu_id].description);
              $("#modal-input-note").val(menus[current_menu_id].note);
              $("#modal-input-duration").val(menus[current_menu_id].duration);
              $("#modal-input-start").val(menus[current_menu_id].start);
              $("#modal-input-end").val(menus[current_menu_id].end);
          }
      })

      $('#edit-modal').on('hide.bs.modal', function() {
          $("#edit-form").trigger("reset");
          edit = 0;
      })

      $('#modal_done').on('click', function() {

        let menu_name = $("#modal-input-name").val();
        let menu_description = $("#modal-input-description").val();
        let menu_note = $("#modal-input-note").val();
        let menu_duration = $("#modal-input-duration").val();
        let menu_start = $("#modal-input-start").val();
        let menu_end = $("#modal-input-end").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        if(edit == 1) {
            menus[current_menu_id].name = menu_name;
            menus[current_menu_id].description = menu_description;
            menus[current_menu_id].note = menu_note;
            menus[current_menu_id].duration = menu_duration;
            menus[current_menu_id].start = menu_start;
            menus[current_menu_id].end = menu_end;

            $.ajax({
              type:'POST',
              url:"{{ route('admin-updateMenu') }}",
              data:{
                id             : menus[current_menu_id].menu_id,
                data           : {
                  name           : menu_name,
                  description    : menu_description,
                  note           : menu_note,
                  duration       : menu_duration,
                  start          : menu_start,
                  end            : menu_end,
                }
              },
              success:function(data){
                edit = 0;
                current_menu_id = 0;
                current.text(menu_name);
                $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
                $("#edit-form").trigger("reset");
                $.notify("Menu Updated Successfully.","success");
              }
            });
            return;
        }

        let res_id = {{ $id }};
        current_name = menu_name;

        $.ajax({
            type:'POST',
            url:"{{ route('admin-createMenu') }}",
            data:{
              id      : res_id,
              data    : {
                name           : menu_name,
                description    : menu_description,
                note           : menu_note,
                duration       : menu_duration,
                start          : menu_start,
                end            : menu_end,
              }
            },
            success:function(data){
              if(menu_count == 0) {
                  $("#first_node").html('<ul><li><div class="treeview__level" data-level="M"><span class="level-title">'+current_name+'</span><div class="treeview__level-btns"><div class="btn btn-default btn-sm level-remove"><span class="fa fa-trash text-danger"></span></div><div class="btn btn-default btn-sm level-sub in"><span><span><span class="fa fa-plus">&nbsp;&nbsp;</span>Add Section</span></div><div class="btn btn-default btn-sm level-collapse in"><span><span class="fa fa-minus">&nbsp;&nbsp;</span>Collapse</span></div><span id="myid" hidden>'+menu_count+'</span><span id="mylevel" hidden>0</span></div></div><ul></ul></li></ul>');

                  menus.push({
                      'name':menu_name,
                      'description':menu_description,
                      'note':menu_note,
                      'duration':menu_duration,
                      'start':menu_start,
                      'end':menu_end,
                      'id':menu_count,
                      'menu_group':[],
                      'group_count':0,
                      'res_id' : res_id,
                      'menu_id' : data.id,
                  });
                  menu_count++;
                  treeview.resetBtnToggle();
                  $("#save-menu").show();
              }
              else {
                  //treeview.addSameLevel(current);
                  let ulElm = $("#new-button").parent().parent().find("#first_node").children().eq(0);
                  console.log(ulElm.html());
                  ulElm.append($("#levelMarkup").html());
                  ulElm
                      .children("li:last-child")
                      .find("[data-level]")
                      .attr("data-level", 'M');

                  ulElm.children("li:last-child").find("[data-level]").find(".treeview__level-btns").find("#myid").text(menu_count);
                  ulElm.children("li:last-child").find("[data-level]").find(".treeview__level-btns").find("#mylevel").text(level);
                  ulElm.children("li:last-child").find("[data-level]").find(".level-title").text(current_name);

                  treeview.resetBtnToggle();

                  menus.push({
                      'name':menu_name,
                      'description':menu_description,
                      'note':menu_note,
                      'duration':menu_duration,
                      'start':menu_start,
                      'end':menu_end,
                      'id':menu_count,
                      'menu_group':[],
                      'group_count':0,
                      'res_id' : res_id,
                      'menu_id' : data.id,
                  });
                  menu_count++;
              }
              console.log(menus);
              $("#edit-form").trigger("reset");
              $.notify("Menu created Successfully.","success");

            }
        });
      })

      $('#modal_close').on('click', function() {

          $("#edit-form").trigger("reset");
          edit = 0;
      })

      $('#edit-modal').on('hide.bs.modal', function() {
          $("#edit-form").trigger("reset");
          edit = 0;
      })

      $('#edit-group-modal').on('show.bs.modal', function() {
          if(edit == 1){
              $("#group-modal-input-name").val(menus[current_menu_id].menu_group[current_group_id].name);
              $("#group-modal-input-description").val(menus[current_menu_id].menu_group[current_group_id].description);
              $("#group-modal-input-orderNumber").val(menus[current_menu_id].menu_group[current_group_id].orderNumber);
          }
      })

      $('#group-modal_done').on('click', function() {
        let section_name = $("#group-modal-input-name").val();
        let section_description = $("#group-modal-input-description").val();
        let section_orderNumber = $("#group-modal-input-orderNumber").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        if(edit == 1){
            menus[current_menu_id].menu_group[current_group_id].name = section_name;
            menus[current_menu_id].menu_group[current_group_id].description = section_description;
            menus[current_menu_id].menu_group[current_group_id].orderNumber = section_orderNumber;

            $.ajax({
              type:'POST',
              url:"{{ route('admin-updateSection') }}",
              data:{
                id             : menus[current_menu_id].menu_group[current_group_id].section_id,
                data           : {
                  name           : section_name,
                  description    : section_description,
                  orderNumber    : section_orderNumber,
                }
              },
              success:function(data){
                edit = 0;
                current.text(section_name);
                $.notify("Section updated Successfully.","success");
                $("#group-edit-form").trigger("reset");
              }
            });
            return;
        }

        
        $.ajax({
          type:'POST',
          url:"{{ route('admin-createSection') }}",
          data:{
            id             : menus[current_menu_id].menu_id,
            data           : {
              name           : section_name,
              description    : section_description,
              orderNumber    : section_orderNumber,
            }
          },
          success:function(data){
            console.log(data.id);
            current_name = section_name;
            current_group_id = menus[current_menu_id].group_count;
            treeview.addSubLevel(current);
            treeview.resetBtnToggle();

            menus[current_menu_id].menu_group.push({
                'name': section_name,
                'description': section_description,
                'orderNumber' : section_orderNumber,
                'menu_items':[],
                'item_count':0,
                'id':menus[current_menu_id].group_count,
                'section_id' : data.id
            });

            menus[current_menu_id].group_count++;
            console.log(menus);

            $.notify("Section Created Successfully.","success");
            $("#group-edit-form").trigger("reset");
          }
        });
      })

      $('#group-modal_close').on('click', function() {

          $("#group-edit-form").trigger("reset");
          edit = 0;
      })

      $('#edit-group-modal').on('hide.bs.modal', function() {
          $("#group-edit-form").trigger("reset");
          edit = 0;
      })

      //item

      $('#edit-item-modal').on('show.bs.modal', function() {
          if(edit == 1){
              $("#item-modal-input-name").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].name);
              $("#item-modal-input-description").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].description);
              $("#item-modal-input-price").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].price);
              
              $("#item-modal-input-image").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].image);

              menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].vegetarian=='true'?$("#item-modal-input-vegetarian").prop('checked',true):$("#item-modal-input-vegetarian").prop('checked',false)
              menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].vegan=='true'?$("#item-modal-input-vegan").prop('checked',true):$("#item-modal-input-vegan").prop('checked',false)
              menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].kosher=='true'?$("#item-modal-input-kosher").prop('checked',true):$("#item-modal-input-kosher").prop('checked',false)
              menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].halal=='true'?$("#item-modal-input-halal").prop('checked',true):$("#item-modal-input-halal").prop('checked',false)
              menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].gluten=='true'?$("#item-modal-input-gluten").prop('checked',true):$("#item-modal-input-gluten").prop('checked',false)
              menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].alcohol=='true'?$("#item-modal-input-alcohol").prop('checked',true):$("#item-modal-input-alcohol").prop('checked',false)
              

          }
      })

      $('#item-modal_done').on('click', function() {
        let item_name         = $("#item-modal-input-name").val();
        let item_description  = $("#item-modal-input-description").val();
        let item_price        = $("#item-modal-input-price").val();
        
        let item_vegetarian   = $("#item-modal-input-vegetarian").is(":checked")?'true':'false';
        let item_vegan        = $("#item-modal-input-vegan").is(":checked")?'true':'false';
        let item_kosher       = $("#item-modal-input-kosher").is(":checked")?'true':'false';
        let item_halal        = $("#item-modal-input-halal").is(":checked")?'true':'false';
        let item_gluten       = $("#item-modal-input-gluten").is(":checked")?'true':'false';
        let item_alcohol      = $("#item-modal-input-alcohol").is(":checked")?'true':'false';
        let item_img          = $("#item-modal-input-image").val();
        
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        if(edit == 1){
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].name = item_name;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].description = item_description;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].price = item_price;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].vegetarian = item_vegetarian;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].vegan = item_vegan;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].kosher = item_kosher;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].halal = item_halal;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].gluten = item_gluten;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].alcohol = item_alcohol;
            menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].image = item_img;
            $.ajax({
              type:'POST',
              url:"{{ route('admin-updateMenuItem') }}",
              data:{
                id             : menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].item_id,
                data          : {
                  name        : item_name,
                  description : item_description,
                  price       : item_price,
                  vegetarian  : item_vegetarian,
                  vegan       : item_vegan,
                  kosher      : item_kosher,
                  halal       : item_halal,
                  gluten      : item_gluten,
                  alcohol     : item_alcohol,
                  image       : item_img
                }
              },
              success:function(data){
                edit = 0;
                current.text(item_name);
                $.notify("Item updated Successfully.","success");
                $("#item-edit-form").trigger("reset");
              }
            });
            return;
        }

        $.ajax({
          type:'POST',
          url:"{{ route('admin-createMenuItem') }}",
          data:{
            id            : menus[current_menu_id].menu_group[current_group_id].section_id,
            data          : {
              name        : item_name,
              description : item_description,
              price       : item_price,
              vegetarian  : item_vegetarian,
              vegan       : item_vegan,
              kosher      : item_kosher,
              halal       : item_halal,
              gluten      : item_gluten,
              alcohol     : item_alcohol,
              image       : item_img
            }
          },
          success:function(data){
              current_name = item_name;
              current_item_id = menus[current_menu_id].menu_group[current_group_id].item_count;

              treeview.addSubLevel(current);
              treeview.resetBtnToggle();

              menus[current_menu_id].menu_group[current_group_id].menu_items.push({
                  'name':item_name,
                  'description':item_description,
                  'price':item_price,
                  'vegetarian':item_vegetarian,
                  'vegan':item_vegan,
                  'kosher':item_kosher,
                  'halal':item_halal,
                  'gluten':item_gluten,
                  'alcohol':item_alcohol,
                  'image':item_img,
                  'menu_item_options':[],
                  'option_count':0,
                  'id':menus[current_menu_id].menu_group[current_group_id].item_count,
                  'item_id' : data.id
              });
              menus[current_menu_id].menu_group[current_group_id].item_count++;
              console.log(menus);
              $("#item-edit-form").trigger("reset");
              $.notify("Item updated Successfully.","success");
          }
        });
      })

      $('#item-modal_close').on('click', function() {
          $("#item-edit-form").trigger("reset");
          edit = 0;
      })

      $('#edit-item-modal').on('hide.bs.modal', function() {
          $("#item-edit-form").trigger("reset");
          edit = 0;
      })

      //option

      $('#edit-option-modal').on('show.bs.modal', function() {
          if(edit == 1){
              $("#option-modal-input-name").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].name);
              $("#option-modal-input-type").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].type);
              $("#option-modal-trigger").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].trigger);
          }
      })

      $('#option-modal_done').on('click', function() {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        let menu_item = menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id]
        
        if($("#option-modal-input-type").val() > 2){
            saved_group = savedGroup[$("#option-modal-input-type").val()-3];
            if(edit == 1){
              current.parent().parent().children().eq(1).empty();
              menu_item.menu_item_options[current_option_id].name = saved_group.data.name;
              menu_item.menu_item_options[current_option_id].type = saved_group.data.type;
              menu_item.menu_item_options[current_option_id].trigger = saved_group.data.trigger;
              menu_item.menu_item_options[current_option_id].suboption_count = 0;
              menu_item.menu_item_options[current_option_id].menu_option_options = [];

              $.ajax({
                type:'POST',
                url:"{{ route('admin-updateItemOption') }}",
                data:{
                  id      : menu_item.menu_item_options[current_option_id].optiongroup_id,
                  data    : {
                    name           : menu_item.menu_item_options[current_option_id].name,
                    type           : menu_item.menu_item_options[current_option_id].type,
                    trigger        : menu_item.menu_item_options[current_option_id].trigger,
                  },
                },
                success:function(data) {
                  saved_group.data.menu_option_options.forEach(element => {
                    if(element) {
                      current_name = element.name;
                      current_suboption_id = element.id;
                      level = 4;
                      treeview.addSubLevel(current);
                      treeview.resetBtnToggle();

                      $.ajax({
                        type:'POST',
                        url:"{{ route('admin-createSuboption') }}",
                        data:{
                          id      : data.id,
                          data    : {
                            name           : element.name,
                            value           : element.value,
                          },
                        },
                        success:function(datas) {
                          element.option_id = datas.id
                            menu_item.menu_item_options[current_option_id].menu_option_options.push(element);
                            menu_item.menu_item_options[current_option_id].suboption_count++;
                        }
                      });
                    }
                  });
                  edit = 0;
                  
                  console.log(data.data);
                  current.text(saved_group.name);
                  $("#option-edit-form").trigger("reset");
                  return;
                }
              });
              return;
            }

            current_name = saved_group.data.name;
            current_type = saved_group.data.type;
            current_trigger = saved_group.data.trigger;
            current_option_id = menu_item.option_count;

            treeview.addSubLevel(current);
            treeview.resetBtnToggle();

            current_saveGroup = saved_group;

            $.ajax({
                type:'POST',
                url:"{{ route('admin-createItemOption') }}",
                data:{
                  id      : menu_item.item_id,
                  data    : {
                    name           : current_name,
                    type           : current_type,
                    trigger        : current_trigger,
                  },
                },
                success:function(data) {
                  menu_item.menu_item_options.push({
                      'name':current_name,
                      'type':current_type,
                      'trigger':current_trigger,
                      'menu_option_options':[],
                      'suboption_count':0,
                      'id':menu_item.option_count,
                      'optiongroup_id' : data.id
                  });
                  menu_item.option_count++;
                  current = current.parent().parent().parent().children().eq(1).children().last().children().eq(0).children().eq(1).children().eq(1);

                  console.log(current_saveGroup);
                  current_saveGroup.data.menu_option_options.forEach(element => {
                    if (element) {
                      $.ajax({
                        type:'POST',
                        url:"{{ route('admin-createSuboption') }}",
                        data:{
                          id      : data.id,
                          data    : {
                            name           : element.name,
                            value           : element.value,
                          },
                        },
                        success:function(datas) {
                            element.option_id = datas.id;
                            current_name = element.name;
                            current_suboption_id = element.id;
                            level = 4;
                            treeview.addSubLevel(current);
                            treeview.resetBtnToggle();

                            menu_item.menu_item_options[current_option_id].menu_option_options.push(element);
                            menu_item.menu_item_options[current_option_id].suboption_count++;
                        }
                      });
                    }
                  });

                  current.text(current_saveGroup.name);
                  $("#option-edit-form").trigger("reset");

                  $.notify("Removed Successfully.","success");
                }
            })


            

            // $.ajax({
            //     type:'POST',
            //     url:"{{ route('admin-createItemOptionGroup') }}",
            //     data:{
            //       id      : menu_item.item_id,
            //       data    : {
            //         name           : current_name,
            //         type           : current_type,
            //       },
            //       group            : menu_item.menu_item_options[current_option_id].menu_option_options
            //     },
            //     success:function(data) {
            //       console.log(data.id);
            //       return;
            //       $.notify("Removed Successfully.","success");
            //     }
            // })
            return;
        }
        
        let option_name = $("#option-modal-input-name").val();
        let option_type = $("#option-modal-input-type").val();
        let option_trigger = $("#option-modal-trigger").val();
        console.log(option_trigger);
        if(edit == 1){
          $.ajax({
              type:'POST',
              url:"{{ route('admin-updateItemOption') }}",
              data:{
                id      : menu_item.menu_item_options[current_option_id].optiongroup_id,
                data    : {
                  name           : option_name,
                  type           : option_type,
                  trigger        : option_trigger,
                }
              },
              success:function(data){
                $.notify("OptionGroup Updated Successfully.","success");
                menu_item.menu_item_options[current_option_id].name = option_name;
                menu_item.menu_item_options[current_option_id].type = option_type;
                menu_item.menu_item_options[current_option_id].trigger = option_trigger;
                edit = 0;
                current.text(option_name);
                $("#option-edit-form").trigger("reset");
              }
          });
          return;
        }

        $.ajax({
            type:'POST',
            url:"{{ route('admin-createItemOption') }}",
            data:{
              id      : menu_item.item_id,
              data    : {
                name           : option_name,
                type           : option_type,
                trigger        : option_trigger,
              }
            },
            success:function(data){
              $.notify("OptionGroup Created Successfully.","success");
              current_name = option_name;
              current_option_id = menu_item.option_count;

              treeview.addSubLevel(current);
              treeview.resetBtnToggle();

              menu_item.menu_item_options.push({
                  'name':option_name,
                  'type':option_type,
                  'trigger':option_trigger,
                  'menu_option_options':[],
                  'suboption_count':0,
                  'id':menu_item.option_count,
                  'optiongroup_id' : data.id
              });

              menu_item.option_count++;

              $("#option-edit-form").trigger("reset");
            }
        });
      })

      $('#option-modal_close').on('click', function() {
          $("#option-edit-form").trigger("reset");
          edit = 0;
      })

      $('#edit-option-modal').on('hide.bs.modal', function() {
          $("#option-edit-form").trigger("reset");
          edit = 0;
      })
      

      //suboption
      $('#suboption-modal_save').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        let optionGroup = menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id]
        
        console.log(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id]);
        let suboption_name = $("#suboption-modal-input-name").val();
        let suboption_value = $("#suboption-modal-input-value").val();

        if(edit == 1){
          $.ajax({
              type:'POST',
              url:"{{ route('admin-updateSuboption') }}",
              data:{
                id      : optionGroup.menu_option_options[current_suboption_id].option_id,
                data    : {
                  name           : suboption_name,
                  value          : suboption_value,
                }
              },
              success:function(data){
                $.notify("OptionGroup Updated Successfully.","success");
                optionGroup.menu_option_options[current_suboption_id].name = suboption_name;
                optionGroup.menu_option_options[current_suboption_id].value = suboption_value;
                edit = 0;

                current.text(suboption_name);
                $("#suboption-edit-form").trigger("reset");
                
                savedGroup.push({
                    'menu_id': current_menu_id,
                    'group_id': current_group_id,
                    'item_id' : current_item_id,
                    'data' : optionGroup,
                    'option_id' : data.id
                });

                $('#option-modal-input-type').append('<option value="'+savecount+'">'+menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].name+'_'+optionGroup.name+'</option>');
                savecount ++;
                return;
              }
          });
          return;
        }

        $.ajax({
          type:'POST',
          url:"{{ route('admin-createSuboption') }}",
          data:{
            id      : optionGroup.optiongroup_id,
            data    : {
              name           : suboption_name,
              value          : suboption_value,
            }
          },
          success:function(data){
            $.notify("OptionGroup created Successfully.","success");
            current_name = suboption_name;
            console.log(optionGroup.suboption_count);
            current_suboption_id = optionGroup.suboption_count;

            treeview.addSubLevel(current);
            treeview.resetBtnToggle();

            
            optionGroup.menu_option_options.push({
                'name':suboption_name,
                'value':suboption_value,
                'id':optionGroup.suboption_count,
                'option_id' : data.id,
            });

            optionGroup.suboption_count++;

            savedGroup.push({
                'menu_id': current_menu_id,
                'group_id': current_group_id,
                'item_id' : current_item_id,
                'data' : optionGroup,
            });

            $('#option-modal-input-type').append('<option value="'+savecount+'">'+menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].name+'_'+optionGroup.name+'</option>');
            savecount++;
            $("#suboption-edit-form").trigger("reset");
          }
        });
      })

      $('#edit-suboption-modal').on('show.bs.modal', function() {
          if(edit == 1){
              $("#suboption-modal-input-name").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].menu_option_options[current_suboption_id].name);
              $("#suboption-modal-input-value").val(menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id].menu_option_options[current_suboption_id].value);
          }
      })

      $('#suboption-modal_done').on('click', function() {
        let optionGroup = menus[current_menu_id].menu_group[current_group_id].menu_items[current_item_id].menu_item_options[current_option_id]

        let suboption_name = $("#suboption-modal-input-name").val();
        let suboption_value = $("#suboption-modal-input-value").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        if(edit == 1){
          $.ajax({
            type:'POST',
            url:"{{ route('admin-updateSuboption') }}",
            data:{
              id      : optionGroup.menu_option_options[current_suboption_id].option_id,
              data    : {
                name           : suboption_name,
                value          : suboption_value,
              }
            },
            success:function(data){
              optionGroup.menu_option_options[current_suboption_id].name = suboption_name;
              optionGroup.menu_option_options[current_suboption_id].value = suboption_value;
              edit = 0;
              current.text(suboption_name);
              $("#suboption-edit-form").trigger("reset");
              $.notify("Suboption updated Successfully.","success");

            }
          });
          return;
        }

        
        $.ajax({
          type:'POST',
          url:"{{ route('admin-createSuboption') }}",
          data:{
            id      : optionGroup.optiongroup_id,
            data    : {
              name           : suboption_name,
              value          : suboption_value,
            }
          },
          success:function(data){
            current_name = suboption_name;
            console.log(optionGroup.suboption_count);
            current_suboption_id = optionGroup.suboption_count;

            treeview.addSubLevel(current);
            treeview.resetBtnToggle();

            optionGroup.menu_option_options.push({
                'name':suboption_name,
                'value':suboption_value,
                'id':optionGroup.suboption_count,
                'option_id' : data.id
                
            });

            optionGroup.suboption_count++;
            console.log(menus);

            $("#suboption-edit-form").trigger("reset");
            $.notify("Suboption created Successfully.","success");
          }
        });
      })

      $('#suboption-modal_close').on('click', function() {

          $("#suboption-edit-form").trigger("reset");
          edit = 0;
      })

      $('#edit-suboption-modal').on('hide.bs.modal', function() {
          $("#suboption-edit-form").trigger("reset");
          edit = 0;
      })

      $('#new-button').on('click', function() {

          current = $(this);
          level = 0;
          if(menus == null)
              current_menu_id = 0;
          else{
              current_menu_id = menus.menu_count;
          }
          is_sub = 0;
          var options = {
              'backdrop': 'static'
          };
          if(level == 0)
              $('#edit-modal').modal(options)
      })

      $('#save-menu').on('click',function(){
          $('.gocover').show();
          var res_id = {{$id}};

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  
              }
          });

          $.ajax({

              type:'POST',

              url:'{{ route('admin.update_menu') }}',

              data:{id:res_id,data:menus},
              
              success:function(data){
                  $('.gocover').hide();
                  window.location.href = "{{route('admin.restaruant')}}"
              }

          });
      })
  })
</script>
@endsection
