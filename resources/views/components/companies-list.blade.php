                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        @foreach($companies as $company)
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <a href="/proveedores/{{ $company->slug }}/" class="text-lg font-semibold mb-2 hover:text-blue-600 dark:hover:text-blue-400">
                                        {{ $company->com_name }}
                                    </a>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                                        {{ Str::limit($company->com_description, 100) }}
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <a href="/proveedores/{{ $company->slug }}/" 
                                       class="inline-flex items-center px-6 py-3 bg-blue-700 hover:bg-blue-800 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-wider shadow-lg transform hover:-translate-y-0.5 transition-all duration-150">
                                        Contactar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
        