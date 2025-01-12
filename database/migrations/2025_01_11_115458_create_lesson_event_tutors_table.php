<?php

use App\Models\LessonEvent;
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
        Schema::create('lesson_event_tutors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_event_id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('lesson_event_id')
                ->references('id')
                ->on(app(LessonEvent::class)->getTable())
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tutor_id')
                ->references('user_id')
                ->on(app(Tutor::class)->getTable())
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['lesson_event_id', 'tutor_id']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_event_tutors');
    }
};
