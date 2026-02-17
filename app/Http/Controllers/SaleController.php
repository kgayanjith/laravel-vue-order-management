<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer', 'items.product'])->where('status', 1)->latest()->get();
        // dd($sales);
        return Inertia::render('Home/Index', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        return Inertia::render('Sales/CreateUpdate', ['customers' => $customers, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();

        try {

            DB::beginTransaction();

            $sale = new Sale();
            $sale->customer_id = $validated['order']['customer_id'];
            $sale->invoiceNo = $validated['order']['invoiceNo'];
            $sale->invoiceDate = $validated['order']['invoiceDate'];
            $sale->referenceNo = $validated['order']['referenceNo'] ?? null;
            $sale->note = $validated['order']['note'] ?? null;
            $sale->save();

            $product = Product::findOrFail($validated['order']['product_id']);

            $qty =  $validated['order']['quantity'];
            $taxRate =  ($validated['order']['tax'] ?? 0);
            $price = $product->price;

            $excl = $qty * $price;
            $taxAmount = $excl * $taxRate / 100;
            $incl = $excl + $taxAmount;

            $sale->items()->create([
                'product_id' => $product->id,
                'note' => $validated['order']['product_note'] ?? null,
                'quantity' => $qty,
                'tax_rate' => $taxRate,
                'price' => $price,
                'excl_amount' => $excl,
                'tax_amount' => $taxAmount,
                'incl_amount' => $incl,
            ]);

            DB::commit();

            return redirect()->route('home')->with('success', 'Sale created successfully.');
        } catch (\Exception $ex) {
            dd($ex);
            DB::rollback();
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $customers = Customer::where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        $sales = Sale::with(['customer', 'items.product'])->where('id', $id)->first();
        return Inertia::render('Sales/CreateUpdate', ['customers' => $customers, 'products' => $products, 'sales' => $sales]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSaleRequest $request, Sale $sale)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $sale = Sale::findOrFail($validated['order']['id']);
            // dd($sale);
            $sale->customer_id = $validated['order']['customer_id'];
            $sale->invoiceNo    = $validated['order']['invoiceNo'];
            $sale->invoiceDate  = $validated['order']['invoiceDate'];
            $sale->referenceNo  = $validated['order']['referenceNo'] ?? null;
            $sale->note         = $validated['order']['note'] ?? null;
            $sale->save();

            $product = Product::findOrFail($validated['order']['product_id']);

            $qty   = $validated['order']['quantity'];
            $taxRate  = $validated['order']['tax'] ?? 0;
            $price  = $product->price;
            $excl  = $qty * $price;
            $taxAmount = $excl * $taxRate / 100;
            $incl   = $excl + $taxAmount;

            $sale->items()->updateOrCreate(
                ['sale_id' => $sale->id],
                [
                    'product_id' => $product->id,
                    'note'   => $validated['order']['product_note'] ?? null,
                    'quantity'  => $qty,
                    'tax_rate'  => $taxRate,
                    'price' => $price,
                    'excl_amount' => $excl,
                    'tax_amount'  => $taxAmount,
                    'incl_amount' => $incl,
                ]
            );

            DB::commit();

            return redirect()->route('home')->with('success', 'Sale updated successfully.');
        } catch (\Exception $ex) {
            dd($ex);
            DB::rollback();
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
