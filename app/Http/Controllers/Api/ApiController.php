<?php

namespace App\Http\Controllers\Api;

use App\admin;
use App\Http\Resources\nhomRS;
use App\nhom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    function groups(){
        $group = nhom::all();
        return response()->json([
            'groups' => nhomRS::collection($group)
        ], 200);
    }

    function add(){
        $data = \request();

        if ($data['token'] == null)
            return response()->json([
                'message' => 'User not logged in'
            ], 401);

        $user = admin::where('token', $data['token'])
            ->first();

        if ($user == null)
            return response()->json([
                'message' => 'User not logged in'
            ], 401);

        if ($data['group'] == null)
            return response()->json([
                'message' => 'Name group is undefined'
            ], 401);

        $group = nhom::where('group', $data['group'])->first();
        if ($group != null)
            return response()->json([
                'message' => 'Name group is already used'
            ], 401);

        nhom::create([
            'group' => $data['group'],
            'point' => '0'
        ]);

        $groups = nhom::all();
        return response()->json([
            'message' => 'Group successfully created',
            'groups' => nhomRS::collection($groups)
        ], 200);
    }

    function update(){
        $data = \request();

        if ($data['token'] == null)
            return response()->json([
                'message' => 'User not logged in'
            ], 401);

        $user = admin::where('token', $data['token'])
            ->first();

        if ($user == null)
            return response()->json([
                'message' => 'User not logged in'
            ], 401);

        if ($data['group'] == null)
            return response()->json([
                'message' => 'Group is undefined'
            ], 401);

        $group = nhom::where('group', $data['group'])->first();
        if ($group == null)
            return response()->json([
                'message' => 'Group is undefined'
            ], 401);

        $group->point = $data['point'];
        $group->save();
        $groups = nhom::all();
        return response()->json([
            'message' => 'Group successfully updated',
            'groups' => nhomRS::collection($groups)
        ], 200);
    }

    function delete(){
        $data = \request();

        if ($data['token'] == null)
            return response()->json([
                'message' => 'User not logged in'
            ], 401);

        $user = admin::where('token', $data['token'])
            ->first();

        if ($user == null)
            return response()->json([
                'message' => 'User not logged in'
            ], 401);

        if ($data['group'] == null)
            return response()->json([
                'message' => 'Group is undefined'
            ], 401);

        $group = nhom::where('group', $data['group'])->first();
        if ($group == null)
            return response()->json([
                'message' => 'Group is undefined'
            ], 401);

        $group->delete();
        $groups = nhom::all();
        return response()->json([
            'message' => 'Group successfully deleted',
            'groups' => nhomRS::collection($groups)
        ], 200);
    }

    function login(){
        $data = \request();
        if ($data['email'] == null)
            return response()->json([
                'message' => 'Invalid email'
            ], 401);

        $user = admin::where('email', $data['email'])
            ->where('password', md5($data['password']))
            ->first();

        if ($user == null)
            return response()->json([
                'message' => 'Invalid email'
            ], 401);

        $user->token = md5($user->username);
        $user->save();

        return response()->json([
            'username' => $user->username,
            'token' => $user->token
        ], 200);
    }

    function logout(){
        $data = \request();
        if ($data['token'] == null)
            return response()->json([
                'message' => 'Invalid token'
            ], 401);

        $user = admin::where('token', $data['token'])->first();
        if ($user == null)
            return response()->json([
                'message' => 'Invalid token'
            ], 401);

        $user->token = '';
        $user->save();
        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }
}
