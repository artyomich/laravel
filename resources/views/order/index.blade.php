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
            <h1 class="text-center">Заказы</h1><hr>
    
            <form ng-submit="submitOrder()">
            @if ( ! $orders->isEmpty() )
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">
                        Мои заказы
                    </h1>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Номер заказа</th>
                                <th>Сумма заказа</th>
                                <th>Дата заказа</th>
                                <th>Редактирование заказа</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)

                            <tr>
                                <td class="nowrap">
                                    <a class="bold" href="{{ $order['id'] }}/edit/">
                                        {{ $order->id }}
                                    </a>
                                </td>
                                <td><span class="gray">{{ $order['total'] }}</span><br>
                                </td>
                                <td>
                                    <span class="gray">{{ $order['created_at'] }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ $order['id'] }}/edit/">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
            @else
            <h1 class="panel-title">
                Заказов пока еще нет
            </h1>
            @endif
            </form>
            <a class="bold" href="/index.php/home">
                Вернутся на домашнюю страницу
            </a>
        </div>
    </body>
</html>