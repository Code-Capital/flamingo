<?php include_once 'includes/headerLinks.php'; ?>
<main>
    <div id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
        <?php include_once 'includes/dashboardSideBar.php'; ?>
        <div id="content-wrapper" class="contentWrapper h-100">
            <?php include_once 'includes/dashboardHeader.php'; ?>
            <div class="container px-0 px-md-2 px-lg-3 ">
                <div class="row mx-0 pt-5">
                    <div class="col-lg-8 mb-3">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="innerCard p-3 bg-white">
                                <div class="avatar align-items-center gap-3 py-4">
                                    <img class="rounded-circle" src="assets/profile.png">
                                    <input class="border-0 form-control " type="text" placeholder="What's on your mind?">
                                </div>
                                <div class="border-top d-flex align-items-center justify-content-between pt-3">

                                    <div class="d-flex align-items-center gap-4">
                                        <div class="text">
                                            <img src="assets/icon9.svg">
                                            <span>Photo</span>
                                        </div>
                                        <div class="text">
                                            <div class="d-flex align-items-center gap-1">
                                                <img src="assets/icon11.svg">
                                                <select class="form-select border-0 p-0 custom-select-styling">
                                                    <option value="">Public</option>
                                                    <option value="">Private</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary px-4">Post</button>
                                    </div>
                                </div>
                            </div>
                            <div class="innerCard p-3 bg-white mt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="avatar align-items-center gap-3 py-4">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <div class="details">
                                            <span class="d-block">Muhammad Usama</span>
                                            <span class="d-block">UI/UX Designer</span>
                                            <span class="d-block small">25 Nov at 12:24 PM</span>
                                        </div>
                                    </div>
                                    <div class="">

                                    </div>
                                </div>
                                <p class="detailsText">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                                <img class="img-fluid" src="assets/feedImage1.png">
                                <div class="likes align-items-center justify-content-between pt-4">
                                    <div class="d-flex align-items-center gap-4 ">
                                        <div class="text d-flex align-items-center gap-3">
                                            <img src="assets/icon12.svg">
                                            <span>14</span>
                                        </div>
                                        <div class="text d-flex align-items-center gap-3">
                                            <img src="assets/icon13.svg">
                                            <span>14</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="innerCard p-3 bg-white mt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="avatar align-items-center gap-3 py-4">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <div class="details">
                                            <span class="d-block">Muhammad Usama</span>
                                            <span class="d-block">UI/UX Designer</span>
                                            <span class="d-block small">25 Nov at 12:24 PM</span>
                                        </div>
                                    </div>
                                    <div class="">

                                    </div>
                                </div>
                                <p class="detailsText">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                                <div class="likes align-items-center justify-content-between pt-4">
                                    <div class="d-flex align-items-center gap-4 ">
                                        <div class="text d-flex align-items-center gap-3">
                                            <img src="assets/icon12.svg">
                                            <span>14</span>
                                        </div>
                                        <div class="text d-flex align-items-center gap-3">
                                            <img src="assets/icon13.svg">
                                            <span>14</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="comments">
                                <h5 class="py-3">Comments:</h5>
                                <div class="commentbox p-3">
                                    <div class="d-flex align-items-start gap-2">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <div class="content">
                                            <h5 class="mb-1">Elon Musk</h5>
                                            <p class="mb-3">Nice idea!! keep up the great work!</p>
                                            <div class="d-flex align-items-center gap-3">
                                                <a class="text-decoration-none" href=""><span>14</span> Likes</a>
                                                <a class="text-decoration-none" href="">Like</a>
                                                <a class="text-decoration-none" href="">Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <div class="position-absolute">
                                        <img src="assets/commentImg.svg" >
                                    </div>
                                </div>
                                <div class="reply p-3 ms-5 mt-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <img class="rounded-circle" src="assets/profile.png">
                                        <div class="content">
                                            <h5 class="mb-1">Muhammad Usama</h5>
                                            <p class="mb-3">Thanks Musk!!</p>
                                            <div class="d-flex align-items-center gap-3">
                                                <a class="text-decoration-none" href="">Like</a>
                                                <a class="text-decoration-none" href="">Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="bg-white p-4 dashboardCard mt-4">
                            <div class="d-flex align-items-center flex-column justify-content-center noResult">
                                <img src="assets/secure.svg">
                                <h2 class="mb-0 py-3">This Account is Private</h2>
                                <p>Follow this account to see their Friends and Photos</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div class="bg-white p-4 dashboardCard ">
                            <h5>People you may know</h5>
                            <div class="list">
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="singlePerson py-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="avatarWrapper">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="image position-relative">
                                                    <img src="assets/profile.png">
                                                    <span class="position-absolute"></span>
                                                </div>

                                                <div class="details">
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttonWrapper">
                                            <div class="d-flex align-items-center gap-1 flex-column">
                                                <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                   class="text-decoration-none">
                                                    <img src="assets/icon7.svg">
                                                </a>
                                                <span class="d-block">Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-0 mt-3">See more...</h5>


                        </div>
                        <div class="bg-white p-4 dashboardCard mt-4">
                            <h5>Advertizement</h5>
                            <img class="img-fluid" src="assets/feedImage.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="joinCommunity" tabindex="-1" aria-labelledby="joinCommunityLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-3 p-md-3 p-lg-5">
                    <div class="text-center px-0 px-md-0 px-lg-5">
                        <img src="assets/icon8.svg">
                        <h1 class="my-4">Join Our Community</h1>
                        <p>Ready to dive in? Join our community today to start connecting, sharing, and discovering with
                            individuals who share your interests and passions. Subscribe now to become part of our
                            growing community!</p>
                        <a href="friends-feed" type="button" class="btn btn-primary mt-5 px-4">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'includes/footerLinks.php'; ?>
<script>
    $(document).ready(function() {
        $("#feed").addClass('active');
    });
</script>
