<?php

namespace App\Services;

use App\Models\Books;
use App\Models\Verses;
use App\Models\Versions;

class VerseService
{
    private $books;
    private $verses;
    private $versions;

    public function __construct(
        Books $books,
        Verses $verses,
        Versions $versions
    ) {
        $this->books = $books;
        $this->verses = $verses;
        $this->versions = $versions;
    }

    public function getVerses(array $data)
    {
        $book = $this->books->findByShort($data['bookRef']);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $version = $this->resolveVersion($data['version'] ?? null);
        $translation = $this->versions->getTranslationName($version);
        $totalChapters = $this->books->getTotalChaptersPerBook($book->id);
        $verses = $this->verses->getVerses(
            $book->id,
            $version,
            $data['chapter'],
            $data['verse'] ?? null
        );

        return response()->json([
            'chapter' => $data['chapter'],
            'results' => $verses,
            'total_chapters' => $totalChapters,
            'translation' => $translation,
        ]);
    }

    private function resolveVersion(?string $version): int
    {
        $versionsMap = [
            "ara93" => 1, "arc69" => 2, "arc09" => 3, "naa" => 4,
            "ntlh" => 5, "nvi" => 6, "nvt" => 7, "aa48" => 8,
            "ar" => 9, "kja" => 10, "bbe" => 11, "niv" => 12, "asv" => 13
        ];

        return $versionsMap[$version] ?? 3;
    }
}
