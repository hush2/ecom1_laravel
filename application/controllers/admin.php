<?php

class Admin_Controller extends Base_Controller
{
    public $restful = TRUE;

    //--------------------------------------------------------------------------
    // Show add page form.
    //--------------------------------------------------------------------------
    public function get_add_page()
    {
        return view('admin.add_page');
    }

    //--------------------------------------------------------------------------
    // Process submitted page.
    //--------------------------------------------------------------------------
    public function post_add_page()
    {
        $rules = Config::get('rules.add_page');
        $validation = Validator::make(Input::get(), $rules);

        if ($validation->passes())
        {
            if (Page::add(Input::get()))
            {
                return Redirect::to('add_page')->with('success', TRUE);
            }
            return Event::first('500', 'The page could not be added due to a system error. We apologize for any inconvenience.');
        }
        return Redirect::to('add_page')->with_input()
                                       ->with_errors($validation);
    }

    //--------------------------------------------------------------------------
    // Show Add PDF form.
    //--------------------------------------------------------------------------
    public function get_add_pdf()
    {
        return view('admin.add_pdf');
    }

    //--------------------------------------------------------------------------
    // Process submitted PDF file.
    //--------------------------------------------------------------------------
    public function post_add_pdf()
    {
        $rules = Config::get('rules.add_pdf');
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
            $pdf = Input::file('pdf');
            if (is_file($pdf['tmp_name']) AND $pdf['error'] === UPLOAD_ERR_OK)
            {
                if (Pdfs::add(Input::all()))
                {
                    return Redirect::to('add_pdf')->with('success', TRUE);
                }
                else
                {
                    return Event::first('500', 'The PDF could not be added due to a system error. We apologize for any inconvenience.');
                }
            }
            Session::flash('failed', TRUE);
        }
        return Redirect::to('add_pdf')->with_input()
                                      ->with_errors($validation);
    }
}
