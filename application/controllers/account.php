<?php

class Account_Controller extends Base_Controller
{
    public $restful = TRUE;

    //--------------------------------------------------------------------------
    // Process user login.
    //--------------------------------------------------------------------------
    public function post_login()
    {
        $rules = Config::get('rules.login');
        $validation = Validator::make(Input::get(), $rules);

        if ($validation->passes())
        {
            $info['username'] = Input::get('login_email');
            $info['password'] = Input::get('login_password');

            if ( ! Auth::attempt($info))
            {
                Session::flash('failed', TRUE);
            }
        }
        return Redirect::to('/')->with_input()
                                ->with_errors($validation);
    }

    //--------------------------------------------------------------------------
    // Logout current user.
    //--------------------------------------------------------------------------
    public function get_logout()
    {
        Auth::logout();

        return Redirect::to('/')->with('logout', TRUE);
    }

    //--------------------------------------------------------------------------
    // Show registration form.
    //--------------------------------------------------------------------------
    public function get_register()
    {
        return view('account.register');
    }

    //--------------------------------------------------------------------------
    // Process registration data.
    //--------------------------------------------------------------------------
    public function post_register()
    {
        $rules = Config::get('rules.register');
        $validation = Validator::make(Input::get(), $rules);

        if ($validation->passes())
        {
            if ($user = User::add(Input::get()))
            {
                Auth::login($user);
                return Redirect::to('/')->with('registered', TRUE);
            }
            return Event::first('500', 'You could not be registered due to a system error. We apologize for any inconvenience.');
        }
        return Redirect::to('/register')->with_input()
                                        ->with_errors($validation);
    }

    //--------------------------------------------------------------------------
    // Show change password form.
    //--------------------------------------------------------------------------
    public function get_change_password()
    {
        return view('account.change_password');
    }

    //--------------------------------------------------------------------------
    // Process change new password.
    //--------------------------------------------------------------------------
    public function post_change_password()
    {
        $rules = Config::get('rules.change_password');
        $validation = Validator::make(Input::get(), $rules);

        if ($validation->passes())
        {
            if ( ! User::password_update(Input::get('new_password')))
            {
                return Event::first('500', 'Your password could not be changed due to a system error. We apologize for any inconvenience.');
            }
            Session::flash('success', TRUE);
        }
        return Redirect::to('change_password')->with_input()
                                              ->with_errors($validation);
    }

    //--------------------------------------------------------------------------
    // Show forgot password form.
    //--------------------------------------------------------------------------
    public function get_forgot_password()
    {
        return view('account.forgot_password');
    }

    //--------------------------------------------------------------------------
    // Process forgotten password.
    //--------------------------------------------------------------------------
    public function post_forgot_password()
    {
        $rules = Config::get('rules.forgot_password');
        $validation = Validator::make(Input::get(), $rules);

        if ($validation->passes())
        {
            $new_password = User::new_password(Input::get('email'));
            if ( ! $new_password)
            {
                return Event::first('500', 'Your password could not be changed due to a system error. We apologize for any inconvenience.');
            }
            //$message = "Your password to log into <whatever site> has been temporarily changed to '$new_password'. Please log in using that password and this email address. Then you may change your password to something more familiar.";
            //mail(Input::get('email'), 'Your temporary password.', $message, 'From: admin@example.com');
            Session::flash('success', TRUE);
        }
        return Redirect::to('forgot_password')->with_input()
                                              ->with_errors($validation);
    }

    //--------------------------------------------------------------------------
    // Show account renewal form.
    //--------------------------------------------------------------------------
    public function get_renew()
    {
        return view('account.renew');
    }

}
