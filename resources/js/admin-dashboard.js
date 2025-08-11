document.addEventListener('DOMContentLoaded', function() {
    // Period selector for statistics
    const periodSelector = document.getElementById('period-selector');
    if (periodSelector) {
        periodSelector.addEventListener('change', function() {
            fetchStatistics(this.value);
        });
    }

    // Fetch statistics for a specific period
    function fetchStatistics(period) {
        fetch(`/admin/dashboard/statistics?period=${period}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            updateStatistics(data);
        })
        .catch(error => console.error('Error:', error));
    }

    // Update statistics in the UI
    function updateStatistics(data) {
        document.getElementById('stats-orders').textContent = data.orders;
        document.getElementById('stats-revenue').textContent = formatCurrency(data.revenue);
        document.getElementById('stats-users').textContent = data.users;
        document.getElementById('stats-products').textContent = data.products;
    }

    // Format currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(amount);
    }

    // Draggable dashboard components
    const dashboardGrid = document.querySelector('.dashboard-grid');
    if (dashboardGrid) {
        new Sortable(dashboardGrid, {
            animation: 150,
            handle: '.dashboard-handle',
            onEnd: function() {
                saveDashboardLayout();
            }
        });
    }

    // Save dashboard layout
    function saveDashboardLayout() {
        const components = Array.from(dashboardGrid.children).map(el => el.dataset.component);
        fetch('/admin/dashboard/layout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ layout: components })
        })
        .catch(error => console.error('Error:', error));
    }

    // Toggle component visibility
    const toggleButtons = document.querySelectorAll('.toggle-component');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const componentId = this.dataset.target;
            const component = document.getElementById(componentId);
            if (component) {
                component.classList.toggle('hidden');
                saveDashboardLayout();
            }
        });
    });
});
