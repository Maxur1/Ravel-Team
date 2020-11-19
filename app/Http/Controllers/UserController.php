<?php

namespace App\Http\Controllers;

use App\User_Table;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('sample_data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_Table  $user_Table
     * @return \Illuminate\Http\Response
     */
    public function show(User_Table $user_Table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_Table  $user_Table
     * @return \Illuminate\Http\Response
     */
    public function edit(User_Table $user_Table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_Table  $user_Table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_Table $user_Table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_Table  $user_Table
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_Table $user_Table)
    {
        //
    }
}
