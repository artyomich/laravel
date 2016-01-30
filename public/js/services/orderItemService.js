/* 
Angular service
 */

angular.module('orderItemService', [])

.factory('OrderItem', function($http) {

    return {
        // get all the comments
        get : function() {
            return $http.get('/api/orders/1/edit');
        },

        // save a comment (pass in orderItem data)
        save : function(commentData) {
            return $http({
                method: 'POST',
                url: 'api/orders/1/edit ',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(orderItemData)
            });
        },

        // destroy a comment
        destroy : function(id) {
            return $http.delete('/api/orders/1/edit/'+ id);
        }
    }

});

