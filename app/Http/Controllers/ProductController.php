<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('products.create');
    }

    // Store new product in the database
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'address' => 'required|min:5',
            'city' => 'required|min:5',
            'sku' => 'required|min:5',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048', // image validation
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('products.create')
                             ->withInput()
                             ->withErrors($validator);
        }

        // Create new Product instance
        $product = new Product();
        $product->name = $request->name;
        $product->email = $request->email;
        $product->password = Hash::make($request->password);  // Hash password
        $product->address = $request->address;
        $product->city = $request->city;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->price = $request->price;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/products'), $imageName);
            $product->image = $imageName;
        }

        // Save product to database
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Show form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    // Update a product's details
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validation rules
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'nullable|min:5',  // Optional for update
            'address' => 'required|min:5',
            'city' => 'required|min:5',
            'sku' => 'required|min:5',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',  // Optional for update
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)
                             ->withInput()
                             ->withErrors($validator);
        }

        // Update product details
        $product->name = $request->name;
        $product->email = $request->email;
        if ($request->password) {
            $product->password = Hash::make($request->password); // Hash password
        }
        $product->address = $request->address;
        $product->city = $request->city;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->price = $request->price;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                File::delete(public_path('upload/products/' . $product->image));
            }

            // Process new image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/products'), $imageName);
            $product->image = $imageName;
        }

        // Save the updated product
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy($id)
    { 
        $product = Product::findOrFail($id);

        // Delete old image if exists
        if ($product->image) {
            File::delete(public_path('upload/products/' . $product->image));
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}


