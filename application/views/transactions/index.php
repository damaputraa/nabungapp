<div class="row">
	<div class="col-12">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fas fa-list"></i> Daftar Transaksi
				</h3>
				<div class="card-tools">
					<a href="<?= site_url('transactions/add') ?>" class="btn btn-success btn-sm">
						<i class="fas fa-plus"></i> Tambah Transaksi
					</a>
				</div>
			</div>
			<div class="card-body">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?= $this->session->flashdata('success') ?>
					</div>
				<?php endif; ?>

				<!-- Filter -->
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-filter"></i> Filter Transaksi
						</h3>
					</div>
					<div class="card-body">
						<form method="GET" action="<?= site_url('transactions') ?>">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Jenis</label>
										<select name="type" class="form-control">
											<option value="">Semua</option>
											<option value="income" <?= $type == 'income' ? 'selected' : '' ?>>Pemasukan</option>
											<option value="expense" <?= $type == 'expense' ? 'selected' : '' ?>>Pengeluaran</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Kategori</label>
										<select name="category" class="form-control">
											<option value="">Semua</option>
											<option value="Gaji" <?= $category == 'Gaji' ? 'selected' : '' ?>>Gaji</option>
											<option value="Makanan" <?= $category == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
											<option value="Transportasi" <?= $category == 'Transportasi' ? 'selected' : '' ?>>Transportasi</option>
											<option value="Tagihan" <?= $category == 'Tagihan' ? 'selected' : '' ?>>Tagihan</option>
											<option value="Belanja" <?= $category == 'Belanja' ? 'selected' : '' ?>>Belanja</option>
											<option value="Hiburan" <?= $category == 'Hiburan' ? 'selected' : '' ?>>Hiburan</option>
											<option value="Kesehatan" <?= $category == 'Kesehatan' ? 'selected' : '' ?>>Kesehatan</option>
											<option value="Lainnya" <?= $category == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Dari Tanggal</label>
										<input type="date" name="date_from" class="form-control" value="<?= $date_from ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Sampai Tanggal</label>
										<input type="date" name="date_to" class="form-control" value="<?= $date_to ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" class="btn btn-primary btn-block">
											<i class="fas fa-search"></i> Filter
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<table id="table-transactions" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Jenis</th>
							<th>Kategori</th>
							<th>Jumlah</th>
							<th>Bukti</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($transactions as $trx): ?>
							<tr>
								<td><?= date('d-m-Y', strtotime($trx->transaction_date)) ?></td>
								<td>
									<?php if ($trx->type == 'income'): ?>
										<span class="badge badge-success">Pemasukan</span>
									<?php else: ?>
										<span class="badge badge-danger">Pengeluaran</span>
									<?php endif; ?>
								</td>
								<td><?= $trx->category ?></td>
								<td>Rp <?= number_format($trx->amount, 0, ',', '.') ?></td>
								<td class="text-center">
									<?php if (!empty($trx->receipt_image) && file_exists('./uploads/receipts/' . $trx->receipt_image)): ?>
										<a href="javascript:void(0)" onclick="showReceiptModal('<?= base_url('uploads/receipts/' . $trx->receipt_image) ?>', '<?= date('d-m-Y', strtotime($trx->transaction_date)) ?> - <?= htmlspecialchars($trx->category) ?>')">
											<img src="<?= base_url('uploads/receipts/' . $trx->receipt_image) ?>" alt="Struk" class="img-thumbnail" style="width: 42px; height: 42px; object-fit: cover; border-radius: 8px;">
										</a>
									<?php else: ?>
										<span class="text-muted small">-</span>
									<?php endif; ?>
								</td>
								<td><?= $trx->description ?? '-' ?></td>
								<td>
									<a href="<?= site_url('transactions/edit/' . $trx->id) ?>" class="btn btn-warning btn-sm" title="Edit">
										<i class="fas fa-edit"></i>
									</a>
									<a href="<?= site_url('transactions/delete/' . $trx->id) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin hapus transaksi ini?')">
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
</div>

<!-- MODAL PREVIEW STRUK -->
<div class="modal fade" id="modalReceiptPreview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-light py-2 px-3">
                <h6 class="modal-title font-weight-bold" id="receiptModalTitle">Bukti Transaksi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-3 bg-dark">
                <img id="receiptModalImage" src="" alt="Bukti Transaksi" class="img-fluid rounded" style="max-height: 75vh; object-fit: contain;">
            </div>
            <div class="modal-footer py-2 px-3 justify-content-between">
                <a id="receiptDownloadBtn" href="" target="_blank" download class="btn btn-sm btn-primary">
                    <i class="fas fa-download mr-1"></i> Buka / Unduh Gambar
                </a>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function showReceiptModal(imageUrl, title) {
    document.getElementById('receiptModalImage').src = imageUrl;
    document.getElementById('receiptModalTitle').innerText = 'Bukti: ' + title;
    document.getElementById('receiptDownloadBtn').href = imageUrl;
    $('#modalReceiptPreview').modal('show');
}
</script>
