<x-app-layout>
    <x-page-header title="Applications" :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['label' => 'Applications'],
    ]"></x-page-header>


    <x-card>

        <a href="{{ route('create-application') }}" class="btn btn-soft-primary btn-sm">
            <i class="tio-add"></i> Create Application
        </a>

        <x-flash class="my-2"/>

        <table class="table table-striped table-hover mt-5">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>ID</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $application)
                <tr>
                    <td>{{ $application->id }}</td>

                    <td>
                        <x-link href="{{ route('edit-application', ['id' => $application->id]) }}">
                            {{ $application->name }}
                        </x-link>
                    </td>
                    <td>
                        <h6>
                            @if($application->type === \App\Data\ApplicationType::MOBILE)
                                <i class="bi bi-phone"></i>
                            @elseif($application->type === \App\Data\ApplicationType::DESKTOP)
                                <i class="bi bi-windows"></i>
                            @else
                                <i class="bi bi-window"></i>
                            @endif

                            <span class="mx-2">{{ $application->type }}</span>
                        </h6>
                    </td>
                    <td>{{ $application->unique_id }}</td>
                    <td>

                        <x-link
                            href="#"
                            onclick="if(confirm('Are you sure you want to change status ?')){$($(this).attr('data-target')).submit()}"
                            data-target="#toggle-application-status-{{$application->id}}"
                            class="btn {{ $application->is_active ? 'btn-soft-success' : 'btn-soft-danger' }} btn-sm">
                            <i class="tio-toggle-on"></i> {{ $application->is_active ? 'ACTIVE' : 'IN-ACTIVE' }}
                        </x-link>

                        <x-form
                            action="{{ route('toggle-application-status', ['id' => $application->id]) }}"
                            id="toggle-application-status-{{$application->id}}"
                            method="PUT">
                        </x-form>
                    </td>
                    <td>{{ $application->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-card>

</x-app-layout>
