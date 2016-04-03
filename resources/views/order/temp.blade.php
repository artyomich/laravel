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