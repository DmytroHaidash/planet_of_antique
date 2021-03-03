<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    public function index():View
    {
        return view('admin.suppliers.index', [
            'suppliers' => Supplier::paginate(20),
        ]);
    }

    public function edit(Supplier $supplier):View
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier):RedirectResponse
    {
        $supplier->update($request->only('title'));
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier successfully updated');
    }

    public function destroy(Supplier $supplier):RedirectResponse
    {
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier successfully deleted');
    }
}
