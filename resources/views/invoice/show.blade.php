@extends('layouts.simple.master')

@section('title', 'Invoice')

@section('css')
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Invoice #{{ $order->invoice->invoice_number }}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Shop</li>
<li class="breadcrumb-item">Orders</li>
<li class="breadcrumb-item active">Invoice</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="invoice-box">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="4">
                            <table>
                                <tr>
                                    <td>
                                        <h2>{{ config('app.name') }}</h2>
                                    </td>
                                    <td>
                                        Invoice #: {{ $order->invoice->invoice_number }}<br>
                                        Created: {{ $order->invoice->invoice_date->format('M d, Y') }}<br>
                                        Due: {{ $order->invoice->due_date->format('M d, Y') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr class="information">
                        <td colspan="4">
                            <table>
                                <tr>
                                    <td>
                                        <strong>Billing Address:</strong><br>
                                        {{ $order->customer->name }}<br>
                                        {{ $order->shipping_address }}
                                    </td>
                                    
                                    <td>
                                        <strong>Shipping Method:</strong><br>
                                        {{ $order->shipping_method }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr class="heading">
                        <td>Item</td>
                        <td style="text-align: center;">Quantity</td>
                        <td style="text-align: right;">Unit Price</td>
                        <td style="text-align: right;">Amount</td>
                    </tr>
                    
                    @foreach($order->items as $item)
                    <tr class="item {{ $loop->last ? 'last' : '' }}">
                        <td>{{ $item->product->name }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">${{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align: right;">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                    
                    <tr class="total">
                        <td colspan="3">Subtotal:</td>
                        <td>${{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    
                    <tr class="total">
                        <td colspan="3">Shipping:</td>
                        <td>${{ number_format($order->shipping_cost, 2) }}</td>
                    </tr>
                    
                    <tr class="total">
                        <td colspan="3">Tax:</td>
                        <td>${{ number_format($order->tax, 2) }}</td>
                    </tr>
                    
                    <tr class="total">
                        <td colspan="3"><strong>Total:</strong></td>
                        <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                    </tr>
                </table>
                
                <div class="mt-4 text-center">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fa fa-print"></i> Print Invoice
                    </button>
                    <a href="{{ route('order-history') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
