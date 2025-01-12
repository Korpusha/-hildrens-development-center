@php
    /**
     * @var Collection $lessonEvents
     * @var int $month
     * @var int $year
     * @var Carbon $calendarStart
     * @var Carbon $calendarEnd
     * @var array $weekDays
     * @var array $months
     * @var array $years
     */

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Collection;

    $currentDate = $calendarStart->copy();
@endphp

<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Timetable') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('dashboard.lesson-events.create') }}"
                   class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-500 bg-green-600 text-white">
                    New Lesson Event
                </a>
            </div>

            <div class="flex justify-end items-center mb-4">
                <form method="GET" action="{{ route('dashboard.timetable.index') }}"
                      class="flex items-center space-x-4">
                    <x-select-menu-normal
                        id="month"
                        name="month"
                        :options="$months"
                        :values="[$month]"
                    />

                    <x-select-menu-normal
                        id="year"
                        name="year"
                        :options="$years"
                        :values="[$year]"
                    />

                    <x-primary-button>{{ __('Show') }}</x-primary-button>
                </form>
            </div>

            <div class="border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="grid grid-cols-7 gap-2 mb-2">
                    @foreach ($weekDays as $weekDay)
                        <div class="text-center font-bold text-gray-700 dark:text-gray-300">
                            {{ $weekDay }}
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-2">
                    @while ($currentDate->lte($calendarEnd))
                        @php
                            $isCurrentMonth = $currentDate->month === $month;
                            $currentDateFormatted = $currentDate->format('Y-m-d');
                            $currentLessonEvents = $lessonEvents->get($currentDateFormatted);
                        @endphp

                        <div class="calendar-cell border border-gray-300 dark:border-gray-700 p-2 rounded-md h-32
                                bg-{{ $isCurrentMonth ? 'white' : 'gray-100' }}
                                dark:bg-{{ $isCurrentMonth ? 'gray-800' : 'gray-900' }}"
                             data-date="{{ $currentDateFormatted }}"
                             data-is-enabled="{{ $isCurrentMonth }}"
                             role="button"
                        >
                            <div class="text-sm font-semibold
                                    {{ $isCurrentMonth ? 'text-gray-900' : 'text-gray-500' }}
                                    dark:{{ $isCurrentMonth ? 'text-gray-200' : 'text-gray-500' }}"
                            >
                                {{ $currentDate->day }}
                            </div>

                            <div class="mt-2 space-y-1 overflow-hidden">
                                @isset ($currentLessonEvents)
                                    @foreach ($currentLessonEvents as $lessonEvent)
                                        <div class="text-sm truncate text-gray-800 dark:text-gray-300"
                                             title="{{ $lessonEvent->start_time->format('H:i') }} - {{ $lessonEvent->end_time->format('H:i') }} {{ $lessonEvent->activity_name }}">
                                            {{ $lessonEvent->start_time->format('H:i') }} - {{ $lessonEvent->end_time->format('H:i') }} {{ $lessonEvent->activity_name }}
                                        </div>
                                        @if ($loop->index === 2 && $loop->remaining > 0)
                                            <div class="text-sm text-gray-500 dark:text-gray-400">+ {{ $loop->remaining }}
                                                more
                                            </div>
                                            @break
                                        @endif
                                    @endforeach
                                @endisset
                            </div>
                        </div>

                        @php $currentDate->addDay(); @endphp
                    @endwhile
                </div>
            </div>
        </div>

        <div id="show-timetable-cell-container"></div>
    </div>

    @push('scripts')
        @vite(['resources/js/dashboard/timetable/index.js'])
    @endpush
</x-dashboard-layout>
