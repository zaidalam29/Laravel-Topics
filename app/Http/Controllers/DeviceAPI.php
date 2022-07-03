<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;

class DeviceAPI extends Controller
{
    //
    function list($id=null)
    {
        return $id?Device::find($id):Device::all();
    }

    function add(Request $req)
    {
        $device = new Device;
        $device->model_name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result)
        {
            return ["Result"=>"Data has Been Saved"];
        }else{
            return ["Result"=>"failed to saved"];
        }


    }

    function update(Request $req)
    {
        $device = Device::find($req->id);
        $device->model_name = $req->model_name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if($result)
        {
            return ["Result"=>"Updated Successfully"];
        }
        else{

            return ["Result"=>"Failed update"];
        }

    }

    function search($name)
    {
        return Device::where("model_name","LIKE", "%".$name."%")->get();
    }

    function delete($id)
    {
        $device = Device::find($id);
        $result=$device->delete();

        if($result)
        {
            return ["return"=>"Deleted Successfully"];
        }else{
            return ["return"=>"failed deletion"];
        }


    }

    function save(Request $req)
    {

        $rules = array(
            "member_id"=>"required|min:2|max:4"
        );
        $validator = Validator::make($req->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 401);
        }else{
            $device = new Device;
            $device->model_name=$req->name;
            $device->member_id=$req->member_id;
            $result = $device->save();
            if($result)
            {
                return ["result"=>"Data saved"];
            }else{
                return ["result"=>"failed to save"];
            }
        }

    }
}
