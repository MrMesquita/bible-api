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
        if (!Schema::hasTable('verses')) {
            Schema::create('verses', function (Blueprint $table) {
                $table->id();
                $table->tinyInteger("version_id");
                $table->tinyInteger("book_id");
                $table->tinyInteger("chapter");
                $table->tinyInteger("verse");
                $table->text("text");
                
                $table->unsignedBigInteger("version_id");
                $table->unsignedBigInteger("book_id");

                $table->foreginId("version_id")->references("id")->on("verses")->onDelete("cascade");
                $table->foreginId("book_id")->references("id")->on("books")->onDelete("cascade");
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("verses", function (Blueprint $table) {
            $table->dropForeign(["version_id", "book_id"]);

            $table->dropColumn("version_id");
            $table->dropColumn("book_id");
        });
        Schema::dropIfExists('verses');
    }
};
