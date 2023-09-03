<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use GuzzleHttp\Psr7\Message;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return task::select('id','task','Priority','created_at')->get();
    }


    public function store(Request $request)
    {
        $request->validate([
            "task"=>'required',
            "Priority"=>'required'
        ]);
        task::create($request->post());
        return response()->json(
            [
                "Message" => "task created successfully"
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        return response()->json(
            [
                "task" => $task
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task)
    {
        $request->validate([
            "task"=>'required',
            "Priority"=>'required'
        ]);
        $task ->fill($request->post())->update();
        return response()->json(
            [
                "Message" => "task updated successfully"
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    task::destroy($id);
    return response()->json([
        "Message" => "task deleted successfully"
    ]);
}

}
