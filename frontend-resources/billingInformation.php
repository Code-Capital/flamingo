<?php include_once 'includes/headerLinks.php'; ?>
    <main>
        <div id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
            <?php include_once 'includes/dashboardSideBar.php'; ?>
            <div id="content-wrapper"  class="contentWrapper h-100">
                <?php include_once 'includes/dashboardHeader.php'; ?>
                <div class="container px-0 px-md-2 px-lg-3 ">
                    <div class="row mx-0 pt-5">
                        <div class="col-lg-12">
                            <div class="bg-white p-4 dashboardCard">
                                <div class="row mx-0">
                                    <div class="col-lg-6 mb-3">
                                        <div class="formContent">
                                            <h1 class="mb-5">
                                                Billing Information
                                            </h1>

                                            <div class="form-group mb-3">
                                                <label class="mb-1">Name</label>
                                                <input class="form-control form-control-lg" type="text"
                                                       placeholder="Muhammad Usama">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Phone</label>
                                                <input class="form-control form-control-lg" type="text"
                                                       placeholder="+133-983-0942-1675">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Email</label>
                                                <input class="form-control form-control-lg" type="email"
                                                       placeholder="i.e. support@flamingo.com">
                                            </div>
                                            <div class="row mx-0">
                                                <div class="col-lg-6 ps-0">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Country</label>
                                                        <select class="form-select form-select-lg">
                                                            <option selected>USA</option>
                                                            <option value="1">UK</option>
                                                            <option value="2">UAE</option>
                                                            <option value="3">EUROPE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 pe-0">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">California</label>
                                                        <input class="form-control form-control-lg" type="email"
                                                               placeholder="i.e. support@flamingo.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mb-5 mt-4">
                                                Payment Details
                                            </h1>
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Enter Name on Card</label>
                                                <input class="form-control form-control-lg" type="text"
                                                       placeholder="Muhammad Usama">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Card Number</label>
                                                <input class="form-control form-control-lg" type="text"
                                                       placeholder="0000 0000 0000 0000">
                                            </div>
                                            <div class="row mx-0">
                                                <div class="col-lg-6 ps-0">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">Expire Date</label>
                                                        <input class="form-control form-control-lg" type="email"
                                                               placeholder="21-03-2024">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 pe-0">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-1">CVV</label>
                                                        <input class="form-control form-control-lg" type="email"
                                                               placeholder="345">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="formContent">
                                            <div class=" d-flex align-items-center justify-content-between">
                                                <div class="plans">
                                                    <span class="d-block">Basic Plan</span>
                                                    <span class="d-block">For Indivituals</span>
                                                </div>
                                                <div class="duration">
                                                    <span>$ 99</span>
                                                    <span>/ monthly</span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 d-flex gap-3 mt-3">
                                                <input class="form-control form-control-lg" type="text"
                                                       placeholder="Coupon Code">
                                                <button class="btn btn-primary px-3">Apply</button>
                                            </div>
                                            <div class=" d-flex align-items-center justify-content-between subtotal mb-3">
                                                <h6 class="mb-0">Subtotal</h6>
                                                <h6 class="mb-0">$ 99.00</h6>
                                            </div>
                                            <div class=" d-flex align-items-center justify-content-between total mb-3">
                                                <h6 class="mb-0">Total</h6>
                                                <h6 class="mb-0">$ 99.00</h6>
                                            </div>
                                            <div class="form-group mb-4 mt-3">

                                                <a href="confirmation" class="btn btn-primary px-3 w-100">Submit</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include_once 'includes/footerLinks.php'; ?>
<script>
    $(document).ready(function() {
        $("#visitors").addClass('active');
    });
</script>
