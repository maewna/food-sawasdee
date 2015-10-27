jQuery(document).ready(function(){
    
   var jq=jQuery;
   jq("#bpprofbpg_change").on('click', '#bppg-del-image', function(){
      var $this=jq(this);
      var noce='';
      
      jq.post(ajaxurl,{action:'bppg_delete_hd',
                      cookie:encodeURIComponent(document.cookie),
                       _wpnonce:jq($this.parents('form').get(0)).find('#_wpnonce').val()
          
      },
        function(response){
            //remove the current image
            //jq("div#message").remove();
            //$this.parent().before(jq("<div id='message' class='update'>"+response+"</div>"));
           //$this.prev('current-hd').fadeOut(100);//hide current image
           //$this.parent().remove();//remove from dom the delete link
			
			jq(".current-hd").empty();
			$("#bprpgbp_upload").replaceWith($("#bprpgbp_upload").val('').clone(true));
			jq(".current-hd").addClass('background-hd');
			
            //give feedback
            //remove the body class
            //jq('body').removeClass('is-user-profile');
			//jq('#header').removeClass('cover-head');
			jq('.cover-head').removeID('bg-img');
			
        }
  

);
    return false;
       
   })
  //bind for live change
    
});