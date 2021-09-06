<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public static $tableName = 'transactions';
    public static $tableNameJoins = [
        'accounts',
        'type_transactions'
    ];
    public static $typeTransaction = ['BALANCE_INC' => [1, 3],'BALANCE_DEC' => [2, 4]];

    protected $guarded =['id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function typeTransaction()
    {
        return $this->belongsTo(TypeTransaction::class);
    }
}
