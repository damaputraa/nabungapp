/**
 * format-rupiah.js
 * Sistem format otomatis mata uang Rupiah secara real-time pada semua form input.
 * - Mengonversi input type="number" menjadi type="text" + inputmode="numeric" secara otomatis
 * - Memformat angka dengan pemisah ribuan titik (.) tanpa merusak posisi kursor
 * - Menghilangkan 'Rp' di dalam nilai input agar kompatibel dengan input-group prefix [Rp]
 * - Otomatis membersihkan titik saat form di-submit sehingga backend menerima integer murni
 */
(function(window, document) {
    'use strict';

    /**
     * Memformat angka dengan pemisah ribuan titik (1000000 -> 1.000.000)
     */
    function formatNumberWithDots(val) {
        if (val === null || val === undefined) return '';
        // Hanya ambil digit 0-9
        let clean = val.toString().replace(/[^0-9]/g, '');
        if (!clean) return '';
        // Format dengan titik pemisah ribuan
        return new Intl.NumberFormat('id-ID').format(clean);
    }

    /**
     * Membersihkan string menjadi angka murni ('1.000.000' -> '1000000')
     */
    function unformatRupiah(val) {
        if (val === null || val === undefined) return '0';
        let clean = val.toString().replace(/[^0-9]/g, '');
        return clean || '0';
    }

    // Expose fungsi ke global window
    window.formatRupiah = formatNumberWithDots;
    window.unformatRupiah = unformatRupiah;

    const selector = '.input-rupiah, .rupiah-input, input[data-type="rupiah"], input[name="amount"], input[name="target_amount"], input[name="monthly_limit"], input[name="balance"], input[name="initial_amount"]';

    function setupRupiahField(input) {
        if (!input || input.dataset.rupiahInitialized) return;
        input.dataset.rupiahInitialized = 'true';

        // PENTING: Jika elemen adalah type="number", ubah ke type="text" agar browser tidak memblokir titik
        if (input.type === 'number') {
            try {
                input.type = 'text';
            } catch (e) {
                input.setAttribute('type', 'text');
            }
        }
        input.setAttribute('inputmode', 'numeric');
        input.setAttribute('autocomplete', 'off');

        // Format nilai awal jika ada
        if (input.value && input.value.trim() !== '') {
            let initialClean = input.value.replace(/[^0-9]/g, '');
            if (initialClean && initialClean !== '0') {
                input.value = formatNumberWithDots(initialClean);
            }
        }

        // Backspace handling: jika kursor tepat setelah tanda titik, hapus digit sebelumnya
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.selectionStart === this.selectionEnd) {
                let cursor = this.selectionStart;
                if (cursor > 0 && this.value.charAt(cursor - 1) === '.') {
                    e.preventDefault();
                    let val = this.value;
                    let left = val.slice(0, cursor - 2);
                    let right = val.slice(cursor);
                    let clean = (left + right).replace(/[^0-9]/g, '');
                    let formatted = clean ? formatNumberWithDots(clean) : '';
                    this.value = formatted;
                    
                    let digitsBefore = left.replace(/[^0-9]/g, '').length;
                    let newCursor = 0;
                    let count = 0;
                    for (let i = 0; i < formatted.length; i++) {
                        if (/[0-9]/.test(formatted[i])) count++;
                        if (count === digitsBefore) {
                            newCursor = i + 1;
                            break;
                        }
                    }
                    try {
                        this.setSelectionRange(newCursor, newCursor);
                    } catch (err) {}
                    this.dispatchEvent(new Event('input', { bubbles: true }));
                }
            }
        });

        // Listener saat mengetik (input event)
        input.addEventListener('input', function(e) {
            let cursor = this.selectionStart || 0;
            let originalLen = this.value.length;
            
            // Format ulang dengan titik
            let rawDigits = this.value.replace(/[^0-9]/g, '');
            if (!rawDigits) {
                this.value = '';
                return;
            }
            
            let formatted = formatNumberWithDots(rawDigits);
            this.value = formatted;
            
            // Pertahankan posisi kursor
            let diff = formatted.length - originalLen;
            let newCursor = Math.max(0, cursor + diff);
            try {
                this.setSelectionRange(newCursor, newCursor);
            } catch (err) {}
        });

        // Tangani form submit: bersihkan titik menjadi digit murni
        const form = input.closest('form');
        if (form && !form.dataset.rupiahSubmitHooked) {
            form.dataset.rupiahSubmitHooked = 'true';
            form.addEventListener('submit', function() {
                const allRupiahFields = form.querySelectorAll(selector);
                allRupiahFields.forEach(function(f) {
                    f.value = unformatRupiah(f.value);
                });
            });
        }
    }

    function initAllRupiahInputs() {
        const inputs = document.querySelectorAll(selector);
        inputs.forEach(setupRupiahField);
    }

    // Inisialisasi pada berbagai siklus DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllRupiahInputs);
    } else {
        initAllRupiahInputs();
    }

    // Dukung dynamic modals & dynamic content
    document.addEventListener('shown.bs.modal', initAllRupiahInputs);
    window.addEventListener('load', initAllRupiahInputs);

    // Observer untuk modal atau elemen baru yang di-inject via JS
    if (typeof MutationObserver !== 'undefined') {
        const observer = new MutationObserver(function(mutations) {
            initAllRupiahInputs();
        });
        if (document.body) {
            observer.observe(document.body, { childList: true, subtree: true });
        }
    }

})(window, document);
