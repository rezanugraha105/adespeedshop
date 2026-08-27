        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var sidebar = document.getElementById('sidebar');
        var backdrop = document.getElementById('sidebarBackdrop');
        var btnToggle = document.getElementById('btnToggleSidebar');

        function openSidebar() {
            sidebar.classList.add('show');
            backdrop.classList.add('show');
        }
        function closeSidebar() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
        }

        btnToggle && btnToggle.addEventListener('click', function () {
            sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
        });
        backdrop.addEventListener('click', closeSidebar);

        document.querySelectorAll('.sidebar a.nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 992) closeSidebar();
            });
        });
    </script>
</body>
</html>
