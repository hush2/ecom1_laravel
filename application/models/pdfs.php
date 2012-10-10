<?php

class Pdfs extends Eloquent
{
    public static $timestamps = TRUE;

    public static function add($pdf)
    {
        $tmp_name = sha1($pdf['pdf']['name'] . uniqid('', TRUE));
        Input::upload('pdf', path('storage') . 'pdfs', $tmp_name);

        return self::insert(array(
            'tmp_name'     => $tmp_name,
            'title'        => strip_tags($pdf['title']),
            'description'  => strip_tags($pdf['description']),
            'file_name'    => $pdf['pdf']['name'],
            'size'         => round($pdf['pdf']['size'] / 1024),
        ));
    }

    public static function all()
    {
        return self::order_by('created_at', 'desc')->get();
    }
}
