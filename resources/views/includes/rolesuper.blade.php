

   <li>
        <a href="#langs" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-user-secret"></i>{{ __('Staffs') }}
        </a>
        <ul class="collapse list-unstyled" id="langs" data-parent="#accordion">
            <li>
                <a href="{{ route('admin.staff.index') }}"><span>{{ __('Manage Staffs') }}</span></a>
            </li>
            <li>
                <a href="{{ route('admin.staff.history') }}"><span>{{ __('Staffs History') }}</span></a>
            </li>
        </ul>
    </li>

   <li>
        <a href="#users" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-user-secret"></i>{{ __('Users') }}
        </a>
        <ul class="collapse list-unstyled" id="users" data-parent="#accordion">
            <li>
                <a href="{{ route('admin.users') }}"><span>{{ __('Manage Users') }}</span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#categories" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-cart"></i>{{ __('Categories') }}
        </a>
        <ul class="collapse list-unstyled" id="categories" data-parent="#accordion">
            <li>
                <a href="{{ route('admin-categories')}}"><span>{{ __('Category List') }}</span></a>
            </li>
            <li>
                <a href="{{ route('admin-assgincategories')}}"><span>{{ __('Assign Categories') }}</span></a>
            </li>
            <li>
                <a href="{{route('admin.add_category')}}"><span>{{ __('Add/Edit Categories') }}</span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#course" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-cart"></i>{{ __('Restaurants') }}
        </a>
        <ul class="collapse list-unstyled" id="course" data-parent="#accordion">
            <li>
                <a href="{{route('admin.add_restaruant')}}"><span>{{ __('Add New Restaurants') }}</span></a>
            </li>
            <li>
                <a href="{{route('admin.restaruant')}}"><span>{{ __('All Restaurants') }}</span></a>
            </li>
            <!-- <li>
                <a href="{{route('admin.find_restaruant')}}"><span>{{ __('Find Restaurants') }}</span></a>
            </li>
            <li>
                <a href="{{route('admin.view_restaruant',0)}}"><span>{{ __('Searched Restaurants') }}</span></a>
            </li> -->

        </ul>
    </li>



    <li>
        <a href="#invoice" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-wrench"></i>{{ __('Settings') }}
        </a>
        
    </li>
    
    <li>
        <a href="#report" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-cart"></i>{{ __('Reports') }}
        </a>
        <ul class="collapse list-unstyled" id="report" data-parent="#accordion">
            <li>
                <a href="{{ route('admin-salesReport')}}"><span>{{ __('Sales Report') }}</span></a>
            </li>
            <li>
                <a href="javascript:void(0)"><span>{{ __('Traffic Report') }}</span></a>
            </li>
        </ul>
    </li>






