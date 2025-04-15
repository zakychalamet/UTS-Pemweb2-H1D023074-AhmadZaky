<!DOCTYPE html>
<html>
<head>
    <title>Alumni Statistics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Statistik Alumni</h1>
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Alumni Dihitung dari Tahun Lulus</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Chart -->
                    <div class="col-md-8">
                        <canvas id="alumniChart"></canvas>
                    </div>
                    
                    <!-- Tabel Statistik -->
                    <div class="col-md-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <th>Jumlah Alumni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($stats as $record): ?>
                                    <tr>
                                        <td><?php echo $record->tahun_lulus; ?></td>
                                        <td><?php echo $record->count; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-dark">
                                    <th>Total</th>
                                    <th><?php echo array_sum(array_column($stats, 'count')); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="<?php echo site_url('alumni'); ?>" class="btn btn-secondary">Kembali</a>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('alumniChart').getContext('2d');
            
            const years = <?php echo json_encode(array_column($stats, 'tahun_lulus')); ?>;
            const counts = <?php echo json_encode(array_column($stats, 'count')); ?>;
            
            // Buat chart
            const alumniChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Jumlah Alumni',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribusi Alumni berdasarkan Tahun Lulus',
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            });
        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>