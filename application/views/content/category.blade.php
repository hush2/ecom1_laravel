@layout('base')

@section('page_title')
    {{ $page_title }}
@endsection

@section('content')

    <h3>{{ $page_title }}</h3>

    @if (Auth::guest())
        <p class='error'>Thank you for your interest in this content. You must be logged in as a registered user to view site content.</p>
    @elseif (User::is_expired())
        <p class="error">Thank you for your interest in this content. Unfortunately your account has expired. Please {{ HTML::link('renew', 'renew your account') }} in order to access site content.</p>
    @endif

    @if (empty($titles))
        <p>There are currently no pages of content associated with this category. Please check back again!</p>
    @else
        @foreach ($titles as $title)
            <div>
                <h4>{{ HTML::link("page/$title->id", $title->title) }}</h4>
                <p>{{ $title->description }}</p>
            </div>
        @endforeach
    @endif

@endsection
