<div class="title">
    <h4>Login</h4>
</div>

{{ Form::open('/') }}

    <p>
    @if (Session::has('failed'))
        <span class="error">The email address and password do not match those on file.</span><br/>
    @endif

    <label for="login_email"><strong>Email Address</strong></label><br />
    {{ Form::create_form_input('text', 'login_email', $errors) }}<br/>

    <label for="login_password"><strong>Password</strong></label><br />
    {{ Form::create_form_input('password', 'login_password', $errors) }}

    {{ HTML::link('forgot_password', 'Forgot?') }}<br />

    {{ Form::submit('Login &rarr;') }}
    </p>
    
{{ Form::close() }}
