<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versions extends Model
{
    use HasFactory;

    protected $table = "versions";

    protected $fillable = ["name"];

    public function verses()
    {
        return $this->hasMany(Verses::class);
    }

    public function getTranslationName(int $versionId): ?string
    {
        return $this->where('id', $versionId)->value('name');
    }
}
