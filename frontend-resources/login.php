<?php include_once 'includes/header.php'; ?>
<main>
    <div class="loginWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <div class="col-lg-5 mx-auto px-0">
                    <div class="text-center pt-2">
                        <h2>Login</h2>
                        <p class="px-0 px-md-3 px-lg-5">
                            To embark on your journey, take the first step by signing in here
                        </p>
                    </div>
                    <div class="loginCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                        <div class="form-group mb-3">
                            <label class="mb-1">Username</label>
                            <input class="form-control form-control-lg" type="email" placeholder="Username">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1">Password</label>
                            <input class="form-control form-control-lg" type="password" placeholder="**********">
                        </div>
                        <div class="text-end">
                            <a href="reset" class="text-decoration-none link">
                                Forgot password?
                            </a>
                        </div>
                        <div>
                            <label class="formCheckBox d-flex align-items-center gap-2" >
                                <input class="form-check-input" type="checkbox" >
                                <span class="mt-1">Remember me</span>
                            </label>
                        </div>
                        <a href="visitors" class="btn btn-primary w-100 mt-3">
                            Sign in
                        </a>

                        <div class="linkText mt-3">
                            <span>Don’t have an account? <a class="text-decoration-none" href="register">Create an account</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include_once 'includes/footer.php'; ?>

