<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

        return response()->json([
            'success' => true,
            'data' => $todos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // Create a new instance
        $todo = new Todo();

        // Set properties individually from the validated data
        $todo->title = $validated['title'];
        $todo->description = $validated['description'] ?? null;
        $todo->due_date = $validated['due_date'] ?? null;

        // Save the new instance to the database
        $todo->save();

        // Return the saved model with consistent JSON response
        return response()->json([
            'success' => true,
            'message' => 'Todo created successfully',
            'data' => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return response()->json([
            'success' => true,
            'data' => $todo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // validate the request
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'completed' => 'sometimes|boolean',
            'due_date' => 'nullable|date'
        ]);

        // update properties individually from validated data
        foreach ($validated as $key => $value) {
            $todo->key = $value;
        }

        // save the updated instance
        $todo->save();

        return response()->json([
            'success' => true,
            'message' => 'Todo updated successfully',
            'data' => $todo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
