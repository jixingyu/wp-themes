jQuery(document).ready(function($){
	// http://ymic3dworld.com/lightwindow2/jQueryBubblePopup/Documentation/index.html
	/* Bubble popup for help tips*/
	$('#settings-container img.help').mouseenter(function(){
		$(this).CreateBubblePopup({
			themePath: bubblePopup.imagePath,
			position: 'top',
			align: 'right',
			themeName: 'all-black',
			innerHtmlStyle: { 'color': '#fff' },
			innerHtml: $(this).attr( 'tips' ),
			width: 200
		});		
	}).mouseleave(function(){
		$(this).RemoveBubblePopup();
	});
	
	/* Tabs */	
	$("#tabs-wrap ul li a").click(function(){
		sTab = $(this).attr('tab');
		document.cookie = 'settings_tab=' + sTab;
	});	
	sTabCookie = getCookie( 'settings_tab' );
	$("#tabs-wrap").tabs({
		collapsible: true, 
		active: sTabCookie 
	});	
		
	/* Get cookie */
	function getCookie( Name ) { 
		var search = Name + "=" 
		if(document.cookie.length > 0) 
		{ 
			offset = document.cookie.indexOf(search) 
			if(offset != -1) 
			{ 
				offset += search.length 
				end = document.cookie.indexOf(";", offset) 
				if(end == -1) end = document.cookie.length 
				return unescape(document.cookie.substring(offset, end)) 
			} 
			else return "" 
		} 
	}
	
});