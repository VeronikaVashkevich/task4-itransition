<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        $users = User::all();
        return view('all ', ['users'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function deleteCheckedUsers(Request $request){
        $ids = $request -> input('ids');
        $dbs = DB::delete('delete from users where id in ('. implode(",", $ids) .')');
        return redirect('all');
    }

    public function blockSelectedUsers(Request $request){
        $ids = $request -> input('ids');
        foreach ($ids as $id){
            DB::table('users')
                ->where('id', $id)
                ->update(['is_blocked' => true]);
        }
        return redirect('all');
    }
    public function unblockSelectedUsers(Request $request){
        $ids = $request -> input('ids');
        foreach ($ids as $id){
            DB::table('users')
                ->where('id', $id)
                ->update(['is_blocked' => false]);
        }
        return redirect('all');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}
