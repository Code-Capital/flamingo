@extends('layouts.dashboard')
@section('title', 'Messages')
@section('styles')
@endsection
@section('content')
    <div id="content-wrapper" class="contentWrapper h-100">
        <div class="row align-items-stretch d-flex mx-0 position-relative">
            <div class="col-lg-3 px-0 h-100 ">
                <div class=" text-end p-2">
                    <button class="btn chatBtn btn-primary btn-sm">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="chatSidebar">
                    <div class="border-bottom p-3 d-flex align-items-center justify-content-between ">
                        <div class="d-flex gap-2 align-items-center flex-grow-1">
                            <div class="dropdown">
                                <button class="btn p-0 dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    Messages
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                            <span>02</span>
                        </div>
                        <a href="">
                            <img src="assets/icon17.svg">
                        </a>
                    </div>
                    <div class="searchInput p-3">
                        <input class="form-control form-control-lg" type="search"
                               placeholder="Search by name or message ">
                    </div>
                    <div class="singleMessage mx-3 px-2 py-1 mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="image position-relative">
                                <img class="rounded-circle" src="assets/profile.png">
                                <span class="position-absolute rounded-circle"></span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between time">
                                    <span>Umer Umair</span>
                                    <span>12m</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between message">
                                    <span>Haha oh man </span>
                                    <span>2</span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="singleMessage mx-3 px-2 py-1 active mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="image position-relative">
                                <img class="rounded-circle" src="assets/profile.png">
                                <span class="position-absolute rounded"></span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between time">
                                    <span>Umer Umair</span>
                                    <span>12m</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between message">
                                    <span>Typing...</span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="singleMessage mx-3 px-2 py-1 mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="image position-relative">
                                <img class="rounded-circle" src="assets/profile.png">
                                <span class="position-absolute rounded-circle"></span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between time">
                                    <span>Umer Umair</span>
                                    <span>12m</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between message">
                                    <span>Haha oh man </span>
                                    <span>2</span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="singleMessage mx-3 px-2 py-1 mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="image position-relative">
                                <img class="rounded-circle" src="assets/profile.png">
                                <span class="position-absolute rounded-circle"></span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between time">
                                    <span>Umer Umair</span>
                                    <span>12m</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between message">
                                    <span>Haha oh man </span>
                                    <span>2</span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="singleMessage mx-3 px-2 py-1 mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="image position-relative">
                                <img class="rounded-circle" src="assets/profile.png">
                                <span class="position-absolute rounded-circle"></span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between time">
                                    <span>Umer Umair</span>
                                    <span>12m</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between message">
                                    <span>Haha oh man </span>
                                    <span>2</span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="singleMessage mx-3 px-2 py-1 mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="image position-relative">
                                <img class="rounded-circle" src="assets/profile.png">
                                <span class="position-absolute rounded-circle"></span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between time">
                                    <span>Umer Umair</span>
                                    <span>12m</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between message">
                                    <span>Haha oh man </span>
                                    <span>2</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 px-0 h-100 border-start chatWrapper">
                <div class="border-bottom p-3 d-flex align-items-center justify-content-between ">
                    <div class="d-flex gap-3 align-items-center flex-grow-1 rightChat">
                        <img class="rounded-circle" src="assets/profile.png">
                        <div>
                            <h6 class="mb-0">Muhammad Usama</h6>
                            <span><span></span>Online</span>
                        </div>
                    </div>
                    <a type="button" class="btn d-flex gap-1 align-items-center" data-bs-toggle="modal"
                       data-bs-target="#groupMemberModal">
                        <!--                            <img src="assets/icon19.svg" alt="">-->
                        Group Members
                    </a>
                </div>
                <div class="p-4">
                    <div class="d-flex align-items-start justify-content-start message gap-2 py-3">
                        <img class="rounded-circle" src="assets/profile.png">
                        <div>
                            <div class="mb-3"><span class="p-2">omg, this is amazing</span></div>
                            <div class="mb-3"><span class="p-2">perfect! ✅</span></div>
                            <div class="mb-3"><span class="p-2">Wow, this is really epic</span></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start justify-content-end message reply gap-2 py-3">
                        <div>
                            <div class="mb-3  text-end"><span class="p-2">How are you?</span></div>
                        </div>
                        <img class="rounded-circle" src="assets/profile.png">
                    </div>
                    <div class="d-flex align-items-start justify-content-start message gap-2 py-3">
                        <img class="rounded-circle" src="assets/profile.png">
                        <div>
                            <div class="mb-3"><span class="p-2">just ideas for next time</span></div>
                            <div class="mb-3"><span class="p-2">I'll be there in 2 mins ⏰</span></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start justify-content-end message reply gap-2 py-3">

                        <div>
                            <div class="mb-3  text-end"><span class="p-2">woohoooo</span></div>
                            <div class="mb-3  text-end"><span class="p-2">Haha oh man</span></div>
                            <div class="mb-3  text-end"><span class="p-2">Haha that's terrifying 😂</span></div>
                        </div>
                        <img class="rounded-circle" src="assets/profile.png">
                    </div>
                    <div class="d-flex align-items-start justify-content-start message gap-2 py-3">
                        <img class="rounded-circle" src="assets/profile.png">
                        <div>
                            <div class="mb-3"><span class="p-2">aww</span></div>
                            <div class="mb-3"><span class="p-2">omg, this is amazing</span></div>
                            <div class="mb-3"><span class="p-2">woohoooo 🔥</span></div>
                        </div>
                    </div>
                </div>
                <div class="chatFooter d-flex align-items-center gap-3 px-4 mb-4">
                    <a href="">
                        <img src="assets/attach.svg">
                    </a>
                    <div class="chatInput d-flex align-items-center p-2 w-100">
                        <input class="w-100" type="text" placeholder="Type a message">
                        <a href="">
                            <img src="assets/send.svg">
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
