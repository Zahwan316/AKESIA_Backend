<?php

namespace App\Http\Controllers\Notification;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $getCurrUserNotif = $request->query('user_id');

        if($getCurrUserNotif){
            $data = Notification::where('user_id', $getCurrUserNotif)->get();
        }
        else{
            $data = Notification::orderBy("created_at","desc")->get();
        }

        return $this->apiResponse('Data berhasil diambil', $data);
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
        //
        $validate = $request->validate([
            'user_id' => 'required',
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        try{
            $data = Notification::create($request->only([
                'user_id', 'title', 'message'
            ]));
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), '', 500, true );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Notification::find($id);

        return $this->apiResponse('Data berhasil diambil', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
