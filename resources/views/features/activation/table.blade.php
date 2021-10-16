<div class="card mt-3">

    <div class="card-body">
        <div class="card-title">
            {{ $stage }}
        </div>
    </div>

    <table class="table">
        <thead>
        <tr class="">
            <th class="">Name</th>
            <th class="">Type</th>
            <th class="">Status</th>
            <th class="">Allocations</th>
            <th class=""></th>
        </tr>
        </thead>
        <tbody>
        @foreach($applications as $application)
            <tr>

                <td>{{ $application->application->name }}</td>
                <td class="">

                    <h6>
                        @if($application->application->type === \App\Data\ApplicationType::MOBILE)
                            <i class="bi bi-phone"></i>
                        @elseif($application->application->type === \App\Data\ApplicationType::DESKTOP)
                            <i class="bi bi-windows"></i>
                        @else
                            <i class="bi bi-window"></i>
                        @endif

                        <span class="mx-2">{{ $application->application->type }}</span>
                    </h6>
                </td>

                <td>

                    @if($application->status === \App\Data\FeatureApplicationStatus::OFF)
                        <span class="badge rounded-pill bg-secondary"> {{$application->status}} </span>
                    @elseif($application->status === \App\Data\FeatureApplicationStatus::ON)
                        <span
                            class="badge rounded-pill bg-primary"> {{$application->status}} </span>
                    @elseif($application->status === \App\Data\FeatureApplicationStatus::LAUNCHED)
                        <span
                            class="badge rounded-pill bg-success"> {{$application->status}} </span>
                    @elseif($application->status === \App\Data\FeatureApplicationStatus::PAUSED)
                        <span
                            class="badge rounded-pill bg-warning"> {{$application->status}} </span>
                    @endif

                </td>

                <td>
                    @foreach($application->treatments as $featureTreatment)
                        <small class="mx-2">{{ $featureTreatment->name }}: {{ $featureTreatment->pivot->allocation }}%</small>
                    @endforeach
                </td>

                <td>
                    <x-link
                        href="{{ route('modify-allocations', ['name' => $model->name, 'stage' => $stage, 'application' => $application->id] ) }}"
                        class="btn btn-primary btn-sm">
                        Modify Allocations
                    </x-link>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
