<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verses extends Model
{
    use HasFactory;

    protected $table = "verses";

    protected $fillable = [
        "version_id", 
        "book_id",
        "chapter",
        "verse",
        "text"
    ];

    public function book()
    {
        return $this->belongsTo(Books::class);
    }

    public function version()
    {
        return $this->belongsTo(Versions::class);
    }
}
