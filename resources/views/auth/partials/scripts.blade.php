<!-- Core JS -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Auth specific JS -->
<script>
    // Password toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const passwordToggles = document.querySelectorAll('.form-password-toggle .input-group-text');

        passwordToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bx-hide');
                    icon.classList.add('bx-show');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bx-show');
                    icon.classList.add('bx-hide');
                }
            });
        });

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

    window.addEventListener('offline', function() {
        window.location.href = "{{ route('offline') }}";
    });
</script>

<!-- Additional Scripts -->
@stack('scripts')

<!-- Page specific scripts -->
@yield('scripts')

</body>

</html>
