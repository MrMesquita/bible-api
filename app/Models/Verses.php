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

    public function getVerses(int $bookId, int $versionId, int $chapter, ?int $verse)
    {
        return $this->select('book_id', 'chapter', 'verse', 'text')
            ->where('book_id', $bookId)
            ->where('version_id', $versionId)
            ->where('chapter', $chapter)
            ->when($verse, function ($query, $verse) {
                return $query->where('verse', $verse);
            })
            ->get();
    }
}
