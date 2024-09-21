<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'reason', 'price', 'cost', 'quantity', 'transaction_type', 'user_id', 'supplier_id',
    ];

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class, 'item_id');
    }

    public function username()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getTransactionType()
    {
        $transaction_type = '';

        switch ($this->transaction_type) {
            case 1 :
                $transaction_type = 'In';
                break;
            case 2 :
                $transaction_type = 'Out';
        }

        return $transaction_type;
    }
}
