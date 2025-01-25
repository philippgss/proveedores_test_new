<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $company->com_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-6">
                        <!-- Company  Description -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ $company->com_description }}
                            </p>
                        </div>

                        <!-- Grouped Categories  Section -->
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold mb-4">Categorías</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($groupedCategories as $group)
                                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                        <h4 class="text-md font-semibold mb-2">
                                            <a href="{{ route('companies.category.index', ['category' => $group['parent']->slug]) }}/" class="hover:text-blue-600">
                                                {{ $group['parent']->name }}
                                            </a>
                                        </h4>



                                        @php
                                            $maxVisibleCategories = 10; // Define the number here
                                        @endphp

                                        <div x-data="{ showMore: false }" class="flex flex-wrap gap-2">
                                            <!-- Display the first N categories -->
                                            @foreach (array_slice($group['children'], 0, $maxVisibleCategories) as $child)
                                                <a href="{{ route('companies.category.index', ['category' => $child->slug]) }}/" 
                                                    class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm transition-all duration-200 hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-100">
                                                    {{ $child->name }}
                                                </a>
                                            @endforeach

                                            <!-- Hidden extra categories -->
                                            @if (count($group['children']) > $maxVisibleCategories)
                                                <div x-show="showMore" class="flex flex-wrap gap-2">
                                                    @foreach (array_slice($group['children'], $maxVisibleCategories) as $child)
                                                        <a href="{{ route('companies.category.index', ['category' => $child->slug]) }}/" 
                                                            class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm transition-all duration-200 hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-100">
                                                            {{ $child->name }}
                                                        </a>
                                                    @endforeach
                                                </div>

                                                <!-- "Show More" Button with Distinct Styling -->
                                                <button @click="showMore = !showMore" 
                                                        class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm transition-all duration-200 hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-100">
                                                    <span x-text="showMore ? 'Show Less' : 'Show More'"></span>
                                                </button>
                                            @endif
                                        </div>


																				
                                        {{--
                                        <div class="flex flex-wrap gap-2">
                                            @foreach (array_slice($group['children'], 0, 3) as $child)
                                                <a href="{{ route('companies.category.index', ['category' => $child->slug]) }}/" class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm transition-all duration-200 hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-100">
                                                    {{ $child->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                        --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>