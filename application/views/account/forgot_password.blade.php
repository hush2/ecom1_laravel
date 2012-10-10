@layout('base')

@section('page_title')
    Forgot Your Password?
@endsection

@section('content')

    @if (Session::has('success'))
        <h3>Your password has been changed.</h3>
        <p>You will receive the new, temporary password via email. Once you have logged in with this new password, you may change it by clicking on the "Change Password" link.</p>
    @else
        <h3>Reset Your Password</h3>
        <p>Enter your email address below to reset your password.</p>

        {{ Form::open('forgot_password') }}
            <p>
            {{ Form::label('email', 'Email Address') }}<br/>
            {{ Form::create_form_input('text', 'email', $errors) }}<br/>
            </p>
            {{ Form::submit('Reset &rarr;', array('class' =>  'formbutton')) }}
        {{ Form::close() }}
    @endif

@endsection
