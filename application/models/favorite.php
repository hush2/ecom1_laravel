<?php

class Favorite extends Eloquent
{
    public static $table = 'favorite_pages';
    public static $timestamp = true;

    public static function add($page_id)
    {
        if (Page::find($page_id))
        {
            try {
                return self::insert(array(
                            'user_id' => Auth::user()->id,
                            'page_id' => $page_id));
            }
            catch (Exception $e) {}
        }
    }

    public static function remove($page_id)
    {
        if (Page::find($page_id))
        {
            return self::where_user_id(Auth::user()->id)
                       ->where_page_id($page_id)
                       ->delete();
        }
    }

    public static function is_favorite($page_id)
    {
        return (bool) self::where_user_id(Auth::user()->id)
                          ->where_page_id($page_id)
                          ->count();
    }

    public static function all()
    {
        return DB::table('pages')
                ->join('favorite_pages', 'favorite_pages.page_id', '=', 'pages.id')
                ->where('favorite_pages.user_id', '=', Auth::user()->id)
                ->order_by('title')
                ->get(array('id', 'title', 'description'));
    }
}
