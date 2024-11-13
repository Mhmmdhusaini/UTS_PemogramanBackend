<?php

namespace App\Http\Controllers;

use App\Models\digitalMedia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class DigitalMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $digital = digitalMedia::all();

        $data = [
            'message' => 'Get all resouce ',
            'data' => $digital
        ];
        return response()->json($data, 200);
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
       $validator = Validator::make($request->all(), [
            'title' => 'required', 
            'author' => 'required', 
            'description' => 'required', 
            'content' => 'required', 
            'url' => 'required', 
            'url_image' => 'required', 
            'published_at' => 'required', 
            'category' => 'required',
       ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $digital = digitalMedia::create($request->all());

        $data = [
            'message' => 'Resource is added succesfully ',
            'data' => $digital,
        ];

        return response()->json($data, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $digital = digitalMedia::find($id);

        if ($digital) {
            $data = [
                'message' => 'Get detail resource',
                'data' => $digital,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resouce not found',
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(digitalMedia $digitalMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari data  berdasarkan ID
        $digital = digitalMedia::find($id);
        if ($digital) {
            $input = [
                'id' => $request->id ?? $digital->id, 
                'title' => $request->title ?? $digital->title, 
                'author' => $request->author ?? $digital->author, 
                'description' => $request->description ?? $digital->description, 
                'content' => $request->content ?? $digital->content, 
                'url' => $request->url ?? $digital->url,  
                'url_image' => $request->url_image ?? $digital->url_image,                     
                'published_at' => $request->published_at ?? $digital->published_at, 
                'category' => $request->category ?? $digital->category
            ];
            $digital->update($input);
            $data = [
                'message' => 'Resource is updated succesfully',
                'data' => $digital
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];
            return response()->json($data, 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $digital = digitalMedia::find($id);

        if ($digital) {

            $digital->delete();

            $data = [
                'message' => 'Resource delete is successfully',
                'data' => $digital,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource  not found',
            ];

            return response()->json($data, 404);
        }
    }

    public function search(Request $request)
{
    $title = $request->query('title'); // Mengambil parameter 'title' dari query string

    // Cari berita berdasarkan title
    $digital = digitalMedia::where('title', 'like', '%' . $title . '%')->get();

    if ($digital->isEmpty()) {
        return response()->json([
            'message' => 'Resource not found',
        ], 404);
    }

    return response()->json([
        'message' => 'Get searched resource',
        'data' => $digital,
    ], 200);
}

public function getSportResource()
{
    try {
        // Get all sport resources using Eloquent
        $digital = digitalMedia::where('status', 'active')->get();
        
        // Prepare response data
        $response = [
            'message' => 'Get sport resource',
            'total' => $digital->count(),
            'data' => $digital,
            'status' => 200
        ];
        
        return response()->json($response, 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error getting sport resource',
            'error' => $e->getMessage()
        ], 500);
    }
}
}


