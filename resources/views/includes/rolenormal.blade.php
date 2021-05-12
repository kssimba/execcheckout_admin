


    <li>
        <a href="#course" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-cart"></i>{{ __('Restaruants') }}
        </a>
        <ul class="collapse list-unstyled" id="course" data-parent="#accordion">
             <li>
                <a href="{{route('admin.add_restaruant')}}"><span>{{ __('Add New Restaruant') }}</span></a>
            </li>
            <li>
                <a href="{{route('admin.restaruant')}}"><span>{{ __('All Restaruants') }}</span></a>
            </li>
            <li>
                <a href="{{route('admin.find_restaruant')}}"><span>{{ __('Find Restaruants') }}</span></a>
            </li>
            <li>
                <a href="{{route('admin.view_restaruant',0)}}"><span>{{ __('Searched Restaruants') }}</span></a>
            </li>

        </ul>
    </li>







