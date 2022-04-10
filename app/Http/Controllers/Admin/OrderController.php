<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderDelivery;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 1;
        $currentPage = isset($request->page) ? $request->page : 1;

        $data['orders'] = Order::with(['user', 'orderItems', 'orderItems.product'])->whereHas('orderItems')->orderBy('created_at', 'desc');
        $data['orderCount'] = $data['orders']->count();
        $data['orderPages'] = ceil($data['orderCount'] / $perPage);

        $data['orders'] = $data['orders']->offset($perPage * ($currentPage - 1))
            ->limit($perPage)
            ->get();

        return view('admin.order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delivery($id)
    {
        $order = Order::find($id);

        if ($order->is_shipped) {
            return response([
                'result' => false,
            ]);
        } else {
            $order->update([
                'is_shipped' => true,
            ]);

            $order->user->notify(new OrderDelivery);

            return response([
                'result' => true,
            ]);
        }
    }
}
