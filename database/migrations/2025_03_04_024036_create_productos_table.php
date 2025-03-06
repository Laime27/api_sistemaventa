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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('nombre');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('precio_compra', 10, 2);
            $table->text('descripcion')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('estado')->default('activo');
            $table->string('imagen')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
