<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->timestamp('sent_at')->nullable();
            $table->enum('status', ['starting', 'queued', 'sent', 'failed'])->default('starting')->index();
            $table->text('log')->nullable();
            $table->string('recipient')->nullable()->index();
            $table->string('subject')->nullable();
            $table->mediumText('raw')->nullable();

            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_logs');
    }
}
