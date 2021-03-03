<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    public function index():View
    {
        return view('board.suppliers.index', [
            'suppliers' => Auth::user()->suppliers()->paginate(20),
        ]);
    }
    public function create():View
    {
        return view('board.suppliers.create');
    }

    public function store(Request $request):RedirectResponse
    {
        Auth::user()->suppliers()->create($request->only('title'));
        return redirect()->route('board.suppliers.index')->with('success', 'Supplier successfully created');
    }

    public function edit(Supplier $supplier):View
    {
        return view('board.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier):RedirectResponse
    {
        $supplier->update($request->only('title'));
        return redirect()->route('board.suppliers.index')->with('success', 'Supplier successfully updated');
    }

    public function destroy(Supplier $supplier):RedirectResponse
    {
        $supplier->delete();
        return redirect()->route('board.suppliers.index')->with('success', 'Supplier successfully deleted');
    }
}
