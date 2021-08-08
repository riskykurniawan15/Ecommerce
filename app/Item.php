<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'CODE_ITEMS', 'HEAD_PICTURE_ITEMS', 'NAME_ITEMS', 'PURCHASE_PRICE_ITEMS', 'SELLING_PRICE_ITEMS', 'WEIGHT_ITEMS', 'DESCRIPTION_ITEMS'
    ];

    protected $primaryKey = 'ID_ITEMS';
}
