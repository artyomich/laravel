<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>Шоп</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <div class="container">
            <h1 class="text-center">Заказ</h1><hr>

            @if ( ! $order_items->isEmpty() )
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            Мои заказы
                        </h1>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Товар</th>
                                    <th>Количество</th>
                                    <th>Цена</th>
                                    <th>Сумма</th>
                                </tr>
                @foreach ($order_items as $order_item)
                                
                                <tr>
                                <td class="nowrap">
                                    {{ $order_item->product_id }}
                                </td>
                                <td>
                                    <span class="gray">{{ $order_item['quantity'] }}</span>
                                </td>
                                <td>
                                   {{ $order_item['price'] }}
                                </td>
                                <td>
                                     <button class="btn btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                @endforeach
                        </tbody></table>
                    </div>
                </div>  
            @else
                    <h1 class="panel-title">
                        Товаров в заказе нет :(
                    </h1>
            @endif
            
            <a class="bold" href="/index.php/orders/">
                Вернутся ко всем моим заказам
            </a>
        </div>
    </body>
</html>