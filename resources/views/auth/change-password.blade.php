<x-app-layout>
    <x-auth-card>

        <x-slot name="title">
            Change Password
        </x-slot>

        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1">

                <x-flash class="my-2" />

                <form method="POST" action="{{ route('update-password') }}">
                @csrf

                <!-- Password -->
                    <div class="mt-4">
                        <x-label for="current-password" :value="__('Current Password')"/>

                        <x-input id="current-password" class="block mt-1 w-full" type="password" name="current_password"
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
                            {{ __('Change Password') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>

    </x-auth-card>
</x-app-layout>
