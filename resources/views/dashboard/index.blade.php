<x-app-layout>
    <x-page-header title="Dashboard"></x-page-header>

    @section('title', 'Dashboard')

    <div class="alert alert-soft-success  alert-dismissible fade show" role="alert">
        <i class="tio tio-checkmark-circle"></i> You're logged in as {{ Auth::user()->name }}!

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>

    <div class="row gx-2 gx-lg-3">

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Card -->
            <div class="card card-hover-shadow h-100" href="#" id="stats-sellers">
                <div class="card-body">
                    <h6 class="card-subtitle">Applications</h6>

                    <div class="row align-items-center gx-2 mb-1">
                        <div class="col-6">
                            <span class="card-title h4">{{ \App\Models\Application::count() }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Card -->
            <div class="card card-hover-shadow h-100" href="#" id="stats-sellers">
                <div class="card-body">
                    <h6 class="card-subtitle">Features</h6>

                    <div class="row align-items-center gx-2 mb-1">
                        <div class="col-6">
                            <span class="card-title h4">{{ \App\Models\Feature::count() }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Card -->
            <div class="card card-hover-shadow h-100" href="#" id="stats-sellers">
                <div class="card-body">
                    <h6 class="card-subtitle">Treatments</h6>

                    <div class="row align-items-center gx-2 mb-1">
                        <div class="col-6">
                            <span class="card-title h4">{{ \App\Models\Feature\FeatureTreatment::count() }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <!-- Card -->
            <div class="card card-hover-shadow h-100" href="#" id="stats-sellers">
                <div class="card-body">
                    <h6 class="card-subtitle">Users</h6>

                    <div class="row align-items-center gx-2 mb-1">
                        <div class="col-6">
                            <span class="card-title h4">{{ \App\Models\User::count() }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>


    </div>


</x-app-layout>
