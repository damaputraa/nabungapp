// ============================================================
// DASHBOARD JS - MODULAR & ROBUST
// Mengambil data dari atribut data-* di masing-masing canvas
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('📊 Dashboard JS loaded');
    
    // ============================================================
    // CEK CHART.JS
    // ============================================================
    if (typeof Chart === 'undefined') {
        console.warn('⚠️ Chart.js tidak terload.');
        return;
    }
    console.log('✅ Chart.js terload (versi:', Chart.version, ')');

    var colorPalette = [
        '#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', 
        '#06b6d4', '#ec4899', '#14b8a6', '#f97316', '#64748b'
    ];
    
    // ============================================================
    // GRAFIK 1: Pemasukan vs Pengeluaran (Doughnut) - Admin/User
    // ============================================================
    var canvas1 = document.getElementById('chartIncomeExpense');
    if (canvas1) {
        var income = parseInt(canvas1.dataset.income) || 0;
        var expense = parseInt(canvas1.dataset.expense) || 0;
        
        try {
            new Chart(canvas1.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Pemasukan', 'Pengeluaran'],
                    datasets: [{
                        data: [income, expense],
                        backgroundColor: ['#10b981', '#ef4444'],
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
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var val = context.parsed || 0;
                                    return ' ' + context.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(val);
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
            console.log('✅ Chart 1 (Income/Expense) loaded');
        } catch(e) {
            console.error('❌ Chart 1 error:', e);
        }
    }
    
    // ============================================================
    // GRAFIK 2: Tabungan Realisasi vs Target (Bar)
    // ============================================================
    var canvas2 = document.getElementById('chartSavings');
    if (canvas2) {
        var target = parseInt(canvas2.dataset.target) || 0;
        var deposit = parseInt(canvas2.dataset.deposit) || 0;

        try {
            new Chart(canvas2.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Target', 'Realisasi'],
                    datasets: [{
                        label: 'Tabungan',
                        data: [target, deposit],
                        backgroundColor: [
                            'rgba(37, 99, 235, 0.7)',
                            'rgba(16, 185, 129, 0.7)'
                        ],
                        borderColor: ['#2563eb', '#10b981'],
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
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var val = context.parsed.y || 0;
                                    return ' Rp ' + new Intl.NumberFormat('id-ID').format(val);
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
                                        return 'Rp ' + (value / 1000) + 'K';
                                    }
                                    return 'Rp ' + value;
                                }
                            }
                        }
                    }
                }
            });
            console.log('✅ Chart 2 (Savings Bar) loaded');
        } catch(e) {
            console.error('❌ Chart 2 error:', e);
        }
    }

    // ============================================================
    // GRAFIK 3: Tren Tabungan Platform 6 Bulan (Line Chart) - Admin
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
            gradient.addColorStop(0, 'rgba(37, 99, 235, 0.35)');
            gradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)');

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Tabungan Masuk (Rp)',
                        data: values,
                        borderColor: '#2563eb',
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#2563eb',
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
            console.log('✅ Chart 3 (Trend Line) loaded');
        } catch(e) {
            console.error('❌ Chart 3 error:', e);
        }
    }

    // ============================================================
    // GRAFIK 4: Komposisi Pengeluaran per Kategori (Doughnut) - User
    // ============================================================
    var canvasCatUser = document.getElementById('chartExpenseCategory');
    if (canvasCatUser) {
        try {
            var rawCats = canvasCatUser.dataset.categories || '[]';
            var catData = JSON.parse(rawCats);
            
            if (catData.length > 0) {
                var catLabels = catData.map(function(c) { return c.category; });
                var catTotals = catData.map(function(c) { return parseFloat(c.total); });
                var colors = colorPalette.slice(0, catData.length);

                new Chart(canvasCatUser.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: catLabels,
                        datasets: [{
                            data: catTotals,
                            backgroundColor: colors,
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
                                    padding: 12,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        var val = context.parsed || 0;
                                        var total = context.dataset.data.reduce(function(a, b) { return a + b; }, 0);
                                        var pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                        return ' ' + context.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(val) + ' (' + pct + '%)';
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
                console.log('✅ Chart 4 (Expense Breakdown) loaded');
            } else {
                // Tampilkan placeholder jika belum ada pengeluaran
                var parent = canvasCatUser.parentElement;
                canvasCatUser.style.display = 'none';
                parent.insertAdjacentHTML('beforeend', 
                    '<div class="text-center py-4 text-muted"><i class="fas fa-chart-pie fa-2x mb-2 text-muted"></i><p class="small mb-0">Belum ada catatan pengeluaran bulan ini.</p></div>'
                );
            }
        } catch(e) {
            console.error('❌ Chart 4 error:', e);
        }
    }

    // ============================================================
    // GRAFIK 5: Kategori Terpopuler Platform (Doughnut) - Admin
    // ============================================================
    var canvasCatAdmin = document.getElementById('chartPlatformCategories');
    if (canvasCatAdmin) {
        try {
            var rawAdminCats = canvasCatAdmin.dataset.categories || '[]';
            var adminCatData = JSON.parse(rawAdminCats);

            if (adminCatData.length > 0) {
                var admLabels = adminCatData.map(function(c) { return c.category; });
                var admTotals = adminCatData.map(function(c) { return parseFloat(c.total_amount); });
                var admColors = colorPalette.slice(0, adminCatData.length);

                new Chart(canvasCatAdmin.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: admLabels,
                        datasets: [{
                            data: admTotals,
                            backgroundColor: admColors,
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
                                    padding: 12,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        var val = context.parsed || 0;
                                        return ' ' + context.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(val);
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
                console.log('✅ Chart 5 (Platform Categories) loaded');
            } else {
                var parentAdmin = canvasCatAdmin.parentElement;
                canvasCatAdmin.style.display = 'none';
                parentAdmin.insertAdjacentHTML('beforeend', 
                    '<div class="text-center py-4 text-muted"><p class="small mb-0">Belum ada transaksi di platform.</p></div>'
                );
            }
        } catch(e) {
            console.error('❌ Chart 5 error:', e);
        }
    }
});
