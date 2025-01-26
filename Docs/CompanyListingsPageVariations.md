Company Listings Page Variations


1. Standard Company List
URL Structure: /proveedores/

Example: https://domain.com/proveedores/

Pagination: /proveedores?page=n

Example: https://domain.com/proveedores?page=2

Category Widget: Top-level categories.

Geo Widget: All provinces.

Description: Displays all companies when no category, geo, or search term is selected.

2. Category Pages
URL Structure: /categoryslug/

Example: https://domain.com/technology/

Pagination: /categoryslug?page=n

Example: https://domain.com/technology?page=2

Category Widget: Child categories of the selected category.

Geo Widget: All provinces.

Description: Displays companies filtered by the selected category.

3. Province Pages
URL Structure: /provinceslug

Example: https://domain.com/barcelona

Pagination: /provinceslug?page=n

Example: https://domain.com/barcelona?page=2

Category Widget: Top-level categories.

Geo Widget: Cities within the selected province.

Description: Displays companies filtered by the selected province.

4. City Pages
URL Structure: /cityslug

Example: https://domain.com/barcelona-ciudad

Pagination: /cityslug?page=n

Example: https://domain.com/barcelona-ciudad?page=2

Category Widget: Top-level categories.

Geo Widget: Empty (no further geo breakdown).

Description: Displays companies filtered by the selected city.

5. Category + Province Pages
URL Structure: /categoryslug/provinceslug

Example: https://domain.com/technology/barcelona

Pagination: /categoryslug/provinceslug?page=n

Example: https://domain.com/technology/barcelona?page=2

Category Widget: Child categories of the selected category.

Geo Widget: Cities within the selected province.

Description: Displays companies filtered by both the category and province.

6. Category + City Pages
URL Structure: /categoryslug/cityslug

Example: https://domain.com/technology/barcelona-ciudad

Pagination: /categoryslug/cityslug?page=n

Example: https://domain.com/technology/barcelona-ciudad?page=2

Category Widget: Child categories of the selected category.

Geo Widget: Empty (no further geo breakdown).

Description: Displays companies filtered by both the category and city.

7. Search Results
URL Structure: /search?query=searchterm&category=categoryid&province=provinceid&city=cityid&page=n

Examples:

Search term only: https://domain.com/search?query=web

Search term + category: https://domain.com/search?query=web&category=1

Search term + province: https://domain.com/search?query=web&province=2

Search term + city: https://domain.com/search?query=web&city=3

Search term + category + province: https://domain.com/search?query=web&category=1&province=2

Search term + category + city: https://domain.com/search?query=web&category=1&city=3

Pagination: https://domain.com/search?query=web&category=1&province=2&page=2

Category Widget:

If a category is selected: Child categories of the selected category.

If no category is selected: Top-level categories.

Geo Widget:

If a province is selected: Cities within the selected province.

If a city is selected: Empty (no further geo breakdown).

If no geo filter is selected: All provinces.

Description: Displays search results with optional filters for category, province, city, and pagination.

Summary of Slug and ID Usage
Category Slug: Used in URLs like /technology/ (trailing slash only when not paginated).

Category ID: Used in search result URLs like ?category=1.

Province Slug: Used in URLs like /barcelona.

Province ID: Used in search result URLs like ?province=2.

City Slug: Used in URLs like /barcelona-ciudad.

City ID: Used in search result URLs like ?city=3.

Key Points
Trailing Slashes:

Only /proveedores/ and /categoryslug/ (when not paginated) have trailing slashes.

All other URLs (including paginated ones) do not have trailing slashes.

Geo Widget Behavior:

Displays cities within the selected province on province pages.

Remains empty on city pages.

Displays all provinces by default when no geo slug is selected.

Category Widget Behavior:

Displays top-level categories by default.

Displays child categories of the selected category when a category is selected.