<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Данные заказа</h2>

    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Quantity</th>
            <th>Price x1</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price_x1 }}</td>
                <td>${{ $item->total_price }}</td>
            </tr>
        @endforeach
        <h3>Overall price:</h3>
        <p>${{$totalPrice}}</p>

        @if($discount)
            <h3>Discount %{{$discount['totalPercent']}}</h3>
            <h3>Price with discount:</h3>
            <p>${{floor($discount['priceWithDiscount'])}}</p>
        @endif
        </tbody>
    </table>

    <a href="{{ route('checkout.confirmOrder', ['order' => $order->id]) }}" class="btn btn-primary">Confirm Order</a>
</div>

</body>


</html>



