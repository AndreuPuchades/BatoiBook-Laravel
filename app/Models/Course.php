<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cycle',
        'idFamily',
        'vliteral',
        'cliteral',
    ];

    protected $table = 'courses';
    public $timestamps = false;

    public function family()
    {
        return $this->belongsTo(Family::class, 'idFamily');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'idCycle');
    }
}

