<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        "will_id",
        "position",
        "name",
        "short",
        "chapters"
    ];

    public function will()
    {
        return $this->belongsTo(Wills::class);
    }

    public function verses()
    {
        return $this->hasMany(Verses::class);
    }

    public function findByShort($bookRef) 
    {
        return $this->where("short", $bookRef)->first();
    }

    public function getTotalChaptersPerBook($bookId) 
    {
        return $this->select('chapters')->where('id', $bookId)->first()->chapters;
    }
}
