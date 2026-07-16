(function () {
    function setupSidebar() {
        var sidebar = document.getElementById('sidebar');
        var backdrop = document.getElementById('sidebarBackdrop');
        var toggle  = document.getElementById('sidebarToggle');
        if (!sidebar || !toggle) return;

        function isOpen() {
            return !sidebar.classList.contains('-translate-x-full');
        }
        function open() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            if (backdrop) backdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        function close() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            if (backdrop) backdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            isOpen() ? close() : open();
        });
        if (backdrop) backdrop.addEventListener('click', close);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') close();
        });
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) close();
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupSidebar);
    } else {
        setupSidebar();
    }
})();
