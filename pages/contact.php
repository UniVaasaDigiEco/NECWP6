<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../css/bs-custom.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-secondary-subtle">
    <header>
        <?php include_once '../components/navbar.php'; ?>
    </header>
    <main>
        <section id="headline">
            <div class="col-12 col-lg-8 offset-lg-2 px-4 pt-5 pb-3 text-center">
                <h1 class="display-4 fw-bold">Contact</h1>
                <p class="lead fs-3 text-muted fw-semibold">Get in touch with the team!</p>
            </div>
        </section>
        <hr>
        <section id="contact-info" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <!-- Contact Card -->
                        <div class="card shadow-lg border-0 overflow-hidden">
                            <div class="row g-0">
                                <!-- Image Column -->
                                <div class="col-md-4 bg-primary bg-gradient d-flex align-items-center justify-content-center p-4">
                                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><rect fill='%23f3f4f6' width='100%' height='100%'/><g transform='translate(56 56)'><circle cx='200' cy='120' r='96' fill='%23ffe8d6'/><path d='M96 304c0-88 208-88 208 0v56H96z' fill='%2398c1d9'/><rect x='48' y='360' width='304' height='40' rx='20' fill='%2389a8be'/><ellipse cx='200' cy='120' rx='52' ry='32' fill='%23000000' opacity='0.08'/><g fill='none' stroke='%23000000' stroke-width='6' stroke-linecap='round' stroke-linejoin='round'><path d='M164 112c6 6 18 6 24 0' /><path d='M236 112c6 6 18 6 24 0' /></g><circle cx='172' cy='116' r='8' fill='%23000000'/><circle cx='228' cy='116' r='8' fill='%23000000'/><path d='M168 152c10 10 32 10 42 0' stroke='%23000000' stroke-width='4' stroke-linecap='round' fill='none'/></g></svg>"
                                         alt="Project Coordinator"
                                         class="rounded-circle img-fluid"
                                         style="max-width: 200px; border: 5px solid white;">
                                </div>

                                <!-- Contact Details Column -->
                                <div class="col-md-8">
                                    <div class="card-body p-4 p-lg-5">
                                        <h3 class="card-title fw-bold mb-3">[Name]</h3>
                                        <p class="text-muted mb-4">Project Coordinator</p>

                                        <div class="contact-details pb-2">
                                            <!-- Phone -->
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-telephone-fill text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Phone</small>
                                                    <a href="tel:+1234567890" class="text-decoration-none text-dark fw-semibold">+1 234 567 890</a>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-envelope-fill text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Email</small>
                                                    <a href="mailto:contact@example.com" class="text-decoration-none text-dark fw-semibold">contact@example.com</a>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-geo-alt-fill text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Address</small>
                                                    <p class="mb-0 text-dark fw-semibold">123 Main Street<br>City, State 12345<br>Country</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- Action Buttons -->
                                        <div class="mt-4 pt-3">
                                            <a href="#" class="btn btn-primary me-2 mb-2">
                                                <i class="bi bi-envelope-fill me-2"></i>Send Email
                                            </a>
                                            <a href="#" class="btn btn-outline-primary mb-2">
                                                <i class="bi bi-telephone-fill me-2"></i>Call Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
