<!DOCTYPE html>
<html>
<head>
    <title>Member Activity</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="member-activity-chart"></canvas>

    <script>
        const chartData = {!! json_encode($chartData) !!};

        const datasets = chartData.map(data => ({
            label: data.label,
            data: data.data,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
        }));

        const ctx = document.getElementById('member-activity-chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: datasets,
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'User ID',
                        },
                        stacked: true,
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Duration (Days)',
                        },
                        stacked: true,
                    },
                },
            },
        });
    </script>
</body>
</html>
