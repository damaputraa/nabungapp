<div class="row mb-3">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-bullhorn mr-2 text-primary"></i> Pusat Pengumuman & Pesan Siaran
            </h3>
            <p class="text-muted mb-0">Terbitkan pengumuman resmi yang akan tampil di halaman dashboard pengguna platform Yuk Nabung.</p>
        </div>
        <div class="mt-2 mt-md-0">
            <button class="btn btn-primary font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalAddAnnouncement">
                <i class="fas fa-plus-circle mr-1"></i> Buat Pengumuman Baru
            </button>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show shadow-sm">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
</div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="font-weight-bold text-dark mb-0">
            <i class="fas fa-list mr-2 text-primary"></i> Daftar Pengumuman
        </h5>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable w-100">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Judul Pengumuman</th>
                        <th>Isi Pesan</th>
                        <th style="width: 100px;">Tipe</th>
                        <th style="width: 100px;" class="text-center">Status</th>
                        <th style="width: 130px;">Tanggal Dibuat</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($announcements as $a): 
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
                        <td><strong class="text-dark"><?= htmlspecialchars($a->title) ?></strong></td>
                        <td><?= nl2br(htmlspecialchars($a->message)) ?></td>
                        <td>
                            <span class="badge badge-<?= $a->type ?> px-2 py-1 text-uppercase font-weight-bold">
                                <?= $a->type ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($a->is_active): ?>
                                <span class="badge badge-success px-2 py-1">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-secondary px-2 py-1">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="small text-muted"><?= date('d M Y H:i', strtotime($a->created_at)) ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('admin/toggle_announcement/' . $a->id) ?>" class="btn btn-sm btn-<?= $a->is_active ? 'warning text-dark' : 'success' ?>" title="<?= $a->is_active ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                <i class="fas fa-<?= $a->is_active ? 'eye-slash' : 'eye' ?>"></i>
                            </a>
                            <a href="<?= site_url('admin/delete_announcement/' . $a->id) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengumuman -->
<div class="modal fade" id="modalAddAnnouncement" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 16px;">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-dark">
                    <i class="fas fa-bullhorn text-primary mr-1"></i> Buat Pengumuman Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= site_url('admin/add_announcement') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Judul Pengumuman</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Tips Hemat Menabung Minggu Ini" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Tipe Tampilan</label>
                        <select name="type" class="form-control" required>
                            <option value="info">Info (Biru)</option>
                            <option value="success">Sukses / Selamat (Hijau)</option>
                            <option value="warning">Peringatan / Hati-hati (Kuning)</option>
                            <option value="danger">Penting / Darurat (Merah)</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark">Isi Pesan Pengumuman</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Tuliskan pesan broadcast lengkap di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-paper-plane mr-1"></i> Publikasikan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>