<?php

namespace App\Http\Controllers;

use App\Models\Inclusion;
use App\Models\Room;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InclusionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete("Delete", "Are you sure you want to delete?");
        $inclusions = Inclusion::all();
        return view('inclusion.index', compact('inclusions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inclusion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Inclusion::create($this->validate($request, [
            'name' => 'required',
        ]))){
            Alert::success('Success', "Inclusion created successfully!");
            return redirect()->route('inclusions.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Inclusion $inclusion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inclusion $inclusion)
    {
        return view('inclusion.edit', compact('inclusion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inclusion $inclusion)
    {
        if ($inclusion->update($this->validate($request, [
            'name' => 'required|unique:inclusions,name,'.$inclusion->id
        ]))){
            Alert::success("Success", "Update Successfully!");
            return redirect()->route('inclusions.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inclusion $inclusion)
    {
        if ($inclusion->delete()){
            Alert::success("Success", "Deleted Successfully!");


            return redirect()->route('inclusions.index');
        }
    }
}
