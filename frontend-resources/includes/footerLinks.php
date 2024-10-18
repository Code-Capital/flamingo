<script src="js/jquery-3.6.3.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".multipleChosen").chosen({
            placeholder_text_multiple: "" //placeholder
        });
    })

</script>
<script>
    $(document).ready(function () {
        $("#imageUpload").change(function (data) {
            var imageFile = data.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onload = function (evt) {
                $('#imagePreview').attr('src', evt.target.result);
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
        });
    });
</script>
<script>
    $("#imageUpload").change(function () {
        const fileName = this.files[0]?.name; // Get the first selected file's name
        const $fileNameSpan = $("#fileNameSpan");

        if (fileName) {
            $fileNameSpan.text(fileName); // Show the file name
        } else {
            $fileNameSpan.text(""); // If no file, ensure it's empty
        }
    });
</script>
<script>
    const $button = document.querySelector('.sidebar-toggle');
    const $wrapper = document.querySelector('#wrapper');

    $button.addEventListener('click', (e) => {
        e.preventDefault();
        $wrapper.classList.toggle('toggled');
    });

    document.addEventListener("DOMContentLoaded", () => {
        function handleResize() {
            console.log({this})
        }

        document.addEventListener('resize', handleResize)
    })
</script>
<script>
    $(".chatBtn").click(function () {
        $(".chatSidebar").toggleClass("chatSidebarshow");
    });
</script>

</body>
</html>
