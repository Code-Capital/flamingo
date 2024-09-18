<div class="tab-pane fade" id="Info" role="tabpanel" aria-labelledby="Info-tab">
    <div class="row mx-0">
        <div class="col-lg-8 ps-0 ps-md-0 ps-lg-auto pe-0 pe-md-0 pe-lg-2 mb-3">
            <div class="bg-white p-4 dashboardCard">
                <div class="aboutCard">
                    <h6 class="mb-4">About</h6>
                    <p>
                        {{ $event->description }}
                    </p>

                    <h6 class="mb-2 mt-4">Rules and Regulations</h6>
                    <p>
                        {{ $event->rules }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Peoples --}}
        <x-people-with-same-interest :peoples="$peoples" />
    </div>
</div>
