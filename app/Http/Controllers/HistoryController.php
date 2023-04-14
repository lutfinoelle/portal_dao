<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function store(Request $request)
    {
        try {
            $history = new History();
            $history->user_id = auth()->user()->id;
            $history->action = $request->action ?? '';
            $history->detail = $request->detail;
            $history->save();

            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Data gagal disimpan'
            ]);
        }
    }
}
