;(function(window){
	console.log('JSmSimpleFilterSelectDropDownItem');

	if (window.JSmSimpleFilterSelectDropDownItem)
		return;

	window.JSmSimpleFilterSelectDropDownItem = function (arParams){
		this.sizeSort = arParams.SIZE_SORT;
		this.priceSort = arParams.PRICE_SORT;
		this.popups = [];
	};

	window.JSmSimpleFilterSelectDropDownItem.prototype = 
	{
		popup: function(element, popupId) 
		{
			var contentNode,
				id = "smartFilterDropDown_" + popupId;
				
			if (!this.popups[id])
			{
				contentNode = element.querySelector('[data-role="dropdownContent"]');
				this.popups[id] = BX.PopupWindowManager.create(id, element, {
					autoHide: true,
					offsetLeft: 0,
					offsetTop: 3,
					overlay : false,
					draggable: {restrict:true},
					closeByEsc: true,
					content: BX.clone(contentNode)
				});
				this.popups[id].show();
				this.bindClick(this.popups[id]);
			}
			else this.popups[id].show();
		},

		bindClick: function(element)
		{
			var i;
			element = element.popupContainer.querySelectorAll('[data-sort]');
			for (i = 0; i < element.length; i++)
				BX.bind(element[i], 'click', BX.proxy(this.setFilter, this));			
		},

		setFilter: function(e)
		{
			var request = e.target.getAttribute('data-request');
			var sort = e.target.getAttribute('data-sort');

			if (request == 'PRICE_SORT')
			{
				if (sort == this.priceSort) {
					BX.PopupWindowManager.getCurrentPopup().close();
					return;
				}
				var sortURL = window.location.origin + 
					window.location.pathname + 
					'?PRICE_SORT=' + sort + 
					'&SIZE_SORT='+ this.sizeSort;
			}
			if (request == 'SIZE_SORT')
			{
				if (sort == this.sizeSort) {
					BX.PopupWindowManager.getCurrentPopup().close();
					return;
				}
				var sortURL = window.location.origin + 
					window.location.pathname + 
					'?SIZE_SORT=' + sort + 
					'&PRICE_SORT='+ this.priceSort;
			}
			window.location = sortURL;
		}
	};

})(window);