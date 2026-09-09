<div class="row mb-3">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-history mr-2 text-primary"></i> Log Aktivitas Sistem (Audit Trail)
            </h3>
            <p class="text-muted mb-0">Catatan lengkap aktivitas autentikasi, transaksi, dan perubahan data pengguna platform.</p>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="font-weight-bold text-dark mb-0">
            <i class="fas fa-list-alt mr-2 text-primary"></i> Rekaman Riwayat Aktivitas
        </h5>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th style="width: 150px;">Waktu Kejadian</th>
                        <th>Pengguna / Pelaku</th>
                        <th style="width: 140px;">Tindakan (Action)</th>
                        <th>Rincian Keterangan</th>
                        <th>Alamat IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($logs as $log): 
                        $badge_class = 'badge-secondary';
                        if (strpos($log->action, 'LOGIN') !== false) $badge_class = 'badge-success';
                        elseif (strpos($log->action, 'LOGOUT') !== false) $badge_class = 'badge-dark';
                        elseif (strpos($log->action, 'DELETE') !== false) $badge_class = 'badge-danger';
                        elseif (strpos($log->action, 'STATUS') !== false || strpos($log->action, 'RESET') !== false) $badge_class = 'badge-warning';
                        elseif (strpos($log->action, 'ADD') !== false) $badge_class = 'badge-primary';
                    ?>
                    <tr>
                        <td class="text-center text-muted small"><?= $no++ ?></td>
                        <td class="small">
                            <strong><?= date('d M Y', strtotime($log->created_at)) ?></strong><br>
                            <span class="text-muted"><?= date('H:i:s', strtotime($log->created_at)) ?> WIB</span>
                        </td>
                        <td>
                            <?php if ($log->user_id): ?>
                                <strong class="text-dark"><?= htmlspecialchars($log->username ?? 'User #' . $log->user_id) ?></strong>
                                <div class="small text-muted"><?= htmlspecialchars($log->email ?? '') ?> (<?= ucfirst($log->role ?? 'user') ?>)</div>
                            <?php else: ?>
                                <span class="badge badge-light border">Sistem / Tamu</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge <?= $badge_class ?> px-2 py-1 font-weight-bold">
                                <?= htmlspecialchars($log->action) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($log->description) ?></td>
                        <td><code><?= htmlspecialchars($log->ip_address ?? '-') ?></code></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>