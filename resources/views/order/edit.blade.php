<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>Шоп</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

        <!-- ANGULAR -->
        <!-- all angular resources will be loaded from the /public folder -->
        <script src="/js/controllers/orderItemCtrl.js" type="text/javascript"></script> <!-- load our controller -->
        <script src="/js/services/orderItemService.js" type="text/javascript"></script> <!-- load our service -->
        <script src="/js/app.js" type="text/javascript"></script> <!-- load our application -->
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js" type="text/javascript"></script>
        <script src="/js/autocompleteCityIn.js" type="text/javascript"></script>
        <script src="/js/autocompleteCityOut.js" type="text/javascript"></script>
    </head>    
    <!-- declare our angular app and controller --> 
    <body id="orderItemController" class="container" ng-init="initData({{ $order -> id}})" ng-app="orderItemApp" ng-controller="orderItemController"> 
        <div class="container">
            <h1 class="text-center">Заказ №<% order.id %></h1><hr>
            <dl class="dl-horizontal">
                <dt><label for="cityin">Город-отправитель:</label></dt>
                <dd><input id="cityin" /></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt><label for="cityout">Город-получатель: </label></dt>
                <dd><input id="cityout" /></dd>
            </dl>
            </div>

            <form ng-submit="submitOrderItem()">
                @if (!$order->items->isEmpty())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            Мои заказы
                        </h1>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Товар</th>
                                    <th>Вес, кг</th>
                                    <th>Габариты, см</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Сумма</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in order.items">
                                    <td class="nowrap">
                                        <% item.product.name %>
                                    </td>
                                    <td>
                                        <% item.product.weight %>
                                    </td>
                                    <td>
                                        <% item.product.length %> x <% item.product.width %> x <% item.product.height %>
                                    </td>
                                    <td>
                                        <% item.price %>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="quantity" ng-model="item.quantity" placeholder="Quantity" ng-blur="recalcQuantities(item)">
                                        </div>
                                    </td>
                                    <td>
                                        <% item.price * item.quantity %>
                                    </td>
                                    <td>
                                        <button ng-click="deleteItem(item)" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody></table>  
                    </div>
                </div>  
            <dl class="dl-horizontal">
                <dt>Вес</dt>
                <dd><% order.weight %> кг</dd>
                <dt>Объем:</dt>
                <dd><% order.volume %> м<pow>3</pow></dd>
                <dt>Цена доставки:</dt>
                <dd><% order.delivery_price %> руб</dd>
                <dt>Итого:</dt>
                <dd><% order.total %> руб</dd>
            </dl>
            @else
            <h1 class="panel-title">
                Товаров в заказе нет
            </h1>
            @endif

            
                <div class="text-left">
                    {{ Form::label('product', 'Товар ') }} {{ Form::select('addProductId',$products,null,['id'=>'addProductId', 'ng-model'=>'addProductId']) }}
                    <input type="text" size="5" name="addQuantity" ng-model="addQuantity" placeholder="Кол-во">
                    <button ng-click="addItem()" class="btn btn-primary btn-lg">
                        <i class="glyphicon glyphicon-plus-sign"></i> Добавить в заказ
                    </button>                               
                </div>
            </form>
    </body>

</html>