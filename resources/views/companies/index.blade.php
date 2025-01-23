<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Dynamic Header Based on Category --}}
            @if(isset($category))
                {{ __('Companies in :category', ['category' => $category->name]) }}
            @else
                {{ __('All Companies') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg mb-4">Categories</h3>
                    @if($sidebarCategories->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach($sidebarCategories as $sidebarCategory)
                                <li>
                                    <a href="{{ route('companies.category.index', ['category' => $sidebarCategory->slug]) }}" 
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600">
                                        {{ $sidebarCategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
		                    <!-- Sibling Categories Widget. -->
		                    @if($siblingCategories->isNotEmpty())
		                        <div class="mt-6">
		                            <h3 class="font-semibold text-lg mb-4">Sibling Categories</h3>
		                            <ul class="space-y-2">
		                                @foreach($siblingCategories as $siblingCategory)
		                                    <li>
		                                        <a href="{{ route('companies.category.index', ['category' => $siblingCategory->slug]) }}" 
		                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600">
		                                            {{ $siblingCategory->name }}
		                                        </a>
		                                    </li>
		                                @endforeach
		                            </ul>
		                        </div>
		                    @endif
                    @endif


                </div>

                <!-- Main Content -->
                <div class="w-full lg:w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{-- Category Description (Optional) --}}
                        @if(isset($category) && $category->description)
                            <div class="mb-6 prose dark:prose-invert">
                                {!! Str::markdown($category->description) !!}
                            </div>
                        @endif

                        {{-- Shared Companies List Component --}}
                        <x-companies-list :companies="$companies" />

                        {{-- Pagination --}}
                        <div class="mt-8">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>