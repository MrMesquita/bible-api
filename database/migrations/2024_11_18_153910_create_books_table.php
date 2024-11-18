<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->tinyInteger("will_id");
                $table->tinyInteger("position");
                $table->char("name", 30);
                $table->char("short", 3);
                
                $table->foreginId("will_id")->references("id")->on("wills")->onDelete("cascade");
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("books", function (Blueprint $table) {
            $table->dropForeign(["will_id"]);
            $table->dropColumn("will_id");
        });

        Schema::dropIfExists('books');
    }
};
