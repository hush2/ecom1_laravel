@layout('base')

@section('page_title')
    Knowledge is Power: And It Pays to Know
@endsection

@section('content')

    @if (Session::has('logout'))
        <h3>Logged Out</h3>
        <p>Thank you for visiting. You are now logged out. Please come back soon!</p>
    
    @elseif (Session::has('registered'))
        <h3>Thanks!</h3>
        <p>Thank you for registering! To complete the process, please now click the button below so that you may pay for your site access via PayPal. The cost is $10 (US) per year.</p>
        
    @else
        <h3>Welcome</h3>
        <p>Welcome to Knowledge is Power, a site dedicated to keeping you up to date on the Web security and programming information you need to know.

        <h3>Most Popular Pages</h3>
        <p>
        <ol>
            @foreach(History::most_popular() as $page)
                <li><h4>{{ HTML::link("page/{$page->id}", $page->title) }}</h4></li>
            @endforeach
        </ol>
        </p>
    @endif

@endsection