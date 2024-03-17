<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $query = Order::query();

        if (isset($params['$orderby'])) {
            $query = $query->orderBy($params['$orderby']);
        }
        if (isset($params['$skip'])) {
            $query = $query->skip($params['$skip']);
        }
        if (isset($params['$top'])) {
            $query = $query->limit($params['$top']);
        }

        return [
            'Items' => OrderResource::collection($query->get()),
            'Count' => Order::count(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        $data = $request->all();
        Order::create($data);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order)
    {
        return [
            'Item' => new OrderResource($order),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $order = Order::where('orderID', $data['orderID'])->first();
        if ($order) {
            $order->update($data);
        }
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($orderID)
    {
        $order = Order::where('orderID', $orderID)->firstOrFail();
        if ($order->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
