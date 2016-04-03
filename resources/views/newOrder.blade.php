@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">
                        Новый заказ
                    </h1>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Товар</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th>Сумма</th>
                                <th>Удалить</th>
                            </tr>
                            <tr ng-repeat="item in order.items">
                                <td class="nowrap">
                                  <select>
                                  @foreach ($products as $product)
                                        <option><% product.name %></option>
                                  @endforeach
                                  </select>
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
        </div>
    </div>
</div>
@endsection