<!-- Menu geting function -->
@php function cats_mobile($cats_mobile, $locale, $level = 0){
    foreach($cats_mobile as $cat){ @endphp
        <!-- Item -->
        <li class="mobile-menu-list-item">
            <!-- Title -->
            <a href="{{ route('category', ['locale' => app()->getLocale(), 'id' => $cat['id']]) }}">{{ $cat['title_'.app()->getLocale()] }}</a>
            
            <!-- Check children categories -->
            @php if(count($cat['children']) > 0){ @endphp
                <!-- Icon -->
                <i class="icon fa fa-angle-down"></i>
                
                <!-- Submenu -->
                <ul class="mobile-submenu">
                    <!-- Recursion call -->
                    @php cats_mobile($cat['children'], $locale, $level+1); @endphp
                </ul>
            @php } @endphp
        </li>
    @php } 
} @endphp

<!-- Check categories data -->
@if(isset($categories)&& count($categories) > 0)
    <div class="container-fluid">
        <div class="row">
            <nav class="mobile-menu-container">
                <ul>
                    <!-- Call menu -->
                    {{ cats_mobile($categories, $locale) }} 

                    <!-- Languages -->
                    <li>
                        <!-- Armenian -->
                        <a class="@if(app()->getLocale() == 'hy') active-lang @else bg-light @endif p-2 rounded mr-2" href="{{ route('set-languege', ['locale' => app()->getLocale(), 'new_locale' => 'hy']) }}">
                            <svg id="armenia" xmlns="http://www.w3.org/2000/svg" width="21.079" height="21.079" viewBox="0 0 21.079 21.079">
                                <path id="Path_575" data-name="Path 575" d="M21.079,159.95a10.516,10.516,0,0,0-.656-3.666l-9.884-.458-9.884.458a10.578,10.578,0,0,0,0,7.332l9.884.458,9.884-.458A10.516,10.516,0,0,0,21.079,159.95Z" transform="translate(0 -149.411)" fill="#0052b4"/>
                                <path id="Path_576" data-name="Path 576" d="M25.807,351.917a10.543,10.543,0,0,0,9.884-6.874H15.923A10.543,10.543,0,0,0,25.807,351.917Z" transform="translate(-15.267 -330.837)" fill="#ff9811"/>
                                <path id="Path_577" data-name="Path 577" d="M15.923,6.874H35.691a10.543,10.543,0,0,0-19.768,0Z" transform="translate(-15.267)" fill="#d80027"/>
                            </svg>
                        </a>

                        <!-- Russian -->
                        <a class="@if(app()->getLocale() == 'ru') active-lang @else bg-light @endif p-2 rounded mr-2" href="{{ route('set-languege', ['locale' => app()->getLocale(), 'new_locale' => 'ru']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <g id="russia" transform="translate(0 0)">
                                    <circle id="Ellipse_29" data-name="Ellipse 29" cx="10" cy="10" r="10" transform="translate(0 0)" fill="#f0f0f0"/>
                                    <path id="Path_661" data-name="Path 661" d="M19.378,173.913a10.036,10.036,0,0,0,0-6.956H.622a10.036,10.036,0,0,0,0,6.956l9.378.87Z" transform="translate(0 -160.435)" fill="#0052b4"/>
                                    <path id="Path_662" data-name="Path 662" d="M25.3,351.565a10,10,0,0,0,9.378-6.522H15.923A10,10,0,0,0,25.3,351.565Z" transform="translate(-15.301 -331.565)" fill="#d80027"/>
                                </g>
                            </svg>
                        </a>

                        <!-- English -->
                        <a class="@if(app()->getLocale() == 'en') active-lang @else bg-light @endif p-2 rounded mr-2" href="{{ route('set-languege', ['locale' => app()->getLocale(), 'new_locale' => 'en']) }}">
                            <svg id="united-states" xmlns="http://www.w3.org/2000/svg" width="22.158" height="22.158" viewBox="0 0 22.158 22.158">
                                <circle id="Ellipse_30" data-name="Ellipse 30" cx="11" cy="11" r="11" transform="translate(0.079 0.079)" fill="#f0f0f0"/>
                                <g id="Group_1455" data-name="Group 1455" transform="translate(0.382 2.408)">
                                    <path id="Path_663" data-name="Path 663" d="M244.87,192.107h11.561a11.091,11.091,0,0,0-.382-2.89H244.87Z" transform="translate(-234.654 -183.437)" fill="#d80027"/>
                                    <path id="Path_664" data-name="Path 664" d="M244.87,58.542H254.8a11.137,11.137,0,0,0-2.556-2.89H244.87Z" transform="translate(-234.654 -55.652)" fill="#d80027"/>
                                    <path id="Path_665" data-name="Path 665" d="M103.541,458.756a11.032,11.032,0,0,0,6.9-2.409H96.644A11.032,11.032,0,0,0,103.541,458.756Z" transform="translate(-92.843 -439.007)" fill="#d80027"/>
                                    <path id="Path_666" data-name="Path 666" d="M10.063,325.672H28.969a11.013,11.013,0,0,0,1.244-2.89H8.819A11.013,11.013,0,0,0,10.063,325.672Z" transform="translate(-8.819 -311.221)" fill="#d80027"/>
                                </g>
                                <path id="Path_667" data-name="Path 667" d="M5.132,1.73h1.01L5.2,2.412l.359,1.1-.939-.682-.939.682.31-.954A11.14,11.14,0,0,0,1.844,4.958h.324l-.6.434q-.14.233-.268.473l.285.879-.533-.387q-.2.421-.362.86l.314.968H2.168l-.939.682.359,1.1L.648,9.289.086,9.7A11.186,11.186,0,0,0,0,11.079H11.079V0A11.027,11.027,0,0,0,5.132,1.73Zm.429,8.241-.939-.682-.939.682.359-1.1L3.1,8.185H4.264l.359-1.1.359,1.1H6.142L5.2,8.867ZM5.2,5.64l.359,1.1-.939-.682-.939.682.359-1.1L3.1,4.958H4.264l.359-1.1.359,1.1H6.142ZM9.535,9.971,8.6,9.289l-.939.682.359-1.1-.939-.682H8.238l.359-1.1.359,1.1h1.161l-.939.682ZM9.177,5.64l.359,1.1L8.6,6.062l-.939.682.359-1.1-.939-.682H8.238l.359-1.1.359,1.1h1.161Zm0-3.227.359,1.1L8.6,2.834l-.939.682.359-1.1L7.077,1.73H8.238L8.6.626l.359,1.1h1.161Z" fill="#0052b4"/>
                            </svg>
                        </a>
                    </li>

                    <!-- Currency -->
                    <li>
                        <!-- Check other currencies exists -->
                        @if(isset($currencies) && count($currencies) > 0)
                            <!-- Loop from currencies -->
                            @foreach($currencies as $currency_item)
                                <a href="{{ route('set-currency', ['locale' => app()->getLocale(), 'set_currency' => $currency_item->type]) }}" class="font-weight-bold p-2 rounded @if($currency_item->id == $currency->id) bg-dark text-light @else  bg-light text-dark @endif">{{ $currency_item->{'name_'.app()->getLocale()}.' '.$currency_item->simbol }}</a>
                            @endforeach
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endif  


