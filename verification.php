<?php include_once 'includes/header.php'; ?>
<main>
    <div class="verificationWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <div class="col-lg-5 mx-auto px-0">
                    <div class="text-center pt-4">
                        <h2>Verification Code</h2>
                        <p class="px-0 px-md-3 px-lg-5">
                            Check your email for the verification code to reset your password.
                        </p>
                    </div>
                    <div class="verificationCard bg-white p-3 p-md-3 p-lg-5 mt-5">
                        <div class="form-group mb-3">
                            <label class="mb-1">Enter Code Here</label>
                            <div class="d-flex align-items-center justify-content-center gap-2 mt-5 mb-4">
                                <input class="form-control form-control-lg" type="text">
                                <input class="form-control form-control-lg" type="text">
                                <input class="form-control form-control-lg" type="text">
                                <input class="form-control form-control-lg" type="text">
                                <input class="form-control form-control-lg" type="text">
                                <input class="form-control form-control-lg" type="text">
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">
                            Send Email
                        </button>

                        <div class="linkText mt-3">
                            <span>Resend code in 57s</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>

