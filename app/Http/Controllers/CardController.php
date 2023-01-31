<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

//todo add api method to return all cards ( even those who are soft deleted )
class CardController extends Controller
{
    /**
     * List all cards
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Card::all());
    }

    /**
     * Store a card
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['nullable', 'max:500'],
            'column_id' => ['required', 'exists:columns,id']
        ]);

        Card::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'column_id' => $validated['column_id']
        ]);

        return response()->json('card created successfully');
    }

    /**
     * Display card
     *
     * @param Card $card
     * @return JsonResponse
     */
    public function show(Card $card)
    {
        return response()->json($card);
    }

    /**
     * Update card in storage.
     *
     * @param Request $request
     * @param Card $card
     * @return JsonResponse
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'max:50'],
            'description' => ['nullable', 'max:500']
        ]);

        if(!empty($validated['title'])){
            $card->title = $validated['title'];
        }

        if(!empty($validated['description'])){
            $card->description = $validated['description'];
        }

        $card->save();

        return response()->json('card updated successfully');
    }

    /**
     * Remove card from storage.
     *
     * @param Card $card
     * @return JsonResponse
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return response()->json('card deleted successfully');
    }
}
