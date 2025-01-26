<!DOCTYPE html>
<html>
<head>
    <style>
        .quote-header {
            background: #2d3748;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .company-logo {
            height: 80px;
            margin-bottom: 1rem;
        }
        .quote-details {
            margin: 2rem 0;
            border-collapse: collapse;
            width: 100%;
        }
        .quote-table th {
            background: #f7fafc;
        }
        /* Add your PDF styling here */
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left;}
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .totals { margin-top: 20px; float: right; }

    </style>
</head>
<body>
<div class="quote-header">
    <img src="{{ storage_path('app/public/logo.png') }}" class="company-logo">
    <h1>Industrial Tank Quotation</h1>
</div>
<div class="header">
    <h1>Quote #{{ $quote->id }}</h1>
    <p>Date: {{ now()->format('Y-m-d') }}</p>
</div>

<div class="customer-info">
    <h3>{{ $quote->company_name }}</h3>
    <p>Contact: {{ $quote->contact_name }}</p>
    <p>Email: {{ $quote->email }}</p>
    <p>Quote Valid Until: {{ \Carbon\Carbon::parse($quote->expiration_date)->format('d M Y') }}</p>
</div>

<table class="quote-table">
    <thead>
    <tr>
        <th>Tank Model</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($quote->products) as $product)
        <tr>
            <td>{{ $product->product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>${{ number_format($product->unit_price, 2) }}</td>
            <td>{{ $product->tax_rate }}%</td>
            <td>${{ number_format(($product->quantity * $product->unit_price) * (1 + $product->tax_rate/100), 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totals">
    <p>Subtotal: ${{ number_format($quote->subtotal, 2) }}</p>
    <p>Tax: ${{ number_format($quote->tax_total, 2) }}</p>
    <h3>Grand Total: ${{ number_format($quote->grand_total, 2) }}</h3>
</div>

<div class="terms">
    <h4>Terms & Conditions</h4>
    <p>{{ $quote->payment_terms }}</p>
    {!! nl2br($quote->special_notes) !!}
</div>


<table>
    <thead>
    <tr>
        <th>Tank Model</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quote->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>${{ number_format($product->pivot->unit_price, 2) }}</td>
            <td>{{ $product->pivot->tax_rate }}%</td>
            <td>${{ number_format(
                    ($product->pivot->quantity * $product->pivot->unit_price) *
                    (1 + ($product->pivot->tax_rate / 100)),
                    2
                ) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totals">
    <p>Subtotal: ${{ number_format($quote->subtotal, 2) }}</p>
    <p>Tax: ${{ number_format($quote->tax_total, 2) }}</p>
    <p><strong>Grand Total: ${{ number_format($quote->grand_total, 2) }}</strong></p>
</div>

<div class="terms">
    <h4>Terms & Conditions</h4>
    <p>{{ $quote->payment_terms }}</p>
    <p>{{ $quote->special_notes }}</p>
</div>

</body>
</html>
