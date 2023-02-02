<?php

namespace App\Http\Controllers;
use App\Models\ModelOrder;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function profile(Request $request){
        Auth::routes();
        $userid =  Auth::user()->id;
        $checkadmin =  Auth::user()->is_admin;
        $allorders = ModelOrder::where('userid',$userid)->paginate(5);
       // $allorders = ModelOrder::orderBy('id','desc')->paginate(10);

        $userinfo = User::find($userid, 'picture');
        $urlImg =  $userinfo->picture;

        $user = auth()->user();


        if( $checkadmin == 1 ){
            return view ('admin.profile',['urlImg' => $urlImg, 'user' => $user ]);
        }else{
            return view ('dashboards.users.profile',compact('urlImg', 'allorders'));
        }



    }

    public function update(Request $request){
        $id = $request->input('id');

        $user = User::find($id);


        if($request->file('picture_file')) {
            $file = $request->file('picture_file');
            $filename = time().'_'.$file->getClientOriginalName();

            // File upload location
            $location = 'uploads/user-profile';

            // Upload file
            $fileobject = $file->move($location,$filename);


            $fileUrl = $fileobject->getLinkTarget();

        }else{
            $fileUrl = '';
        }



        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'picture' => 'uploads/user-profile/'.$filename,
            'favoritecolor'=>$request['favoritecolor'],
            'password' => Hash::make($request['password'])
        ];
        $user->update($data);
        return back()->with('success','Profile Updated successfully!');
    }

}
