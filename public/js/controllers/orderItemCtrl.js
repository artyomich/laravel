
angular.module('orderItemCtrl', [])

// inject the orderItem service into our controller
        .controller('orderItemController', function ($scope, $http, OrderItem) {
            // object to hold all the data for the new comment form
            $scope.order = {};

            // loading variable to show the spinning loading icon
            $scope.loading = true;


            // get all the OrderItems first and bind it to the $scope.orderItems object
            // use the function we created in our service
            // GET ALL OrderItems ==============
            $scope.initData = function (orderId) {
                OrderItem.get(orderId)
                        .success(function (data) {
                            $scope.order = data;
                            $scope.loading = false;
                        });
            }

            $scope.receiverCityId = function (cityOutId) {
                OrderItem.receiver($scope.order.id, cityOutId).success(function (data) {
                    $scope.order = data;
                    $scope.loading = false;
                })
                        .error(function (data) {
                            console.log(data);
                        });
            }
            
            $scope.senderCityId = function (cityInId) {
                OrderItem.sender($scope.order.id, cityInId).success(function (data) {
                    $scope.order = data;
                    $scope.loading = false;
                })
                        .error(function (data) {
                            console.log(data);
                        });
            }

            $scope.recalcQuantities = function (item) {
                $scope.loading = true;

                // save the comment. pass in comment data from the form
                // use the function we created in our service
                OrderItem.quantity($scope.order.id, item.id, item.quantity)
                        .success(function (data) {
                            $scope.order = data;
                            $scope.loading = false;
                        })
                        .error(function (data) {
                            console.log(data);
                        });
            };

            // function to handle deleting an order item
            // DELETE AN ORDER ITEM ====================================================
            $scope.deleteItem = function (item) {
                $scope.loading = true;

                // use the function we created in our service
                OrderItem.destroy($scope.order.id, item.id)
                        .success(function (data) {
                            $scope.order = data;
                            $scope.loading = false;
                        });
            };

            // ADD NEW ORDER ITEM ====================================================
            $scope.addItem = function (item) {
                $scope.loading = true;

                // use the function we created in our service
                OrderItem.add($scope.order.id, item.id)
                        .success(function (data) {
                            $scope.order = data;
                            $scope.loading = false;
                        });
            };

        });
