<?php

class Category extends Eloquent
{
    public static function all()
    {
        return self::order_by('category')->get();
    }
}
