@layout('base')

@section('page_title')
    Contact
@endsection

@section('content')

    <h3>Contact</h3>
    <br />
    {{ HTML::mailto('hushywushy@gmail.com') }}

@endsection
