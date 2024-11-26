<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap">
    <title>reciept</title>
    <style>
        * {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 0.8rem;
        }

        @php
            $products = $order->orderProducts ?? [];
            $height = (count($products) * 3) + 10;
        @endphp

@page {
            size: 7cm {{ $height }}cm;
            margin: 0;
        }

        .content-wrapper {
            height: auto;
            width: 6cm !important;
        }
    </style>

</head>
<body style="width: 6cm !important;height: auto;">
<div class="content-wrapper">
    <h3 align="center">Shox Market</h3>
    <table width="100%" border="1" align="center">
        <thead>
        <tr>
            <th>Продукт</th>
            <th>Кла</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderProducts as $orderProduct)
            <tr>
                <td class="w-25">{{$orderProduct->product->name}}</td>
                <td>{{$orderProduct->quantity}}</td>
                <td>{{$orderProduct->product->price}}</td>
                <td>{{$orderProduct->product->price * $orderProduct->quantity}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <td colspan="3" align="right"><b>Общая суммa:</b></td>
        <td>{{$order->total_price}}</td>
        </tfoot>
    </table>

</div>
</body>
</html>
