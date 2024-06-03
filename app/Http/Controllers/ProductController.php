<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // Recherchez les produits qui contiennent le mot-clé saisi dans leur nom ou leur description
    $products = Product::where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');

    // Recherchez les produits appartenant à une catégorie spécifique si le mot-clé correspond à une catégorie
    $category = Category::where('name', 'like', '%' . $search . '%')->first();
    if ($category) {
        $products->orWhere('category_id', $category->id);
    }

    // Exécuter la requête
    $products = $products->get();

    return view('products.index', compact('products'));
}


    public function create()
{
    $categories = Category::all(); // Assuming you have a Category model
    return view('products.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:products|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image_url' => 'nullable|url',
    ]);

    Product::create($request->all());
    return redirect()->route('products.index');
}

public function show($id)
{
    $product = Product::findOrFail($id);
    $similarProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->take(4) // Limitez à 4 produits similaires
                                ->get();

    return view('products.show', compact('product', 'similarProducts'));
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id . '|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    public function welcome()
    {
        // Fetch all products from the database
        $products = Product::all();
    
        // Pass the products to the view
        return view('welcome', compact('products'));
    }
    
    
}
