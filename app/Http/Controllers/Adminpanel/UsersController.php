<?php

namespace App\Http\Controllers\Adminpanel;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('adminpanel.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:Users',
            'contact' => 'max:15|unique:Users',
            'gender' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'gender' => $request->gender
        ]);

        return redirect(url('adminpanel/users'))->with('status', 'Perintah berhasil dijalankan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return redirect(url('adminpanel/users'));
    }

    public function change_password(User $user)
    {
        if ($user->id == Auth::user()->id) {
            return redirect(url('adminpanel/users'))->with('error', 'Form gagal diakses');
        }
        return view('adminpanel.pages.users.change_password', compact('user'));
    }

    public function update_change_password(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'same:password|required'
        ]);

        User::where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);
        return redirect(url('adminpanel/users'))->with('status', 'Data berhasil diubah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id == Auth::user()->id) {
            return redirect(url('adminpanel/users'))->with('error', 'Form gagal diakses');
        }
        return view('adminpanel.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id == Auth::user()->id) {
            return redirect(url('adminpanel/users'))->with('error', 'Data gagal diubah');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'contact' => 'max:15',
            'gender' => 'required',
        ]);

        User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'gender' => $request->gender
            ]);
        return redirect(url('adminpanel/users'))->with('status', 'Perintah berhasil dijalankan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect(url('adminpanel/users'))->with('status', 'Perintah berhasil dijalankan');
    }
}
