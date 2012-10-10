@layout('base')

@section('page_title')
    Change Your Password
@endsection

@section('content')

    @if (Session::has('success'))
        <h3>Your password has been changed.</h3>
    @else
        <h3>Change Your Password</h3>
        <p>Use the form below to change your password.</p>

        {{ Form::open('change_password') }}
            <p>
            {{ Form::label('current_password', 'Current Password') }}<br/>
            {{ Form::create_form_input('password', 'current_password', $errors) }}
            </p>
            <p>
            {{ Form::label('new_password', 'New Password') }}<br/>
            {{ Form::create_form_input('password', 'new_password', $errors) }}&nbsp;<small>Must be between 6 and 20 characters long, with at least one lowercase letter, one uppercase letter, and one number.</small>
            </p>
            <p>
            {{ Form::label('confirm_password', 'Confirm New Password') }}<br/>
            {{ Form::create_form_input('password', 'confirm_password', $errors) }}
            </p>
            {{ Form::submit('Change &rarr;', array('class' => 'formbutton')) }}
        {{ Form::close() }}
    @endif

@endsection
