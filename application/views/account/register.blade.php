@layout('base')

@section('page_title')
    Register
@endsection

@section('content')

    <h3>Register</h3>
    <p>Access to the site's content is available to registered users at a cost of $10.00 (US) per year. Use the form below to begin the registration process. <strong>Note: All fields are required.</strong> After completing this form, you'll be presented with the opportunity to securely pay for your yearly subscription via <a href="http://www.paypal.com">PayPal</a>.</p>

    {{ Form::open('register', 'post', array('style' => 'padding-left:100px')) }}
        <p>
        {{ Form::label('first_name', 'First Name') }}<br />
        {{ Form::create_form_input('text', 'first_name', $errors) }}
        </p>
        <p>
        {{ Form::label('last_name', 'Last Name') }}<br />
        {{ Form::create_form_input('text', 'last_name', $errors) }}
        </p>
        <p>
        {{ Form::label('username', 'Desired Name') }}<br />
        {{ Form::create_form_input('text', 'username', $errors) }}&nbsp;<small>Only letters and numbers are allowed.</small>
        </p>
        <p>
        {{ Form::label('email', 'Email Address') }}<br />
        {{ Form::create_form_input('text', 'email', $errors) }}
        </p>
        <p>
        {{ Form::label('password', 'Password') }}<br />
        {{ Form::create_form_input('password', 'password', $errors) }}&nbsp;<small>Must be between 6 and 20 characters long, with at least one lowercase letter, one uppercase letter, and one number.</small>
        </p>
        <p>
        {{ Form::label('confirm_password', 'Confirm Password') }}<br />
        {{ Form::create_form_input('password', 'confirm_password', $errors) }}
        </p>
        {{ Form::submit('Next &rarr;', array('class' => 'formbutton')) }}
    {{ Form::close() }}

@endsection
