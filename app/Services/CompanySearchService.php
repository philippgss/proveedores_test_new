<?php

namespace App\Services;

use App\Models\Company;

class CompanySearchService
{
    public function search($query)
    {
        \Log::info('Search Query:', ['query' => $query]);

        // Step 1: Exact match in com_name (case-insensitive)
        $exactMatches = Company::where('com_name', 'ILIKE', $query)->get();
        \Log::info('Exact Matches:', ['count' => $exactMatches->count()]);

        // Step 2: Partial matches in com_name and com_description
        $partialMatches = Company::where('com_name', 'ILIKE', "%{$query}%")
            ->orWhere('com_description', 'ILIKE', "%{$query}%")
            ->whereNotIn('id', $exactMatches->pluck('id')) // Exclude exact matches
            ->get();
        \Log::info('Partial Matches:', ['count' => $partialMatches->count()]);

        // Step 3: Combine results with exact matches first
        return $exactMatches->concat($partialMatches);
    }

 
}