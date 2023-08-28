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
    <form action="{{ route('api.confirmOrder', ['orderId' => $order->id])}}" method="post">
        @csrf
        @method('PATCH')


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

            </tbody>
        </table>

        <input type="submit" name="submit" value="Confirm Order">
    </form>
</div>

</body>


</html>



