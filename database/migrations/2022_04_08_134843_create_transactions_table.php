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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "date");
            $table->integer(column: "hoomans_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("hoomans_id")
                ->references("id")
                ->on("hoomans")
                ->onDelete("cascade");
        });
        Schema::create('transaction_line', function (Blueprint $table) {
            $table->integer(column: "transaction_id")->unsigned();
            $table->integer(column: "pet_id")->unsigned();
            $table->integer(column: "service_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("transaction_id")
                ->references("id")
                ->on("transactions")
                ->onDelete("cascade");
            $table
                ->foreign("pet_id")
                ->references("id")
                ->on("pets")
                ->onDelete("cascade");
            $table
                ->foreign("service_id")
                ->references("id")
                ->on("services")
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
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_line');
    }
};
