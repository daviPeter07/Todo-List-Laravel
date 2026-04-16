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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            //associa tarefa a user id
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
                tarefa tem:
                titulo
                descricao (nao pode ser null)
                status que por padrao é pending
                position do tipo nao negativo (somente zero e positivos)
                timestamp, qnd foi criado e editado

                $table->TIPO("nome da tabela")->regra
            */
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
