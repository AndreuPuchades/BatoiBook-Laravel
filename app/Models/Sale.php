<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'idBook',
        'idUser',
        'date',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'idBook');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
