
angular.module('orderItemCtrl', [])

// inject the Comment service into our controller
.controller('orderItemController', function($scope, $http, OrderItem) {
    // object to hold all the data for the new comment form
    $scope.orderItemData = {};

    // loading variable to show the spinning loading icon
    $scope.loading = true;

    // get all the OrderItems first and bind it to the $scope.orderItems object
    // use the function we created in our service
    // GET ALL OrderItems ==============
    Comment.get()
        .success(function(data) {
            $scope.orderItems = data;
            $scope.loading = false;
        });

    // function to handle submitting the form
    // SAVE A COMMENT ================
    $scope.submitOrderItem = function() {
        $scope.loading = true;

        // save the comment. pass in comment data from the form
        // use the function we created in our service
        Comment.save($scope.orderItemData)
            .success(function(data) {

                // if successful, we'll need to refresh the comment list
                Comment.get()
                    .success(function(getData) {
                        $scope.orderItems = getData;
                        $scope.loading = false;
                    });

            })
            .error(function(data) {
                console.log(data);
            });
    };

    // function to handle deleting a comment
    // DELETE A COMMENT ====================================================
    $scope.deleteComment = function(id) {
        $scope.loading = true; 

        // use the function we created in our service
        Comment.destroy(id)
            .success(function(data) {

                // if successful, we'll need to refresh the comment list
                Comment.get()
                    .success(function(getData) {
                        $scope.orderItems = getData;
                        $scope.loading = false;
                    });

            });
    };

});
