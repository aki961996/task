<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('products.create', compact('roles'));
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'prize' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);


        Product::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'prize' => $request->prize,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }


    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, Product $product): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'prize' => 'required',
            'quantity' => 'required|numeric'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
