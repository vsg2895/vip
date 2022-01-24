@extends('admin.layouts.app')

@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title text-capitalize">{{ $item->icon }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route($route.'-admin-update', ['locale' => app()->getLocale(), 'id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control mb-2" name="url" max="255" min="2" placeholder="URL" value="{{ $item->url }}" required>
                    </div>
                    <div class="form-group">
                        <label>Position ID</label>
                        <input type="text" class="form-control mb-2" name="position_id" max="255" min="1" placeholder="Position ID" value="{{ $item->position_id }}" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <select class="form-control mb-2" name="icon" required>
                            <option value="facebook-f" @if($item -> icon == 'facebook-f') selected @endif>Facebook Circle</option>
                            <option value="facebook-square" @if($item -> icon == 'facebook-square') selected @endif>Facebook Square</option>
                            <option value="facebook" @if($item -> icon == 'facebook') selected @endif>Facebook</option>
                            <option value="facebook-messenger" @if($item -> icon == 'facebook-messenger') selected @endif>Messenger</option>
                            <option value="youtube" @if($item -> icon == 'youtube') selected @endif>Youtube</option>
                            <option value="youtube-square" @if($item -> icon == 'youtube-square') selected @endif>Youtube Square</option>
                            <option value="instagram" @if($item -> icon == 'instagram') selected @endif>Instagram</option>
                            <option value="instagram-square" @if($item -> icon == 'instagram-square') selected @endif>Instagram Square</option>
                            <option value="twitter" @if($item -> icon == 'twitter') selected @endif>Twitter</option>
                            <option value="twitter-square" @if($item -> icon == 'twitter-square') selected @endif>Twitter Square</option>
                            <option value="telegram" @if($item -> icon == 'telegram') selected @endif>Telegram</option>
                            <option value="telegram-plane" @if($item -> icon == 'telegram-plane') selected @endif>Telegram Plane</option>
                            <option value="viber" @if($item -> icon == 'viber') selected @endif>Viber</option>
                            <option value="whatsapp" @if($item -> icon == 'whatsapp') selected @endif>Whatsapp</option>
                            <option value="whatsapp-square" @if($item -> icon == 'whatsapp-square') selected @endif>Whatsapp Square</option>
                            <option value="pinterest" @if($item -> icon == 'pinterest') selected @endif>Pinterest</option>
                            <option value="google" @if($item -> icon == 'google') selected @endif>Google</option>
                            <option value="google-drive" @if($item -> icon == 'google-drive') selected @endif>Google Drive</option>
                            <option value="google-play" @if($item -> icon == 'google-play') selected @endif>Google Play</option>
                            <option value="google-plus" @if($item -> icon == 'google-plus') selected @endif>Google Plus</option>
                            <option value="linkedin-in" @if($item -> icon == 'linkedin-in') selected @endif>Linkedin</option>
                            <option value="odnoklassniki" @if($item -> icon == 'odnoklassniki') selected @endif>Odnoklassniki</option>
                            <option value="odnoklassniki-square" @if($item -> icon == 'odnoklassniki-square') selected @endif>Odnoklassniki Square</option>
                            <option value="reddite" @if($item -> icon == 'reddite') selected @endif>Reddit</option>
                            <option value="reddite-alien" @if($item -> icon == 'reddite-alien') selected @endif>Reddit Alien</option>
                            <option value="reddit-square" @if($item -> icon == 'reddit-square') selected @endif>Reddit Square</option>
                            <option value="slack" @if($item -> icon == 'slack') selected @endif>Slack</option>
                            <option value="snapchat" @if($item -> icon == 'snapchat') selected @endif>Snapchat</option>
                            <option value="snapchat-ghost" @if($item -> icon == 'snapchat-ghost') selected @endif>Snapchat Ghost</option>
                            <option value="snapchat-square" @if($item -> icon == 'snapchat-square') selected @endif>Snapchat Square</option>
                            <option value="snapchat-square" @if($item -> icon == 'snapchat-square') selected @endif>Snapchat Square</option>
                            <option value="tiktok" @if($item -> icon == 'tiktok') selected @endif>Tiktok</option>
                            <option value="tripadvisor" @if($item -> icon == 'tripadvisor') selected @endif>Tripadvisor</option>
                            <option value="tumblr" @if($item -> icon == 'tumblr') selected @endif>Tumblr</option>
                            <option value="tumblr-square" @if($item -> icon == 'tumblr-square') selected @endif>Tumblr Square</option>
                            <option value="vimeo" @if($item -> icon == 'vimeo') selected @endif>Vimeo</option>
                            <option value="vimeo-square" @if($item -> icon == 'vimeo-square') selected @endif>Vimeo Square</option>
                            <option value="vimeo-v" @if($item -> icon == 'vimeo-v') selected @endif>Vimeo V</option>
                            <option value="yandex" @if($item -> icon == 'yandex') selected @endif>Yandex</option>
                            <option value="yahoo" @if($item -> icon == 'yahoo') selected @endif>Yahoo</option>
                            <option value="behance" @if($item -> icon == 'behance') selected @endif>behance</option>
                            <option value="behance-square" @if($item -> icon == 'behance-square') selected @endif>Behance Square</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection