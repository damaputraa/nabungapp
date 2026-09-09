<div class="row">
    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i> Edit Transaksi
                </h3>
            </div>
            <div class="card-body">
                <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('transactions/edit/' . $transaction->id) ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="type" class="form-control" required>
                            <option value="income" <?= $transaction->type == 'income' ? 'selected' : '' ?>>Pemasukan</option>
                            <option value="expense" <?= $transaction->type == 'expense' ? 'selected' : '' ?>>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="Gaji" <?= $transaction->category == 'Gaji' ? 'selected' : '' ?>>Gaji</option>
                            <option value="Bonus" <?= $transaction->category == 'Bonus' ? 'selected' : '' ?>>Bonus</option>
                            <option value="Investasi" <?= $transaction->category == 'Investasi' ? 'selected' : '' ?>>Investasi</option>
                            <option value="Makanan" <?= $transaction->category == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
                            <option value="Transportasi" <?= $transaction->category == 'Transportasi' ? 'selected' : '' ?>>Transportasi</option>
                            <option value="Tagihan" <?= $transaction->category == 'Tagihan' ? 'selected' : '' ?>>Tagihan</option>
                            <option value="Belanja" <?= $transaction->category == 'Belanja' ? 'selected' : '' ?>>Belanja</option>
                            <option value="Hiburan" <?= $transaction->category == 'Hiburan' ? 'selected' : '' ?>>Hiburan</option>
                            <option value="Kesehatan" <?= $transaction->category == 'Kesehatan' ? 'selected' : '' ?>>Kesehatan</option>
                            <option value="Lainnya" <?= $transaction->category == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" value="<?= $transaction->amount ?>" required min="0">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="transaction_date" class="form-control" value="<?= $transaction->transaction_date ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control"><?= $transaction->description ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Bukti Struk / Nota</label>
                        <?php if (!empty($transaction->receipt_image) && file_exists('./uploads/receipts/' . $transaction->receipt_image)): ?>
                            <div class="mb-2">
                                <span class="d-block text-muted small mb-1">Struk saat ini:</span>
                                <a href="<?= base_url('uploads/receipts/' . $transaction->receipt_image) ?>" target="_blank">
                                    <img src="<?= base_url('uploads/receipts/' . $transaction->receipt_image) ?>" alt="Struk" class="img-thumbnail" style="max-height: 120px;">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="custom-file">
                            <input type="file" name="receipt_file" class="custom-file-input" id="receiptEditFile" accept="image/png, image/jpeg, image/jpg, image/webp" onchange="previewReceipt(this)">
                            <label class="custom-file-label" for="receiptEditFile" id="receiptFileLabel">Pilih untuk ganti struk...</label>
                        </div>
                        <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
                        <div id="receiptPreviewContainer" class="mt-2" style="display: none;">
                            <span class="d-block text-muted small mb-1">Preview struk baru:</span>
                            <img id="receiptPreviewImg" src="" alt="Preview Struk" class="img-thumbnail" style="max-height: 140px;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="<?= site_url('transactions') ?>" class="btn btn-default">Batal</a>
                </form>
                <script>
                function previewReceipt(input) {
                    if (input.files && input.files[0]) {
                        var file = input.files[0];
                        document.getElementById('receiptFileLabel').innerText = file.name;
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('receiptPreviewImg').src = e.target.result;
                            document.getElementById('receiptPreviewContainer').style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    }
                }
                </script>
            </div>
        </div>
    </div>
</div>
