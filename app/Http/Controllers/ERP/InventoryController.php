<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Afficher le tableau de bord inventaire
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistiques inventaire
        $stats = [
            'warehouses_count' => DB::table('erp_inventory_warehouses')->count(),
            'locations_count' => DB::table('erp_inventory_locations')->count(),
            'stock_movements_today' => DB::table('erp_inventory_stock_movements')
                ->whereDate('created_at', today())
                ->count(),
            'low_stock_items' => DB::table('erp_inventory_stock_levels')
                ->where('quantity_on_hand', '<=', DB::raw('reorder_point'))
                ->count()
        ];
        
        // Entrepôts récents
        $warehouses = DB::table('erp_inventory_warehouses')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Mouvements récents
        $recentMovements = DB::table('erp_inventory_stock_movements')
            ->join('products', 'erp_inventory_stock_movements.product_id', '=', 'products.id')
            ->join('erp_inventory_warehouses', 'erp_inventory_stock_movements.warehouse_id', '=', 'erp_inventory_warehouses.id')
            ->select('erp_inventory_stock_movements.*', 'products.name as product_name', 'erp_inventory_warehouses.name as warehouse_name')
            ->orderBy('erp_inventory_stock_movements.created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('erp.inventory.dashboard', compact('stats', 'warehouses', 'recentMovements', 'user'));
    }
    
    /**
     * Liste des entrepôts
     */
    public function warehouses()
    {
        $warehouses = DB::table('erp_inventory_warehouses')
            ->orderBy('name')
            ->paginate(10);
            
        return view('erp.inventory.warehouses.index', compact('warehouses'));
    }
    
    /**
     * Créer un nouvel entrepôt
     */
    public function createWarehouse()
    {
        return view('erp.inventory.warehouses.create');
    }
    
    /**
     * Stocker un nouvel entrepôt
     */
    public function storeWarehouse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:erp_inventory_warehouses',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);
        
        DB::table('erp_inventory_warehouses')->insert([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('erp.inventory.warehouses.index')
            ->with('success', 'Entrepôt créé avec succès !');
    }
    
    /**
     * Liste des mouvements de stock
     */
    public function movements()
    {
        $movements = DB::table('erp_inventory_stock_movements')
            ->join('products', 'erp_inventory_stock_movements.product_id', '=', 'products.id')
            ->join('erp_inventory_warehouses', 'erp_inventory_stock_movements.warehouse_id', '=', 'erp_inventory_warehouses.id')
            ->select('erp_inventory_stock_movements.*', 'products.name as product_name', 'erp_inventory_warehouses.name as warehouse_name')
            ->orderBy('erp_inventory_stock_movements.created_at', 'desc')
            ->paginate(15);
            
        return view('erp.inventory.movements.index', compact('movements'));
    }
    
    /**
     * Créer un nouveau mouvement
     */
    public function createMovement()
    {
        $products = DB::table('products')->orderBy('name')->get();
        $warehouses = DB::table('erp_inventory_warehouses')->where('is_active', true)->get();
        
        return view('erp.inventory.movements.create', compact('products', 'warehouses'));
    }
    
    /**
     * Stocker un nouveau mouvement
     */
    public function storeMovement(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:erp_inventory_warehouses,id',
            'movement_type' => 'required|in:in,out,transfer,adjustment',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'nullable|numeric|min:0',
        ]);
        
        DB::table('erp_inventory_stock_movements')->insert([
            'product_id' => $request->product_id,
            'warehouse_id' => $request->warehouse_id,
            'location_id' => $request->location_id,
            'movement_type' => $request->movement_type,
            'quantity' => $request->quantity,
            'unit_cost' => $request->unit_cost,
            'reference' => $request->reference,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
            'movement_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('erp.inventory.movements.index')
            ->with('success', 'Mouvement de stock enregistré avec succès !');
    }
} 