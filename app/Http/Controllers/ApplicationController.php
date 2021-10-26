<?php

namespace App\Http\Controllers;

use App\Data\ApplicationType;
use App\Data\FeatureEventType;
use App\Data\FeatureType;
use App\Events\FeatureUpdate;
use App\Models\Application;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function index()
    {
        $builder = Application::query();

        $results = $builder
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('applications.index', compact('results'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => [
                'required',
                Rule::in(array_keys(ApplicationType::toList()))
            ],
            'name' => [
                'required',
                'max: 128'
            ],
            'detail' => [
                'required',
                'max:1024'
            ],
            'unique_id' => [
                'required',
                Rule::unique('applications', 'unique_id')
            ]
        ]);

        $validator = Validator::make([
            'unique_id_upper' => strtoupper($request->get('unique_id'))
        ], [
            'unique_id_upper' => [
                'required',
                Rule::unique('applications', 'unique_id')
            ]
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please choose a different unique id');
        }

        $model = new Application();
        $model->name = $request->get('name');
        $model->type = $request->get('type');
        $model->detail = $request->get('detail');
        $model->unique_id = strtoupper($request->get('unique_id'));
        $model->icon = 'web.png';
        $model->save();

        return redirect()->route('applications')
            ->with('success', 'Application created successfully!');
    }

    public function showUpdateForm($id)
    {
        /** @var Application $model */
        $model = Application::query()
            ->where('id', $id)->firstOrFail();

        return view('applications.edit', compact('model'));
    }

    public function update($id, Request $request)
    {
        /** @var Application $model */
        $model = Application::query()
            ->where('id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'type' => [
                'required',
                Rule::in(array_keys(ApplicationType::toList()))
            ],
            'name' => [
                'required',
                'max: 128'
            ],
            'detail' => [
                'required',
                'max:1024'
            ]
        ]);

        $model->update($validatedData);

        return back()->with('success', 'Application updated successfully!');
    }

    public function toggleStatus($id, Request $request)
    {
        /** @var Application $model */
        $model = Application::query()
            ->where('id', $id)->firstOrFail();


        $model->is_active = !$model->is_active;
        $model->save();

        return back()->with('success', 'Application status updated successfully!');
    }
}
