<?php

use App\Models\Scategorie;
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
    Schema::create('articles', function (Blueprint $table) {
        $table->id(); // Auto-incremented primary key
        $table->string('designation', 100)->unique(); // Unique constraint for 'designation'
        $table->string('reference', 50)->index(); // Index for 'reference' for faster lookups
        $table->string('marque', 50)->nullable(); // 'marque' can be nullable
        $table->unsignedInteger('qtestock'); // Unsigned integer for 'qtestock'
        $table->decimal('prix', 8, 2); // Decimal for 'prix' with 2 decimals
        $table->string('imageart', 200)->nullable(); // Nullable 'imageart'
        
        // Foreign key referencing the 'scategories' table
        $table->unsignedBigInteger('scategorieID');
        $table->foreign('scategorieID')
              ->references('id')
              ->on('scategories')
              ->onDelete('restrict'); // Restrict deletion if referenced

        // Automatic 'created_at' and 'updated_at' columns
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
