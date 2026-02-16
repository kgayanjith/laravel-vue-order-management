<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        return Inertia::render('Customer/Index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customer/CreateUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $validated = $request->validated();

        try{
            DB::beginTransaction();

            $addressParts = [
            $validated['addressline1'] ?? null,
            $validated['addressline2'] ?? null,
            $validated['addressline3'] ?? null,
            $validated['suburb'] ?? null,
            $validated['state'] ?? null,
            $validated['postalcode'] ?? null,
        ];

        $address = collect($addressParts)
            ->map(fn ($v) => is_string($v) ? trim($v) : $v)
            ->filter()
            ->implode(', ');

            $customer = new Customer();
            $customer->name = $validated['name'];
            $customer->phone = $validated['phone'];
            $customer->status = $validated['status'];
            $customer->address = $address; 
            $customer->save();

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer created successfully.');

        }catch (Exception $ex) {
            dd($ex);
            DB::rollback();
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
