<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function index()
    {
        $card = Card::all();
        return response()->json($card);
    }

    // GET a specific card
    public function show($id)
    {
        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        return response()->json($card);
    }

    // CREATE a new card
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CardNumber' => 'required|integer|max:16',
            'FullName' => 'required|string|max:30',
            'Date' => 'required|date',
            'TypeOfCard' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $card = Card::create([
            'CardNumber' => $request->CardNumber,
            'FullName' => $request->FullName,
            'Date' => $request->Date,
            'TypeOfCard' => $request->TypeOfCard,
        ]);

        return response()->json($card, 201);
    }

    // UPDATE a card
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'CardNumber' => 'required',
            'FullName' => 'required',
            'Date' => 'required',
            'TypeOfCard' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $card->CardNumber = $request->CardNumber;
        $card->FullName = $request->FullName;
        $card->Date = $request->Date;
        $card->TypeOfCard = $request->TypeOfCard;
        $card->save();

        return response()->json($card);
    }

    // DELETE a card
    public function destroy($id)
    {
        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $card->delete();

        return response()->json(['message' => 'Card deleted']);
    }
}
