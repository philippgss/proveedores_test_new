<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Dynamic Header Based on Listing Type --}}
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
                <x-sidebar :sidebarCategories="$sidebarCategories" :siblingCategories="$siblingCategories" :sidebarGeo="$sidebarGeo" />

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