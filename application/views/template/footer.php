    </div> <!-- /.content-wrapper -->
</div> <!-- /.wrapper -->

<!-- ======================================== -->
<!-- BOTTOM NAVIGATION - KHUSUS USER -->
<!-- ======================================== -->
<?php if (strtolower(trim((string) $this->session->userdata('role'))) !== 'admin'): ?>
    <?php $this->load->view('template/bottom_nav'); ?>
<?php endif; ?>

<!-- ======================================== -->
<!-- REQUIRED SCRIPTS -->
<!-- ======================================== -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE 3 -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

<?php if (isset($plugins) && !empty($plugins)): ?>
    <?php foreach ($plugins as $plugin): ?>
        <?php if ($plugin == 'chartjs'): ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <?php elseif ($plugin == 'datatables'): ?>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready(function() {
            if ($('#table-users').length) {
                $('#table-users').DataTable({
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ entri",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "Berikutnya",
                            previous: "Sebelumnya"
                        },
                        zeroRecords: "Tidak ada data yang cocok"
                    }
                });
            }
            if ($('#table-targets').length) {
                $('#table-targets').DataTable({
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ entri",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "Berikutnya",
                            previous: "Sebelumnya"
                        },
                        zeroRecords: "Tidak ada data yang cocok"
                    }
                });
            }
            if ($('.datatable').length) {
                $('.datatable').DataTable({
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ entri"
                    }
                });
            }
        });
        </script>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($page_js) && !empty($page_js)): ?>
    <?php foreach ($page_js as $js): 
        $js_ver = file_exists(FCPATH . $js) ? filemtime(FCPATH . $js) : time();
    ?>
    <script src="<?= base_url($js . '?v=' . $js_ver) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert2 Flashdata Toast Handler -->
<script>
$(document).ready(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    <?php if ($this->session->flashdata('success')): ?>
    Toast.fire({
        icon: 'success',
        title: <?= json_encode($this->session->flashdata('success')) ?>
    });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
    Toast.fire({
        icon: 'error',
        title: <?= json_encode($this->session->flashdata('error')) ?>
    });
    <?php endif; ?>
});
</script>

<!-- Real-time Rupiah Formatting Helper -->
<script src="<?= base_url('assets/js/format-rupiah.js?v=' . (file_exists(FCPATH . 'assets/js/format-rupiah.js') ? filemtime(FCPATH . 'assets/js/format-rupiah.js') : time())) ?>"></script>

<!-- Dark Mode System -->
<script src="<?= base_url('assets/js/dark-mode.js?v=' . (file_exists(FCPATH . 'assets/js/dark-mode.js') ? filemtime(FCPATH . 'assets/js/dark-mode.js') : time())) ?>"></script>

</body>
</html>
