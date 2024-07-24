<aside id="sidebar-wrapper">
    <div class="sidebar h-100 bg-white p-4">
        <div class="logo pb-4 text-center">
            <a class="text-decoration-none" href="{{ route('home') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="">
            </a>
        </div>
        <ul class="list-unstyled px-2">
            <li>
                <a id="announcement" href="{{ route('announcements.index') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('announcements') ? 'active' : '' }}">
                    <svg class="announcement" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_7316)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.0002 5.24092V8.49992C19.3941 8.49992 19.7842 8.57751 20.1482 8.72828C20.5122 8.87904 20.8429 9.10002 21.1215 9.3786C21.4001 9.65717 21.6211 9.98789 21.7718 10.3519C21.9226 10.7158 22.0002 11.106 22.0002 11.4999C22.0002 11.8939 21.9226 12.284 21.7718 12.648C21.6211 13.0119 21.4001 13.3427 21.1215 13.6212C20.8429 13.8998 20.5122 14.1208 20.1482 14.2716C19.7842 14.4223 19.3941 14.4999 19.0002 14.4999V17.4999C19.0002 19.1479 17.1192 20.0889 15.8002 19.0999L13.7402 17.5539C12.639 16.7283 11.3569 16.177 10.0002 15.9459V18.7899C10.0003 19.4437 9.76407 20.0754 9.33507 20.5687C8.90608 21.062 8.31322 21.3836 7.66579 21.4742C7.01836 21.5648 6.35999 21.4183 5.81205 21.0618C5.26412 20.7052 4.86354 20.1626 4.68417 19.5339L3.11417 14.0379C2.54919 13.3707 2.18151 12.5591 2.05246 11.6944C1.92341 10.8297 2.03811 9.94615 2.38366 9.14306C2.72921 8.33996 3.29192 7.64916 4.00853 7.14831C4.72513 6.64747 5.56724 6.35643 6.44017 6.30792L9.45817 6.13992C10.9348 6.05775 12.3708 5.62625 13.6482 4.88092L15.9922 3.51292C17.3262 2.73592 19.0002 3.69692 19.0002 5.24092ZM5.63417 15.5779L6.60717 18.9849C6.654 19.1498 6.75892 19.2922 6.90255 19.3858C7.04618 19.4794 7.21883 19.5179 7.38861 19.4941C7.55839 19.4704 7.71383 19.386 7.82624 19.2565C7.93865 19.1271 8.00043 18.9614 8.00017 18.7899V15.7799L6.44017 15.6929C6.1687 15.6779 5.89903 15.6394 5.63417 15.5779ZM17.0002 5.24092L14.6552 6.60992C13.2305 7.44036 11.642 7.9502 10.0002 8.10392V13.9229C11.7872 14.1689 13.4882 14.8659 14.9402 15.9539L17.0002 17.4999V5.24092ZM8.00017 8.22392L6.55017 8.30392C5.87562 8.34116 5.23954 8.62994 4.76749 9.11324C4.29544 9.59654 4.02173 10.2392 4.00038 10.9145C3.97903 11.5897 4.2116 12.2484 4.65217 12.7606C5.09275 13.2728 5.70932 13.6011 6.38017 13.6809L6.55017 13.6959L8.00017 13.7759V8.22392ZM19.0002 10.4999V12.4999C19.2551 12.4996 19.5002 12.402 19.6855 12.2271C19.8709 12.0521 19.9824 11.813 19.9973 11.5585C20.0123 11.3041 19.9295 11.0535 19.7659 10.8581C19.6023 10.6626 19.3703 10.537 19.1172 10.5069L19.0002 10.4999Z"
                                fill="#5C5C5C" fill-opacity="0.3" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_7316">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Announcement</span>
                </a>
            </li>

            <li>
                <a id="profileInfo" href="{{ route('profile.info') }}"
                    class="text-decoration-none d-flex align-items-center  {{ request()->is('profile/*') ? 'active' : '' }}">
                    <svg class="profile" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 18.5C4 17.4391 4.42143 16.4217 5.17157 15.6716C5.92172 14.9214 6.93913 14.5 8 14.5H16C17.0609 14.5 18.0783 14.9214 18.8284 15.6716C19.5786 16.4217 20 17.4391 20 18.5C20 19.0304 19.7893 19.5391 19.4142 19.9142C19.0391 20.2893 18.5304 20.5 18 20.5H6C5.46957 20.5 4.96086 20.2893 4.58579 19.9142C4.21071 19.5391 4 19.0304 4 18.5Z"
                            stroke="#5C5C5C" stroke-opacity="0.3" stroke-width="1.5" stroke-linejoin="round" />
                        <path
                            d="M12 10.5C13.6569 10.5 15 9.15685 15 7.5C15 5.84315 13.6569 4.5 12 4.5C10.3431 4.5 9 5.84315 9 7.5C9 9.15685 10.3431 10.5 12 10.5Z"
                            stroke="#5C5C5C" stroke-opacity="0.3" stroke-width="1.5" />
                    </svg>
                    <span>About</span>
                </a>
            </li>

            <li>
                <a id="feed" href="{{ route('feed') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('feed') ? 'active' : '' }}">
                    <svg class="feed" width="24" fill="#5C5C5C" fill-opacity="0.3" height="25"
                        viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.81687 21C4.29937 21 3.86737 20.8268 3.52087 20.4803C3.17362 20.133 3 19.7006 3 19.1831V4.81687C3 4.29937 3.17362 3.86737 3.52087 3.52087C3.86737 3.17362 4.29937 3 4.81687 3H16.0241L21 7.97588V19.1831C21 19.7006 20.8268 20.1326 20.4803 20.4791C20.133 20.8264 19.7006 21 19.1831 21H4.81687ZM4.81687 19.875H19.1831C19.3849 19.875 19.5506 19.8101 19.6804 19.6804C19.8101 19.5506 19.875 19.3849 19.875 19.1831V8.625H15.375V4.125H4.81687C4.61512 4.125 4.44937 4.18987 4.31962 4.31962C4.18987 4.44937 4.125 4.61512 4.125 4.81687V19.1831C4.125 19.3849 4.18987 19.5506 4.31962 19.6804C4.44937 19.8101 4.61512 19.875 4.81687 19.875ZM6.9375 16.5H17.0625V15.375H6.9375V16.5ZM6.9375 8.625H12V7.5H6.9375V8.625ZM6.9375 12.5625H17.0625V11.4375H6.9375V12.5625Z" />
                    </svg>

                    <span>Feed</span>
                </a>
            </li>

            <li>
                <a id="events" href="{{ route('user.friends') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('my/friends/*') ? 'active' : '' }}">
                    <svg class="events" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.2456 19.1337C14.5879 19.1337 14.0265 18.9012 13.5615 18.4362C13.0972 17.9727 12.8651 17.4121 12.8651 16.7544C12.8651 16.0966 13.0976 15.5353 13.5626 15.0703C14.0269 14.606 14.5879 14.3739 15.2456 14.3739C15.9034 14.3739 16.4644 14.6064 16.9286 15.0714C17.3929 15.5356 17.625 16.0966 17.625 16.7544C17.625 17.4121 17.3925 17.9731 16.9275 18.4374C16.464 18.9016 15.9034 19.1337 15.2456 19.1337ZM4.81687 22.5087C4.29937 22.5087 3.86737 22.3355 3.52087 21.989C3.17362 21.6417 3 21.2094 3 20.6919V6.32562C3 5.80812 3.17362 5.37612 3.52087 5.02962C3.86737 4.68237 4.29937 4.50875 4.81687 4.50875H6.80813V2H8.01975V4.50875H16.0669V2H17.1919V4.50875H19.1831C19.7006 4.50875 20.1326 4.68237 20.4791 5.02962C20.8264 5.37612 21 5.80812 21 6.32562V20.6919C21 21.2094 20.8268 21.6414 20.4803 21.9879C20.133 22.3351 19.7006 22.5087 19.1831 22.5087H4.81687ZM4.81687 21.3837H19.1831C19.3556 21.3837 19.5143 21.3118 19.659 21.1678C19.803 21.023 19.875 20.8644 19.875 20.6919V10.8256H4.125V20.6919C4.125 20.8644 4.197 21.023 4.341 21.1678C4.48575 21.3118 4.64437 21.3837 4.81687 21.3837ZM4.125 9.70062H19.875V6.32562C19.875 6.15312 19.803 5.9945 19.659 5.84975C19.5143 5.70575 19.3556 5.63375 19.1831 5.63375H4.81687C4.64437 5.63375 4.48575 5.70575 4.341 5.84975C4.197 5.9945 4.125 6.15312 4.125 6.32562V9.70062Z"
                            fill="#5C5C5C" fill-opacity="0.3" />
                    </svg>
                    <span>My Friends</span>
                </a>
            </li>

            <li>
                <a id="events" href="{{ route('events.index') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('events') ? 'active' : '' }}">
                    <svg class="events" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.2456 19.1337C14.5879 19.1337 14.0265 18.9012 13.5615 18.4362C13.0972 17.9727 12.8651 17.4121 12.8651 16.7544C12.8651 16.0966 13.0976 15.5353 13.5626 15.0703C14.0269 14.606 14.5879 14.3739 15.2456 14.3739C15.9034 14.3739 16.4644 14.6064 16.9286 15.0714C17.3929 15.5356 17.625 16.0966 17.625 16.7544C17.625 17.4121 17.3925 17.9731 16.9275 18.4374C16.464 18.9016 15.9034 19.1337 15.2456 19.1337ZM4.81687 22.5087C4.29937 22.5087 3.86737 22.3355 3.52087 21.989C3.17362 21.6417 3 21.2094 3 20.6919V6.32562C3 5.80812 3.17362 5.37612 3.52087 5.02962C3.86737 4.68237 4.29937 4.50875 4.81687 4.50875H6.80813V2H8.01975V4.50875H16.0669V2H17.1919V4.50875H19.1831C19.7006 4.50875 20.1326 4.68237 20.4791 5.02962C20.8264 5.37612 21 5.80812 21 6.32562V20.6919C21 21.2094 20.8268 21.6414 20.4803 21.9879C20.133 22.3351 19.7006 22.5087 19.1831 22.5087H4.81687ZM4.81687 21.3837H19.1831C19.3556 21.3837 19.5143 21.3118 19.659 21.1678C19.803 21.023 19.875 20.8644 19.875 20.6919V10.8256H4.125V20.6919C4.125 20.8644 4.197 21.023 4.341 21.1678C4.48575 21.3118 4.64437 21.3837 4.81687 21.3837ZM4.125 9.70062H19.875V6.32562C19.875 6.15312 19.803 5.9945 19.659 5.84975C19.5143 5.70575 19.3556 5.63375 19.1831 5.63375H4.81687C4.64437 5.63375 4.48575 5.70575 4.341 5.84975C4.197 5.9945 4.125 6.15312 4.125 6.32562V9.70062Z"
                            fill="#5C5C5C" fill-opacity="0.3" />
                    </svg>
                    <span>My Events</span>
                </a>
            </li>

            <li>
                <a id="search" href="{{ route('search.users') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('search/*') ? 'active' : '' }}">
                    <svg fill-opacity="0.3" class="search" width="24" height="25" viewBox="0 0 24 25"
                        fill="#5C5C5C" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_7272)">
                            <path
                                d="M10.8869 3.86667C12.331 3.86535 13.743 4.29236 14.9444 5.0937C16.1457 5.89503 17.0824 7.03467 17.636 8.36846C18.1895 9.70224 18.335 11.1702 18.0541 12.5867C17.7732 14.0032 17.0784 15.3046 16.0578 16.3262C15.0371 17.3478 13.7364 18.0437 12.3202 18.3259C10.9039 18.6081 9.43579 18.4639 8.10151 17.9116C6.76722 17.3593 5.62672 16.4236 4.82429 15.223C4.02186 14.0224 3.59355 12.6108 3.59355 11.1667C3.60231 9.23444 4.37331 7.38374 5.73899 6.01681C7.10467 4.64988 8.95466 3.87719 10.8869 3.86667ZM10.8869 2.5C9.17278 2.5 7.49717 3.00829 6.07194 3.9606C4.64672 4.9129 3.53589 6.26645 2.87993 7.85008C2.22397 9.4337 2.05234 11.1763 2.38675 12.8575C2.72115 14.5386 3.54657 16.0829 4.75863 17.2949C5.97068 18.507 7.51493 19.3324 9.1961 19.6668C10.8773 20.0012 12.6198 19.8296 14.2035 19.1736C15.7871 18.5177 17.1407 17.4068 18.093 15.9816C19.0453 14.5564 19.5536 12.8808 19.5536 11.1667C19.5536 8.86812 18.6405 6.66372 17.0151 5.03841C15.3898 3.41309 13.1854 2.5 10.8869 2.5Z" />
                            <path
                                d="M23.3331 22.6932L18.4198 17.7466L17.4731 18.6866L22.3865 23.6332C22.4482 23.6954 22.5216 23.7448 22.6024 23.7786C22.6832 23.8124 22.7699 23.83 22.8575 23.8303C22.9451 23.8306 23.0319 23.8136 23.1129 23.7804C23.1939 23.7472 23.2677 23.6983 23.3298 23.6366C23.392 23.5749 23.4414 23.5015 23.4752 23.4207C23.509 23.3399 23.5265 23.2532 23.5269 23.1656C23.5272 23.078 23.5102 22.9912 23.477 22.9102C23.4437 22.8291 23.3949 22.7554 23.3331 22.6932Z" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_7272">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Search Users</span>
                </a>
            </li>

            <li>
                <a id="search" href="{{ route('search.events') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('search.events') ? 'active' : '' }}">
                    <svg fill-opacity="0.3" class="search" width="24" height="25" viewBox="0 0 24 25"
                        fill="#5C5C5C" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_7272)">
                            <path
                                d="M10.8869 3.86667C12.331 3.86535 13.743 4.29236 14.9444 5.0937C16.1457 5.89503 17.0824 7.03467 17.636 8.36846C18.1895 9.70224 18.335 11.1702 18.0541 12.5867C17.7732 14.0032 17.0784 15.3046 16.0578 16.3262C15.0371 17.3478 13.7364 18.0437 12.3202 18.3259C10.9039 18.6081 9.43579 18.4639 8.10151 17.9116C6.76722 17.3593 5.62672 16.4236 4.82429 15.223C4.02186 14.0224 3.59355 12.6108 3.59355 11.1667C3.60231 9.23444 4.37331 7.38374 5.73899 6.01681C7.10467 4.64988 8.95466 3.87719 10.8869 3.86667ZM10.8869 2.5C9.17278 2.5 7.49717 3.00829 6.07194 3.9606C4.64672 4.9129 3.53589 6.26645 2.87993 7.85008C2.22397 9.4337 2.05234 11.1763 2.38675 12.8575C2.72115 14.5386 3.54657 16.0829 4.75863 17.2949C5.97068 18.507 7.51493 19.3324 9.1961 19.6668C10.8773 20.0012 12.6198 19.8296 14.2035 19.1736C15.7871 18.5177 17.1407 17.4068 18.093 15.9816C19.0453 14.5564 19.5536 12.8808 19.5536 11.1667C19.5536 8.86812 18.6405 6.66372 17.0151 5.03841C15.3898 3.41309 13.1854 2.5 10.8869 2.5Z" />
                            <path
                                d="M23.3331 22.6932L18.4198 17.7466L17.4731 18.6866L22.3865 23.6332C22.4482 23.6954 22.5216 23.7448 22.6024 23.7786C22.6832 23.8124 22.7699 23.83 22.8575 23.8303C22.9451 23.8306 23.0319 23.8136 23.1129 23.7804C23.1939 23.7472 23.2677 23.6983 23.3298 23.6366C23.392 23.5749 23.4414 23.5015 23.4752 23.4207C23.509 23.3399 23.5265 23.2532 23.5269 23.1656C23.5272 23.078 23.5102 22.9912 23.477 22.9102C23.4437 22.8291 23.3949 22.7554 23.3331 22.6932Z" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_7272">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Search Events</span>
                </a>
            </li>

            <li>
                <a id="messages" href="{{ route('messages') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('messages') ? 'active' : '' }}">
                    <svg class="message" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 12.5H17M7 8.5H13" stroke="#5C5C5C" stroke-opacity="0.3" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M3 20.79V5.5C3 4.96957 3.21071 4.46086 3.58579 4.08579C3.96086 3.71071 4.46957 3.5 5 3.5H19C19.5304 3.5 20.0391 3.71071 20.4142 4.08579C20.7893 4.46086 21 4.96957 21 5.5V15.5C21 16.0304 20.7893 16.5391 20.4142 16.9142C20.0391 17.2893 19.5304 17.5 19 17.5H7.961C7.66123 17.5 7.36531 17.5675 7.09511 17.6973C6.82491 17.8271 6.58735 18.016 6.4 18.25L4.069 21.164C3.99143 21.2612 3.88556 21.3319 3.76604 21.3664C3.64652 21.4008 3.51926 21.3972 3.40186 21.3561C3.28446 21.315 3.18273 21.2385 3.11073 21.1371C3.03874 21.0357 3.00005 20.9144 3 20.79Z"
                            stroke="#5C5C5C" stroke-opacity="0.3" stroke-width="1.5" />
                    </svg>
                    <span>Messages</span>
                </a>
            </li>

            <li>
                <a id="gallery" href="{{ route('gallery') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('gallery') ? 'active' : '' }}">
                    <svg class="gallery" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22 12.5C22 17.214 22 19.571 20.535 21.035C19.072 22.5 16.714 22.5 12 22.5C7.286 22.5 4.929 22.5 3.464 21.035C2 19.572 2 17.214 2 12.5C2 7.786 2 5.429 3.464 3.964C4.93 2.5 7.286 2.5 12 2.5"
                            stroke="#5C5C5C" stroke-opacity="0.3" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M2 12.9999L3.752 11.4669C4.19114 11.083 4.75974 10.8802 5.34272 10.8997C5.9257 10.9192 6.47949 11.1595 6.892 11.5719L11.182 15.8619C11.5149 16.1947 11.9546 16.3995 12.4235 16.4401C12.8925 16.4807 13.3608 16.3546 13.746 16.0839L14.045 15.8739C14.6006 15.4837 15.2721 15.2935 15.9498 15.3343C16.6275 15.3752 17.2713 15.6447 17.776 16.0989L21 18.9999"
                            stroke="#5C5C5C" stroke-opacity="0.3" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M17 2.5V11.5M17 2.5L20 5.5M17 2.5L14 5.5" stroke="#5C5C5C" stroke-opacity="0.3"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Gallery</span>
                </a>
            </li>

            <li>
                <a id="shop" href="{{ route('marketplace') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('marketplace') ? 'active' : '' }}">
                    <svg class="shop" width="24" height="25" viewBox="0 0 24 25" fill="#5C5C5C"
                        fill-opacity="0.3" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.6 5.76006C20.5242 5.15475 20.2308 4.59769 19.7744 4.19286C19.3181 3.78804 18.73 3.56311 18.12 3.56006H5.88498C5.27647 3.56279 4.68964 3.78632 4.23351 4.18911C3.77739 4.59189 3.48298 5.14656 3.40498 5.75006L3.10498 8.22006C3.10538 8.70468 3.20904 9.18366 3.40906 9.62509C3.60908 10.0665 3.90086 10.4602 4.26498 10.7801V18.9401C4.26498 19.6031 4.52837 20.239 4.99721 20.7078C5.46605 21.1767 6.10194 21.4401 6.76498 21.4401H17.235C17.898 21.4401 18.5339 21.1767 19.0027 20.7078C19.4716 20.239 19.735 19.6031 19.735 18.9401V10.7801C20.1 10.4607 20.3927 10.0672 20.5936 9.62573C20.7945 9.18428 20.899 8.70507 20.9 8.22006L20.6 5.76006ZM14.01 20.4401H10.01V16.3601C10.01 15.9622 10.168 15.5807 10.4493 15.2994C10.7306 15.0181 11.1122 14.8601 11.51 14.8601H12.51C12.9078 14.8601 13.2893 15.0181 13.5706 15.2994C13.8519 15.5807 14.01 15.9622 14.01 16.3601V20.4401ZM18.74 18.9401C18.74 19.3379 18.5819 19.7194 18.3006 20.0007C18.0193 20.282 17.6378 20.4401 17.24 20.4401H15.01V16.3601C15.01 15.697 14.7466 15.0611 14.2777 14.5923C13.8089 14.1234 13.173 13.8601 12.51 13.8601H11.51C10.8469 13.8601 10.2111 14.1234 9.74221 14.5923C9.27337 15.0611 9.00998 15.697 9.00998 16.3601V20.4401H6.76498C6.36716 20.4401 5.98562 20.282 5.70432 20.0007C5.42302 19.7194 5.26498 19.3379 5.26498 18.9401V11.3701C5.65844 11.5311 6.07986 11.6126 6.50498 11.6101C6.99586 11.6123 7.48128 11.507 7.92704 11.3014C8.3728 11.0958 8.76806 10.7949 9.08498 10.4201C9.13014 10.3751 9.19127 10.3499 9.25498 10.3499C9.3187 10.3499 9.37982 10.3751 9.42498 10.4201C9.7419 10.7949 10.1372 11.0958 10.5829 11.3014C11.0287 11.507 11.5141 11.6123 12.005 11.6101C12.498 11.6122 12.9856 11.5068 13.4337 11.3013C13.8819 11.0958 14.2799 10.795 14.6 10.4201C14.6204 10.398 14.6452 10.3805 14.6727 10.3684C14.7002 10.3564 14.7299 10.3501 14.76 10.3501C14.7915 10.3499 14.8228 10.356 14.852 10.368C14.8812 10.38 14.9077 10.3977 14.93 10.4201C15.2469 10.7949 15.6422 11.0958 16.0879 11.3014C16.5337 11.507 17.0191 11.6123 17.51 11.6101C17.9319 11.6126 18.35 11.531 18.74 11.3701V18.9401ZM17.51 10.6101C17.1646 10.6117 16.823 10.5383 16.5088 10.395C16.1946 10.2517 15.9152 10.0419 15.69 9.78006C15.5774 9.64548 15.4367 9.53723 15.2777 9.46294C15.1188 9.38865 14.9454 9.35011 14.77 9.35006H14.76C14.5852 9.34848 14.4123 9.38527 14.2533 9.45784C14.0944 9.53041 13.9533 9.63699 13.84 9.77006C13.608 10.023 13.326 10.225 13.0118 10.3632C12.6977 10.5014 12.3582 10.5728 12.015 10.5728C11.6718 10.5728 11.3323 10.5014 11.0181 10.3632C10.7039 10.225 10.4219 10.023 10.19 9.77006C10.0736 9.63811 9.93051 9.53244 9.77016 9.46006C9.60982 9.38768 9.43591 9.35024 9.25998 9.35024C9.08406 9.35024 8.91014 9.38768 8.7498 9.46006C8.58945 9.53244 8.44634 9.63811 8.32998 9.77006C8.01437 10.1384 7.59477 10.4026 7.12627 10.5281C6.65777 10.6537 6.16226 10.6346 5.70478 10.4735C5.24731 10.3123 4.84924 10.0166 4.56285 9.62519C4.27645 9.23374 4.1151 8.76485 4.09998 8.28006L4.39998 5.88006C4.44747 5.51737 4.6244 5.18405 4.8982 4.94149C5.17199 4.69893 5.52421 4.56347 5.88998 4.56006H18.12C18.4868 4.55985 18.8409 4.69405 19.1155 4.93728C19.39 5.18051 19.566 5.51591 19.61 5.88006L19.9 8.24006C19.8942 8.87116 19.6392 9.47439 19.1906 9.91831C18.742 10.3622 18.1361 10.6109 17.505 10.6101H17.51Z" />
                    </svg>
                    <span>Marketplace</span>
                </a>
            </li>
            {{-- <li>
                <a id="visitors" href="{{ route('visitors') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('visitors') ? 'active' : '' }} ">
                    <svg class="visitors" width="24" height="25" viewBox="0 0 24 25" fill="#5C5C5C"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_7266)">
                            <path
                                d="M15.75 18.6071C15.2376 18.6071 14.8061 18.4315 14.4556 18.0801C14.1042 17.7296 13.9286 17.2981 13.9286 16.7857C13.9286 16.2733 14.1042 15.8418 14.4556 15.4913C14.8061 15.14 15.2376 14.9643 15.75 14.9643C16.2624 14.9643 16.6939 15.14 17.0444 15.4913C17.3958 15.8418 17.5714 16.2733 17.5714 16.7857C17.5714 17.2981 17.3958 17.7296 17.0444 18.0801C16.6939 18.4315 16.2624 18.6071 15.75 18.6071ZM11.5 24.0714V23.3732C11.5 22.6851 11.8946 22.1233 12.6839 21.6878C13.4732 21.2523 14.4952 21.0349 15.75 21.0357C17.0048 21.0357 18.0268 21.2535 18.8161 21.689C19.6054 22.1245 20 22.6859 20 23.3732V24.0714H11.5ZM8.46429 9.9675C9.09329 9.9675 9.63202 9.74326 10.0805 9.29479C10.529 8.84631 10.7532 8.30757 10.7532 7.67857C10.7532 7.04957 10.529 6.51083 10.0805 6.06236C9.63202 5.61388 9.09329 5.38964 8.46429 5.38964C7.83529 5.38964 7.29655 5.61388 6.84807 6.06236C6.39959 6.51083 6.17536 7.04957 6.17536 7.67857C6.17536 8.30757 6.39959 8.84631 6.84807 9.29479C7.29655 9.74326 7.83529 9.9675 8.46429 9.9675ZM6.17536 17.3929C6.17536 18.0219 6.39959 18.5606 6.84807 19.0091C7.29655 19.4575 7.83529 19.6818 8.46429 19.6818C9.09329 19.6818 9.63202 19.4575 10.0805 19.0091C10.529 18.5606 10.7532 18.0219 10.7532 17.3929C10.7532 16.7639 10.529 16.2251 10.0805 15.7766C9.63202 15.3282 9.09329 15.1039 8.46429 15.1039C7.83529 15.1039 7.29655 15.3282 6.84807 15.7766C6.39959 16.2251 6.17536 16.7639 6.17536 17.3929ZM8.46429 18.7468C8.08948 18.7468 7.76971 18.6148 7.505 18.3509C7.2419 18.087 7.11036 17.7677 7.11036 17.3929C7.11036 17.018 7.24231 16.6983 7.50621 16.4336C7.77012 16.1705 8.08948 16.0389 8.46429 16.0389C8.8391 16.0389 9.15886 16.1709 9.42357 16.4348C9.68667 16.6987 9.81821 17.018 9.81821 17.3929C9.81821 17.7677 9.68626 18.0874 9.42236 18.3521C9.15845 18.6152 8.8391 18.7468 8.46429 18.7468ZM3 6.46429C3 4.93105 3.52741 3.63702 4.58221 2.58221C5.63702 1.5274 6.93105 1 8.46429 1C9.99752 1 11.2915 1.5274 12.3464 2.58221C13.4012 3.63702 13.9286 4.93105 13.9286 6.46429V11.9286C13.9286 12.101 13.8703 12.2451 13.7537 12.3609C13.6371 12.4774 13.493 12.5357 13.3214 12.5357C13.1498 12.5357 13.0057 12.4774 12.8891 12.3609C12.7734 12.2451 12.7155 12.101 12.7155 11.9286V6.46429C12.7155 5.24514 12.2929 4.23202 11.4478 3.42493C10.6018 2.61783 9.60733 2.21429 8.46429 2.21429C7.32124 2.21429 6.32714 2.61783 5.482 3.42493C4.63686 4.23202 4.21429 5.24514 4.21429 6.46429V18.6071C4.21429 19.5964 4.53 20.4796 5.16143 21.2567C5.79286 22.0339 6.57405 22.5293 7.505 22.743C7.64829 22.7883 7.76931 22.8652 7.86807 22.9737C7.96683 23.0838 8.01621 23.2085 8.01621 23.3477C8.01621 23.5469 7.93809 23.7096 7.78186 23.8359C7.62643 23.9621 7.44752 23.9978 7.24514 23.9427C6.009 23.6545 4.99264 23.0247 4.19607 22.0533C3.39869 21.0819 3 19.9331 3 18.6071V6.46429Z" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_7266">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Visitor</span>
                </a>
            </li> --}}
            {{-- <li>
                <a id="logs" href="{{ route('logs') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('logs') ? 'active' : '' }}">
                    <svg width="24" class="logs" height="25" viewBox="0 0 24 25" fill="#5C5C5C"
                        fill-opacity="0.3" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_7294)">
                            <path
                                d="M9.19689 10.5C8.99797 10.5 8.80721 10.579 8.66656 10.7197C8.5259 10.8603 8.44689 11.0511 8.44689 11.25C8.44689 11.4489 8.5259 11.6397 8.66656 11.7803C8.80721 11.921 8.99797 12 9.19689 12H15.6969C15.8958 12 16.0866 11.921 16.2272 11.7803C16.3679 11.6397 16.4469 11.4489 16.4469 11.25C16.4469 11.0511 16.3679 10.8603 16.2272 10.7197C16.0866 10.579 15.8958 10.5 15.6969 10.5H9.19689ZM6.81489 14.5C6.61597 14.5 6.42521 14.579 6.28456 14.7197C6.1439 14.8603 6.06489 15.0511 6.06489 15.25C6.06489 15.4489 6.1439 15.6397 6.28456 15.7803C6.42521 15.921 6.61597 16 6.81489 16H13.3149C13.5138 16 13.7046 15.921 13.8452 15.7803C13.9859 15.6397 14.0649 15.4489 14.0649 15.25C14.0649 15.0511 13.9859 14.8603 13.8452 14.7197C13.7046 14.579 13.5138 14.5 13.3149 14.5H6.81489ZM5.23389 18.5C5.03497 18.5 4.84421 18.579 4.70356 18.7197C4.5629 18.8603 4.48389 19.0511 4.48389 19.25C4.48389 19.4489 4.5629 19.6397 4.70356 19.7803C4.84421 19.921 5.03497 20 5.23389 20H11.7339C11.9328 20 12.1236 19.921 12.2642 19.7803C12.4049 19.6397 12.4839 19.4489 12.4839 19.25C12.4839 19.0511 12.4049 18.8603 12.2642 18.7197C12.1236 18.579 11.9328 18.5 11.7339 18.5H5.23389Z" />
                            <path
                                d="M4.12521 0.500019H19.8752C20.4173 0.498362 20.9545 0.603979 21.4556 0.810787C21.9567 1.01759 22.412 1.32151 22.7952 1.70502C23.1787 2.08821 23.4826 2.54349 23.6894 3.04463C23.8962 3.54577 24.0019 4.08288 24.0002 4.62502C24.0002 6.00902 23.5242 7.41902 22.8722 8.78502C22.2202 10.15 21.3572 11.542 20.5202 12.889L20.5122 12.902C19.6632 14.27 18.8432 15.593 18.2322 16.872C17.6182 18.155 17.2502 19.322 17.2502 20.375C17.2502 20.8285 17.3678 21.2743 17.5913 21.6689C17.8149 22.0635 18.1369 22.3934 18.5259 22.6265C18.9149 22.8596 19.3577 22.988 19.811 22.9991C20.2644 23.0102 20.7129 22.9036 21.1129 22.6898C21.5128 22.4759 21.8505 22.1621 22.0931 21.779C22.3357 21.3958 22.4749 20.9563 22.4971 20.5033C22.5193 20.0503 22.4237 19.5993 22.2197 19.1943C22.0158 18.7892 21.7103 18.4439 21.3332 18.192C21.2513 18.1373 21.181 18.0669 21.1263 17.985C21.0717 17.9031 21.0336 17.8112 21.0145 17.7145C20.9953 17.6179 20.9953 17.5185 21.0146 17.4219C21.0338 17.3253 21.0719 17.2334 21.1267 17.1515C21.1815 17.0696 21.2518 16.9993 21.3337 16.9447C21.4157 16.89 21.5076 16.852 21.6042 16.8328C21.7008 16.8136 21.8003 16.8136 21.8969 16.8329C21.9935 16.8522 22.0853 16.8903 22.1672 16.945C22.9024 17.4371 23.4601 18.1524 23.7578 18.9855C24.0555 19.8185 24.0776 20.7253 23.8208 21.5718C23.5639 22.4184 23.0418 23.16 22.3314 23.6873C21.621 24.2145 20.7599 24.4994 19.8752 24.5H4.50021C3.40619 24.5 2.35698 24.0654 1.58339 23.2918C0.809806 22.5182 0.375209 21.469 0.375209 20.375C0.375209 18.141 1.63321 15.719 2.96521 13.473C3.31321 12.887 3.66721 12.311 4.01521 11.745C4.81521 10.441 5.58221 9.19202 6.15921 8.00702H3.39021C2.56721 8.00702 1.50421 7.81402 0.823209 6.97202C0.282349 6.31028 -0.0089332 5.47962 0.000208826 4.62502C0.000208826 3.531 0.434806 2.48179 1.20839 1.7082C1.98198 0.934616 3.03119 0.500019 4.12521 0.500019ZM15.7502 20.375C15.7502 18.995 16.2262 17.589 16.8782 16.225C17.5272 14.867 18.3872 13.482 19.2212 12.139L19.2382 12.111C20.0872 10.744 20.9072 9.41902 21.5182 8.13902C22.1322 6.85402 22.5002 5.68202 22.5002 4.62502C22.5015 4.27993 22.4345 3.93799 22.3031 3.61891C22.1716 3.29984 21.9783 3.00993 21.7343 2.76592C21.4903 2.5219 21.2004 2.32859 20.8813 2.19714C20.5622 2.06569 20.2203 1.9987 19.8752 2.00002C19.179 2.00002 18.5113 2.27658 18.0191 2.76886C17.5268 3.26115 17.2502 3.92883 17.2502 4.62502C17.2502 5.49002 17.6712 6.13402 18.4172 6.63402C18.5507 6.72352 18.652 6.85357 18.706 7.00498C18.76 7.15639 18.764 7.32115 18.7173 7.47497C18.6705 7.6288 18.5756 7.76354 18.4465 7.85933C18.3174 7.95512 18.161 8.0069 18.0002 8.00702H7.81221C7.16221 9.49002 6.18821 11.076 5.23521 12.626C4.90121 13.17 4.56921 13.709 4.25521 14.238C2.90021 16.525 1.87521 18.609 1.87521 20.375C1.87521 21.0712 2.15177 21.7389 2.64405 22.2312C3.13634 22.7235 3.80402 23 4.50021 23H16.6932C16.0824 22.2618 15.7488 21.3332 15.7502 20.375ZM1.50021 4.62502C1.49021 5.13602 1.66321 5.63302 1.98721 6.02802C2.24121 6.34102 2.72721 6.50702 3.38921 6.50702H16.2492C15.9154 5.93648 15.743 5.28597 15.7502 4.62502C15.7489 3.66685 16.0825 2.73835 16.6932 2.00002H4.12521C3.42902 2.00002 2.76134 2.27658 2.26905 2.76886C1.77677 3.26115 1.50021 3.92883 1.50021 4.62502Z" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_7294">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Logs</span>
                </a>
            </li> --}}
            {{-- <li>
                <a id="settings" href="{{ route('settings') }}"
                    class="text-decoration-none d-flex align-items-center {{ request()->is('settings') ? 'active' : '' }}">
                    <svg class="settings" width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 14.5C13.1046 14.5 14 13.6046 14 12.5C14 11.3954 13.1046 10.5 12 10.5C10.8954 10.5 10 11.3954 10 12.5C10 13.6046 10.8954 14.5 12 14.5Z"
                            stroke="#5C5C5C" stroke-opacity="0.3" />
                        <path
                            d="M5.3988 6.38005L5.6488 5.94605C5.55065 5.8893 5.43613 5.8676 5.32402 5.8845C5.21191 5.90139 5.10887 5.95589 5.0318 6.03905L5.3988 6.38005ZM3.3998 9.84405L2.9218 9.69605C2.88853 9.80426 2.89297 9.92056 2.93439 10.0259C2.9758 10.1313 3.05175 10.2195 3.1498 10.2761L3.3998 9.84405ZM3.3978 15.1551L3.1478 14.7221C3.04954 14.7787 2.97345 14.867 2.93202 14.9726C2.89059 15.0782 2.88628 15.1947 2.9198 15.3031L3.3978 15.1551ZM5.3978 18.6191L5.0308 18.9591C5.10787 19.0422 5.21091 19.0967 5.32302 19.1136C5.43513 19.1305 5.54965 19.1088 5.6478 19.0521L5.3978 18.6191ZM9.9978 21.2741H9.4978C9.49775 21.3876 9.53633 21.4978 9.60721 21.5865C9.67809 21.6751 9.77705 21.7371 9.8878 21.7621L9.9978 21.2741ZM13.9988 21.2761L14.1098 21.7641C14.2204 21.7389 14.3191 21.6769 14.3898 21.5882C14.4605 21.4995 14.4989 21.3894 14.4988 21.2761H13.9988ZM18.5998 18.6201L18.3498 19.0531C18.448 19.1098 18.5625 19.1315 18.6746 19.1146C18.7867 19.0977 18.8897 19.0432 18.9668 18.96L18.5998 18.6201ZM20.5978 15.1541L21.0758 15.3021C21.1091 15.1938 21.1046 15.0775 21.0632 14.9722C21.0218 14.8668 20.9459 14.7786 20.8478 14.7221L20.5978 15.1541ZM20.5998 9.84305L20.8498 10.2761C20.9481 10.2194 21.0242 10.1311 21.0656 10.0255C21.107 9.91992 21.1113 9.8034 21.0778 9.69505L20.5998 9.84305ZM18.5998 6.37805L18.9668 6.03805C18.8897 5.95489 18.7867 5.90039 18.6746 5.8835C18.5625 5.8666 18.448 5.8883 18.3498 5.94505L18.5998 6.37805ZM13.9998 3.72505H14.4998C14.4997 3.61182 14.4611 3.50199 14.3905 3.41352C14.3198 3.32505 14.2212 3.26319 14.1108 3.23805L13.9998 3.72505ZM9.9998 3.72305L9.8888 3.23505C9.77805 3.26003 9.67909 3.32196 9.60821 3.41065C9.53733 3.49934 9.49874 3.60952 9.4988 3.72305H9.9998ZM3.8778 9.99205C4.25299 8.77317 4.89796 7.65448 5.7648 6.71905L5.0318 6.03905C4.06266 7.08444 3.34147 8.33372 2.9218 9.69605L3.8778 9.99205ZM4.6378 16.7501C4.32 16.1996 4.06475 15.6153 3.8768 15.0081L2.9208 15.3041C3.13147 15.9824 3.41724 16.6351 3.7728 17.2501L4.6378 16.7501ZM5.7658 18.2801C5.33432 17.8136 4.95531 17.3004 4.6378 16.7501L3.7728 17.2501C4.12744 17.8652 4.54973 18.4387 5.0318 18.96L5.7658 18.2801ZM13.8888 20.7901C12.6453 21.0731 11.354 21.0725 10.1108 20.7881L9.8888 21.7621C11.2781 22.08 12.7211 22.0811 14.1108 21.7651L13.8888 20.7901ZM20.1218 15.0081C19.7466 16.2269 19.1016 17.3456 18.2348 18.2811L18.9678 18.9611C19.9369 17.9156 20.6581 16.6654 21.0778 15.3031L20.1218 15.0081ZM19.3618 8.25005C19.6858 8.81305 19.9388 9.39705 20.1238 9.99205L21.0788 9.69605C20.8682 9.01766 20.5824 8.36493 20.2268 7.75005L19.3618 8.25005ZM18.2338 6.72005C18.6656 7.18622 19.0446 7.69944 19.3618 8.25005L20.2268 7.75005C19.8722 7.1349 19.4499 6.56134 18.9678 6.04005L18.2338 6.72005ZM10.1108 4.21005C11.3543 3.92695 12.6456 3.92764 13.8888 4.21205L14.1108 3.23805C12.7215 2.92004 11.2785 2.91901 9.8888 3.23505L10.1108 4.21005ZM10.4998 5.57205V3.72205H9.4998V5.57205H10.4998ZM7.2498 6.87005L5.6488 5.94605L5.1488 6.81105L6.7488 7.73605L7.2498 6.87005ZM4.7498 13.7981L3.1478 14.7221L3.6488 15.5881L5.2488 14.6641L4.7498 13.7981ZM5.2498 10.3341L3.6498 9.41105L3.1498 10.2771L4.7498 11.2001L5.2498 10.3341ZM10.4998 21.2741V19.4271H9.4998V21.2741H10.4998ZM6.7498 17.262L5.1488 18.1861L5.6488 19.0521L7.2488 18.1281L6.7498 17.262ZM18.8508 18.1871L17.2498 17.262L16.7498 18.1291L18.3498 19.0531L18.8508 18.1871ZM14.4998 21.2771V19.4271H13.4998V21.2771H14.4998ZM20.3508 9.41005L18.7498 10.3341L19.2498 11.2001L20.8498 10.2761L20.3508 9.41005ZM20.8488 14.7211L19.2498 13.8001L18.7498 14.6661L20.3498 15.5891L20.8488 14.7211ZM14.4998 5.57205V3.72505H13.4998V5.57205H14.4998ZM18.3508 5.94605L16.7498 6.87105L17.2498 7.73705L18.8508 6.81205L18.3508 5.94605ZM13.4998 5.57205C13.4998 7.49605 15.5828 8.69905 17.2498 7.73705L16.7498 6.87105C16.5217 7.00274 16.2629 7.07206 15.9996 7.07201C15.7362 7.07197 15.4774 7.00258 15.2494 6.87081C15.0213 6.73904 14.832 6.54955 14.7004 6.32139C14.5688 6.09323 14.4996 5.83544 14.4998 5.57205H13.4998ZM18.7498 10.3351C17.0828 11.2971 17.0828 13.7031 18.7498 14.6651L19.2498 13.7991C19.0218 13.6674 18.8325 13.478 18.7008 13.25C18.5692 13.022 18.4999 12.7633 18.4999 12.5001C18.4999 12.2368 18.5692 11.9781 18.7008 11.7501C18.8325 11.5221 19.0218 11.3327 19.2498 11.2011L18.7498 10.3351ZM17.2498 17.2631C15.5828 16.3011 13.4998 17.5021 13.4998 19.4271H14.4998C14.4998 19.1637 14.5691 18.9061 14.7008 18.6781C14.8324 18.45 15.0218 18.2607 15.2498 18.129C15.4778 17.9974 15.7365 17.9281 15.9998 17.9281C16.2631 17.9281 16.5218 17.9974 16.7498 18.1291L17.2498 17.2631ZM10.4998 19.4271C10.4998 17.5031 8.4168 16.3011 6.7498 17.2631L7.2498 18.1291C7.4779 17.9974 7.73666 17.928 8.00004 17.9281C8.26343 17.9281 8.52216 17.9975 8.75022 18.1293C8.97828 18.2611 9.16762 18.4506 9.2992 18.6787C9.43079 18.9069 9.49997 19.1657 9.4998 19.4291L10.4998 19.4271ZM5.2498 14.6651C6.9168 13.7031 6.9168 11.2971 5.2498 10.3351L4.7498 11.2011C5.7498 11.7781 5.7498 13.2201 4.7498 13.7981L5.2498 14.6651ZM9.4998 5.57205C9.49962 5.83527 9.43018 6.0938 9.29845 6.32169C9.16672 6.54957 8.97735 6.73878 8.74935 6.87031C8.52135 7.00184 8.26276 7.07106 7.99954 7.07101C7.73633 7.07097 7.47775 7.00166 7.2498 6.87005L6.7498 7.73705C8.4168 8.69905 10.4998 7.49705 10.4998 5.57205H9.4998Z"
                            fill="#5C5C5C" fill-opacity="0.3" />
                    </svg>
                    <span>Settings</span>
                </a>
            </li> --}}
        </ul>
    </div>
</aside>
