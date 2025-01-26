@extends('layouts.simple.master')

@section('title', 'Order History')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Order History</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Shop</li>
<li class="breadcrumb-item active">Order History</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>My Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="orders-table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->order_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <a href="{{ route('invoice', $order) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-pdf-o"></i> Invoice
                                        </a>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#orderDetails{{ $order->id }}">
                                            <i class="fa fa-eye"></i> Details
                                        </button>
                                    </td>
                                </tr>

                                <!-- Order Details Modal -->
                                <div class="modal fade" id="orderDetails{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Order Details - #{{ $order->order_number }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <h6>Shipping Address</h6>
                                                        <p>{{ $order->shipping_address }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Shipping Method</h6>
                                                        <p>{{ $order->shipping_method }}</p>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($order->items as $item)
                                                            <tr>
                                                                <td>{{ $item->product->name }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>${{ number_format($item->unit_price, 2) }}</td>
                                                                <td>${{ number_format($item->subtotal, 2) }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                                                                <td>${{ number_format($order->subtotal, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>Shipping:</strong></td>
                                                                <td>${{ number_format($order->shipping_cost, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>Tax:</strong></td>
                                                                <td>${{ number_format($order->tax, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                                                <td>${{ number_format($order->total, 2) }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            "order": [[ 1, "desc" ]],
            "pageLength": 10
        });
    });
</script>
@endsection
