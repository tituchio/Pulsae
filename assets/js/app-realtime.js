angular.module('footballApp', [])
  .controller('RealtimeController', ['$scope', function($scope) {
  	$scope.Math = window.Math;
  	$scope.players = [];
    $scope.ball = null;
    $scope.referee = null;
    $scope.field = {width:1008, height:645};
    $scope.currTime = '';
    $scope.tagCount = 0;
    $scope.tagCountNormal = 0;
    $scope.plan = null;
    $scope.game = null;
    
    // redefine func
    $scope.isNaN = isNaN;
    
     var checkErrorIntervalId;
     var ws;
     var wsURL = 'ws://127.0.0.1:8888';
//     var tagStatusURL = 'http://127.0.0.1:80/rest/tag.action?json=get.tags';
     var tagStatusURL = 'http://127.0.0.1:8080/rest/tag.action?json=get.tags';
     var lastTime = 0;
    
    $scope.addData = function(data){
    	var found = false;
		
		console.log(data.tagEuid);
		var now = (new Date()).getTime();
		data.tagEuid = data.tagEuid.toUpperCase();
		
		// check at HOME TEAM players
		for(i in $scope.game.teams.HOME.players){
			if($scope.game.teams.HOME.players[i].EUID == data.tagEuid){
				for(p in data) $scope.game.teams.HOME.players[i][p] = data[p];
				$scope.game.teams.HOME.players[i].isShow =$scope.game.teams.HOME.players[i].isShow || false;
				$scope.game.teams.HOME.players[i].lastUpdate = now; 
			}
		}
		// check at AWAY TEAM players
		for(i in $scope.game.teams.AWAY.players){
			if($scope.game.teams.AWAY.players[i].EUID == data.tagEuid){
				for(p in data) $scope.game.teams.AWAY.players[i][p] = data[p];
				$scope.game.teams.AWAY.players[i].isShow =$scope.game.teams.AWAY.players[i].isShow || false;
				$scope.game.teams.AWAY.players[i].lastUpdate = now;
			}
		}
		
		if($scope.ball && $scope.ball.EUID == data.tagEuid){
			for(p in data) $scope.ball[p] = data[p];
			$scope.ball.lastUpdate = now;
		}
		else if($scope.referee && $scope.referee.EUID == data.tagEuid){
			for(p in data) $scope.referee[p] = data[p];
			$scope.referee.lastUpdate = now;
		}
		
		if(lastTime != data.addTime)
    		$scope.$digest();
    	lastTime = data.addTime;
    };
 	
 	$scope.startFH = function(){
 		if(!confirm("Are you sure?")) return false;
 		$.get(base_url + 'api/realtimeRecord/' + $scope.game.GAMEID + '/FH_STIME', afterClickRecord);
 		//start();
 	};
 	$scope.stopFH = function(){
 		if(!confirm("Are you sure?")) return false;
 		$.get(base_url + 'api/realtimeRecord/' + $scope.game.GAMEID + '/FH_ETIME', afterClickRecord);
 	};
 	$scope.startSH = function(){
 		if(!confirm("Are you sure?")) return false;
 		$.get(base_url + 'api/realtimeRecord/' + $scope.game.GAMEID + '/SH_STIME', afterClickRecord);
 	};
 	$scope.stopSH = function(){
 		if(!confirm("Are you sure?")) return false;
 		$.get(base_url + 'api/realtimeRecord/' + $scope.game.GAMEID + '/SH_ETIME', afterClickRecord);
 		stop();
 	};
 	
  function afterClickRecord(){
  	/*
  	$btn = $('#bt-record button:enabled').next();
  	$('#bt-record button').attr('disabled', true);
  	$btn.attr('disabled', false);
  	console.log($btn); // */
  }
    
  function init(){
  	$.get(base_url + 'api/initrealtime', function(data){
  		if(!data.game)
  		{
  			alert("No realtime game available");
  			return;
  		}
  		
  		console.log(data);
  		$scope.game = data.game;
  		$scope.ball = $scope.game.others.ball;
  		$scope.referee = $scope.game.others.referee;
  		$scope.game.teams.HOME.color = $scope.game.teams.HOME.COLOR;  
  		$scope.game.teams.AWAY.color = $scope.game.teams.AWAY.COLOR;
  		
  		// init error value
  		var now = (new Date()).getTime();
  		for(i in $scope.game.teams.HOME.players){
	  		if(typeof $scope.game.teams.HOME.players[i].lastUpdate == 'undefined'){
	  			$scope.game.teams.HOME.players[i].lastUpdate = now;
	  			$scope.game.teams.HOME.players[i].error =  {NA:0, batt:'N/A', errorNow:false};
	  			$scope.game.teams.HOME.players[i].isShow = true;
	  		}
  		}
  		for(i in $scope.game.teams.AWAY.players){
	  		if(typeof $scope.game.teams.AWAY.players[i].lastUpdate == 'undefined'){
	  			$scope.game.teams.AWAY.players[i].lastUpdate = now;
	  			$scope.game.teams.AWAY.players[i].error =  {NA:0, batt:'N/A', errorNow:false};
	  			$scope.game.teams.AWAY.players[i].isShow = true;
	  		}
  		}
  		
  		if($scope.ball){
	  		$scope.ball.lastUpdate = now;
		  	$scope.ball.error =  {NA:0, batt:'N/A', errorNow:false};
		  	$scope.ball.isShow = true;	
  		}
  		if($scope.referee){
	  		$scope.referee.lastUpdate = now;
		  	$scope.referee.error =  {NA:0, batt:'N/A', errorNow:false};
	  		$scope.referee.isShow = true;	
  		}
	  	
  		
  		$scope.$apply();
  		
  		start();
  	}, 'json');   		
  	
  	// system time
  	setInterval(function(){
  		var d = new Date();
  		$scope.currTime = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate() + " " +  d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
  		$scope.$apply();
  	}, 1000);
  	
  	checkErrorIntervalId = setInterval(checkError, 1000);
  	
  }
  
  function playerAllToggle(){
  	alert($('#players-all').is(':checked'));  	
  }
  
  function start(){
  	// Angular Scope
	    //var el = document.getElementById('main-container');
	    //var scope = angular.element(el).scope();
				
				
		console.log("START REALTIME");
	    // Web Socket
	    //ws = new WebSocket('ws://164.125.122.102:8888'); // Push Server 접속
		ws = new WebSocket(wsURL); // Push Server 접속
	  	ws.onopen = function() {
	  		console.log("ws.onopen"); //Connection Event
	    	//Push.init();
	  	};
	  	ws.onmessage = function(e) { //Push Message Event
	    	//Push.addPush(e.data);
	    	var json  = $.parseJSON(e.data);
	    	console.log(json);
			if(json.eventType == '1'){ // realtime position data
				//for(i in )
				$scope.addData(json);
			} 
	  	};
	 	ws.onclose = function() { //Disconnected Event
	 		console.log("ws.onclose"); 
	 		//Push.close();
	 		ws = null;
	  };
	 	ws.onerror = function() { //Error Event
	 		console.log("ws.onerror");
	    };
	    $( window ).unload(function() { 
	    	console.log("ws.window.unload");
	    	if(ws){
	    		console.log("ws.close()");
	        	ws.close();
	    		ws = null;
	    	}
	    });
	    $(window).bind('beforeunload',function(){
	    	console.log("ws.window.beforeunload");
	    	if(ws){
	    		console.log("ws.close()");
	        	ws.close();
	    		ws = null;
	    	}
	    });
  }
  
  function stop(){
  	clearInterval(checkErrorInterval);
  	ws.stop();
  }
  
  function checkError(){
  	
  	if(!$scope.game) return;
  	
	
  	$scope.$apply();
	$.get(tagStatusURL, function(data){
		
		
		var now = (new Date()).getTime();
		$scope.tagCount = 0;
		$scope.tagCountNormal = 0;
		//data[i].euid = data[i].euid
		
		var battErr = {};
		for(i in data) battErr[data[i].euid] = data[i];
		
		
		for(j in $scope.game.teams.HOME.players){
			
			$scope.tagCount++;
			var err = false; 
			
			var euid = $scope.game.teams.HOME.players[j].EUID;
			if(typeof battErr[euid] != 'undefined'){
				$scope.game.teams.HOME.players[j].error.batt = battErr[euid].batteryState==0?'normal':'low';
				err = battErr[euid].batteryState==1;
			}
			else	
				$scope.game.teams.HOME.players[j].error.batt = 'N/A';
				
			
			if(now - $scope.game.teams.HOME.players[j].lastUpdate > 1000){
				$scope.game.teams.HOME.players[j].error.NA = ($scope.game.teams.HOME.players[j].error.NA || 0) + 1;
				$scope.game.teams.HOME.players[j].error.errorNow = true;
				err = true;
			}
			else
				$scope.game.teams.HOME.players[j].error.errorNow = false;
				
			$scope.tagCountNormal += (err?0:1);
			
		}
		
		
		for(j in $scope.game.teams.AWAY.players){
			
			$scope.tagCount++;
			var err = false;
			
			var euid = $scope.game.teams.AWAY.players[j].EUID;
			if(typeof battErr[euid] != 'undefined'){
				$scope.game.teams.AWAY.players[j].error.batt = battErr[euid].batteryState==0?'normal':'low';
				err = battErr[euid].batteryState==1;
			}
			else	
				$scope.game.teams.AWAY.players[j].error.batt = 'N/A';
			
			if(now - $scope.game.teams.AWAY.players[j].lastUpdate > 1000){
				$scope.game.teams.AWAY.players[j].error.NA = ($scope.game.teams.AWAY.players[j].error.NA || 0) + 1;
				$scope.game.teams.AWAY.players[j].error.errorNow = true;
				err = true;
			}
			else
				$scope.game.teams.AWAY.players[j].error.errorNow = false;
				
			$scope.tagCountNormal += (err?0:1);
		}
		if($scope.ball){
			
			$scope.tagCount++;
			var err = false;
			
			var euid = $scope.ball.EUID;
			if(typeof battErr[euid] != 'undefined'){
			console.log("CHECK BALL STATUS");
			console.log(battErr[euid]);
				$scope.ball.error.batt = battErr[euid].batteryState==0?'normal':'low';
				err = battErr[euid].batteryState==1;
			}
			else	
				$scope.ball.error.batt = 'N/A';
			
			if(now - $scope.ball.lastUpdate > 1000){
				$scope.ball.error.NA = ($scope.ball.error.NA || 0) + 1;
				$scope.ball.error.errorNow = true;
				err = true;
			}
			else
				$scope.ball.error.errorNow = false;
				
			$scope.tagCountNormal += (err?0:1);
		}
			
		if($scope.referee){
				
			$scope.tagCount++;
			var err = false;
			
			var euid = $scope.referee.EUID;
			if(typeof battErr[euid] != 'undefined'){
				$scope.referee.error.batt = battErr[euid].batteryState==0?'normal':'low';
				err = battErr[euid].batteryState==1;
			}
			else	
				$scope.referee.error.batt = 'N/A';
			
			if(now - $scope.referee.lastUpdate > 1000){
				$scope.referee.error.NA = ($scope.referee.error.NA || 0) + 1;
				$scope.referee.error.errorNow = true;
				err = true;
			}
			else
				$scope.referee.error.errorNow = false;
				
			$scope.tagCountNormal += (err?0:1);
		}
	}, 'jsonp');
	
	
  }
        
        init();
  }]);
  
  
