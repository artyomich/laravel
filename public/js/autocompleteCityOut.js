        /**
	 * подтягиваем список городов ajax`ом, данные jsonp в зависмости от введённых символов
	 */
	$(function() {
	  $("#cityout").autocomplete({
	    source: function(request,response) {
	      $.ajax({
	        url: "http://api.cdek.ru/city/getListByTerm/jsonp.php?callback=?",
	        dataType: "jsonp",
	        data: {
	        	q: function () { return $("#cityout").val() },
	        	name_startsWith: function () { return $("#cityout").val() }
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
        