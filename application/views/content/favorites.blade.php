@layout('base')

@section('page_title')
    {{ $page_title }}
@endsection

@section('content')

    <h3>{{ $page_title }}</h3>

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
