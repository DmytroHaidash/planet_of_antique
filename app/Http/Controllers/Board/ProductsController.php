<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSavingRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductsController extends Controller
{
    public function index(Request $request): View
    {
        $products = Auth::user()->shop->products();
        if ($request->filled('q')) {
            $products = $products->where('title', 'like', "%{$request->input('q')}%");
        }
        return view('board.products.index', ['products' => $products->paginate(20)]);
    }

    public function create(): View
    {
        $categories = Category::all();
        $suppliers = Auth::user()->suppliers;
        return view('board.products.create', compact('categories', 'suppliers'));
    }

    public function store(ProductSavingRequest $request): RedirectResponse
    {
        $product = Product::create([
            'shop_id' => Auth::user()->shop->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => $request->input('body'),
            'price' => $request->input('price'),
            'in_stock' => $request->input('in_stock'),
            'publish_price' => $request->has('publish_price'),
            'is_published' => $request->has('is_published'),
            'bargain' => $request->has('bargain'),
        ]);
        $product->categories()->attach($request->input('categories', []));
        $this->handleMedia($request, $product);
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $product->meta()->updateOrCreate([
                    'metable_id' => $product->id
                ], [
                    $key => $meta
                ]);
            }
        }
        if ($request->has('accountings')) {
            $this->handleAccount($request, $product);
        }
        return redirect()->route('board.products.index')->with('success', 'Product successfully created');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        $suppliers = Auth::user()->suppliers;
        return view('board.products.edit', compact('categories', 'product', 'suppliers'));
    }

    public function update(ProductSavingRequest $request, Product $product): RedirectResponse
    {
        $published = $request->has('is_published');
        if (Auth::user()->shop->products()->where('is_published', 1)->count() >= app('settings')->ads_per_user &&
            (Auth::user()->premium == null || Auth::user()->premium < now())) {
            $published = false;
        }
        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => $request->input('body'),
            'price' => $request->input('price'),
            'in_stock' => $request->input('in_stock'),
            'publish_price' => $request->has('publish_price'),
            'is_published' => $published,
            'bargain' => $request->has('bargain'),
        ]);
        $product->categories()->sync($request->input('categories'));
        $this->handleMedia($request, $product);
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $product->meta()->updateOrCreate([
                    'metable_id' => $product->id
                ], [
                    $key => $meta
                ]);
            }
        }
        if ($request->has('accountings')) {
            $this->handleAccount($request, $product);
        }
        return redirect()->route('board.products.index')->with('success', 'Product successfully updated');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('board.products.index')->with('success', 'Product successfully deleted');
    }

    /**
     * @param  Request $request
     * @param  Product $product
     */
    private function handleMedia(Request $request, Product $product): void
    {
        if ($request->filled('uploads')) {
            foreach ($request->input('uploads') as $media) {
                Media::find($media)->update([
                    'model_type' => Product::class,
                    'model_id' => $product->id
                ]);
            }

            Media::setNewOrder($request->input('uploads'));
        }

        if ($request->filled('deletion')) {
            Media::whereIn('id', $request->input('deletion'))->delete();
        }
    }

    private function handleAccount(Request $request, Product $product): void
    {
        $supplier = $request['accountings']['supplier_id'];
        if ($request['new-supplier']) {
            $supplier = Supplier::create(['title' => $request->input('new-supplier'), 'user_id' => Auth::user()->id]);
            $supplier = $supplier->id;
        }

        if ($product->accountings) {
            $product->accountings->update([
                'date' => $request['accountings']['date'],
                'supplier_id' => $supplier,
                'whom' => $request['accountings']['whom'],
                'price' => json_encode($request['accountings']['price']),
                'message' => json_encode($request['accountings']['message']),
                'amount' => $request['accountings']['amount'],
                'comment' => $request['accountings']['comment'],
                'buyer' => $request['accountings']['buyer'],
                'sell_price' => $request['accountings']['sell_price'],
                'sell_date' => $request['accountings']['sell_date']
            ]);
        } else {
            $product->accountings()->create([
                'date' => $request['accountings']['date'],
                'supplier_id' => $supplier,
                'whom' => $request['accountings']['whom'],
                'price' => json_encode($request['accountings']['price']),
                'message' => json_encode($request['accountings']['message']),
                'amount' => $request['accountings']['amount'],
                'comment' => $request['accountings']['comment'],
                'buyer' => $request['accountings']['buyer'],
                'sell_price' => $request['accountings']['sell_price'],
                'sell_date' => $request['accountings']['sell_date']
            ]);
        }
        if ($request->has('accounting')) {
            foreach ($request->accounting as $media) {
                Media::find($media)->update([
                    'model_type' => Accounting::class,
                    'model_id' => $product->accountings->id,
                ]);
            }
            Media::setNewOrder($request->input('accounting'));
        }

    }
}
