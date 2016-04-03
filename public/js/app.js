var orderItemApp = angular.module('orderItemApp', ['orderItemCtrl', 'orderItemService'] , function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });