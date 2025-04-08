<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display form with table of products
    public function index()
    {
        return view('product.index');
    }

    // Store a new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Product::create($data);
        $this->saveToJson();

        return response()->json(['success' => true]);
    }

    // Return the list of products order by created_at
    public function list()
    {
        $products = Product::orderByDesc('created_at')->get();

        $result = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'datetime' => $product->created_at->format('Y-m-d H:i:s'),
                'total' => $product->total_value
            ];
        });

        return response()->json($result);
    }

    // Update the product
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($data);

        $this->saveToJson();

        return response()->json(['success' => true]);
    }

    // Save all products to JSON file in storage named as products.json
    private function saveToJson()
    {
        $products = Product::orderByDesc('created_at')->get();
        Storage::put('products.json', json_encode($products));
    }
}
