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
                            <div class="gallery">
                                <div class="d-flex align-items-center justify-content-between pb-4 ">
                                    <button class="btn btn-primary px-4" >Gallery</button>
                                    <label for="upload">
                                        <input id="upload" type="file" class="px-4 d-none">
                                        <div class="btn btn-outline-primary">Upload</div>
                                    </label>

                                </div>
                                <div class="d-flex align-items-center pt-4 gap-4 flex-wrap">
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
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
        // Toggle upload form visibility
        $("#toggleUpload").click(function() {
            $("#uploadForm").toggle();
        });

        // Display a preview when an image is selected
        $("#fileInput").change(function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#previewImg").attr("src", e.target.result);
                    $("#imagePreview").show();
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle the upload action
        $("#uploadButton").click(function() {
            const formData = new FormData($("#fileUploadForm")[0]);

            $.ajax({
                url: "uploadImage.php", // Endpoint to handle the file upload
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("Upload success:", response);
                    // Optionally, hide the form or reset it after a successful upload
                    $("#uploadForm").hide();
                },
                error: function(err) {
                    console.error("Upload failed:", err);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#gallery").addClass('active');
    });
</script>
