/* 
Angular service
 */

angular.module('orderItemService', [])

.factory('OrderItem', function($http) {

    return {
        // get all the order items
        get : function(orderId) {
            return $http.get('/index.php/api/orders/' + orderId + '/items');
        },

        // save a order item  quantity
        quantity : function(orderId, itemId, quantity) {
            return $http({
                method: 'POST',
                url: '/index.php/api/orders/'+orderId + '/items/' + itemId + '/quantity',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param({'quantity': quantity})
            });
        },
        
                // save a order item  quantity
        receiver : function(orderId, receiverCityId) {
            return $http({
                method: 'POST',
                url: '/index.php/api/orders/'+orderId + '/receiver',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param({'receiver_city_id': receiverCityId})
            });
        },

        // destroy a comment
        destroy : function(orderId, itemId) {
            return $http.delete('/index.php/api/orders/'+ orderId + '/items/'+ itemId);
        }
    }

});

