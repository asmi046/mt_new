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
        Schema::create('pay_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->unicue()->comment('Идентификаток платежного заказа');
            $table->integer('client_count')->default(1)->comment('Количество клиентов');
            $table->string("type")->default('free')->comment('Тип заказа');
            $table->string("status", 50)->default('Создан')->comment('Статус заказа');
            $table->string("name", 500)->default('Созданая оплата')->comment('Наименование заказа');
            $table->string('img')->nullable()->comment('Изображение');
            $table->float('price', 6,2)->comment('Цена');
            $table->string('payment_url', 500)->nullable()->comment('Url из банка');
            $table->string('payment_id', 100)->nullable()->comment('Идентификатор платежа из банка');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_orders');
    }
};
