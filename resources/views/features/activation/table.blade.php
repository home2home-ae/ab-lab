<h1 class="text-2xl mt-8">{{ $stage }}</h1>
<table class="w-full">
    <thead>
    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
        <th class="px-4 py-3">Name</th>
        <th class="px-4 py-3">Type</th>
        <th class="px-4 py-3">Status</th>
        <th class="px-4 py-3">Allocations</th>
        <th class="px-4 py-3"></th>
    </tr>
    </thead>
    <tbody class="bg-white">
    @foreach($applications as $application)
        <tr class="text-gray-700">
            <td class="px-4 py-3 border">
                <div class="flex items-center text-sm">
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                        <img class="object-cover w-full h-full rounded-full"
                             src="{{ asset('/assets/applications/'.$application->application->icon) }}"
                             alt="" loading="lazy"/>
                        <div class="absolute inset-0 rounded-full shadow-inner"
                             aria-hidden="true"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-black">{{ $application->application->name }}</p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ $application->application->type }}</td>
            <td class="px-4 py-3 text-xs border">

                @if($application->status === \App\Data\FeatureApplicationStatus::OFF)
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-sm"> {{$application->status}} </span>
                @elseif($application->status === \App\Data\FeatureApplicationStatus::ON)
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> {{$application->status}} </span>
                @elseif($application->status === \App\Data\FeatureApplicationStatus::LAUNCHED)
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> {{$application->status}} </span>
                @elseif($application->status === \App\Data\FeatureApplicationStatus::PAUSED)
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-sm"> {{$application->status}} </span>
                @endif

            </td>

            <td class="px-4 py-3 text-xs border">
                @foreach($application->treatments as $featureTreatment)
                    <h1>{{ $featureTreatment->name }}
                        : {{ $featureTreatment->pivot->allocation }} %</h1>
                @endforeach

            </td>

            <td class="px-4 py-3 text-sm border">
                <x-link
                    href="{{ route('modify-allocations', ['name' => $model->name, 'stage' => $stage, 'application' => $application->id] ) }}"
                    class="mt-5 mb-3">
                    Modify Allocations
                </x-link>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
