<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
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
        <section is="headline">
            <div class="col-12 col-lg-8 offset-lg-2 px-4 pt-5 pb-3 text-center">
                <h1 class="display-4 fw-bold">About</h1>
                <p class="lead fs-3 text-muted fw-semibold">About the [PROJECT]</p>
            </div>
        </section>
        <hr>
        <section id="content">
            <div class="col-12 col-lg-8 offset-lg-2 px-4 py-5">
                <p>CONTENT HERE</p>
            </div>
        </section>
    </main>
    <?php include_once '../components/footer.php'; ?>
</body>
</html>
