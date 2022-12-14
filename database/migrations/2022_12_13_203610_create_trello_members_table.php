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
        Schema::create('trello_members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\TelegramUser::class)->constrained()->cascadeOnDelete();
            $table->string('trello_id');
            $table->string('full_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trello_members');
    }
};
