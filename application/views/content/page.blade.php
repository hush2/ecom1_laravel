@layout('base')

@section('page_title')
    {{ $page->title }}
@endsection

@section('content')

    <h3>{{ $page->title }}</h3>

    @if (Auth::guest())
        <p class='error'>Thank you for your interest in this content. You must be a logged in as a registered user to view this page in its entirety.</p>
        <div>
            {{ $page->description }}
        </div>
    @else
        @if (User::is_expired())
            <p class="error">Thank you for your interest in this content, but your account is no longer current. Please {{ HTML::link('renew', 'renew your account') }} in order to view this page in its entirety</p>
            <div>
                {{ $page->description }}
            </div>
        @else
            <?php
            $heart = HTML::image('images/heart_48.png', '', array('align' => 'middle'));
            $cross = HTML::image('images/cross_48.png', '', array('align' => 'middle'));
            ?>
            <p>
            @if (Session::has('added'))
                {{ $heart }}This has been added to your favorites!{{ d(HTML::link("remove_from_favorites/$page->id", $cross)) }}
            @elseif (Session::has('removed'))
                This page has been removed from your favorites!{{ $cross }}
            @elseif (Favorite::is_favorite($page->id))
                {{ $heart }}This is a favorite!{{ d(HTML::link("remove_from_favorites/$page->id", $cross)) }}
            @else
                Make this a favorite!{{ d(HTML::link("add_to_favorites/$page->id", $heart)) }}
            @endif
            </p>
            <div>
                {{ nl2br($page->content) }}
            </div>
        @endif
    @endif

@endsection
