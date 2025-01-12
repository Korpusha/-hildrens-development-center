<x-modal id="show-timetable-cell" name="show-timetable-cell" :show="true" focusable>
    <!-- Frontend -->
    <div class="p-6">
        <h2 class="mb-4 text-lg font-bold text-gray-700 dark:text-gray-300">{{ $date }}</h2>

        @foreach ($lessonEvents as $lessonEvent)
            <div class="p-4 border rounded-md mb-4 flex justify-between items-center bg-gray-100 dark:bg-gray-800">
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        <strong>{{ $lessonEvent->start_time->format('H:i') }} - {{ $lessonEvent->end_time->format('H:i') }}</strong>
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Activity: {{ $lessonEvent->activity_name }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Cabinet: {{ $lessonEvent->cabinet_code }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tutors: {{ implode(', ', $lessonEvent->tutors->pluck('name')->toArray()) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-modal>
