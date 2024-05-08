<?php include_once 'includes/headerLinks.php'; ?>
<main>
    <div id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
        <?php include_once 'includes/dashboardSideBar.php'; ?>
        <div id="content-wrapper" class="contentWrapper h-100">
            <?php include_once 'includes/dashboardHeader.php'; ?>
            <div class="container px-0 px-md-2 px-lg-3 ">
                <div class="row mx-0 pt-5">
                    <div class="col-lg-12 mb-3">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="notification">
                                <div class="d-flex align-items-center justify-content-between pb-4 ">
                                    <button class="btn btn-primary" >Notifications</button>
                                    <button class="btn btn-outline-primary">Mark all as read</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between singleMessage py-4 border-top px-4">
                                    <div class="d-flex align-items-start gap-3 ">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <p class="mb-0">Hey Usama, we’ve got a new opportunity for you. Ahmad Ali from the CodeCapital Office is looking for people like you.</p>
                                    </div>
                                    <a class="text-decoration-none" href="">
                                        <img src="assets/cross.svg">
                                    </a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between singleMessage py-4 border-top px-4">
                                    <div class="d-flex align-items-start gap-3 ">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <p class="mb-0">Hey Usama, we’ve got a new opportunity for you. Ahmad Ali from the CodeCapital Office is looking for people like you.</p>
                                    </div>
                                    <a class="text-decoration-none" href="">
                                        <img src="assets/cross.svg">
                                    </a>
                                </div>
                                <div class="d-flex align-items-center justify-content-between singleMessage py-4 border-top px-4">
                                    <div class="d-flex align-items-start gap-3 ">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <p class="mb-0">Hey Usama, we’ve got a new opportunity for you. Ahmad Ali from the CodeCapital Office is looking for people like you.</p>
                                    </div>
                                    <a class="text-decoration-none" href="">
                                        <img src="assets/cross.svg">
                                    </a>
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
        $("#profileInfo").addClass('active');
    });
</script>
