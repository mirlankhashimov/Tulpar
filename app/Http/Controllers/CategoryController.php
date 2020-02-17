<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\CountryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'Message' => $validator->errors()
            ];
            return response()->json($response, 204);
        }
        Category::create($input);
        $response = ['created' => true,];
        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
        $category->update($request->all());
        $response = [
            'updated' => true,
        ];
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $response = ['deleted' => true];
        return response()->json($response, 200);
    }
}
