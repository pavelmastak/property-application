<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function search(Request $request)
    {
        $result = Property::select(['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages']);

        if ($request->exists('name') && !empty($request->query('name')))
            $result->where('name', 'like', "%{$request->query('name')}%");
        if ($request->exists('priceFrom') && !empty($request->query('priceFrom')))
            $result->where('price', '>=', floatval($request->query('priceFrom')));
        if ($request->exists('priceTo') && !empty($request->query('priceTo')))
            $result->where('price', '<=', floatval($request->query('priceTo')));
        if ($request->exists('bedrooms'))
            $result->whereIn('bedrooms', $request->query('bedrooms'));
        if ($request->exists('bathrooms'))
            $result->whereIn('bathrooms', $request->query('bathrooms'));
        if ($request->exists('storeys'))
            $result->whereIn('storeys', $request->query('storeys'));
        if ($request->exists('garages'))
            $result->whereIn('garages', $request->query('garages'));

        return $result->get();
    }
}
