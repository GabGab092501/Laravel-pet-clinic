<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("classify", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "classify");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("pets", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "pets_name");
            $table->integer(column: "age");
            $table->string(column: "gender");
        
            $table->string(column: "images")->default("asdasd123.jpg");
            $table->integer(column: "customer_id")->unsigned();
            $table->integer(column: "classify_id")->unsigned();
            
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("customer_id")
                ->references("id")
                ->on("customers")
                ->onDelete("cascade");

                $table
                ->foreign("classify_id")
                ->references("id")
                ->on("classify")
                ->onDelete("cascade");
        });


       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("pets");
    }
};
