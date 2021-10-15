<div class="d-block">
    <x-link href="{{ route('feature-detail', ['name' => $model->name]) }}">Basic Info</x-link>
    <x-link href="{{ route('feature-treatments', ['name' => $model->name]) }}">Treatments</x-link>
    <x-link href="{{ route('feature-activation', ['name' => $model->name]) }}">Activation</x-link>
</div>
