<x-app-layout>
    <x-page-header title="Applications" :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['label' => 'Applications'],
    ]"></x-page-header>


    <x-card>

        <a href="{{ route('create-application') }}" class="btn btn-primary btn-sm">Create Application</a>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>ID</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>

                    <td>
                        <x-link href="{{ route('edit-application', ['id' => $result->id]) }}">
                            {{ $result->name }}
                        </x-link>
                    </td>
                    <td>
                        <h6>
                            @if($result->type === \App\Data\ApplicationType::MOBILE)
                                <i class="bi bi-phone"></i>
                            @elseif($result->type === \App\Data\ApplicationType::DESKTOP)
                                <i class="bi bi-windows"></i>
                            @else
                                <i class="bi bi-window"></i>
                            @endif

                            <span class="mx-2">{{ $result->type }}</span>
                        </h6>
                    </td>
                    <td>{{ $result->unique_id }}</td>
                    <td>{{ $result->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-card>

</x-app-layout>
