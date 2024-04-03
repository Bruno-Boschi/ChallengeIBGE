<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getAddressesCity($city_id)
    {
        $addresses = Address::where('city_id', $city_id)->get();

        return response()->json(['addresses' => $addresses], 200);
    }

    public function getAddress($id)
    {
        $address = Address::find($id);

        return response()->json(['address' => $address], 200);
    }

    public function postAddress() //criar
    {

        return response()->json(['msg' => 'Create Sucess'], 200);
    }

    public function putAddress() //atualizar
    {
        return response()->json(['msg' => 'Update Sucess'], 200);
    }
}
