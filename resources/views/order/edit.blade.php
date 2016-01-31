<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>Шоп</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/jquery-ui-1.8.21.custom.css">
        
        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

        <!-- ANGULAR -->
        <!-- all angular resources will be loaded from the /public folder -->
        <script src="/js/controllers/orderItemCtrl.js"></script> <!-- load our controller -->
        <script src="/js/services/orderItemService.js"></script> <!-- load our service -->
        <script src="/js/app.js"></script> <!-- load our application -->
        <script src="/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
        <script>
            	/**
	 * подтягиваем список городов ajax`ом, данные jsonp в зависмости от введённых символов
	 */
	$(function() {
	  $("#city").autocomplete({
	    source: function(request,response) {
	      $.ajax({
	        url: "http://api.cdek.ru/city/getListByTerm/jsonp.php?callback=?",
	        dataType: "jsonp",
	        data: {
	        	q: function () { return $("#city").val() },
	        	name_startsWith: function () { return $("#city").val() }
	        },
	        success: function(data) {
	          response($.map(data.geonames, function(item) {
	            return {
	              label: item.name,
	              value: item.name,
	              id: item.id
	            }
	          }));
	        }
	      });
	    },
	    minLength: 1,
	    select: function(event,ui) {
	    	//console.log("Yep!");
	    	angular.element('#orderItemController').scope().receiverCityId(ui.item.id);
	    }
	  });
	});
        </script>
    </head>    
    <!-- declare our angular app and controller --> 
    <body id="orderItemController" class="container" ng-init="initData({{ $order->id }})" ng-app="orderItemApp" ng-controller="orderItemController"> 


        <div class="container">
            <h1 class="text-center">Заказ</h1><hr>

            <label for="city">Город-получатель: </label>
            <div class="ui-widget" style="display: inline-block;">
                <input id="city" />
                <br />
            </div>

            <form ng-submit="submitOrderItem()">
                @if (!$order->items->isEmpty())
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
                                    <th>Действие</th>
                                </tr>
                                <tr ng-repeat="item in order.items">
                                    <td class="nowrap">
                                        <% item.product.name %>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="quantity" ng-model="item.quantity" placeholder="Quantity" ng-blur="recalcQuantities(item)">
                                        </div>
                                    </td>
                                    <td>
                                        <% item.price %>
                                    </td>
                                    <td>
                                        <% item.quantity %> x <% item.price %> = <% item.price * item.quantity %>
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
            </form>
            @else
            <h1 class="panel-title">
                Товаров в заказе нет :(
            </h1>
            @endif
            
            <span>Вес:</span>
            <span><% order.weight %></span>
            <span>Цена доставки:</span>
            <span><% order.delivery_price %></span>
            <span>Итого:</span>
            <span><% order.total %></span>

    </body>

</html>