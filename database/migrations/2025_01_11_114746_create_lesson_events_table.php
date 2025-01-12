<?php

use App\Models\Activity;
use App\Models\Cabinet;
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
        Schema::create('lesson_events', function (Blueprint $table) {
            $table->id();
            $table->string('cabinet_code');
            $table->time('start_time')->nullable(false);
            $table->date('date')->nullable(false);
            $table->string('activity_name');
            $table->time('end_time')->nullable(false);
            $table->foreign('activity_name')
                ->references('name')
                ->on(app(Activity::class)->getTable())
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('cabinet_code')
                ->references('code')
                ->on(app(Cabinet::class)->getTable())
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['cabinet_code', 'start_time', 'date']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_events');
    }
};
