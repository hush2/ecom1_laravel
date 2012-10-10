@layout('base')

@section('page_title')
    Your Viewing History
@endsection

@section('content')

    <h3>Your Viewing History</h3>

    <h4>Pages You Have Viewed</h4>

    @if (empty($pages))
        <p>You have not yet viewed any pages.</p>
    @else
        @foreach ($pages as $page)
            <div>
                <h4><a href="page/{{ $page->id }}">{{ $page->title }}</a></h4>
                <p>{{ $page->description }}<br />Last viewed: {{ $page->date }}</p>
            </div>
        @endforeach
    @endif

    <h4>PDFs You Have Viewed</h4>

    @if (empty($pdfs))
        <p>You have not yet viewed any PDFs.</p>
    @else
        @foreach ($pdfs as $pdf)
            <div>
                <h4><a href="view_pdf/{{ $pdf->tmp_name }}">{{ $pdf->title }}</a></h4>
                <p>{{ $pdf->description }}<br />Last viewed: {{ $pdf->date }}</p>
            </div>
        @endforeach
    @endif

@endsection