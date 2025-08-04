<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show the checkout page
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity
                ];
                $total += $product->price * $quantity;
            }
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        return view('payment.checkout', compact('cartItems', 'total'));
    }

    /**
     * Process the payment
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'shipping_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:card,cash_on_delivery',
            'card_number' => 'required_if:payment_method,card|string|size:16',
            'card_expiry' => 'required_if:payment_method,card|string',
            'card_cvv' => 'required_if:payment_method,card|string|size:3',
        ]);

        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->stock >= $quantity) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity
                ];
                $total += $product->price * $quantity;
            }
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'client_id' => auth()->id(),
                'total' => $total,
                'shipping_address' => $request->shipping_address,
                'shipping_phone' => $request->shipping_phone,
                'payment_method' => $request->payment_method,
                'status' => $request->payment_method === 'card' ? 'paid' : 'pending',
                'payment_status' => $request->payment_method === 'card' ? 'paid' : 'pending',
                'order_number' => 'ORD-' . time() . '-' . auth()->id(),
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                    'subtotal' => $item['subtotal'],
                ]);

                // Update product stock
                $item['product']->decrement('stock', $item['quantity']);
            }

            // Clear the cart
            session()->forget('cart');

            DB::commit();

            return redirect()->route('payment.success', $order->id)
                           ->with('success', 'Commande passée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue lors du traitement de votre commande.');
        }
    }

    /**
     * Show payment success page
     */
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        // Ensure the order belongs to the authenticated user
        if ($order->client_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.success', compact('order'));
    }

    /**
     * Show payment failure page
     */
    public function failure()
    {
        return view('payment.failure');
    }
}
