@extends('admin.frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('admin.frontend.component.home')

@endsection

@section('script')
<script>
$(function() {
    // ═══════════════════════════════════════════════════════════
    //  INITIAL DATA FROM PHP (passed to JS for charts)
    // ═══════════════════════════════════════════════════════════
    var monthlyLabels = @json($monthlyLabels);
    var monthlyUsers = @json($monthlyUsers);
    var monthlyBookings = @json($monthlyBookings);
    var monthlyRides = @json($monthlyRides);
    var bookingsByStatus = @json($bookingsByStatus);
    var ridesByStatus = @json($ridesByStatus);
    var rideBookingsByStatus = @json($rideBookingsByStatus);

    // ═══════════════════════════════════════════════════════════
    //  CHART INSTANCES
    // ═══════════════════════════════════════════════════════════
    var monthlyTrendsChart, bookingStatusChart, rideStatusChart, rideBookingStatusChart;

    function initMonthlyTrendsChart() {
        var ctx = document.getElementById('monthlyTrendsChart');
        if (!ctx) return;
        if (monthlyTrendsChart) monthlyTrendsChart.destroy();

        monthlyTrendsChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [
                    {
                        label: 'Users',
                        data: monthlyUsers,
                        borderColor: '#17a2b8',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Bookings',
                        data: monthlyBookings,
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Rides',
                        data: monthlyRides,
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true, precision: 0 }
                    }]
                },
                legend: { position: 'top' },
                tooltips: { mode: 'index', intersect: false }
            }
        });
    }

    function initBookingStatusChart() {
        var ctx = document.getElementById('bookingStatusChart');
        if (!ctx) return;
        if (bookingStatusChart) bookingStatusChart.destroy();

        var labels = Object.keys(bookingsByStatus).map(function(s) { return s.charAt(0).toUpperCase() + s.slice(1); });
        var data = Object.values(bookingsByStatus);
        var colors = ['#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d', '#6610f2'];

        bookingStatusChart = new Chart(ctx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels.length ? labels : ['No Data'],
                datasets: [{
                    data: data.length ? data : [1],
                    backgroundColor: data.length ? colors.slice(0, data.length) : ['#e9ecef'],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: 'bottom' },
                cutoutPercentage: 60,
            }
        });
    }

    function initRideStatusChart() {
        var ctx = document.getElementById('rideStatusChart');
        if (!ctx) return;
        if (rideStatusChart) rideStatusChart.destroy();

        var labels = Object.keys(ridesByStatus).map(function(s) { return s.charAt(0).toUpperCase() + s.slice(1); });
        var data = Object.values(ridesByStatus);
        var colors = ['#28a745', '#17a2b8', '#dc3545', '#ffc107', '#6c757d'];

        rideStatusChart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels.length ? labels : ['No Data'],
                datasets: [{
                    label: 'Rides',
                    data: data.length ? data : [0],
                    backgroundColor: data.length ? colors.slice(0, data.length) : ['#e9ecef'],
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true, precision: 0 }
                    }]
                },
                legend: { display: false }
            }
        });
    }

    function initRideBookingStatusChart() {
        var ctx = document.getElementById('rideBookingStatusChart');
        if (!ctx) return;
        if (rideBookingStatusChart) rideBookingStatusChart.destroy();

        var labels = Object.keys(rideBookingsByStatus).map(function(s) { return s.charAt(0).toUpperCase() + s.slice(1); });
        var data = Object.values(rideBookingsByStatus);
        var colors = ['#007bff', '#28a745', '#dc3545', '#ffc107', '#6610f2'];

        rideBookingStatusChart = new Chart(ctx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels.length ? labels : ['No Data'],
                datasets: [{
                    data: data.length ? data : [1],
                    backgroundColor: data.length ? colors.slice(0, data.length) : ['#e9ecef'],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: 'bottom' }
            }
        });
    }

    // Initialize all charts
    initMonthlyTrendsChart();
    initBookingStatusChart();
    initRideStatusChart();
    initRideBookingStatusChart();

    // ═══════════════════════════════════════════════════════════
    //  REAL-TIME AJAX POLLING (every 10 seconds)
    // ═══════════════════════════════════════════════════════════
    function animateCounter(el, newVal) {
        var $el = $(el);
        var oldVal = parseInt($el.text().replace(/[^0-9]/g, '')) || 0;
        if (oldVal !== newVal) {
            $el.addClass('stat-flash');
            $el.text(newVal);
            setTimeout(function() { $el.removeClass('stat-flash'); }, 600);
        }
    }

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function refreshDashboard() {
        $.ajax({
            url: '{{ route("admin.dashboard.stats") }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // ── Update stat boxes ──
                animateCounter('#stat-total-users', data.totalUsers);
                animateCounter('#stat-total-cars', data.totalCars);
                animateCounter('#stat-total-rides', data.totalRides);
                animateCounter('#stat-total-bookings', data.totalBookings);
                animateCounter('#stat-total-ride-bookings', data.totalRideBookings);
                animateCounter('#stat-total-messages', data.totalContactMessages);
                animateCounter('#stat-total-blog-posts', data.totalBlogPosts);

                $('#stat-total-revenue').text(formatNumber(Math.round(data.totalRevenue)));
                $('#stat-revenue-this-month').text(formatNumber(Math.round(data.revenueThisMonth)));

                // ── Update growth indicators ──
                animateCounter('#stat-users-this-month', data.usersThisMonth);
                animateCounter('#stat-bookings-this-month', data.bookingsThisMonth);
                animateCounter('#stat-rides-this-month', data.ridesThisMonth);

                function changeHtml(val) {
                    if (val >= 0) {
                        return '<i class="fas fa-arrow-up text-success"></i> ' + val + '% vs last month';
                    } else {
                        return '<i class="fas fa-arrow-down text-danger"></i> ' + Math.abs(val) + '% vs last month';
                    }
                }
                $('#stat-user-change').html(changeHtml(data.userChange));
                $('#stat-booking-change').html(changeHtml(data.bookingChange));
                $('#stat-ride-change').html(changeHtml(data.rideChange));

                // ── Update charts ──
                monthlyLabels = data.monthlyLabels;
                monthlyUsers = data.monthlyUsers;
                monthlyBookings = data.monthlyBookings;
                monthlyRides = data.monthlyRides;
                bookingsByStatus = data.bookingsByStatus;
                ridesByStatus = data.ridesByStatus;
                rideBookingsByStatus = data.rideBookingsByStatus;

                initMonthlyTrendsChart();
                initBookingStatusChart();
                initRideStatusChart();
                initRideBookingStatusChart();

                // ── Update recent tables ──
                updateRecentUsers(data.recentUsers);
                updateRecentBookings(data.recentBookings);
                updateRecentRides(data.recentRides);
                updateRecentMessages(data.recentMessages);
                updateTopCars(data.topCars);

                // ── Update timestamp ──
                $('#last-updated-time').text(data.lastUpdated);
            },
            error: function() {
                console.warn('Dashboard refresh failed, retrying...');
            }
        });
    }

    // ── Table Update Helpers ──
    function updateRecentUsers(users) {
        var $tbody = $('#recent-users-table tbody');
        if (!users || users.length === 0) {
            $tbody.html('<tr><td colspan="4" class="text-center text-muted">No users yet</td></tr>');
            return;
        }
        var rows = '';
        users.forEach(function(u) {
            var statusBadge = (u.status === 'active' || u.status === null)
                ? '<span class="badge badge-success">Active</span>'
                : '<span class="badge badge-danger">' + (u.status ? u.status.charAt(0).toUpperCase() + u.status.slice(1) : 'Unknown') + '</span>';
            rows += '<tr>' +
                '<td>' + u.name + '</td>' +
                '<td><small>' + u.email + '</small></td>' +
                '<td>' + statusBadge + '</td>' +
                '<td><small>' + timeAgo(u.created_at) + '</small></td>' +
                '</tr>';
        });
        $tbody.html(rows);
    }

    function updateRecentBookings(bookings) {
        var $tbody = $('#recent-bookings-table tbody');
        if (!bookings || bookings.length === 0) {
            $tbody.html('<tr><td colspan="5" class="text-center text-muted">No bookings yet</td></tr>');
            return;
        }
        var statusColors = { confirmed: 'success', pending: 'warning', cancelled: 'danger', completed: 'info' };
        var rows = '';
        bookings.forEach(function(b) {
            var color = statusColors[b.status] || 'secondary';
            rows += '<tr>' +
                '<td>' + (b.user ? b.user.name : 'N/A') + '</td>' +
                '<td>' + (b.car ? b.car.car_name : 'N/A') + '</td>' +
                '<td>₹' + formatNumber(Math.round(b.total_amount || 0)) + '</td>' +
                '<td><span class="badge badge-' + color + '">' + ucfirst(b.status || 'unknown') + '</span></td>' +
                '<td><small>' + timeAgo(b.created_at) + '</small></td>' +
                '</tr>';
        });
        $tbody.html(rows);
    }

    function updateRecentRides(rides) {
        var $tbody = $('#recent-rides-table tbody');
        if (!rides || rides.length === 0) {
            $tbody.html('<tr><td colspan="5" class="text-center text-muted">No rides yet</td></tr>');
            return;
        }
        var rideColors = { active: 'success', completed: 'info', cancelled: 'danger' };
        var rows = '';
        rides.forEach(function(r) {
            var color = rideColors[r.status] || 'secondary';
            var from = (r.pickup_location || '').substring(0, 12);
            var to = (r.destination || '').substring(0, 12);
            var date = r.travel_date ? new Date(r.travel_date).toLocaleDateString('en-IN', { day: '2-digit', month: 'short' }) : '';
            rows += '<tr>' +
                '<td>' + (r.user ? r.user.name : 'N/A') + '</td>' +
                '<td><small>' + from + ' → ' + to + '</small></td>' +
                '<td><small>' + date + '</small></td>' +
                '<td>₹' + (r.fare || 0) + '</td>' +
                '<td><span class="badge badge-' + color + '">' + ucfirst(r.status || 'unknown') + '</span></td>' +
                '</tr>';
        });
        $tbody.html(rows);
    }

    function updateRecentMessages(messages) {
        var $tbody = $('#recent-messages-table tbody');
        if (!messages || messages.length === 0) {
            $tbody.html('<tr><td colspan="3" class="text-center text-muted">No messages yet</td></tr>');
            return;
        }
        var rows = '';
        messages.forEach(function(m) {
            var subject = (m.subject || '').substring(0, 30);
            rows += '<tr>' +
                '<td>' + m.name + '</td>' +
                '<td><small>' + subject + '</small></td>' +
                '<td><small>' + timeAgo(m.created_at) + '</small></td>' +
                '</tr>';
        });
        $tbody.html(rows);
    }

    function updateTopCars(cars) {
        var $tbody = $('#top-cars-table tbody');
        if (!cars || cars.length === 0) {
            $tbody.html('<tr><td colspan="4" class="text-center text-muted">No cars found</td></tr>');
            return;
        }
        var rows = '';
        cars.forEach(function(c, i) {
            rows += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + c.car_name + '</td>' +
                '<td>' + (c.brand || '') + '</td>' +
                '<td><span class="badge badge-primary">' + c.bookings_count + '</span></td>' +
                '</tr>';
        });
        $tbody.html(rows);
    }

    // ── Utility functions ──
    function ucfirst(str) {
        return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
    }

    function timeAgo(dateStr) {
        if (!dateStr) return '';
        var date = new Date(dateStr);
        var now = new Date();
        var seconds = Math.floor((now - date) / 1000);

        if (seconds < 60) return 'just now';
        if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
        if (seconds < 86400) return Math.floor(seconds / 3600) + 'h ago';
        if (seconds < 2592000) return Math.floor(seconds / 86400) + 'd ago';
        if (seconds < 31536000) return Math.floor(seconds / 2592000) + 'mo ago';
        return Math.floor(seconds / 31536000) + 'y ago';
    }

    // ── Start auto-refresh: every 10 seconds ──
    setInterval(refreshDashboard, 10000);

    console.log('✅ Admin Dashboard loaded with real-time updates');
});
</script>
@endsection