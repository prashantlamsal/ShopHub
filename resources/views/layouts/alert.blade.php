@if(session('success'))
    <div id="alert-success" class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-green-700 max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="closeAlert('alert-success')" class="text-green-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            closeAlert('alert-success');
        }, 5000);
    </script>
@endif

@if(session('error'))
    <div id="alert-error" class="fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-red-700 max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="closeAlert('alert-error')" class="text-red-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            closeAlert('alert-error');
        }, 5000);
    </script>
@endif

@if(session('warning'))
    <div id="alert-warning" class="fixed top-4 right-4 z-50 bg-yellow-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-yellow-700 max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('warning') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="closeAlert('alert-warning')" class="text-yellow-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            closeAlert('alert-warning');
        }, 5000);
    </script>
@endif

@if(session('info'))
    <div id="alert-info" class="fixed top-4 right-4 z-50 bg-blue-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-blue-700 max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('info') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="closeAlert('alert-info')" class="text-blue-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            closeAlert('alert-info');
        }, 5000);
    </script>
@endif

@if($errors->any())
    <div id="alert-errors" class="fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg border-l-4 border-red-700 max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">Please fix the following errors:</p>
                <ul class="text-xs mt-1 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="closeAlert('alert-errors')" class="text-red-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            closeAlert('alert-errors');
        }, 8000);
    </script>
@endif

<script>
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

// Auto-close alerts when clicking outside
document.addEventListener('click', function(event) {
    const alerts = document.querySelectorAll('[id^="alert-"]');
    alerts.forEach(alert => {
        if (!alert.contains(event.target)) {
            // Don't auto-close when clicking outside, let user manually close
        }
    });
});
</script>
