<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="footer container-fluid bg-secondary text-light mb-0">
    <p class="text-center mb-0 py-2">
        Copyright &copy; 2023 CodeConnect Coding Forums | All rights reserved
    </p>
</div>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="toast-container my-5 position-absolute top-0 d-flex justify-content-center align-items-center w-100">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="error_toast">
            <div class="toast-header bg-danger text-light">
                <strong class="me-auto">Error</strong>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var toast_id = document.getElementById('error_toast')
            var error_toast = new bootstrap.Toast(toast_id);
            error_toast.show();
        })
    </script>
<?php endif; ?>
<script>
    let p_image = document.querySelector(".img");
    let menu = document.querySelector(".user_menu");
    p_image.addEventListener("click", () => {
        menu.classList.toggle("d_none");
    });
</script>