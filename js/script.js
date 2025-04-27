/**
 * Front Office System - Main JavaScript
 * 
 * This file contains the main JavaScript functionality for the Front Office System
 */

document.addEventListener('DOMContentLoaded', function () {
    // Sidebar Menu Functionality
    const menuCategories = document.querySelectorAll('.menu-category');

    menuCategories.forEach(category => {
        category.addEventListener('click', function () {
            // Toggle the expanded class on the category
            this.classList.toggle('expanded');

            // Find the submenu that follows this category
            const submenu = this.nextElementSibling;

            // Toggle the expanded class on the submenu
            if (submenu && submenu.classList.contains('submenu')) {
                submenu.classList.toggle('expanded');
            }
        });
    });

    // Mobile sidebar toggle
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            // Toggle the sidebar-collapsed class on the body instead of active on the sidebar
            document.body.classList.toggle('sidebar-collapsed');
        });

        // Close sidebar when clicking outside (modified to work with sidebar-collapsed)
        document.addEventListener('click', function (e) {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.querySelector('.sidebar-toggle');

            if (!document.body.classList.contains('sidebar-collapsed') &&
                sidebar &&
                !sidebar.contains(e.target) &&
                e.target !== sidebarToggle &&
                !sidebarToggle.contains(e.target)) {
                document.body.classList.add('sidebar-collapsed');
            }
        });
    }

    // Auto-fade success messages after 5 seconds
    const successMessages = document.querySelectorAll('.success-message');
    if (successMessages.length > 0) {
        setTimeout(function () {
            successMessages.forEach(message => {
                message.classList.add('fade-out');

                // Remove the message from DOM after fade animation completes
                setTimeout(function () {
                    if (message.parentNode) {
                        message.parentNode.removeChild(message);
                    }
                }, 500);
            });
        }, 5000);
    }
});