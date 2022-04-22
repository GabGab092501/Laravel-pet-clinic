<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("hoomans", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "name");
            $table->string(column: "email");
            $table->string(column: "password");
            $table->string(column: "images")->default("asdasd123.jpg");;
            $table->string(column: "role");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("hoomans");
    }
};
