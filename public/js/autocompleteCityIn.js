        /**
	 * подтягиваем список городов ajax`ом, данные jsonp в зависмости от введённых символов
	 */
	$(function() {
	  $("#cityin").autocomplete({
	    source: function(request,response) {
	      $.ajax({
	        url: "http://api.cdek.ru/city/getListByTerm/jsonp.php?callback=?",
	        dataType: "jsonp",
	        data: {
	        	q: function () { return $("#cityin").val() },
	        	name_startsWith: function () { return $("#cityin").val() }
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
	    	angular.element('#orderItemController').scope().senderCityId(ui.item.id);
	    }
	  });
	});
        