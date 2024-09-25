<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file')->store('files');

        Excel::import(new UsersImport, storage_path('app/' . $file));
        return redirect()->back()->with('success', 'All good!');
    }

    /*Excel::import(new UsersImport(), $request->file('file')->store('files'));
        return redirect('/')->with('success', 'All good!');
        return 'success';*/
}
