@layout('base')

@section('page_title')
    PDFs
@endsection

@section('content')

    <h3>PDF Guides</h3>

    @if (Auth::guest())
        <p class='error'>Thank you for your interest in this content. You must be logged in as a registered user to view any of the PDFs listed below.</p>
    @elseif (User::is_expired())
        <p class='error'>Thank you for your interest in this content. Unfortunately your account has expired. Please <?= HTML::link('renew', 'renew your account') ?> in order to view any of the PDFs listed below.</p>
    @endif

    @if (empty($titles))
        <p>There are currently no PDFs available to view. Please check back again!</p>
    @else
        @foreach($titles as $title)
            <div>
                <h4>{{ HTML::link("view_pdf/{$title->tmp_name}", $title->title) }} ({{ $title->size }} kb)</h4>
                <p>{{ $title->description }}</p>
            </div>
        @endforeach
    @endif

@endsection
