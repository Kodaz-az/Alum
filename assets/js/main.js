/**
 * Alumpro.Az Management System - Main JavaScript
 * Modern ES6+ JavaScript with utility functions
 */

class AlumproApp {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
        this.initComponents();
        this.checkAuth();
    }

    bindEvents() {
        document.addEventListener('DOMContentLoaded', () => {
            this.showFlashMessages();
            this.initTooltips();
            this.initModals();
            this.initForms();
        });

        // Handle logout
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-action="logout"]')) {
                e.preventDefault();
                this.logout();
            }
        });

        // Handle form submissions
        document.addEventListener('submit', (e) => {
            if (e.target.matches('form[data-ajax="true"]')) {
                e.preventDefault();
                this.submitAjaxForm(e.target);
            }
        });

        // Handle CSRF token refresh
        setInterval(() => {
            this.refreshCSRFToken();
        }, 30 * 60 * 1000); // 30 minutes
    }

    initComponents() {
        // Initialize any third-party components
        this.initDataTables();
        this.initCharts();
        this.initDatePickers();
    }

    checkAuth() {
        // Check if user session is still valid
        const lastActivity = localStorage.getItem('lastActivity');
        const sessionTimeout = 2 * 60 * 60 * 1000; // 2 hours in milliseconds

        if (lastActivity && (Date.now() - parseInt(lastActivity)) > sessionTimeout) {
            this.logout();
        } else {
            localStorage.setItem('lastActivity', Date.now().toString());
        }
    }

    // Flash Messages
    showFlashMessages() {
        const flashContainer = document.querySelector('.flash-messages');
        if (flashContainer) {
            const messages = flashContainer.querySelectorAll('.alert');
            messages.forEach((message, index) => {
                setTimeout(() => {
                    message.classList.add('fade-in');
                    setTimeout(() => {
                        message.classList.add('fade-out');
                        setTimeout(() => message.remove(), 300);
                    }, 5000);
                }, index * 100);
            });
        }
    }

    // API Requests
    async apiRequest(url, options = {}) {
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-Token': this.getCSRFToken()
            }
        };

        const config = {
            ...defaultOptions,
            ...options,
            headers: {
                ...defaultOptions.headers,
                ...options.headers
            }
        };

        try {
            const response = await fetch(url, config);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return await response.json();
            } else {
                return await response.text();
            }
        } catch (error) {
            console.error('API request failed:', error);
            this.showNotification('Request failed. Please try again.', 'error');
            throw error;
        }
    }

    // CSRF Token Management
    getCSRFToken() {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        return tokenMeta ? tokenMeta.getAttribute('content') : '';
    }

    async refreshCSRFToken() {
        try {
            const response = await this.apiRequest('/api/auth/csrf-token');
            if (response.token) {
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (tokenMeta) {
                    tokenMeta.setAttribute('content', response.token);
                }
            }
        } catch (error) {
            console.error('Failed to refresh CSRF token:', error);
        }
    }

    // Form Handling
    initForms() {
        const forms = document.querySelectorAll('form[data-validate="true"]');
        forms.forEach(form => {
            this.initFormValidation(form);
        });
    }

    initFormValidation(form) {
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateInput(input);
            });

            input.addEventListener('input', () => {
                if (input.classList.contains('is-invalid')) {
                    this.validateInput(input);
                }
            });
        });

        form.addEventListener('submit', (e) => {
            let isValid = true;
            inputs.forEach(input => {
                if (!this.validateInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    validateInput(input) {
        const value = input.value.trim();
        const type = input.type;
        const required = input.hasAttribute('required');
        let isValid = true;
        let message = '';

        // Remove existing validation classes
        input.classList.remove('is-valid', 'is-invalid');

        // Required validation
        if (required && !value) {
            isValid = false;
            message = 'This field is required.';
        }

        // Email validation
        if (type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid email address.';
            }
        }

        // Phone validation (Azerbaijan format)
        if (input.hasAttribute('data-validate-phone') && value) {
            const phoneRegex = /^(\+994|994|0)?(50|51|55|70|77|99)[0-9]{7}$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid phone number.';
            }
        }

        // Password validation
        if (type === 'password' && value) {
            if (value.length < 8) {
                isValid = false;
                message = 'Password must be at least 8 characters long.';
            }
        }

        // Confirm password validation
        if (input.hasAttribute('data-confirm-password')) {
            const passwordInput = document.querySelector(input.getAttribute('data-confirm-password'));
            if (passwordInput && value !== passwordInput.value) {
                isValid = false;
                message = 'Passwords do not match.';
            }
        }

        // Update UI
        input.classList.add(isValid ? 'is-valid' : 'is-invalid');
        
        const feedback = input.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.textContent = message;
            feedback.style.display = isValid ? 'none' : 'block';
        }

        return isValid;
    }

    async submitAjaxForm(form) {
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading"></span> Processing...';

        try {
            const response = await this.apiRequest(form.action, {
                method: form.method || 'POST',
                body: formData
            });

            if (response.success) {
                this.showNotification(response.message || 'Operation completed successfully.', 'success');
                
                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                } else if (response.reload) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    form.reset();
                }
            } else {
                this.showNotification(response.message || 'Operation failed.', 'error');
                
                if (response.errors) {
                    this.displayFormErrors(form, response.errors);
                }
            }
        } catch (error) {
            this.showNotification('Request failed. Please try again.', 'error');
        } finally {
            // Restore button state
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    }

    displayFormErrors(form, errors) {
        Object.keys(errors).forEach(field => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                
                const feedback = input.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = errors[field];
                    feedback.style.display = 'block';
                }
            }
        });
    }

    // Notifications
    showNotification(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade-in`;
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-dismiss="alert"></button>
        `;

        // Add to page
        let container = document.querySelector('.notification-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'notification-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
            `;
            document.body.appendChild(container);
        }

        container.appendChild(notification);

        // Auto remove
        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => notification.remove(), 300);
        }, duration);

        // Handle manual close
        notification.querySelector('.btn-close').addEventListener('click', () => {
            notification.classList.add('fade-out');
            setTimeout(() => notification.remove(), 300);
        });
    }

    // Authentication
    async logout() {
        if (confirm('Are you sure you want to logout?')) {
            try {
                await this.apiRequest('/api/auth/logout', { method: 'POST' });
                localStorage.removeItem('lastActivity');
                window.location.href = '/auth/login';
            } catch (error) {
                this.showNotification('Logout failed. Please try again.', 'error');
            }
        }
    }

    // Component Initializers
    initTooltips() {
        // Initialize tooltips if bootstrap is available
        if (typeof bootstrap !== 'undefined') {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }

    initModals() {
        // Handle modal events
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-modal-target]')) {
                e.preventDefault();
                const modalId = e.target.getAttribute('data-modal-target');
                const modal = document.querySelector(modalId);
                if (modal && typeof bootstrap !== 'undefined') {
                    const modalInstance = new bootstrap.Modal(modal);
                    modalInstance.show();
                }
            }
        });
    }

    initDataTables() {
        // Initialize DataTables if available
        const tables = document.querySelectorAll('[data-table="true"]');
        if (tables.length && typeof DataTable !== 'undefined') {
            tables.forEach(table => {
                new DataTable(table, {
                    responsive: true,
                    pageLength: 25,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/az.json'
                    }
                });
            });
        }
    }

    initCharts() {
        // Initialize charts if Chart.js is available
        const chartElements = document.querySelectorAll('[data-chart]');
        if (chartElements.length && typeof Chart !== 'undefined') {
            chartElements.forEach(element => {
                const chartType = element.getAttribute('data-chart');
                const chartData = JSON.parse(element.getAttribute('data-chart-data') || '{}');
                
                new Chart(element, {
                    type: chartType,
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
        }
    }

    initDatePickers() {
        // Initialize date pickers if available
        const dateInputs = document.querySelectorAll('input[type="date"], input[data-datepicker]');
        if (dateInputs.length) {
            dateInputs.forEach(input => {
                // Add date validation
                input.addEventListener('change', () => {
                    this.validateInput(input);
                });
            });
        }
    }

    // Utility Functions
    formatCurrency(amount, currency = 'AZN') {
        return new Intl.NumberFormat('az-AZ', {
            style: 'currency',
            currency: currency,
            minimumFractionDigits: 2
        }).format(amount);
    }

    formatDate(date, options = {}) {
        const defaultOptions = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        };

        return new Intl.DateTimeFormat('az-AZ', {
            ...defaultOptions,
            ...options
        }).format(new Date(date));
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
}

// Initialize the application
const alumproApp = new AlumproApp();

// Export for use in other modules
window.AlumproApp = AlumproApp;
window.app = alumproApp;