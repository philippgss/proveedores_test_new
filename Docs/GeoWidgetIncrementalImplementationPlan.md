Incremental Implementation Plan
Phase 1: Standard Company List

Implement /proveedores/ and /proveedores?page=n.

Add the category widget (top-level categories) and geo widget (all provinces).

Validate the trailing slash behavior and pagination.

Phase 2: Category Pages

Implement /categoryslug/ and /categoryslug?page=n.

Update the category widget to show child categories of the selected category.

Keep the geo widget displaying all provinces.

Validate the trailing slash behavior and pagination.

Phase 3: Province Pages

Implement /provinceslug and /provinceslug?page=n.

Update the geo widget to show cities within the selected province.

Keep the category widget displaying top-level categories.

Validate the URL structure and pagination.

Phase 4: City Pages

Implement /cityslug and /cityslug?page=n.

Update the geo widget to remain empty.

Keep the category widget displaying top-level categories.

Validate the URL structure and pagination.

Phase 5: Category + Province Pages

Implement /categoryslug/provinceslug and /categoryslug/provinceslug?page=n.

Update the category widget to show child categories of the selected category.

Update the geo widget to show cities within the selected province.

Validate the URL structure and pagination.

Phase 6: Category + City Pages

Implement /categoryslug/cityslug and /categoryslug/cityslug?page=n.

Update the category widget to show child categories of the selected category.

Update the geo widget to remain empty.

Validate the URL structure and pagination.

Phase 7: Search Results

Implement /search?query=searchterm&category=categoryid&province=provinceid&city=cityid&page=n.

Update the category and geo widgets based on the selected filters.

Validate the URL structure, filtering, and pagination.