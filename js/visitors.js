/**
 * Front Office System - Visitors Records JavaScript
 * 
 * Handles search and filtering for the visitor records page
 */

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get references to elements
    const searchInput = document.getElementById('visitorSearch');
    const visitorTable = document.getElementById('visitorTable');
    const filterForm = document.getElementById('filterForm');
    const searchTermField = document.getElementById('searchTermField');

    // Skip if elements don't exist on the current page
    if (!searchInput || !visitorTable) return;

    // Add event listener for search input
    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();

        // For client-side filtering without refreshing
        filterVisitorTable(searchTerm);

        // Update the hidden field for server-side filtering
        if (searchTermField) {
            searchTermField.value = searchTerm;
        }
    });

    // Add event listener for search input to trigger search on enter key
    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && filterForm) {
            e.preventDefault();
            filterForm.submit();
        }
    });

    // Initialize search input from URL parameter if present
    const urlParams = new URLSearchParams(window.location.search);
    const searchTermParam = urlParams.get('searchTerm');
    if (searchTermParam && searchInput) {
        searchInput.value = searchTermParam;
    }

    /**
     * Filter the visitor table based on search term (client-side filtering)
     * 
     * @param {string} searchTerm - The term to search for
     */
    function filterVisitorTable(searchTerm) {
        // Get all rows except the header
        const rows = visitorTable.querySelectorAll('tbody tr');

        // Loop through each row
        rows.forEach(function (row) {
            let matchFound = false;

            // Get all cells in the row
            const cells = row.querySelectorAll('td');

            // Check each cell for a match
            cells.forEach(function (cell) {
                const text = cell.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    matchFound = true;
                }
            });

            // Show or hide the row based on match
            if (matchFound) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Check if any results are visible
        const visibleRows = visitorTable.querySelectorAll('tbody tr:not([style*="display: none"])');

        // Show or hide the no results message
        let noResultsMsg = document.querySelector('.no-results-message');

        if (visibleRows.length === 0 && searchTerm !== '') {
            // Create the message if it doesn't exist
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('p');
                noResultsMsg.className = 'info-message no-results-message';
                noResultsMsg.textContent = 'No visitors found matching your search.';

                // Insert after the table
                visitorTable.parentNode.insertBefore(noResultsMsg, visitorTable.nextSibling);
            } else {
                noResultsMsg.style.display = 'block';
            }
        } else if (noResultsMsg) {
            // Hide the message if it exists
            noResultsMsg.style.display = 'none';
        }
    }
});