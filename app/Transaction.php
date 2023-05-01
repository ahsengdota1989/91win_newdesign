<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public $timestamps = false;

    protected $softDelete = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'company_id',
        'status',
        'promotion_id',
        'bank_id',
        'remark',
        'approved_by',
        'created_at',
        'approval_remark',
        'isPromotion',
        'receipt_path',
        'deposit_path',
        'game_type_id',
        'parent_id',
        'doneAffBonus',
        'usdt_amount'
    ];

}
