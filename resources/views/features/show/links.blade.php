<div class="d-block mb-3">
    <ul class="nav nav-tabs">
        <li><a class="nav-link {{ request()->routeIs('feature-detail') ? 'active' : '' }}"
               href="{{ route('feature-detail', ['name' => $model->name]) }}">Basic Info</a></li>

        <li><a class="nav-link {{ request()->routeIs('feature-treatments') ? 'active' : '' }}"
               href="{{ route('feature-treatments', ['name' => $model->name]) }}">Treatments</a></li>

        <li>
            <a class="nav-link {{ request()->routeIs('feature-activation') || request()->routeIs('modify-allocations') ? 'active' : '' }}"
               href="{{ route('feature-activation', ['name' => $model->name]) }}">Activation</a></li>

        <li><a class="nav-link {{ request()->routeIs('feature-overrides') ? 'active' : '' }}"
               href="{{ route('feature-overrides', ['name' => $model->name]) }}">Overrides</a></li>
    </ul>
</div>
