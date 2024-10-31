<?php
// MIGRACION DE LA TABLA FILES EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name');
            $table->string('path');
            $table->string('url');
            $table->string('link')->nullable();
            $table->string('size');
            $table->string('alt');
            $table->string('title');
            $table->string('mime_type');
            $table->string('type')->default('image');
            $table->integer('order')->default(0);
            $table->morphs('imageable');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
