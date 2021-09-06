<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    
    public static $tableName = 'accounts';
    public static $tableNameJoin = ['users','transactions'];

    protected $guarded =['id'];

    // public function users(){
    //     return $this->belongsTo(User::class);
    // }

    // public function account()
    // {
    //     return $this->hasOne(Transaction::class)->latestOfMany();
    // }
}
