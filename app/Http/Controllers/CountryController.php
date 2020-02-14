<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\CountryCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Country[]|Builder[]|Collection
     */
    public function index()
    {
        // $countries = CountryCategory::with('country')->get();
        //$countries = CountryCategory::with('category')->get();
        //  $countries = Category::with('country')->get();
        // $countries = CountryCategory::with(['category', 'country'])->get();
        return Country::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $country_category = new CountryCategory();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:countries',
            'code' => 'required|unique:countries'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
        Country::create($input);
        $country_id = Country::where('code', $input['code'])->first()->id;
        foreach ($request->category as $key => $item) {
            $country_category->country_id = $country_id;
            $country_category->category_id = $item['id'];
            $country_category->is_member = $item['is_member'];
            CountryCategory::create($country_category->toArray());
        }
        return response()->json('Success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Country|Country[]|Builder|Builder[]|Collection|Model
     */
    public function show($id)
    {
        return Country::with('category')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $categories = CountryCategory::where('country_id', $id)->get();
        $validator = Validator::make($request->all(), [
            'name' => 'required', Rule::unique('countries')->ignore($id),
            'code' => 'required', Rule::unique('countries')->ignore($id)
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
        $country = Country::find($id);
        $country->name = $input['name'];
        $country->code = $input['code'];
        $country->save();
        foreach ($input['category'] as $key => $item) {
            CountryCategory::where('country_id', $id)
                ->where('category_id', $item['id'])
                ->update(['is_member' => $item['is_member']]);
        }
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return response()->json('Deleted', 200);
    }
}
