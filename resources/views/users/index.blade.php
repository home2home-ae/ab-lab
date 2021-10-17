<x-app-layout>
    <x-page-header title="Users" :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['label' => 'Users'],
    ]"></x-page-header>


    <x-card>

        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm my-3">Create User</a>

        <x-flash class="my-3" />

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Active</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->email }}</td>
                    <td>{{ $result->user_type }}</td>
                    <td>{{ $result->is_active ? 'YES' : 'NO' }}</td>
                    <td>{{ $result->created_at }}</td>
                    <td>
                        <x-form action="{{ route('toggle-user-status', ['id' => $result->id]) }}"
                                id="toggle-user-{{$result->id}}"
                                method="PUT"></x-form>

                        @if($result->is_active)
                            <a href="#"
                               onclick="$($(this).attr('data-target')).submit()"
                               data-target="#toggle-user-{{$result->id}}"
                               class="btn btn-warning btn-sm">
                                Mark as in-active
                            </a>
                        @else
                            <a href="#"
                               onclick="$($(this).attr('data-target')).submit()"
                               data-target="#toggle-user-{{$result->id}}"
                               class="btn btn-primary btn-sm">
                                Mark is active
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-card>

</x-app-layout>
