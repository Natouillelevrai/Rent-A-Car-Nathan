<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    public function up(): void
    {
        $path = database_path('sql/data-structure.sql');
        $sql = File::get($path);

        $pathFix = database_path('sql/data-fixtures.sql');
        $sqlFix = File::get($pathFix);
    
        DB::unprepared($sql);
        DB::unprepared($sqlFix);
    }
    
    public function down(): void
    {

    }
    
};
