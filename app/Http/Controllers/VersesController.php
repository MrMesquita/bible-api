<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Verses;
use App\Models\Versions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VersesController extends Controller
{
    private $verses;
    private $books; 
    private $versions;

    public function __construct(
        Verses $verses,
        Books $books,
        Versions $versions
    ) {
        $this->verses = $verses;
        $this->books = $books;
        $this->versions = $versions;
    }

    public function index(Request $request)
    {
        $bookRef = $request->bookRef;
        $chapter = $request->chapter;
        $verse = $request->verse;
        $version = null;
    
        switch ($request->version) {
            case "ara93": $version = 1; break;
            case "arc69": $version = 2; break;
            case "arc09": $version = 3; break;
            case "naa": $version = 4; break;
            case "ntlh": $version = 5; break;
            case "nvi": $version = 6; break;
            case "nvt": $version = 7; break;
            case "aa48": $version = 8; break;
            case "ar": $version = 9; break;
            case "kja": $version = 10; break;
            case "bbe": $version = 11; break;
            case "niv": $version = 12; break;
            case "asv": $version = 13; break;
            default: $version = 3; break;
        }
    
        $book = $this->books->where("short", $bookRef)->first();
    
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
    
        
        $retorno = $this->verses
            ->select("book_id", "chapter", "verse", "text")
            ->where("book_id", $book->id)
            ->where("version_id", $version)
            ->where("chapter", $chapter)
            ->when($verse, function ($query, $verse) {
                return $query->where("verse_id", $verse);
            })
            ->get();
    
        return response()->json([
            "c" => $chapter,
            'results' => $retorno, 
            'translation' => $this->versions->select("name")->where("id", $version)->first()->name
        ]);
    }
    
}
