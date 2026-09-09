/**
 * dark-mode.js
 * Manajemen Tema Terang / Gelap dengan persistensi localStorage
 */
(function() {
    'use strict';

    function applyTheme(theme) {
        const icon = document.getElementById('themeIcon');
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            if (icon) {
                icon.className = 'fas fa-sun text-warning';
            }
        } else {
            document.body.classList.remove('dark-mode');
            if (icon) {
                icon.className = 'fas fa-moon text-warning';
            }
        }
    }

    function initTheme() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        applyTheme(savedTheme);

        const btn = document.getElementById('themeToggleBtn');
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const isDark = document.body.classList.contains('dark-mode');
                const newTheme = isDark ? 'light' : 'dark';
                localStorage.setItem('theme', newTheme);
                applyTheme(newTheme);
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTheme);
    } else {
        initTheme();
    }
})();