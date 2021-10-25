<x-app-layout>
    <x-page-header title="How to guide." :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['label' => 'Setting'],
        ['label' => 'How to guide.'],
    ]"></x-page-header>


    <x-card>

        <h3>Installation</h3>

        <p>
            Accessor to this A/B lab is available via composer, right now it's accessor implementation is only written
            as a laravel package.
            You can add the repo in your composer.json

            @include('setting.code-partials.repositories')

            and add the package to composer.json require dependencies

            @include('setting.code-partials.composer-require')

            and run composer update to install the package.

        </p>

        <h3 class="mt-3">Package Registeration</h3>

        Next thing you need to register service provider and facade in <code>config/app.php</code>

        <h5>Service Provider</h5>

        @include('setting.code-partials.service-provider')


        <h3 class="mt-3">Config</h3>

        Next thing you need to publish the config by running this command in terminal

        @include('setting.code-partials.facade')

        Above command will publish the config in with file name <code>config/ab-lab-accessor.php</code>.

        Now, update the config/ab-lab-accessor.php with following code

        @include('setting.code-partials.config')
        Now, you're all set to use the A/B Lab accessor.


        <h1 class="mt-3">Usage</h1>

        @include('setting.code-partials.usage')


    </x-card>

</x-app-layout>
