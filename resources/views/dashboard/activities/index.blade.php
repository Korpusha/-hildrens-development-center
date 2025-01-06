<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Activities') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('dashboard.activities.create') }}"
                   class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-500 bg-green-600 text-white">
                    New Activity
                </a>
            </div>
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 border-b">
                        <th class="px-4 py-2 text-left font-semibold text-sm text-gray-600 dark:text-gray-300">Name</th>
                        <th class="px-4 py-2 text-left font-semibold text-sm text-gray-600 dark:text-gray-300">Duration Minutes</th>
                        <th class="px-4 py-2 text-left font-semibold text-sm text-gray-600 dark:text-gray-300">Type</th>
                        <th class="px-4 py-2 text-left font-semibold text-sm text-gray-600 dark:text-gray-300">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($activities as $activity)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $activity->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $activity->duration_minutes }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $activity->type_display }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 flex space-x-4">
                                <a href="{{ route('dashboard.activities.edit', $activity->name) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('dashboard.activities.destroy', $activity->name) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                                            onclick="return confirm('Are you sure you want to delete this activity?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>
