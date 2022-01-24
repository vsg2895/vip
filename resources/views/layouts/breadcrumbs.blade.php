<div class="row">
<ul class="col-8 bg-white breadcrumb-line">
    @foreach($breadcrumbs as $breadcrumb)
        <li class="d-inline float-left @if(!$loop->last) mr-2 @endif">
            <a href="@if($loop->last) javascript:void(0) @else {{ route($breadcrumb, ['locale' => app()->getLocale()]) }} @endif" class="text-dark">
                @if(!$loop->last)
                    {{ translating('url-'.$breadcrumb) }}&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="4.508" height="8.913" viewBox="0 0 4.508 8.913">
                        <g id="left-arrow" transform="translate(76.741 0.533)">
                            <g id="Group_9" data-name="Group 9" transform="translate(-76.741 -0.533)">
                            <path id="Path_5" data-name="Path 5" d="M126.615,8.319,130.224,4.7a.349.349,0,0,0,0-.493L126.615.594A.348.348,0,1,1,127.108.1l3.608,3.616a1.046,1.046,0,0,1,0,1.477l-3.608,3.616a.348.348,0,0,1-.493-.492Z" transform="translate(-126.514 0)"/>
                            <path id="Path_14" data-name="Path 14" d="M126.615,8.319,130.224,4.7a.349.349,0,0,0,0-.493L126.615.594A.348.348,0,1,1,127.108.1l3.608,3.616a1.046,1.046,0,0,1,0,1.477l-3.608,3.616a.348.348,0,0,1-.493-.492Z" transform="translate(-126.514 0)"/>
                            </g>
                        </g>
                    </svg>
                @else
                    {{ $breadcrumb }}&nbsp;
                @endif
            </a>
        </li>
    @endforeach
</ul>

<!-- Check data -->
@if(\Request::segment(2) == 'create-post')
    <!-- Create post steps -->
    <ul class="bg-light p-0 col-4 rounded mr-auto">
        {{ translating('step1') }} 
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29.797" height="31.986" viewBox="0 0 29.797 31.986">
            <defs>
                <filter id="right-arrow" x="0" y="0" width="29.797" height="31.986" filterUnits="userSpaceOnUse">
                <feOffset input="SourceAlpha"/>
                <feGaussianBlur stdDeviation="1.5" result="blur"/>
                <feFlood flood-opacity="0.161"/>
                <feComposite operator="in" in2="blur"/>
                <feComposite in="SourceGraphic"/>
                </filter>
            </defs>
            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#right-arrow)">
                <path id="right-arrow-2" data-name="right-arrow" d="M41.965,11.139,31.073.146A.493.493,0,0,0,30.722,0H21.81a.5.5,0,0,0-.351.853L32,11.493,21.459,22.132a.5.5,0,0,0,0,.707.493.493,0,0,0,.351.147h8.912a.493.493,0,0,0,.351-.146L41.965,11.847a.5.5,0,0,0,0-.707Z" transform="translate(-16.81 4.5)" fill="#009688"/>
            </g>
        </svg>

        {{ translating('step2') }} 
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29.797" height="31.986" viewBox="0 0 29.797 31.986">
            <defs>
                <filter id="right-arrow" x="0" y="0" width="29.797" height="31.986" filterUnits="userSpaceOnUse">
                <feOffset input="SourceAlpha"/>
                <feGaussianBlur stdDeviation="1.5" result="blur"/>
                <feFlood flood-opacity="0.161"/>
                <feComposite operator="in" in2="blur"/>
                <feComposite in="SourceGraphic"/>
                </filter>
            </defs>
            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#right-arrow)">
                <path class="levle2color" id="right-arrow-2" data-name="right-arrow" d="M41.965,11.139,31.073.146A.493.493,0,0,0,30.722,0H21.81a.5.5,0,0,0-.351.853L32,11.493,21.459,22.132a.5.5,0,0,0,0,.707.493.493,0,0,0,.351.147h8.912a.493.493,0,0,0,.351-.146L41.965,11.847a.5.5,0,0,0,0-.707Z" transform="translate(-16.81 4.5)" fill="@if(\Request::segment(3) == 'level2' || \Request::segment(3) == 'level3' || \Request::segment(3) == 'level4') #009688 @else #ccc @endif"/>
            </g>
        </svg>

        {{ translating('step3') }} 
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29.797" height="31.986" viewBox="0 0 29.797 31.986">
            <defs>
                <filter id="right-arrow" x="0" y="0" width="29.797" height="31.986" filterUnits="userSpaceOnUse">
                <feOffset input="SourceAlpha"/>
                <feGaussianBlur stdDeviation="1.5" result="blur"/>
                <feFlood flood-opacity="0.161"/>
                <feComposite operator="in" in2="blur"/>
                <feComposite in="SourceGraphic"/>
                </filter>
            </defs>
            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#right-arrow)">
                <path id="right-arrow-2" data-name="right-arrow" d="M41.965,11.139,31.073.146A.493.493,0,0,0,30.722,0H21.81a.5.5,0,0,0-.351.853L32,11.493,21.459,22.132a.5.5,0,0,0,0,.707.493.493,0,0,0,.351.147h8.912a.493.493,0,0,0,.351-.146L41.965,11.847a.5.5,0,0,0,0-.707Z" transform="translate(-16.81 4.5)" fill="@if(\Request::segment(3) == 'level3' || \Request::segment(3) == 'level4') #009688 @else #ccc @endif"/>
            </g>
        </svg>

        {{ translating('step4') }} 

    </ul>
@endif
</div>