@props([
    'sidebarCategories' => collect(),
    'siblingCategories' => collect(),
    'selectedCategory' => null, // Add selected category prop
])

@php
    $isSearchPage = request()->routeIs('companies.search'); // Check if the current route is the search page
@endphp

<div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
    <h3 class="font-semibold text-lg mb-4">Categories</h3>
    @if($sidebarCategories->isNotEmpty())
        <ul class="space-y-2">
            @foreach($sidebarCategories as $sidebarCategory)
                <li>
                    <a href="{{ $isSearchPage ? route('companies.search', ['query' => request('query'), 'category' => $sidebarCategory->id]) : route('companies.category.index', ['category' => $sidebarCategory->slug]) }}" 
                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 {{ $selectedCategory == $sidebarCategory->id ? 'font-bold' : '' }}">
                        {{ $sidebarCategory->name }}
                    </a>
                    @if($selectedCategory == $sidebarCategory->id)
                        <ul class="ml-4 mt-2 space-y-2">
                            @foreach($sidebarCategory->children as $child)
                                <li>
                                    <a href="{{ $isSearchPage ? route('companies.search', ['query' => request('query'), 'category' => $child->id]) : route('companies.category.index', ['category' => $child->slug]) }}" 
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 {{ $selectedCategory == $child->id ? 'font-bold' : '' }}">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <!-- Sibling Categories Widget -->
        @if($siblingCategories->isNotEmpty())
            <div class="mt-6">
                <h3 class="font-semibold text-lg mb-4">Sibling Categories</h3>
                <ul class="space-y-2">
                    @foreach($siblingCategories as $siblingCategory)
                        <li>
                            <a href="{{ $isSearchPage ? route('companies.search', ['query' => request('query'), 'category' => $siblingCategory->id]) : route('companies.category.index', ['category' => $siblingCategory->slug]) }}" 
                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 {{ $selectedCategory == $siblingCategory->id ? 'font-bold' : '' }}">
                                {{ $siblingCategory->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif
</div>