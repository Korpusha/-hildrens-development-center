<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Activity') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('dashboard.activities.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required autofocus autocomplete="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label for="duration_minutes" :value="__('Duration Minutes')" />
                                <x-text-input id="duration_minutes" name="duration_minutes" type="text" class="mt-1 block w-full" :value="old('duration_minutes')" required autofocus autocomplete="duration_minutes" />
                                <x-input-error class="mt-2" :messages="$errors->get('duration_minutes')" />
                            </div>

                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <x-select-menu
                                    id="type"
                                    name="type"
                                    class="mt-1 block w-full"
                                    :values="[old('type')]"
                                    :options="\App\Enums\ActivityType::casesForSelect()"
                                    :emptyOption="true"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
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
