<div class="col-md-3 col-sm-6">
    <x-form
        action="{{ route('update-treatment', ['name' => $model->name, 'treatment' => $treatment->id]) }}"
        method="PUT"
        id="treatment-form-{{$treatment->id}}">

        <div class="card">

            <div
                class="bg-gradient-to-r from-{{ $loop->iteration == 1 ? 'yellow' :  ( $loop->iteration == 2 ? 'green' : 'blue') }}-400 via-red-500 to-pink-500 h-2"></div>
            <div class="card-body">

                <div class="card-title text-center">
                    <h5 class="">
                        Treatment: {{ $treatment->name }}
                    </h5>
                </div>

                <x-form-group required="required" type="textarea"
                              label="Description"
                              placeholder="Add description for {{$treatment->name}} treatment"
                              value="{{ $treatment->description }}"
                              name="description"></x-form-group>

                <div class="form-group mt-3">
                    <x-button class="btn-block" color="primary">
                        <i class="tio-update"></i> Update description
                    </x-button>
                </div>

            </div>
        </div>
    </x-form>
</div>
