<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;
    protected $fillable = ['name','url'];

    public function user()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('status');
    }


}
