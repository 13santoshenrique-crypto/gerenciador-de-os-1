<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceOrders = ServiceOrder::all();
        return view('service-orders.index', compact('serviceOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_model' => 'required',
            'license_plate' => 'required|unique:service_orders',
            'service_description' => 'required',
        ]);

        ServiceOrder::create($request->all());

        return redirect()->route('service-orders.index')
                        ->with('success','Service order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrder $serviceOrder)
    {
        return view('service-orders.show',compact('serviceOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOrder $serviceOrder)
    {
        return view('service-orders.edit',compact('serviceOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceOrder $serviceOrder)
    {
        $request->validate([
            'vehicle_model' => 'required',
            'license_plate' => 'required|unique:service_orders,license_plate,'.$serviceOrder->id,
            'service_description' => 'required',
            'status' => 'required',
        ]);

        $serviceOrder->update($request->all());

        return redirect()->route('service-orders.index')
                        ->with('success','Service order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrder $serviceOrder)
    {
        $serviceOrder->delete();

        return redirect()->route('service-orders.index')
                        ->with('success','Service order deleted successfully');
    }
}
