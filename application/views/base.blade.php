<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('page_title')</title>
    {{ HTML::style('css/styles.css') }}
</head>

<body>

<div id="wrap">
    <div class="header">
        <h1>{{ HTML::link('/', 'Knowledge is Power') }}</h1>
        <h2>and it pays to know</h2>
    </div>
    <div id="nav">
        <ul>
            <li {{ Form::selected('/') }}><a href="{{ url() }}"><span>Home</span></a></li>
            <li {{ Form::selected('about') }}><a href="{{ url('about') }}"><span>About</span></a></li>
            <li {{ Form::selected('contact') }}><a href="{{ url('contact') }}"><span>Contact</span></a></li>
            @if (Auth::guest())
            <li {{ Form::selected('register') }}><a href="{{ url('register') }}"><span>Register</span></a></li>
            @endif
        </ul>
    </div>
    <div class="page">
        <div class="content">
            @yield('content')
            <p><br clear="all" /></p>
        </div>
    <div class="sidebar">

    @if (Auth::check())
        <div class="title">
            <h4>Manage Your Account</h4>
        </div>
        <ul>
            <li>{{ HTML::link('renew', 'Renew Account') }}</li>
            <li>{{ HTML::link('change_password', 'Change Password') }}</li>
            <li>{{ HTML::link('favorites', 'Favorites') }}</li>
            <li>{{ HTML::link('history', 'History') }}</li>
            <li>{{ HTML::link('logout', 'Logout') }}</li>
        </ul>
        @if (Auth::user()->type == 'admin')
            <div class="title">
                <h4>Administration</h4>
            </div>
            <ul>
                <li>{{ HTML::link('add_page', 'Add Page') }}</a></li>
                <li>{{ HTML::link('add_pdf', 'Add PDF') }}</a></li>
            </ul>
        @endif
    @else
        @include('account/login_form')
    @endif
        <div class="title">
            <h4>Content</h4>
        </div>
        <ul>
            @foreach ($categories as $category)
                <li>{{ HTML::link("category/$category->id", $category->category) }}</li>
            @endforeach
            <li>{{ HTML::link('pdfs', 'PDF Guides') }}</li>
        </ul>
    </div>

    <div class="footer">
        <p><a href="#" title="Site Map">Site Map</a> | <a href="#" title="Site Policies">Policies</a> &nbsp; - &nbsp; &copy; Knowledge is Power &nbsp; - &nbsp; Design by <a href="http://www.spyka.net">spyka webmaster</a></p>
    </div>

</div>
</div>
</body>
</html>
