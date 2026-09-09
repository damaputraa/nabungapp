<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus"></i> Tambah Transaksi
                </h3>
            </div>
            <div class="card-body">
                <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('transactions/add') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="type" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="income">Pemasukan</option>
                            <option value="expense">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <optgroup label="Pemasukan">
                                <option value="Gaji">Gaji</option>
                                <option value="Bonus">Bonus</option>
                                <option value="Investasi">Investasi</option>
                                <option value="Lainnya">Lainnya</option>
                            </optgroup>
                            <optgroup label="Pengeluaran">
                                <option value="Makanan">Makanan</option>
                                <option value="Transportasi">Transportasi</option>
                                <option value="Tagihan">Tagihan</option>
                                <option value="Belanja">Belanja</option>
                                <option value="Hiburan">Hiburan</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Lainnya">Lainnya</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" placeholder="Masukkan jumlah" required min="0">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="transaction_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control" placeholder="Opsional"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Bukti Struk / Nota (Opsional)</label>
                        <div class="custom-file">
                            <input type="file" name="receipt_file" class="custom-file-input" id="receiptFile" accept="image/png, image/jpeg, image/jpg, image/webp" onchange="previewReceipt(this)">
                            <label class="custom-file-label" for="receiptFile" id="receiptFileLabel">Pilih foto/struk...</label>
                        </div>
                        <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB.</small>
                        <div id="receiptPreviewContainer" class="mt-2" style="display: none;">
                            <img id="receiptPreviewImg" src="" alt="Preview Struk" class="img-thumbnail" style="max-height: 140px;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
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
