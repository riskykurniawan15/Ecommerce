<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_transaction extends Model
{
    protected $fillable = [
        'ID_TRANSACTIONS', 'ID_ITEMS', 'PRICE_ITEMS_TRANSACTIONS', 'QUANTITY_ITEM_DETAIL_TRANSACTIONS'
    ];

    protected $primaryKey = 'ID_DETAIL_TRANSACTIONS';
}
