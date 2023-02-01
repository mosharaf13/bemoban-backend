<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

//todo add api method to return all cards ( even those who are soft deleted )
//todo increase title length of cards (200 chars?)
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

    public function list(Request $request)
    {
        $request->validate([
           'date' => ['sometimes', 'date_format:Y-m-d'],
            'status' => ['sometimes', 'digits_between:0,1']
        ]);

        $query = Card::query();
        if($request->has('date')){
            $query->whereDate('created_at', '=', Carbon::parse($request->get('date')));
        }

        if(!$request->has('status')){
            return $query->withTrashed()->get();
        }

        if($request->has('status') && $request->get('status') == 0){
            $query->onlyTrashed();
        }

        return $query->get();
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
        //todo check if cards names can be empty
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
