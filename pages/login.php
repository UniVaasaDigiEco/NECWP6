<?php
require_once __DIR__ . '/../classes/tools.class.php';
$message_code = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - [PROJECT]</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../css/bs-custom.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Password toggle functionality
            $('#togglePassword').on('click', function() {
                const passwordInput = $('#password');
                const passwordIcon = $('#togglePasswordIcon');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
                }
            });

            // Add focus effects to inputs
            $('.form-control').on('focus', function() {
                $(this).parent().addClass('shadow-sm');
            }).on('blur', function() {
                $(this).parent().removeClass('shadow-sm');
            });
        });
    </script>
</head>
<body class="bg-secondary-subtle">
<header>
    <?php include_once '../components/navbar.php'; ?>
</header>
<main>
    <section id="login_form" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">
                            <!-- Logo Section -->
                            <div class="text-center mb-4">
                                <img src="../images/logos/logo.png" alt="[PROJECT] Icon" class="mb-3" style="height: 120px;">
                                <h2 class="fw-bold text-primary">Login</h2>
                                <p class="text-muted">Please enter your credentials to access the admin panel</p>
                            </div>

                            <!-- Alert for login errors/messages -->
                            <?php
                            if(!empty($message_code)){
                                echo Tools::showMessage($message_code);
                            }
                            ?>

                            <!-- Login Form -->
                            <form id="loginForm" action="../actions/login.php" method="POST">
                                <!-- Email/Username Field -->
                                <div class="mb-4">
                                    <label for="username" class="form-label fw-semibold"><i class="bi bi-person-fill"></i> Username or Email</label>
                                    <input type="text" class="form-control form-control-lg rounded-3" id="username" name="username" placeholder="Enter your username or email" required autocomplete="username">
                                </div>

                                <!-- Password Field -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill"></i> Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg rounded-start-3" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                                        <button class="btn btn-outline-secondary rounded-end-3" type="button" id="togglePassword" aria-label="Toggle password visibility">
                                            <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>

