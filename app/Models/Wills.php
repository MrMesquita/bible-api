<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wills extends Model
{
    use HasFactory;

    protected $table = "wills";

    protected $fillable = ["name"];

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
