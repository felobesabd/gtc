<?php

namespace App\Http\Controllers\Admin;

use App\Models\IncidentalExpenses;
use App\Services\IncidentalExpensesService;
use Illuminate\Http\Request;

class IncidentalExpensesController
{
    protected $expensesService;

    public function __construct(IncidentalExpensesService $expensesService)
    {
        $this->expensesService = $expensesService;
    }

    public function index(Request $request)
    {
        checkUserHasRolesOrRedirect('expenses.list');
        if ($request->ajax()) {
            return $this->expensesService->getExpenses();
        }

        return view('admin.expenses.index');
    }

    public function create()
    {
        checkUserHasRolesOrRedirect('expenses.add');
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $expenses = $this->expensesService->createExpense(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        checkUserHasRolesOrRedirect('expenses.edit');
        $expense = IncidentalExpenses::findOrFail($id);
        return view('admin.expenses.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expenses = $this->expensesService->updateExpense(id: $id, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        checkUserHasRolesOrRedirect('expenses.delete');
        $expenses = $this->expensesService->deleteExpense($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
