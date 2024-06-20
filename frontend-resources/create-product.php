<?php include_once 'includes/headerLinks.php'; ?>
<main>
    <div  id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
        <?php include_once 'includes/dashboardSideBar.php'; ?>
        <div id="content-wrapper" class="contentWrapper h-100">
            <div class="hero">
                <div class="bg-primary">
                    <a id="sidebar-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div class="px-2 px-md-3 px-lg-5 bg-white pb-4">
                    <div class="d-flex align-items-center justify-content-between gap-4 pb-3">
                        <div class="profile position-relative">
                            <img class="position-absolute" src="assets/profile.png">
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-grow-1 pt-4">
                            <div class="name">
                                <span class="d-block">Muhammad Usama</span>
                                <span class="d-block pt-2">Visitor</span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <div class="notifications position-relative">
                                    <a class="text-decoration-none" href="notification">
                                        <img src="assets/bell.svg">
                                        <span class="position-absolute dot"></span>
                                    </a>
                                </div>
                                <button class="btn btn-primary">Create New Listing</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container  px-md-2 px-lg-5 py-5 ">
                <div class="bg-white createProduct">
                    <div class="row mx-0 py-5">
                        <div class="col-lg-6 mb-3 mx-auto">
                            <div class="createProductForm bg-white py-4">
                                <label class="imageUploadLabel mx-auto mb-3 mb-md-4 mb-lg-5 px-4 py-3 d-flex align-items-center justify-content-center" for="imageUpload">
                                    <div class="imageUploadWrapper d-flex align-items-center justify-content-between flex-column">
                                        <img class="mb-2" src="assets/imageUpload.svg">
                                        <h5 class="mb-2">Add Photos</h5>
                                        <p class="mb-0">or drag and drop</p>
                                        <span id="fileNameSpan"></span>
                                    </div>
                                    <input id="imageUpload" type="file" style="display: none;">

                                </label>
                                <div class="form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Product Title</span>
                                    </label>
                                    <input class="w-100 form-control form-control-lg" type="text" placeholder="Family Room Couch">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Product Price</span>
                                    </label>
                                    <input class="w-100 form-control form-control-lg" type="text" placeholder="$320.00">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Product Description</span>
                                    </label>
                                    <textarea rows="6" class="w-100 form-control form-control-lg" placeholder="About the product"></textarea>
                                </div>
                                <div class="form-group mb-3 mt-5">
                                    <label class="mb-3 d-flex align-items-center justify-content-between">
                                        <span>Others</span>
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-2">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="checkboxLabel">Allow all to ‘view’</span>
                                    </label>
                                    <label class="d-flex align-items-center gap-2">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="checkboxLabel">Hide from my friends</span>
                                    </label>
                                </div>

                                <button class="btn btn-primary w-100 mt-3">
                                    Create Listing
                                </button>
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
        $("#shop").addClass('active');
    });
</script>

