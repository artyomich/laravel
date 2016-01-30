<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>Шоп</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
     <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
            <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->
    
    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
        <script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
        <script src="js/services/commentService.js"></script> <!-- load our service -->
        <script src="js/app.js"></script> <!-- load our application -->
        
<!-- declare our angular app and controller --> 
<body class="container" ng-app="commentApp" ng-controller="mainController"> 
 
       
        <div class="container">
            <h1 class="text-center">Заказ</h1><hr>
 <form ng-submit="submitOrderItem()">
            @if (!$order_items->isEmpty())
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
                                    <div class="form-group">
                                        <input type="text" class="form-control input-sm" name="quantity" ng-model="orderItemData.quantity" placeholder="Quantity">
                                        {{ $order_item['quantity'] }}
                                        </input>
                                    </div>
                                </td>
                                <td>
                                   {{ $order_item['price'] }}
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                @endforeach
                        </tbody></table>
                    </div>
                </div>  
             </form>
            @else
                    <h1 class="panel-title">
                        Товаров в заказе нет :(
                    </h1>
            @endif
            
        
    <!-- LOADING ICON =============================================== -->
    <!-- show loading icon if the loading variable is set to true -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
    
    <!-- THE COMMENTS =============================================== -->
    <!-- hide these comments if the loading variable is true -->
    <div class="comment" ng-hide="loading" ng-repeat="orderItem in orderItems">
    <h3>Comment #{{ orderItem.id }}</h3>
    <p>{{ orderItem.text }}</p>
    
    <p><a href="#" ng-click="deleteOrderItem(orderItem.id)" class="text-muted">Delete</a></p>
            
            
            <a class="bold" href="/index.php/orders/">
                Вернутся ко всем моим заказам
            </a>
        </div>
    </body>
</html>