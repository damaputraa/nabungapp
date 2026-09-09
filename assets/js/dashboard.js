// ============================================================
// DASHBOARD JS - VERSI FINAL
// Mengambil data dari atribut data-* di canvas
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('📊 Dashboard JS loaded');
    
    // ============================================================
    // CEK CHART.JS
    // ============================================================
    if (typeof Chart === 'undefined') {
        console.error('❌ Chart.js tidak terload!');
        document.querySelector('#chartIncomeExpense')?.parentElement?.insertAdjacentHTML('beforeend', 
            '<div class="alert alert-danger mt-2">⚠️ Chart.js tidak terload. Periksa koneksi internet.</div>'
        );
        document.querySelector('#chartSavings')?.parentElement?.insertAdjacentHTML('beforeend', 
            '<div class="alert alert-danger mt-2">⚠️ Chart.js tidak terload. Periksa koneksi internet.</div>'
        );
        return;
    }
    console.log('✅ Chart.js terload (versi:', Chart.version, ')');
    
    // ============================================================
    // AMBIL DATA DARI ATRIBUT CANVAS
    // ============================================================
    var canvas1 = document.getElementById('chartIncomeExpense');
    var canvas2 = document.getElementById('chartSavings');
    
    if (!canvas1 || !canvas2) {
        console.error('❌ Canvas tidak ditemukan!');
        return;
    }
    
    var income = parseInt(canvas1.dataset.income) || 0;
    var expense = parseInt(canvas1.dataset.expense) || 0;
    var target = parseInt(canvas2.dataset.target) || 0;
    var deposit = parseInt(canvas2.dataset.deposit) || 0;
    
    console.log('📊 Data:', { income, expense, target, deposit });
    
    // ============================================================
    // GRAFIK 1: Pemasukan vs Pengeluaran (Doughnut)
    // ============================================================
    try {
        new Chart(canvas1.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [income, expense],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                cutout: '60%'
            }
        });
        console.log('✅ Chart 1 (Doughnut) berhasil dibuat');
    } catch(e) {
        console.error('❌ Chart 1 error:', e);
    }
    
    // ============================================================
    // GRAFIK 2: Tabungan (Bar)
    // ============================================================
    try {
        new Chart(canvas2.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Target', 'Realisasi'],
                datasets: [{
                    label: 'Tabungan',
                    data: [target, deposit],
                    backgroundColor: [
                        'rgba(26, 86, 219, 0.7)',
                        'rgba(59, 130, 246, 0.7)'
                    ],
                    borderColor: ['#1a56db', '#3b82f6'],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000) {
                                    return 'Rp ' + (value / 1000) + 'K';
                                }
                                return 'Rp ' + value;
                            }
                        }
                    }
                }
            }
        });
        console.log('✅ Chart 2 (Bar) berhasil dibuat');
    } catch(e) {
        console.error('❌ Chart 2 error:', e);
    }

    // ============================================================
    // GRAFIK 3: Tren Tabungan Platform 6 Bulan (Line Chart)
    // ============================================================
    var canvasTrend = document.getElementById('chartPlatformTrend');
    if (canvasTrend) {
        try {
            var trendRaw = canvasTrend.dataset.trend || '[]';
            var trendData = JSON.parse(trendRaw);
            
            var labels = trendData.map(function(item) { return item.label; });
            var values = trendData.map(function(item) { return item.total; });

            var ctxTrend = canvasTrend.getContext('2d');
            var gradient = ctxTrend.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(26, 86, 219, 0.35)');
            gradient.addColorStop(1, 'rgba(26, 86, 219, 0.0)');

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Tabungan Masuk (Rp)',
                        data: values,
                        borderColor: '#1a56db',
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#1a56db',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var val = context.parsed.y || 0;
                                    return ' Tabungan: Rp ' + new Intl.NumberFormat('id-ID').format(val);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp ' + value;
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            console.log('✅ Chart 3 (Trend Line) berhasil dibuat');
        } catch(e) {
            console.error('❌ Chart 3 error:', e);
        }
    }
});
