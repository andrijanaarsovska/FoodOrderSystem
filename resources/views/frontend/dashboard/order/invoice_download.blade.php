<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
            <!-- {{-- <img src="" alt="" width="150"/> --}} -->
            <h2 style="color: green; font-size: 26px;"><strong>FoodShop</strong></h2>
        </td>
        <td align="right">
            <pre class="font">
               FoodShop Head Office
               Email:support@foodshop.com <br>
               Mob: +38971000111 <br>

            </pre>
        </td>
    </tr>

</table>


<table width="100%" style="background:white; padding:2px;"></table>

<table width="100%" style="background: #F7F7F7" class="font">
    <tr>
        <td style="padding: 15px; vertical-align: top;">
            <div style="line-height: 1.6;">
                <strong>Name:</strong> {{ $order->name }}<br>
                <strong>Email:</strong> {{ $order->email }}<br>
                <strong>Phone:</strong> {{ $order->phone }}<br>
                <strong>Address:</strong> {{ $order->address }}
            </div>
        </td>

        <td style="padding: 15px; vertical-align: top;">
            <div style="line-height: 1.6;">
                <span style="color: green; font-weight: bold;">Invoice:</span> #{{ $order->invoice_no }}<br>
                <strong>Order Date:</strong> {{ $order->order_date }}<br>
                <strong>Payment Type:</strong> {{ $order->payment_type }}
            </div>
        </td>
    </tr>
</table>
<br/>
<h3>Products</h3>


<table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
    <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Restaurant Name</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>


    @foreach( $orderItem as $item)
    <tr class="font">
        <td align="center">
            <img src="{{ public_path($item->product->image) }}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center">{{ $item->product->name }}</td>
        <td align="center">{{ $item->product->code }}</td>
        <td align="center">{{ $item->qty}}</td>
        <td align="center">{{ $item->product->client->name }}</td>
        <td align="center">{{ $item->price }}</td>
    </tr>
    @endforeach

    </tbody>
</table>
<br>
<table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right">
            <h2><span style="color: green;">Total:</span>{{ $totalPrice }} mkd</h2>
        </td>
    </tr>
</table>
<div class="thanks mt-3">
    <p>Thanks For The Purchase!</p>
</div>
<div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
</div>
</body>
</html>
