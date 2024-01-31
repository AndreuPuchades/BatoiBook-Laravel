<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_id',
        'publisher',
        'price',
        'pages',
        'status',
        'photo',
        'comments',
        'soldDate',
        'admit',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
