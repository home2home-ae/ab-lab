<x-app-layout>

    <x-page-header title="Edit application" :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('applications'),'label' => 'Applications'],
        ['label' => $model->name],
        ['label' => 'Update'],
    ]"></x-page-header>

    <x-card>

        <x-form action="{{ route('update-application', ['id' => $model->id]) }}" method="POST">

            <x-flash class="my-2"/>

            <div class="row">
                <div class="col-md-8 col-sm-12">

                    <div class="row my-3">

                        <div class="col-md-6 col-sm-12">
                            <x-select-group label="Select application type"
                                            name="type"
                                            placeholder="Select application type"
                                            value="{{$model->type}}"
                                            :list="\App\Data\ApplicationType::toList()"/>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <x-form-group label="Unique identifier"
                                          disabled="disabled"
                                          name="identifier"
                                          value="{{ $model->unique_id }}"></x-form-group>
                        </div>

                    </div>

                    <div class="row my-3">
                        <div class="col-12">
                            <x-form-group required="required"
                                          label="Name" name="name"
                                          value="{{ $model->name }}"></x-form-group>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12">
                            <x-form-group required="required" type="textarea"
                                          label="Detail" value="{{ $model->detail }}"
                                          name="detail"></x-form-group>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <x-button>Update application</x-button>
                        </div>

                    </div>

                </div>
            </div>


        </x-form>

    </x-card>
</x-app-layout>
