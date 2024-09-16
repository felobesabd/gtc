<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\Request;

class GroupController
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->groupService->getGroups();
        }

        return view('admin.groups.index');
    }

    public function create()
    {
        return view('admin.groups.create');
    }

    public function getSpecificGroup($id)
    {
        return $this->groupService->getGroup($id);
    }

    public function store(GroupRequest $request)
    {
        $group = $this->groupService->createGroup(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        return view('admin.groups.edit', compact('group'));
    }

    public function update(GroupRequest $request, $id)
    {
        $group = $this->groupService->updateGroup(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $group = $this->groupService->deleteGroup($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
