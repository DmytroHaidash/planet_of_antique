<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index():View
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user):View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user):RedirectResponse
    {
        $user->update($request->only('role', 'premium'));
        return redirect(route('admin.users.index'))->with('success', 'User successfully updated');
    }

    public function destroy(User $user):RedirectResponse
    {
        $user->delete();
        return redirect(route('admin.users.index'))->with('success', 'User successfully deleted');
    }
}
