@if(isset($post->user) && $post->user != NULL)
    <!-- User Section -->
    <div class="row">
        <!-- User profile Page  -->
        <a href="{{ route('users', ['locale' => app()->getLocale(), 'id' => $post->user['id']]) }}" class="text-dark w-100 text-center d-block mx-auto">
            <!-- Check Image -->
            @if(isset($post->user['img']) && $post->user['role'] == 'facebook_user' || $post->user['role'] == 'google_user')
                <!-- Image -->
                <img src="{{ asset('assets/img/users'.'/'.$post->user['img']) }}" class="w-25 d-block rounded-circle mx-auto" title="{{ $post->user['first_name'].' '.$post->user['last_name'] }}" alt="{{ $post->user['first_name'].' '.$post->user['last_name'] }}">
            @else
                <!-- Image -->
                <img src="{{ asset('assets/img/users'.'/'.$post->user['img']) }}" class="w-25 d-block rounded-circle mx-auto" title="{{ $post->user['first_name'].' '.$post->user['last_name'] }}" alt="{{ $post->user['first_name'].' '.$post->user['last_name'] }}">
            @endif

            <!-- Full Name -->
            <h4 class="w-100 text-center mt-3 user-name-surname">{{ $post->user['first_name'].' '.$post->user['last_name'] }}</h4>
        </a>
    </div>
@endif
