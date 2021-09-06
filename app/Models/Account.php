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
}
