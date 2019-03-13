<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\User;

class UserController extends Controller {
    public function index() {
        return User::all();
    }
    public function create() {}
    public function store(Request $request) {
        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();
    }
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        // validate([])
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    }
    public function destroy($id) {
        $user = User::findOrFail($id)->delete();
        return['id'=>$id];
    }
}
