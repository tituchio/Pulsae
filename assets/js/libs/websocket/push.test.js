
var Push = {
	_isAutoScroll : false, _isMovement : false,
	_console : null,
	init : function(){
		this._console = $('#logs');
		this._console.live("DOMSubtreeModified", function() { 
			var elem = $("#logs");
			if(elem.children('p').size() > 3000){
				elem.children("p:first").remove();
			}
			if (elem[0].scrollHeight > elem.outerHeight() && Push._isAutoScroll) {
				Push._console.animate({scrollTop : elem[0].scrollHeight}, 10);
	        }
		});
	},
	addPush : function(data){
		var json  = $.parseJSON(data);
		if(json.eventType == '1'){ //실시간 측위 데이터
			Push._console.append('<p style="color:white">'+data+'</p>');
			var debug = "측위시간:"+ Push.getLogTime(json.addTime)+", ";
			debug += "TAG EUID:"+json.tagEuid+", ";
			debug += "TAG 별명:"+json.tagAlias+", ";
			debug += "노드크기:"+json.tagSize+"px, ";
			debug += "노드색깔:"+json.tagColor+", ";
			debug += "노드성별:"+(json.tagGender == 1 ? '남' : '여')+", ";
			debug += "SEQ="+json.tagSeq+", ";
			debug += "측위알고리즘:"+(json.algorithm == 1 ? 'TDOA' : 'TWR')+", ";
			debug += "도면ID:"+json.planId+", ";
			debug += "도면이름:"+json.planName+", ";
			debug += "도면크기:"+json.planWidth+"x"+json.planHeight+", ";
			debug += "도면비율:1m="+json.planPixels+"px, ";
			debug += "취위위치:"+json.localX+","+json.localY+", ";
			debug += "거리오차:"+json.distance+"m, ";
			debug += "시간오차:"+json.delayTime+"ms, ";
			debug += "영역:"+json.zoneName+", ";
			debug += "이동경로:";
			for(var i=0; i <json.movePath.length; i++){
				debug += "["+json.movePath[i].x+", "+json.movePath[i].y+"]";
			}
			Push._console.append('<p style="color:white">'+debug+'</p>');
		}else if(json.eventType == '2'){ // 사용자 동선 정보
		}else if(json.eventType == '3'){ // 영역 노드개수 정보
		}else if(json.eventType == '4'){
			if(json.status == '1'){ //TAG 반납
				
			}else if(json.status == '2'){ // TAG 발급
				
			}else if(json.status == '2'){ // TAG 정보수정
				
			}
		}
		
	},
	clearConsole : function(){
		this._console.html('');
	},
	autoConsoleScroll : function(){
		if(this._isAutoScroll){
			this._isAutoScroll = false;
			$('#but_autoscroll').html('<button type="button" onclick="Panel.autoConsoleScroll()"><img src="./images/icon_off.gif"/>Scroll</button>');
		}else{
			this._isAutoScroll = true;
			$('#but_autoscroll').html('<button type="button" onclick="Panel.autoConsoleScroll()"><img src="./images/icon_on.gif"/>Scroll</button>');
		}
	},
	getLogTime : function(milliseconds){
		var d = new Date(parseInt(milliseconds));
		var h = d.getHours();
		var m = d.getMinutes();
		var s = d.getSeconds();
		var ms = d.getMilliseconds();
		if(h < 10) h = "0"+h;
		if(m < 10) m = "0"+m;
		if(s < 10) s = "0"+s;
		if(ms < 100) ms = "0"+ms;
		else if(ms < 10) ms = "00"+ms;
		return h+":"+m+":"+s+":"+ms;
	},
	close : function(){
		$("#dialog-message").dialog({
			title : '서버접속해제',
	        width: "400",
	        bgiframe: true,
	        autoOpen: false,
	        modal: true,
	        resizable: false,
	        buttons: {
				"확인": function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				$("#dialog-message").empty();
	        }
	        
	    });
		$("#dialog-message").append("<p>서버와 접속이 끊어졌습니다.</p><p>다시 접속 하십시요.</p>");
		$('#dialog-message').dialog('open');
	}
	
	
	
};