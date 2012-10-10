@layout('base')

@section('page_title')
    {{ $pdf->title }}
@endsection

@section('content')

    <h3>{{ $pdf->title }}</h3>

    @if (Auth::guest())
        <p class='error'>Thank you for your interest in this content. You must be logged in as a registered user to view any of the PDFs listed below.</p>
    @elseif (User::is_expired())
        <p class='error'>Thank you for your interest in this content. Unfortunately your account has expired. Please {{ HTML::link('renew', 'renew your account') }} in order to access this file.</p>
    @endif

    {{ $pdf->description }}

@endsection
