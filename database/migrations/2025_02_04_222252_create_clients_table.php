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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pay_order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("fio")->comment('ФИО клиента');
            $table->string("phone")->comment('Телефон');
            $table->string("email")->nullable()->comment('email');
            $table->string("document_type")->comment('Тип документа');
            $table->string("document_number")->comment('Номер документа');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
