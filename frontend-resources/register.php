<?php include_once 'includes/header.php'; ?>
<main>
    <div class="registerWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <div class="col-lg-5 mx-auto px-0">
                    <div class="text-center pt-2">
                        <h2>Register</h2>
                        <p class="px-0 px-md-3 px-lg-5">
                            To begin your journey, sign up here and unlock endless possibilities
                        </p>
                    </div>
                    <div class="registerCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                        <div class="form-group mb-3">
                            <label class="mb-1">Name</label>
                            <input class="form-control form-control-lg" type="text" placeholder="John Doe">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">Username</label>
                            <input class="form-control form-control-lg" type="text" placeholder="i.e. John_Doe466">
                        </div>
                        <div class="form-group mb-3 position-relative">
                            <label class="mb-1">Interest <span>(from 1 to 5)</span></label>
                            <div class="position-absolute arrow"><img src="assets/icon18.svg"></div>
                            <select class="multipleChosen form-select" multiple=>

                                <option value="1">Happiness</option>
                                <option value="2">Worklife</option>
                                <option value="3">Good</option>
                                <option value="4">Good</option>
                                <option value="5">Good</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">Email</label>
                            <input class="form-control form-control-lg" type="email" placeholder="i.e. john@mail.com">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">Password</label>
                            <input class="form-control form-control-lg" type="password" placeholder="**********">
                        </div>
                        <a href="visitors" class="btn btn-primary w-100 mt-3">
                            Register
                        </a>
                        <div class="linkText mt-3">
                            <span>Already have an account? <a class="text-decoration-none" href="login">Login</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>

