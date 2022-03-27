<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserFileController extends Controller
{
    function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'file' => 'required',
            'user_id' => 'required',
        ]);
        
        if($validator->fails()) {  
            return response()->json(['error'=>$validator->errors()], 400);
        }  
        
        $user = User::find($request->user_id);
        if(!$user){
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        $file = $request->file('file');
        try {
            $path = Storage::putFile('public', $file);
            $fileName = $file->getClientOriginalName();

            UserFile::create([
                'user_id' => $request->user_id,
                'file_name' => $fileName,
                'url' => '/storage/app/'.$path,
            ]);
            $data = [
                'user_id' => $user->id,
                'uploaded_file' => $user->files->last(),
                'files' => $user->files->reverse()->slice(1),
            ];
            
            return response()->json($data, 201);        
        }
        catch (\Exception $exception) {
            return response($exception, 500);
        }
    }
}
