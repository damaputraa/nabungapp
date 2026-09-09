/**
 * format-rupiah.js
 * Helper untuk format otomatis mata uang Rupiah secara real-time pada form input.
 * Mendukung auto-format pada saat ketik dan auto-strip saat submit ke server.
 */

(function(window, document) {
    'use strict';

    /**
     * Memformat string/angka menjadi format Rupiah dengan pemisah ribuan titik (.)
     * @param {string|number} angka 
     * @param {string} prefix default 'Rp '
     * @returns {string}
     */
    function formatRupiah(angka, prefix) {
        if (angka === null || angka === undefined) return '';
        prefix = prefix === undefined ? 'Rp ' : prefix;
        
        let numberString = angka.toString().replace(/[^,\d]/g, '');
        let split = numberString.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah ? (prefix ? prefix + rupiah : rupiah) : '';
    }

    /**
     * Membersihkan string format Rupiah menjadi angka murni
     * @param {string} rupiahString 
     * @returns {string}
     */
    function unformatRupiah(rupiahString) {
        if (!rupiahString) return '0';
        let clean = rupiahString.toString().replace(/[^0-9]/g, '');
        return clean ? clean : '0';
    }

    // Expose fungsi ke global window
    window.formatRupiah = formatRupiah;
    window.unformatRupiah = unformatRupiah;

    /**
     * Inisialisasi listener pada elemen input
     */
    function initRupiahInputs() {
        const selector = '.input-rupiah, input[data-type="rupiah"], input[name="amount"], input[name="target_amount"], input[name="monthly_limit"]';
        const inputs = document.querySelectorAll(selector);

        inputs.forEach(function(input) {
            // Jangan inisialisasi ganda
            if (input.dataset.rupiahInitialized) return;
            input.dataset.rupiahInitialized = 'true';

            // Jika sudah ada nilai angka saat load (misal form edit), langsung formatkan
            if (input.value && !isNaN(input.value.replace(/[^0-9]/g, '')) && input.value !== '') {
                // Hilangkan desimal jika ada .00 di belakang
                let rawVal = Math.round(parseFloat(input.value) || 0).toString();
                if (rawVal !== '0') {
                    input.value = formatRupiah(rawVal);
                }
            }

            // Pasang event listener saat user mengetik
            input.addEventListener('input', function(e) {
                let cursorPosition = this.selectionStart;
                let oldLength = this.value.length;
                
                this.value = formatRupiah(this.value);
                
                let newLength = this.value.length;
                cursorPosition = cursorPosition + (newLength - oldLength);
                if (cursorPosition >= 0) {
                    this.setSelectionRange(cursorPosition, cursorPosition);
                }
            });

            // Pasang submit handler pada form induk agar nilai yang terkirim bersih (angka murni)
            const form = input.closest('form');
            if (form && !form.dataset.rupiahSubmitHooked) {
                form.dataset.rupiahSubmitHooked = 'true';
                form.addEventListener('submit', function() {
                    const formRupiahInputs = form.querySelectorAll(selector);
                    formRupiahInputs.forEach(function(field) {
                        field.value = unformatRupiah(field.value);
                    });
                });
            }
        });
    }

    // Jalankan saat DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initRupiahInputs);
    } else {
        initRupiahInputs();
    }

    // Jalankan ulang jika ada modal yang dibuka (dukung bootstrap modal)
    document.addEventListener('shown.bs.modal', initRupiahInputs);

})(window, document);