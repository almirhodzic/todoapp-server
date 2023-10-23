<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Todo::all();
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
        $userid = 15;
        $todo = Todo::create(
            [
                'user_id' => $userid,
                'list_id' => 1,
                'title' => $request->title,
                'description' => $request->description,
                'done' => false,
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, Todo $todo, string $id)
    {
        $todo = Todo::find($id);
        $todo->update($request->only('title', 'description','done'));
        return response($todo, Response::HTTP_ACCEPTED);
    }

    public function toggle(Request $request, Todo $todo, string $id)
    {
        $todo = Todo::find($id);
        $donevalue;
        if ($todo->done == false) {
            $donevalue = true;
        } else {
            $donevalue = false;
        }

        $todo->update([
            'done'=> $donevalue,
        ]);
        return response($todo, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Todo $todo, string $id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function test()
    {
        return response()->json([
            'name' => 'test',
        ]);
    }
}
