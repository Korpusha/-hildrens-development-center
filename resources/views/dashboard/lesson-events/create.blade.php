<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Lesson Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('dashboard.lesson-events.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>

                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" :value="old('start_time')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>

                            <div>
                                <x-input-label for="cabinet_code" :value="__('Cabinet')" />
                                <x-select-menu-normal
                                    id="cabinet_code"
                                    name="cabinet_code"
                                    class="mt-1 block w-full"
                                    :options="$availableCabinets"
                                    :emptyOption="true"
                                    :emptyOptionText="__('No cabinet')"
                                    :values="[old('cabinet_code')]"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('cabinet_code')" />
                            </div>

                            <div>
                                <x-input-label for="tutor_ids" :value="__('Tutors')" />
                                <x-select-menu-normal
                                    id="tutor_ids"
                                    name="tutor_ids[]"
                                    class="mt-1 block w-full"
                                    :options="$availableTutors"
                                    :emptyOption="true"
                                    :emptyOptionText="__('No tutor')"

                                    multiple
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('tutor_ids')" />
                            </div>

                            <div>
                                <x-input-label for="activity_name" :value="__('Activity')" />
                                <x-select-menu-normal
                                    id="activity_name"
                                    name="activity_name"
                                    class="mt-1 block w-full"
                                    :options="$availableActivities"
                                    :emptyOption="true"
                                    :emptyOptionText="__('No activity')"
                                    :values="[old('activity_name')]"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('activity_name')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
