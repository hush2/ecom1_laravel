<?php

class Home_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index()
    {
        return view('index');
    }

    public function get_about()
    {
        return view('about');
    }

    public function get_contact()
    {
        return view('contact');
    }
}