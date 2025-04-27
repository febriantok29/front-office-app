/**
 * Front Office System - Form Validation
 * 
 * Client-side validation script for the visitor registration form
 */

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get the visitor form element
    const visitorForm = document.getElementById('visitorForm');

    // Skip if form doesn't exist on the current page
    if (!visitorForm) return;

    // Add submit event listener to the form
    visitorForm.addEventListener('submit', function (event) {
        // Reset previous validation errors
        clearValidationErrors();

        // Flag to track validation status
        let isValid = true;

        // Validate required fields
        isValid = validateRequiredField('full_name', 'Please enter your full name') && isValid;
        isValid = validateRequiredField('id_card_number', 'Please enter your ID card number') && isValid;
        isValid = validateRequiredField('phone_number', 'Please enter your phone number') && isValid;
        isValid = validateRequiredField('employee_id', 'Please select an employee to visit') && isValid;
        isValid = validateRequiredField('visit_purpose', 'Please enter your purpose of visit') && isValid;

        // Validate phone number format (basic validation)
        const phoneInput = document.getElementById('phone_number');
        if (phoneInput.value && !isValidPhoneNumber(phoneInput.value)) {
            displayError(phoneInput, 'Please enter a valid phone number');
            isValid = false;
        }

        // Validate email format if provided
        const emailInput = document.getElementById('email');
        if (emailInput.value && !isValidEmail(emailInput.value)) {
            displayError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }

        // If validation fails, prevent form submission
        if (!isValid) {
            event.preventDefault();

            // Scroll to the first error
            const firstError = document.querySelector('.field-error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    /**
     * Validate a required field
     * 
     * @param {string} fieldId - The ID of the field to validate
     * @param {string} errorMessage - The error message to display if validation fails
     * @return {boolean} - Whether the field is valid
     */
    function validateRequiredField(fieldId, errorMessage) {
        const field = document.getElementById(fieldId);
        if (!field) return true; // Skip if field doesn't exist

        if (!field.value.trim()) {
            displayError(field, errorMessage);
            return false;
        }

        return true;
    }

    /**
     * Display an error message for a field
     * 
     * @param {HTMLElement} field - The field with the error
     * @param {string} message - The error message to display
     */
    function displayError(field, message) {
        // Add error class to the field
        field.classList.add('field-error');

        // Create error message element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-text';
        errorDiv.innerText = message;

        // Insert error message after the field
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
    }

    /**
     * Clear all validation errors
     */
    function clearValidationErrors() {
        // Remove error classes from fields
        const errorFields = document.querySelectorAll('.field-error');
        errorFields.forEach(field => {
            field.classList.remove('field-error');
        });

        // Remove error messages
        const errorMessages = document.querySelectorAll('.error-text');
        errorMessages.forEach(errorMsg => {
            errorMsg.parentNode.removeChild(errorMsg);
        });
    }

    /**
     * Validate email format
     * 
     * @param {string} email - The email to validate
     * @return {boolean} - Whether the email format is valid
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /**
     * Validate phone number format (basic validation)
     * 
     * @param {string} phone - The phone number to validate
     * @return {boolean} - Whether the phone number format is valid
     */
    function isValidPhoneNumber(phone) {
        // Basic validation: at least 8 digits
        const phoneRegex = /^[+]?[\s./0-9-()]{8,}$/;
        return phoneRegex.test(phone);
    }

    // Add input event listeners for real-time validation
    document.querySelectorAll('#visitorForm input, #visitorForm select, #visitorForm textarea').forEach(element => {
        element.addEventListener('input', function () {
            // Remove error styling when user starts typing
            this.classList.remove('field-error');

            // Remove error message if it exists
            const nextSibling = this.nextSibling;
            if (nextSibling && nextSibling.className === 'error-text') {
                nextSibling.parentNode.removeChild(nextSibling);
            }
        });
    });
});