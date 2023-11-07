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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->json('data'); 
           

            $table->timestamps();
        });


        $defaultSettings = [
            'school_name' => 'NEUST Peñaranda Off Campus',
            'school_year_start'=>6
    
    

        ];
    
        DB::table('settings')->insert([
            'data' => json_encode($defaultSettings),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
