<?php

class User extends Eloquent
{
    public static $table = 'users';
    public static $timestamps = true;

    public static function add($form)
    {
        return self::insert(array(
            'first_name'    => $form['first_name'],
            'last_name'     => $form['last_name'],
            'username'      => $form['username'],
            'email'         => $form['email'],
            'pass'          => Hash::make($form['password']),
            'date_expires'  => DB::Raw('ADDDATE(NOW(), INTERVAL 1 MONTH)'),
        ));
    }

    public static function password_update($password, $user=NULL)
    {
        if ($user OR $user = self::find(Auth::user()->id))
        {
            $user->pass = Hash::make($password);
            return $user->save();
        }
    }

    public static function new_password($email)
    {
        $new_password = substr(md5(uniqid(rand(), TRUE)), 10, 15);
        $user = self::where_email($email)->first();
        if (self::password_update($new_password, $user))
        {
            return $new_password;
        }
    }
    public static function renew()
    {
        $user = self::find(Auth::user()->id);
        $user->date_expires = DB::Raw('ADDDATE(NOW(), INTERVAL 1 MONTH)');
        return $user->save();
    }

    public static function is_expired()
    {
        return time() > strtotime(Auth::user()->date_expires);
    }
}
