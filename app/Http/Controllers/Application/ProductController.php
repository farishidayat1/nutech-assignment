<?php

namespace App\Http\Controllers\Application;

use App\Exports\ExportProduct;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product_categories = ProductCategory::get();

        $products = new Product;

        if($request->search) {
            $products = $products->where('name', 'like', '%' .$request->search. '%');
        }
        
        if($request->category) {
            $products = $products->where('category', $request->category);
        }
        
        $products = $products->orderBy('created_at', 'desc')->paginate(10);

        return view('app.product.index', [
            'product_categories' => $product_categories,
            'products' => $products,
            'category' => $request->category,
            'search' => $request->search
        ]);
    }

    public function create() 
    {
        $product_categories = ProductCategory::get();

        return view('app.product.create', [
            'product_categories' => $product_categories,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'qty' => 'required',
            'image' => 'mimes:jpg,png|required|max:100'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'qty' => $request->qty,
            'image_url' => $request->file('image')->store('product-images', ['disk' => 'public']),
        ]);

        return redirect()->route('product')->with('success_message', 'Successfully created product!');
    }

    public function edit($id) 
    {
        $product = Product::where('id', $id)->first();
        $product_categories = ProductCategory::get();

        return view('app.product.edit', [
            'product_categories' => $product_categories,
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'qty' => 'required',
            // 'image' => 'mimes:jpg,png|required|max:100'
        ]);

        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'qty' => $request->qty,
        ];

        if($request->file('image')) {
            $data = array_merge($data, ['image_url' => $request->file('image')->store('product-images', ['disk' => 'public'])]);
        }

        $product = Product::where('id', $id)->update($data);
        
        return redirect()->route('product')->with('success_message', 'Successfully updated product!');
    }

    public function destroy($id) 
    {
        Product::where('id', $id)->delete();

        return redirect()->route('product')->with('success_message', 'Successfully deleted product!');
    }

    public function export(Request $request)  
    {
        return Excel::download(new ExportProduct($request), 'products.xlsx');
    }
}
