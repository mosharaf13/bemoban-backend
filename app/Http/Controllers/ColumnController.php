<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    /**
     * List all columns
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Column::all());
    }

    /**
     * Store a column
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'unique:columns,title', 'max:50']
        ]);
        Column::create([
            'title' => $validated['title']
        ]);

        return response()->json('column created successfully');
    }

    /**
     * Remove column from storage.
     *
     * @param Column $column
     * @return JsonResponse
     */
    public function destroy(Column $column)
    {
        $column->delete();

        return response()->json('column deleted successfully');
    }
}
