<?php

class History extends Eloquent
{
    public static $table = 'history';
    public static $timestamps = true;

    public static function add_pdf($pdf_id)
    {
        return self::insert(array(
            'user_id' => Auth::user()->id,
            'type'    => 'pdf',
            'pdf_id'  => $pdf_id,
        ));
    }

    public static function add_page($page_id)
    {
        return self::insert(array(
            'user_id' => Auth::user()->id,
            'type'    => 'page',
            'page_id' => $page_id,
        ));
    }

    public static function most_popular()
    {
        return self::join('pages', 'pages.id', '=', 'history.page_id')
                   ->where('history.type', '=', 'page')
                   ->group_by('history.page_id')
                   ->order_by('n', 'DESC')
                   ->take(10)
                   ->get(array('pages.id', 'pages.title', DB::raw('COUNT(history.id) as n')));
    }

    public static function page_all()
    {
        return self::join('pages', 'pages.id', '=', 'history.page_id')
                ->where('history.user_id', '=', Auth::user()->id)
                ->where('history.type', '=', 'page')
                ->group_by('history.page_id')
                ->order_by('history.created_at', 'desc')
                ->take(10)
                ->get(array('pages.id', 'title', 'description', DB::raw("DATE_FORMAT(history.created_at, \"%M %d, %Y\") as date")));
    }

    public static function pdf_all()
    {
        return self::join('pdfs', 'pdfs.id', '=', 'history.pdf_id')
                ->where('history.user_id', '=', Auth::user()->id)
                ->where('history.type', '=', 'pdf')
                ->group_by('history.pdf_id')
                ->order_by('history.created_at', 'desc')
                ->take(10)
                ->get(array('pdfs.tmp_name', 'title', 'description', DB::raw("DATE_FORMAT(history.created_at, \"%M %d, %Y\") as date")));
    }
}
