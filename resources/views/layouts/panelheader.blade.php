<div class="header">
    <div class="container">
        <div class="white fl-left"><p>Killing Shot</p></div>
        <div class="fl-right">
            <a class="fl-left" href="{{ URL::route('dashboard') }}">
                <img src="@if($user->picture){{$user->picture}}@else images/Users/default.gif @endif" width="40" height="40" class="img-rounded fl-left">
                <p class="fl-left white">{{$user->short_name}}</p>
            </a>
            <a class="fl-left white"  href="{{ URL::route('posts') }}">Posts</a>
            @yield('header')
            <a class="fl-left white"  href="{{ URL::route('settings') }}">Settings</a>
        </div>
    </div>
</div>