<?php include_once 'includes/headerLinks.php'; ?>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-0">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logo.png">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active pe-4" aria-current="page" href="index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="terms">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="contact">Contact</a>
                    </li>
                </ul>
                <form class="d-flex gap-3">
                    <a class="btn btn-outline-primary px-4" href="login" >Login</a>
                    <a class="btn btn-primary px-4" href="register">Register</a>
                </form>
            </div>
        </div>
    </nav>
</header>