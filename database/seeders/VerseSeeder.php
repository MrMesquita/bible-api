<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Caminho para o arquivo SQL
        $sqlFile = database_path('seeders/sql/verses.sql');
        
        // Verifique se o arquivo existe antes de tentar carregá-lo
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);

            // Executa o SQL sem preparar a consulta
            DB::unprepared($sql);
            echo "SQL executado com sucesso!\n";
        } else {
            echo "Arquivo SQL não encontrado: " . $sqlFile . "\n";
        }
    }
}
