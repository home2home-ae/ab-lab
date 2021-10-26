<x-app-layout>
    <x-page-header title="Features" :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['label' => 'Features'],
    ]"></x-page-header>


    <x-card>

        <a href="{{ route('create-feature') }}" class="btn btn-soft-primary btn-sm">
            <i class="tio-add"></i> Create Feature
        </a>

        <table class="table table-striped table-hover mt-5">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>
                        <x-link href="{{ route('feature-detail', ['name' => $result->name]) }}">
                            {{ $result->name }}
                        </x-link>
                    </td>
                    <td>{{ $result->user->name }}</td>
                    <td>{{ $result->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-card>

</x-app-layout>
