<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Xmenu;
use Hash;
use Session;
use Carbon\Carbon;

class UserController extends Controller
{
    public function Login(Request $request){
        $user = User::where('email', $request->Email)->first();
        //Hash::check('password', $user->password);
        //dd($request->Password);
        if(!$user){
            return view('admin.Login', [
                "title" => "Home",
                "loginstatus" => "false"
            ]);
        }
        
        //$menus = Xmenu::where('class', $user->class)->get();
        //dd($menus);

        if(!Hash::check($request->Password, $user->password)){
            return view('admin.login', [
                "title" => "Login",
                //"menuList" => $menus,
                "loginstatus" => "false"
            ]);
        }

        else{
            $login = Carbon::now();
            $expired = $login->addDays(1);
            // Session::forget('statusLogin');
            // Session::flush();
            //Session::flash('statusLogin', $expired);
            session(['LoginExpired' => $expired]);
            //session(['MenuList' => $menus]);
            session(['UserLoginName' => $user->name]);
            session(['UserLogin' => $user->id]);

            return redirect('/HomeAdmin');
        }
    }

    public function Logout(){
        session()->forget(['LoginExpired']); 
        session()->flush();

        return redirect('/login');
    }

    public function GetListAdmin(){
        $user = User::where('class', "admin")->orWhere('class', 'vendor')->orderBy('created_at', 'DESC')->get();

        return view('adminView/adminList', [
            "title" => "Admin List",
            "adminList" => $user
        ]);
    }
    
    public function GetUserProfile(){
        $user = User::where('id', session()->get('UserLogin'))->first();
        //$pass = Hash::c;

        return view('adminView/userProfile', [
            "title" => "User Profile",
            "userProfile" => $user
        ]);
    }
    
    public function EditUserProfile(Request $request){
        $user = User::where('id', session()->get('UserLogin'))->first();
        
        //dd($user);
        if($request->passLama != null)
        {
            if(!Hash::check($request->passLama, $user->password)){
                return redirect()->back()->with("messageUser", "Password Lama Tidak Sesuai!");
            }
            else {
                if ($request->passBaru == null || $request->passBaru == ""){
                    $users = User::where('id', session()->get('UserLogin'))->first();
                    return redirect()->back()->with("messageUser", "Password Baru Tidak Boleh Kosong");
                }

                $userEdit = User::find($user->id)->update([
                    'name' => $request->name,
                    'password' => $request->passBaru
                ]);
            }
        }
        else{
            $userEdit = User::find($user->id)->update([
                'name' => $request->name
            ]);
        }
        
        return redirect()->back()->with("pesanan", "data berhasil disimpan");
    }
    
    public function TambahUser(Request $request){
        User::factory()->create([
            'name' => $request->namaUser,
            'email' => $request->emailUser,
            'password' => $request->passwordUser,
            'class' => "admin"
        ]);

        return redirect('/Admin');
    }
    
    public function EditUser(Request $request){
        $user = User::find($request->Id)->update([
            'name' => $request->namaUserEdit,
            'email' => $request->emailUserEdit,
            'password' => $request->passwordUserEdit
        ]);

        return redirect('/Admin');
    }
}
