<?php

namespace App\Http\Controllers;

use App\Data\UserType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = User::query();
        $builder->where('user_type', '!=', UserType::ROOT);

        $results = $builder->paginate();

        return view('users.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:128'
            ],
            'email' => [
                'required',
                'max:128',
                'email'
            ],
            'password' => [
                'min:4',
                'max:15',
                'confirmed'
            ]
        ]);

        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make($request->get('password'));
        $model->user_type = UserType::BASIC;
        $model->is_active = true;
        $model->save();

        return redirect()->route('users.index')->with('success', 'User created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toggleUserStatus($id)
    {
        $model = User::where('id', $id)->firstOrFail();

        if ($model->is_active) {
            $model->is_active = false;
        } else {
            $model->is_active = true;
        }

        $model->save();

        return back()->with('success', 'User status updated successfully!');
    }
}
