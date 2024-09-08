<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->userService->getUsers(data: $request->all());
        }
        return view('admin.users.index');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->updateUser(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $user = $this->userService->deleteUser($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    
}
