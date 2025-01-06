<?php

use App\Models\Activity;
use App\Models\Tutor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('activity_tutor_specializations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id');
            $table->string('activity_name');
            $table->foreign('tutor_id')
                ->references('user_id')
                ->on(app(Tutor::class)->getTable())
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('activity_name')
                ->references('name')
                ->on(app(Activity::class)->getTable())
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['tutor_id', 'activity_name']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_tutor_specializations');
    }
};
