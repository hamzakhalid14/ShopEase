<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));  
    }

    
    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Récupérer le produit de la base de données
        $product = Product::find($request->product_id);

        // Vérifier si le produit existe
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Calculer le montant total de la commande
        $totalAmount = $product->price * $request->quantity;

        // Créer une nouvelle commande
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address ?? 'Default Address', // Assurez-vous que l'adresse de livraison est traitée
        ]);

        // Créer un élément de commande pour le produit sélectionné
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $product->price, // Stocker le prix unitaire ici
        ]);

        return redirect()->route('orders.create')->with('success', 'Order created successfully!');
    }
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required|numeric',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
