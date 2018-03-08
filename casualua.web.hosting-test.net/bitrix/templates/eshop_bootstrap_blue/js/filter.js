;(function(window){

	console.log('JSmSimpleFilterSelectDropDownItem');

	if (window.JSmSimpleFilterSelectDropDownItem)
		return;

	window.JSmSimpleFilterSelectDropDownItem = function (arParams){
		this.sizeValue = null;
		this.priceValue = null;
		this.popups = [];		
	};

	window.JSmSimpleFilterSelectDropDownItem.prototype = 
	{
		popup: function(element, popupId) {
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
		},

		bindClick: function(element){
			var i;
			element = element.popupContainer.querySelectorAll('[data-sort]');
			for (i = 0; i < element.length; i++)
				BX.bind(element[i], 'click', BX.proxy(this.setFilter, this));			
		},

		setFilter: function(e){
			console.log('setFilter');
			console.log(e.target.getAttribute('data-sort') );
			
			console.log(this);
		}


	};

})(window);