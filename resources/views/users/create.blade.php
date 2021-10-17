<x-app-layout>

    <x-page-header title="Create User" :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('users.index'),'label' => 'Users'],
        ['label' => 'Create User'],
    ]"/>

    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1">

            <x-card title="Create User">
                <x-flash class="my-2"/>

                <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <!-- Password -->
                    <div class="mt-4">
                        <x-label for="name" :value="__('Name')"/>

                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                 required/>
                    </div>

                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')"/>

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                 required/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')"/>

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                 type="password"
                                 name="password_confirmation" required/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Create User') }}
                        </x-button>
                    </div>
                </form>

            </x-card>

        </div>
    </div>
</x-app-layout>
