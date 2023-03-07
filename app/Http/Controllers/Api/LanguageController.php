<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        if(count($languages) == 0) {
            return response()->json([
                'status' => 404,
                'message' => 'No records found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'languages' => $languages
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:20'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }

        $language = Language::create([
            'name' => $request->name
        ]);
        if($language) {
            return response()->json([
                'status' => 200,
                'message' => 'Language created successfully'
            ], 200);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Something went wrong'
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $language = Language::find($id);
        if($language) {
            return response()->json([
                'status' => 200,
                'language' => $language
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such language found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:20'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }
        $language = Language::find($id);

        if($language) {
            $language->update([
                'name' => $request->name
            ]);  
            return response()->json([
                'status' => 200,
                'message' => 'Language updated successfully'
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'No such language found'
        ], 404);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::find($id);
        if($language) {
            $language->delete();
            return response()->json([
                'status' => 200,
                'message' => "Language deleted successfully"
            ], 200);

        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such language found"
            ], 404);
        }
    }
}
