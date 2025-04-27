/**
 * Main JavaScript File
 * 
 * Common functionality for the front office application
 */

document.addEventListener('DOMContentLoaded', function () {
    // Sidebar toggle functionality for mobile
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function (e) {
        if (window.innerWidth <= 768 &&
            sidebar &&
            sidebar.classList.contains('active') &&
            !sidebar.contains(e.target) &&
            e.target !== sidebarToggle) {
            sidebar.classList.remove('active');
        }
    });

    // Alert auto-dismissal
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });

    // Initialize any date pickers
    const datePickers = document.querySelectorAll('.date-picker');
    if (datePickers.length > 0) {
        datePickers.forEach(function (datePicker) {
            // For a real implementation, you might use a library like flatpickr
            datePicker.type = 'date';
        });
    }

    // Form validation 
    const forms = document.querySelectorAll('form[data-validate="true"]');
    forms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(function (field) {
                if (!field.value.trim()) {
                    isValid = false;

                    // Add error class
                    field.classList.add('is-invalid');

                    // Find or create error message
                    let errorMessage = field.nextElementSibling;
                    if (!errorMessage || !errorMessage.classList.contains('invalid-feedback')) {
                        errorMessage = document.createElement('div');
                        errorMessage.className = 'invalid-feedback';
                        field.parentNode.insertBefore(errorMessage, field.nextSibling);
                    }

                    errorMessage.textContent = 'Bidang ini wajib diisi';
                } else {
                    field.classList.remove('is-invalid');
                    const nextEl = field.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('invalid-feedback')) {
                        nextEl.textContent = '';
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Clear validation styles on input
        form.querySelectorAll('input, select, textarea').forEach(function (input) {
            input.addEventListener('input', function () {
                this.classList.remove('is-invalid');
                const nextEl = this.nextElementSibling;
                if (nextEl && nextEl.classList.contains('invalid-feedback')) {
                    nextEl.textContent = '';
                }
            });
        });
    });

    // Handle modal functionality
    const modalTriggers = document.querySelectorAll('[data-toggle="modal"]');

    modalTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            const modalId = this.getAttribute('data-target');
            const modal = document.querySelector(modalId);

            if (modal) {
                modal.style.display = 'block';

                // Close button
                const closeButtons = modal.querySelectorAll('.close, .modal-close, [data-dismiss="modal"]');
                closeButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        modal.style.display = 'none';
                    });
                });

                // Close when clicking outside the modal
                window.addEventListener('click', function (e) {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            }
        });
    });
});