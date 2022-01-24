<!-- Header Navigation -->
<ul class="nav nav-tabs mb-4" id="postsTab" role="tablist">
    <!-- All Posts -->
    <li class="nav-item">
        <a class="nav-link get-posts all @if(\Request::segment(4) == NULL || \Request::segment(4) == 'all') active @endif" data-url="{{ route('account-posts', ['locale' => app()->getLocale()]) }}" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="@if(\Request::segment(4) == NULL || \Request::segment(4) == 'active') true @else false @endif">{{ translating('all-posts') }}</a>
    </li>

    <!-- Active Posts -->
    <li class="nav-item">
        <a class="nav-link get-posts @if(\Request::segment(4) == 'active') active @endif" data-url="{{ route('account-posts', ['locale' => app()->getLocale(), 'type' => 'active']) }}" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="@if(\Request::segment(4) == 'active') true @else false @endif">{{ translating('active-posts') }}</a>
    </li>

    <!-- Passive Posts -->
    <li class="nav-item">
        <a class="nav-link get-posts passive @if(\Request::segment(4) == 'passive') active @endif" data-url="{{ route('account-posts', ['locale' => app()->getLocale(), 'type' => 'passive']) }}" id="passive-tab" data-toggle="tab" href="#passive" role="tab" aria-controls="passive" aria-selected="@if(\Request::segment(4) == 'passive') true @else false @endif">{{ translating('passive-posts') }}</a>
    </li>

    <!-- Moderation Posts -->
    <li class="nav-item">
        <a class="nav-link get-posts moderation @if(\Request::segment(4) == 'moderation') active @endif" data-url="{{ route('account-posts', ['locale' => app()->getLocale(), 'type' => 'moderation']) }}" id="moderation-tab" data-toggle="tab" href="#moderation" role="tab" aria-controls="moderation" aria-selected="@if(\Request::segment(4) == 'moderation') true @else false @endif">{{ translating('moderation-posts') }}</a>
    </li>
</ul>