/**
 * Front Office System - Employees JavaScript
 * 
 * Handles search functionality for the employee management page
 */

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get references to elements
    const searchInput = document.getElementById('employeeSearch');
    const employeeTable = document.getElementById('employeeTable');

    // Skip if elements don't exist on the current page
    if (!searchInput || !employeeTable) return;

    // Add event listener for search input
    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();
        filterEmployeeTable(searchTerm);
    });

    /**
     * Filter the employee table based on search term
     * 
     * @param {string} searchTerm - The term to search for
     */
    function filterEmployeeTable(searchTerm) {
        // Get all rows except the header
        const rows = employeeTable.querySelectorAll('tbody tr');

        // Loop through each row
        rows.forEach(function (row) {
            let matchFound = false;

            // Get all cells in the row
            const cells = row.querySelectorAll('td');

            // Check each cell for a match (exclude the last cell which contains actions)
            for (let i = 0; i < cells.length - 1; i++) {
                const text = cells[i].textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    matchFound = true;
                    break;
                }
            }

            // Show or hide the row based on match
            if (matchFound) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Check if any results are visible
        const visibleRows = employeeTable.querySelectorAll('tbody tr:not([style*="display: none"])');

        // Show or hide the no results message
        let noResultsMsg = document.querySelector('.no-results-message');

        if (visibleRows.length === 0 && searchTerm !== '') {
            // Create the message if it doesn't exist
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('p');
                noResultsMsg.className = 'info-message no-results-message';
                noResultsMsg.textContent = 'No employees found matching your search.';

                // Insert after the table
                employeeTable.parentNode.insertBefore(noResultsMsg, employeeTable.nextSibling);
            } else {
                noResultsMsg.style.display = 'block';
            }
        } else if (noResultsMsg) {
            // Hide the message if it exists
            noResultsMsg.style.display = 'none';
        }
    }
});