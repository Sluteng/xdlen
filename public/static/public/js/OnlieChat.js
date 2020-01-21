window.onscroll = function(){        
		var oDiv = document.getElementById('top');       
		 var scrollTop =document.documentElement.scrollTop||document.body.scrollTop;//浏览器兼容        
		 startmove(document.documentElement.clientHeight - oDiv.offsetHeight + scrollTop)                // document.documentElement.clientHeight 页面可视区高度   
	}            
	var timer = null;    
	
	//悬浮框缓冲运动
	
	function startmove(iTarget){        
		var oDiv = document.getElementById('top');        
		clearInterval(timer);       
		timer = setInterval(function(){                        
			var speed = (iTarget-oDiv.offsetTop)/4;            
			speed = speed>0?Math.ceil(speed):Math.floor(speed);           
			 if(oDiv.offsetTop == iTarget){               
			 	 clearInterval(timer);          
			 }
		         else{                
		         	oDiv.style.top = oDiv.offsetTop +speed+'px';            
		         }
                },30)
         }   




(function(){window.scrollBox=function(a){var b=this;b.box=a.box||".scrollBox";b.top=a.top||"0px";b.minWidth=a.minWidth||0;b.bottom=a.bottom||0;b.space=a.space||20;b.transition=a.transition==false?false:true;if(a.maxHeightBox){b.maxHeight=$(a.maxHeightBox).offset().top+$(a.maxHeightBox).height()}b.init()};scrollBox.prototype={init:function(){var e=this,d=window.innerWidth,b=window.innerHeight;boxT=$(e.box).offset().top,boxH=$(e.box).height(),boxMT=0;$(window).resize(function(){e.throttle(c,200,3000)()});if(d>=e.minWidth){if(e.transition){$(e.box).css("transition","margin 0.1s ease-out");$(window).scroll(function(){e.throttle(a,200,3000)()})}else{$(window).scroll(function(){a()})}a()}function c(){d=window.innerWidth;b=window.innerHeight;boxT=$(e.box).offset().top-parseFloat($(e.box).css("margin-top"));boxH=$(e.box).height()}function a(){if(d>=e.minWidth){if(e.maxHeight<boxT+boxH+e.space){return false}var g=$(window).scrollTop();if(boxH>b-e.top-e.space*2){if(g<=(boxT-e.top-e.space)){$(e.box).css({"margin-top":"0"})}else{if(e.maxHeight){if(g>e.maxHeight+e.space-b){$(e.box).css({"margin-top":e.maxHeight-boxT-boxH+"px"});return false}}var f=g-boxT-(boxH+e.bottom+e.space-b);if(f<boxMT){if(g<$(e.box).offset().top-e.top-e.space){boxMT=g-boxT+e.top+e.space}}else{boxMT=f}$(e.box).css({"margin-top":boxMT+"px"})}}else{if(g<=(boxT-e.top-e.space)){$(e.box).css({"margin-top":"0"})}else{if(e.maxHeight){if(g>e.maxHeight-boxH-e.top-e.space){return false}}var f=g-boxT+e.top+e.space;$(e.box).css({"margin-top":f+"px"})}}}}},throttle:function(c,b,a){var e=null;var d=null;return function(){var f=+new Date();!d&&(d=f);if(a&&f-d>a){c();d=f}else{clearTimeout(e);e=setTimeout(function(){c();d=null},b)}}}}}());
	new scrollBox({
		box:'.top',			//悬浮框id或class
		top:500,				//顶部固定header高度
		bottom:0,			//底部固定footer高度
		space:20,			//悬浮框距离头部和尾部的间距
		maxHeightBox:'.body',	//需要跟随主体内容的id或class
		minWidth:1000,		//需要悬浮跟随的屏幕最小宽度
		transition:true		//是否启用函数节流和跟随动画
	});