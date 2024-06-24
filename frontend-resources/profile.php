<?php include_once 'includes/headerLinks.php'; ?>
<main class="bg-white">
    <div id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
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
                <div class="position-absolute profile">
                    <div class="d-flex align-items-center justify-content-between px-5">
                        <div></div>
                        <div class="profile_upload">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <form action="" method="post" id="form-image">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                        <label for="imageUpload">
                                            <img src="assets/icon16.svg">
                                        </label>
                                    </form>
                                </div>
                                <div class="avatar-preview">
                                    <img class="profile-user-img img-responsive img-circle" id="imagePreview"
                                         src="assets/profile.png" alt="User profile picture">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 toggler justify-content-end pt-3">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                            <span>Visibility</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-0 px-md-2 px-lg-3 pt-5 ">
                <div class="row mx-0 pt-5">
                    <div class="col-lg-6 mb-3 mx-auto">
                        <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Name</span><span class="d-flex align-items-center gap-2"><img
                                                src="assets/icon11.svg" alt="">Public</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="text" placeholder="Muhammad Usama">
                                        <a class="text-decoration-none" href=""><img src="assets/pencil.svg"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Phone</span><span class="d-flex align-items-center gap-2"><img
                                                src="assets/icon11.svg" alt="">Public</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="text" placeholder="+133-983-0942-1675">
                                        <a class="text-decoration-none" href=""><img src="assets/pencil.svg"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Email</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="email" placeholder="i.e. support@peopleconnect.com">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Password</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="email" placeholder="012345678">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Email</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="email" placeholder="i.e. support@peopleconnect.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="col-lg-6 ps-0">
                                    <div class="form-group mb-3">
                                        <label class="mb-1"><span>Gender</span></label>
                                        <select class="form-select form-select-lg">
                                            <option selected>Male</option>
                                            <option value="1">Female</option>
                                            <option value="2">TransGender</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="form-group mb-3">
                                        <label class="mb-1 d-flex align-items-center justify-content-between">
                                            <span>Age</span>
                                        </label>
                                        <div class="form-control form-control-lg">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <input class="w-100" type="text" placeholder="24">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        <label class="mb-1 d-flex align-items-center justify-content-between">
                                            <span>State</span>
                                        </label>
                                        <div class="form-control form-control-lg">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <input class="w-100" type="text" placeholder="California">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Define yourself</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <textarea rows="6" class="w-100" placeholder="Type you message"></textarea>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 mt-3">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'includes/footerLinks.php'; ?>
<script>
    $(document).ready(function () {
        $("#profileInfo").addClass('active');
    });
</script>

