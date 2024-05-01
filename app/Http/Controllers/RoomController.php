<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete("Delete", "Are you sure you want to delete?");

        $rooms = Room::all();
        return view('room.index', compact('rooms'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:rooms,title',
            'description' => 'required',
            'max_pax' => 'required',
            'current_pax' => 'nullable|integer|max:' . $request->max_pax,
            'price' => 'required',
            'status' => 'required'
        ]);



        $room = Room::create($request->all());
        if ($room){
            alert();
            Alert::success("Success", "Room created successffully!");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $this->validate($request, [
            'title' => 'required|unique:rooms,title,'.$room->id,
            'description' => 'required',
            'max_pax' => 'required',
            'current_pax' => 'nullable|integer|max:' . $request->max_pax,
            'price' => 'required',
            'status' => 'required'
        ]);

        if ($room->update($request->all())){
            Alert::success("Success", "Room updated successfully");
            return redirect()->route('rooms.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room->delete()){
            Alert::success("Success", "Room deleted successfully");
            return redirect()->route('rooms.index');
        }
    }
}
