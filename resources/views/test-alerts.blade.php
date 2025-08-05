@extends('layouts.master')
@section('title', 'Test Alerts - ShopHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Alert System Test</h1>
            <p class="text-lg text-gray-600">Test all the different types of alerts in the system</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Success Alerts -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    Success Alerts
                </h2>
                <div class="space-y-3">
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="success">
                        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                            Show Success Alert
                        </button>
                    </form>
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="success_long">
                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Show Long Success Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Error Alerts -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    Error Alerts
                </h2>
                <div class="space-y-3">
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="error">
                        <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            Show Error Alert
                        </button>
                    </form>
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="error_long">
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                            Show Long Error Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Warning Alerts -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                    Warning Alerts
                </h2>
                <div class="space-y-3">
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="warning">
                        <button type="submit" class="w-full bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                            Show Warning Alert
                        </button>
                    </form>
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="warning_long">
                        <button type="submit" class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                            Show Long Warning Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Alerts -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Info Alerts
                </h2>
                <div class="space-y-3">
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="info">
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            Show Info Alert
                        </button>
                    </form>
                    <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                        <input type="hidden" name="test" value="info_long">
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Show Long Info Message
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Multiple Alerts -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-layer-group text-purple-500 mr-2"></i>
                Multiple Alerts
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                    <input type="hidden" name="test" value="multiple">
                    <button type="submit" class="w-full bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                        Show Multiple Alerts
                    </button>
                </form>
                <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                    <input type="hidden" name="test" value="validation_errors">
                    <button type="submit" class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                        Show Validation Errors
                    </button>
                </form>
                <form action="{{ route('test.alerts') }}" method="GET" class="inline">
                    <input type="hidden" name="test" value="clear">
                    <button type="submit" class="w-full bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Clear All Alerts
                    </button>
                </form>
            </div>
        </div>

        <!-- Alert Features -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Alert Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">✅ What's Working</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Success, Error, Warning, and Info alerts
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Auto-dismiss after 5 seconds (8 for errors)
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Manual close button
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Smooth slide-out animation
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Validation error display
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Responsive design
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">🎨 Design Features</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-palette text-blue-500 mr-2"></i>
                            Color-coded by message type
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-icons text-blue-500 mr-2"></i>
                            FontAwesome icons for each type
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-shadow text-blue-500 mr-2"></i>
                            Modern shadow and border design
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-mobile-alt text-blue-500 mr-2"></i>
                            Mobile-friendly positioning
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-z-index text-blue-500 mr-2"></i>
                            High z-index to stay on top
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            Configurable timeout duration
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>

@if(request('test'))
    <script>
        // Simulate the alert based on the test parameter
        const test = '{{ request('test') }}';
        let message = '';
        let type = 'success';

        switch(test) {
            case 'success':
                message = 'This is a success message!';
                type = 'success';
                break;
            case 'success_long':
                message = 'This is a very long success message that demonstrates how the alert system handles longer text content. It should wrap properly and remain readable.';
                type = 'success';
                break;
            case 'error':
                message = 'This is an error message!';
                type = 'error';
                break;
            case 'error_long':
                message = 'This is a very long error message that demonstrates how the alert system handles longer text content. It should wrap properly and remain readable.';
                type = 'error';
                break;
            case 'warning':
                message = 'This is a warning message!';
                type = 'warning';
                break;
            case 'warning_long':
                message = 'This is a very long warning message that demonstrates how the alert system handles longer text content. It should wrap properly and remain readable.';
                type = 'warning';
                break;
            case 'info':
                message = 'This is an info message!';
                type = 'info';
                break;
            case 'info_long':
                message = 'This is a very long info message that demonstrates how the alert system handles longer text content. It should wrap properly and remain readable.';
                type = 'info';
                break;
            case 'multiple':
                // Create multiple alerts
                setTimeout(() => {
                    showAlert('First alert message!', 'success');
                }, 100);
                setTimeout(() => {
                    showAlert('Second alert message!', 'error');
                }, 500);
                setTimeout(() => {
                    showAlert('Third alert message!', 'warning');
                }, 1000);
                setTimeout(() => {
                    showAlert('Fourth alert message!', 'info');
                }, 1500);
                return;
            case 'validation_errors':
                // Simulate validation errors
                showValidationErrors(['The name field is required.', 'The email field must be a valid email address.', 'The password field must be at least 8 characters.']);
                return;
        }

        if (message) {
            showAlert(message, type);
        }

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.id = `alert-${type}-${Date.now()}`;
            alertDiv.className = `fixed top-4 right-4 z-50 bg-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-700 max-w-sm transform transition-all duration-300 ease-in-out`;
            
            const icon = type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle';
            
            alertDiv.innerHTML = `
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-${icon} text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button onclick="closeAlert('${alertDiv.id}')" class="text-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-200 hover:text-white">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                closeAlert(alertDiv.id);
            }, 5000);
        }

        function showValidationErrors(errors) {
            const alertDiv = document.createElement('div');
            alertDiv.id = `alert-errors-${Date.now()}`;
            alertDiv.className = 'fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-red-700 max-w-sm transform transition-all duration-300 ease-in-out';
            
            alertDiv.innerHTML = `
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Please fix the following errors:</p>
                        <ul class="text-xs mt-1 space-y-1">
                            ${errors.map(error => `<li>• ${error}</li>`).join('')}
                        </ul>
                    </div>
                    <div class="ml-auto pl-3">
                        <button onclick="closeAlert('${alertDiv.id}')" class="text-red-200 hover:text-white">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                closeAlert(alertDiv.id);
            }, 8000);
        }

        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.style.transform = 'translateX(100%)';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }
    </script>
@endif
@endsection 