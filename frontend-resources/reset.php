<?php include_once 'includes/header.php'; ?>
<main>
    <div class="resetWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <div class="col-lg-5 mx-auto px-0">
                    <div class="text-center pt-4">
                        <h2>Reset Password</h2>
                        <p class="px-0 px-md-3 px-lg-5">
                            To reset your password, please enter your email address below.
                        </p>
                    </div>
                    <div class="resetCard bg-white p-3 p-md-3 p-lg-5 mt-5">
                        <div class="form-group mb-3">
                            <label class="mb-1">Email</label>
                            <input class="form-control form-control-lg" type="email" placeholder="i.e. john@mail.com">
                        </div>
                        <button onclick="window.location.href = 'verification.php';" class="btn btn-primary w-100 mt-3">
                            Send Email
                        </button>

                        <div class="linkText mt-4">
                            <span>Remembered the password? <a class="text-decoration-none" href="login">Sign in now</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>

