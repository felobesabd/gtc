<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sales;
use App\Services\SalesService;
use Illuminate\Http\Request;

class SalesController
{
    protected $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->salesService->getSales();
        }

        return view('admin.sales.index');
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function store(Request $request)
    {
        $sales = $this->salesService->createSales(data: $request->all());
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit(Request $request, $id)
    {
        $sales = Sales::findOrFail($id);
        return view('admin.sales.edit', compact('sales'));
    }

    public function update(Request $request, $id)
    {
        $sales = Sales::findOrFail($id);
        $update_sales = $this->salesService->updateSales($sales, data: $request->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $sales = $this->salesService->deleteSales($id);
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
