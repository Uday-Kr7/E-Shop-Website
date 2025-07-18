<!-- Toast Container -->
    <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 9999;">

        <!-- Success Toast -->
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ Product added successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>

        <!-- Error Toast -->
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ❌ Product not added successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>

    </div>


    <!-- Trigger Toasts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($success): ?>
                var toastEl = document.getElementById('successToast');
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 1000,
                    autohide: true
                });
                toast.show();
            <?php elseif ($error): ?>
                var toastEl = document.getElementById('errorToast');
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 1000,
                    autohide: true
                });
                toast.show();
            <?php endif; ?>
        });
    </script>