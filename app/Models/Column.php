<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $fillable = [
      'title'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
