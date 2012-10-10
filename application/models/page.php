<?php

class Page extends Eloquent
{
    public static $table= 'pages';
    public static $timestamps = true;

    public static function add($form)
    {
        $allowed = '<div><p><span><br><a><img><h1><h2><h3><h4><ul><ol><li><blockquote><b><strong><em><i><u><strike><sub><sup><font><hr>';

        return self::insert(array(
            'category_id' => $form['category_id'],
            'title'       => strip_tags($form['title']),
            'description' => strip_tags($form['description']),
            'content'     => strip_tags($form['content'], $allowed),
        ));
    }

    public static function each($category_id)
    {
        return self::where_category_id($category_id)
                   ->order_by('created_at', 'desc')
                   ->get();
    }
}
