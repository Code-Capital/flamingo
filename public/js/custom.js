function loadingStart(title = "Loading...") {
    return Swal.fire({
        title: title,
        allowEscapeKey: false,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
}

function loadingStop() {
    if (swal) {
        swal.close();
    }
}

function renderPagination(data, container) {
    let html = "";

    if (data.data && data.data.length > 0) {
        html += `<div class="post-pagination wow fadeInUp" data-wow-delay="0.10s">
            <ul class="pagination">`;

        if (data.prev_page_url !== null) {
            html += `<li><a href="javascript:void(0)" data-page="${
                data.current_page - 1
            }"><i class="fa-solid fa-arrow-left-long"></i></a></li>`;
        }

        for (let i = 1; i <= data.last_page; i++) {
            html += `<li class="${
                data.current_page == i ? "active" : ""
            }"><a href="javascript:void(0)" data-page="${i}">${i}</a></li>`;
        }

        if (data.next_page_url !== null) {
            html += `<li><a href="javascript:void(0)" data-page="${
                data.current_page + 1
            }"><i class="fa-solid fa-arrow-right-long"></i></a></li>`;
        }

        html += `       </ul>
    </div>`;
    }

    $(container).html(html);
}

function limitString(string, limit = 15) {
    return string.length > limit ? string.substring(0, limit) + "..." : string;
}

function formatTimestampHumanReadable(timestamp) {
    let currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
    let timestampSeconds = Math.floor(new Date(timestamp).getTime() / 1000); // Timestamp in seconds

    let difference = currentTime - timestampSeconds;

    // Define time intervals in seconds
    let intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60,
    };

    // Loop through intervals to find the appropriate one
    for (let key in intervals) {
        let value = Math.floor(difference / intervals[key]);
        if (value >= 1) {
            return value + " " + key + (value > 1 ? "s" : "") + " ago";
        }
    }

    return "Just now";
}

function errorNotificationSound() {
    let audio = new Audio("/audio/error.mp3");
    audio.play();
}

function liveChatSound() {
    let audio = new Audio("/audio/livechat.mp3");
    audio.play();
}

function newNotificationSound() {
    let audio = new Audio("/audio/new-notification.mp3");
    audio.play();
}

function notificationSound() {
    let audio = new Audio("/audio/notification.mp3");
    audio.play();
}

function systemNotificationSound() {
    let audio = new Audio("/audio/system-notification.mp3");
    audio.play();
}

function typingSound() {
    let audio = new Audio("/audio/whatsapp-typing.mp3");
    audio.play();
}

document.addEventListener("DOMContentLoaded",()=>{
    GLightbox({
        selector: '.js-gallery',
        loop: false,
        touchNavigation: true,
    });

})
