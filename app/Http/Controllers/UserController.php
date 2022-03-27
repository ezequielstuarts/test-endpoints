<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function getUserFiles(Request $request) {
        $user = User::find($request->user_id);
        if($user) {
            return response()->json([
                'user_id' => $user->id,
                'files' => $user->files,
            ]);
        } else {
            return response()->json(404);
        }
    }
    
    public function getUsersFiles() {
        foreach (User::all() as $user) {
            $data[] = [
               'user_id' => $user->id,
               'files' => $user->files,
            ];
        };
        return response()->json($data);
    }
}