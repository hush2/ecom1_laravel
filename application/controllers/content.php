<?php

class Content_Controller extends Base_Controller
{
    public $restful = TRUE;

    //--------------------------------------------------------------------------
    // Show titles from a category.
    //--------------------------------------------------------------------------
    public function get_category($category_id)
    {
        if ($category = Category::find($category_id))
        {
            return view('content.category')
                        ->with('page_title', $category->category)
                        ->with('titles', Page::each($category_id));
        }
        return Response::error('404');
    }

    //--------------------------------------------------------------------------
    // Show page info.
    //--------------------------------------------------------------------------
    public function get_page($page_id)
    {
        if ($page = Page::find($page_id))
        {
            if (Auth::check())
            {
                History::add_page($page_id);
            }
            return view('content.page')->with('page', $page);
        }
        return Response::error('404');
    }

    //--------------------------------------------------------------------------
    // Show PDF titles
    //--------------------------------------------------------------------------
    public function get_pdfs()
    {
        return view('content.pdfs')->with('titles', Pdfs::all());
    }

    //--------------------------------------------------------------------------
    // Download PDF file
    //--------------------------------------------------------------------------
    public function get_view_pdf($tmp_name)
    {
        if (preg_match('/\w{40}/', $tmp_name))
        {
            $file = path('storage') . "pdfs/$tmp_name";
            if (file_exists($file) && is_file($file))
            {
                $pdf = Pdfs::where_tmp_name($tmp_name)->first();
                // View the PDF description for guest/expired users.
                if (Auth::guest() OR User::is_expired())
                {
                    return view('content.view_pdf')->with('pdf', $pdf);
                }
                // Add to 'Your Viewing History'.
                History::add_pdf($pdf->id);
                // Laravel will handle the headers.
                return Response::download($file, $pdf->file_name);
            }
        }
        return Response::error('404');
    }

    //--------------------------------------------------------------------------
    // Show list of favorite pages.
    //--------------------------------------------------------------------------
    public function get_favorites()
    {
        return view('content.favorites')
                   ->with('page_title', 'Your Favorite Pages')
                   ->with('titles', Favorite::all());
    }

    //--------------------------------------------------------------------------
    // Add/Remove a page from favorites.
    //--------------------------------------------------------------------------
    public function get_add_to_favorites($page_id)
    {
        if (Favorite::add($page_id))
        {
            return Redirect::to("page/{$page_id}")->with('added', true);
        }
        return Response::error('500');
    }

    public function get_remove_from_favorites($page_id)
    {
        if (Favorite::remove($page_id))
        {
            return Redirect::to("page/{$page_id}")->with('removed', true);
        }
        return Response::error('500');
    }

    //--------------------------------------------------------------------------
    // Show 'Your Viewing History'.
    //--------------------------------------------------------------------------
    public function get_history()
    {
        return view('content.history')
                ->with('pages', History::page_all())
                ->with('pdfs',  History::pdf_all());
    }
}
