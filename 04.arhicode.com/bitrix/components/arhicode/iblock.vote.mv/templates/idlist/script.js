(function(window){

	if (window.JCCatalogVoteRating)
		return;

	window.JCCatalogVoteRating = function(arParams)
	{	
		if (typeof arParams === 'object')
		{
			this.save = false;
			this.rating = -1;
			this.params = arParams;
			this.voteList = new Array();
			this.newDivIdList = new Array();
			this.comment = '';			
			this.init();
		}	
	};

	window.JCCatalogVoteRating.prototype = {
		
		init: function() 
		{		
			var self = this;			

			$("#" + this.params.ID_RATING).change(function(e){				
				self.setRating(this);
				self.enadleDisableButtonSave();
			});

			$("#" + this.params.ID_SAVE_BUTTON).click(function(){		
				if(self.rating >= 0)	
					self.saveRating();
			});			

			$('#' + this.params.VKUS_DATA.DATA.modalID).on('hide.bs.modal', function () {
				self.closeModalWindow();
			});

			$('#' + this.params.ID_VKUS).change(function (e) {
				self.addNewVote(e.target);
				self.enadleDisableButtonSave();
			});
		},

		saveRating: function(){			
			var i, 
				n = 0,
				arr = new Array();


			if (!this.save)	{}

			this.comment = $('#'+ this.params.ID_CONTAINER +' textarea')[0].value;

			for (i in this.voteList){				
				if( this.voteList[i].RATING >= 0 ) {
					arr[n] = {
						'ELEMENT_ID': this.voteList[i].ELEMENT_ID,
						'IBLOCK_ID': this.voteList[i].IBLOCK_ID,
						'RATING' : this.voteList[i].RATING,
					}
					n++;
				}
			};
			
			postData = {
				'AJAX_CALL': this.params.AJAX_PARAMS.AJAX_CALL,
				'PAGE_PARAMS': {
					'ELEMENT_ID': this.params.AJAX_PARAMS.PAGE_PARAMS.ELEMENT_ID 
					},
				'SESSION_PARAMS': this.params.AJAX_PARAMS.SESSION_PARAMS,
				'rating': this.rating,
				'sessid':  this.params.SESSION_ID,
				'vote': "Y",
				'vote_id': this.params.ELEMENT_ID,
				'vote_list': arr,
				'comment': this.comment
			};			
			
			if ( this.rating )
			$.post(this.params.URL, postData)
			  	.done(function(d) {						
			    	// console.log(d);
			    	this.save = true;
			  	})
			  	.fail(function(d) {
			  		console.log('Error:');
			    	console.log(d);
			  	});			

			if(!commentObjectTransferJs.commentSave){				
				commentObjectTransferJs.comment = $('#' + this.params.ID_CONTAINER + ' textarea').val();
				if(commentObjectTransferJs.comment.length > 0 )
				{
					submitCommentNew();
					commentObjectTransferJs.commentSave = true;
					$('#' + this.params.ID_CONTAINER + ' textarea').val('');
				}
			}

			$('#' + this.params.VKUS_DATA.DATA.modalID).modal('hide');

			location.reload();
		},

		closeModalWindow: function(){			
			var i;
			this.rating = -1;			
			this.voteList = new Array(); 

			$("#" + this.params.ID_RATING).prop("selectedIndex", 0); 	// variant 1
			$("#" + this.params.ID_VKUS)[0].selectedIndex = 0;			// variant 2			

			this.enadleDisableButtonSave();

			for (i = 0; i < this.newDivIdList.length; i++){
				$("#"+this.newDivIdList[i]).remove();
			}
			this.newDivIdList = new Array();

			$('#' + this.params.ID_VKUS + ' option').each(function(e){				
				$(this).show();
			});			
		},

		setRating: function(e){
			this.rating = $(e).val();			
			this.voteList[this.params.ELEMENT_ID] = { 
				'ELEMENT_ID': this.params.ELEMENT_ID,
				'IBLOCK_ID': this.params.IBLOCK_ID,
				'RATING' : this.rating,
				'selectedOptionId': 0
			}			
		},

		enadleDisableButtonSave: function() {			
			if( this.rating >= 0)	
			{
				$("#"+this.params.ID_SAVE_BUTTON).removeClass("pvs-modal-footer-button-disable").addClass("pvs-modal-footer-button");
				$("#"+this.params.ID_SAVE_BUTTON).removeAttr('disabled');
			} 
			else 
			{
				$("#"+this.params.ID_SAVE_BUTTON).removeClass("pvs-modal-footer-button" ).addClass("pvs-modal-footer-button-disable");
				$("#"+this.params.ID_SAVE_BUTTON).attr('disabled', 'disabled');
			}
		},

		addNewVote: function(e){
			var self = this;

			var i, 
				j, 
				vkusName,
				vkusVkus,
				text = '',
				voteVkusContainer = '';

			var newDivId = null,
				newGroupName = null;


			var selectId = $(e).attr('id');	 
			var selectedOptionId = $('#'+selectId).find(":selected").attr('id');

			$('#' + selectedOptionId).hide();
			$("#" + selectId).prop("selectedIndex", 0);

			var vkus = this.params.VKUS_DATA.VKUS;

			for (i in vkus)
			{				
				if( selectedOptionId == vkus[i].ID )
				{
					for (j = 0; j < vkus[i]['ELEMENT_LIST_ID'].length; j++) 
					{
						this.voteList[ vkus[i]['ELEMENT_LIST_ID'][j] ] = { 
									'ELEMENT_ID': vkus[i]['ELEMENT_LIST_ID'][j],
									'IBLOCK_ID': vkus[i].IBLOCK_ID,
									'RATING' : -1,
									'selectedOptionId': selectedOptionId
									}						
					}
					vkusName = vkus[i].NAME; 	
					vkusVkus = vkus[i].VALUE; 	
				}
			}

			newDivId = 'div_' + selectedOptionId; 
			this.newDivIdList.push(newDivId); 
			newGroupName = 'group_' + selectedOptionId; 
			

			for (i = 0; i < 10; i++)
			{
				inputId = 'i_' + selectedOptionId + '_' + i;
				text = text + "<span>"+(1+i)+"<br><input data-option='"+selectedOptionId+"' type='radio' value='"+i+"' name='"+newGroupName+"'></span>"
			}
			
			voteVkusContainer = "<div id='"+newDivId+"' class='pvs-modal-vkus-container'>" +
									"<div class='pvs-modal-vkus-label'>" +
										"<span>"+vkusName+' - '+vkusVkus+"</span>"+
										"<a data-id='"+newDivId+"' data-option='"+selectedOptionId+"'>Удалить</a>" +
									"</div>" +
								"<div class='pvs-modal-vkus-check'>" +
									"<form>" +
	    								"<fieldset id='"+newGroupName+"'>" + 
	    									text + 
	    								"</fieldset></form></div></div>";
	    	
			$("#" + selectId).before(voteVkusContainer);

			$('#'+ newDivId + ' a').click(this.deleteVoteVkusContainer.bind(self));

			$('#'+ newDivId + ' input').each( function(){
				$(this).click(self.setRatingForCurentVkus.bind(self));
			});
		},

		deleteVoteVkusContainer: function(e){
			var i;
			var e = e.target;
			var opionId = $(e).attr('data-option');
			var divId = $(e).attr('data-id');
						
			for (i in this.voteList){
				if (opionId == this.voteList[i].selectedOptionId) { delete this.voteList[i]; }
			}
			
			for (i = 0; i < this.newDivIdList.length; i++)
				if (divId == this.newDivIdList[i]) this.newDivIdList.splice(i, 1);						
			
			$("#" + divId).remove();
			
			$('#' + opionId).show();
		},

		setRatingForCurentVkus: function(e){
			var i;
			var e = e.target;
			var opionId = $(e).attr('data-option');			

			for (i in this.voteList){			
				if (opionId == this.voteList[i].selectedOptionId) { 
					this.voteList[i].RATING = $(e).val();
				}
			}
		}

	}	

})(window);
