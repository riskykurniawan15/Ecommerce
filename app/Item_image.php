<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_image extends Model
{
    protected $primaryKey = 'ID_ITEM_IMAGES';

    protected $fillable = [
        'ID_ITEMS', 'NAME_ITEM_IMAGES'
    ];
}
