@extends('layouts.dashboard')
@section('title', 'Settings')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav>
                        <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="sub-settings-tab" data-bs-toggle="tab"
                                data-bs-target="#sub-settings" type="button" role="tab" aria-controls="sub-settings"
                                aria-selected="true">
                                <span class="px-1 px-md-2 px-lg-3">Subscribe Settings</span>
                            </button>
                            <button class="nav-link" id="un-sub-settings-tab" data-bs-toggle="tab"
                                data-bs-target="#un-sub-settings" type="button" role="tab"
                                aria-controls="un-sub-settings" aria-selected="false">
                                <span class="px-1 px-md-2 px-lg-3">Nonsubscribed Settings</span>
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content p-3 border-0" id="nav-tabContent">
                        @include('admin.settings.partials.sub-setting')
                        @include('admin.settings.partials.un-sub-setting')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
