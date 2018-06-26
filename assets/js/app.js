angular.module('footballApp', [])
  .controller('FootballController', ['$scope', function($scope) {
  	$scope.Math = window.Math;
  	$scope.game = null;
  	$scope.analysisreq = null;
  	$scope.analysisteam = null;
  	$scope.analysisteamIndex = 0;
  	$scope.profile = "";
    $scope.time= "00:00";
    $scope.timeProcent = 0;
    $scope.currTime = 0;
    $scope.control = {
    	start : 0,
    	end : 45,
    	startIndex : 0,
    	endIndex : 0,
    	curIndex:0
    };
    $scope.options = {
    	gameId : null,
    	analysisId:null,
    	timeStart : null,
    	timeEnd : null,
    	slider: ''
    };
    $scope.playersLink = {};
    $scope.selectedPlayer = null;
    $scope.selectedTeam = null;
    $scope.ball = {x:-50, y:-50, isShow : true, color:'#000000'};
    $scope.referee = {x:-50, y:-50, isShow : true, color:'#666666'};
    $scope.detailAnalysis = null;
    $scope.showRoute = false;
    $scope.field = {width:1008, height:645};
    $scope.isPlay = false;
    
    var analysis = {};
    
    $scope.setGame = function(){
    	// console.log('SET GAME');
    	init();
    	loading('start');
    };
    
    // PLAYBACK CONTROL
    var timeoutId;
    $scope.start = function(){
    	if($scope.control.startIndex == $scope.control.endIndex){
    		alert("Please select the Game");
    		return false;
    	}
    	if(typeof analysis.events[$scope.control.curIndex] != 'undefined' ){
    		//$scope.control.curIndex = $scope.control.startIndex;
    		// console.log('START : ');
    		$scope.showRoute = false;
    		$scope.isPlay = true;
    		setTimeout(play, 2);
    		//startTick();
    	}
    	else{
    		alert("There is no data");
    	}
    };   
    $scope.stop = function(){
    	clearTimeout(timeoutId);
    	$scope.control.curIndex = $scope.control.startIndex;
    	initCanvas();
    	$scope.isPlay = false;
    	$scope.time= "00:00";
    	$scope.timeProcent = 0;
    };
    $scope.pause = function(){
    	clearTimeout(timeoutId);
    	$scope.isPlay = false;
    	console.log($scope.game);
    };
    
    
    $scope.selectPlayer = function(team, player){
    	player.isShow = !(player.isShow || false);
    	$scope.selectedPlayer = player==$scope.ball||player==$scope.referee?null:player; 
    	$scope.selectedTeam = team;
    };
    $scope.selectTeam = function(team){    	
    	// show information	
    	$scope.profile = "";
		$scope.profile += "TEAM NAME : " + team.NAME+"\n";
		//$scope.profile += '<img src="'+base_url+'assets/img'+team.IMAGE+'">';
		$scope.selectedPlayer = null;
		$scope.selectedTeam = team;
		for(i in team.players)team.players[i].isShow = true; 
    };
    $scope.showMeOnly = function(player){
    	for(i in $scope.playersLink)$scope.playersLink[i].isShow = false;
    	player.isShow = true;
    	$scope.selectedPlayer = player==$scope.ball||player==$scope.referee?null:player; 
    	$scope.selectedTeam = player.team;
    };
    $scope.showDetailAnalysis = function(type, title){
    	$scope.detailAnalysis = {type:type, title:title};
    	setTimeout(function(){$('#detailAnalysis').trigger('openModal');}, 10);
    };
    
    $scope.showRouteChange = function(){
    	if($scope.showRoute){
    		canvasStroke();
    	}
    };
    
    
    // LOAD GAME
    function init(){
    	
    	console.log("INIT");
    	if(nextEventsReq)nextEventsReq.abort();
    	$scope.stop();
    	
	    // init
	    $.get(base_url + 'api/init/' + $scope.options.analysisId, function(data){
	    	$scope.$apply(function(){
	    		$scope.game = data.game;
	    		$scope.analysisreq = data.analysisreq;
	    		$scope.analysisteam = data.analysisteam;
	    		$scope.analysisteamIndex = 0;
	    		//$scope.from_time =data.analysisreq.FS=='F' ? data.game. FH_STIME:data.game. SH_STIME;
	    		//$scope.to_time =data.analysisreq.FS=='F' ? data.game. FH_ETIME:data.game. SH_ETIME;
	    		$scope.from_time = data.game.FROM_TIME;
	    		$scope.to_time = data.game.TO_TIME;
	    		
	    		props = ['PASSSUCCESS', 'PASSFAIL', 'DISTANCE', 'OCCRATE', 'PULSEAVG', 'PULSEMAX', 'RED', 'TOTALSHOOTING', 'VALIDSHOOTING', 'VELAVG', 'VELMAX', 'YELLOW'];
				for(x in props){
					$scope.analysisreq['HOME_' + props[x]]	= Number($scope.analysisreq['HOME_' + props[x]]);
					$scope.analysisreq['AWAY_' + props[x]]	= Number($scope.analysisreq['AWAY_' + props[x]]);
				}
	    		
		  		for (i in $scope.game.teams.HOME.players){
		  			$scope.game.teams.HOME.players[i].isShow = true;
		  			$scope.game.teams.HOME.players[i].color =$scope.game.teams.HOME.COLOR;
		  			$scope.game.teams.HOME.players[i].team = $scope.game.teams.HOME;
		  			$scope.playersLink[$scope.game.teams.HOME.players[i].PLAYERID] = $scope.game.teams.HOME.players[i];
		  		}
		  		for (i in $scope.game.teams.AWAY.players){
		  			$scope.game.teams.AWAY.players[i].isShow = true;
		  			$scope.game.teams.AWAY.players[i].color =$scope.game.teams.AWAY.COLOR;
		  			$scope.game.teams.AWAY.players[i].team = $scope.game.teams.AWAY;
		  			$scope.playersLink[$scope.game.teams.AWAY.players[i].PLAYERID] = $scope.game.teams.AWAY.players[i];
		  		}
		  		
		  		$scope.playersLink[-1] = $scope.ball;
		  		$scope.playersLink[-2] = $scope.referee;
		  		
		  		$scope.ball.x = -50;
		  		$scope.ball.y = -50;
    			$scope.referee.x = -50;
    			$scope.referee.y = -50;
		  		  		
		  		analysis = data.analysis;
    			$scope.control.endIndex = data.analysis.events.length - 1;
    			
    			setTimeout(initCanvas, 100);
    			
    			$('#options').trigger('closeModal');
    			loading('stop');
    			
	    	});
	    	
	    	// request next events
	    	next_events(analysis.events[$scope.control.endIndex].OID);
	    	
	    	// console.log(data);    	
	    }, 'json')	;
    }
    
    var nextEventsReq = null;
    function next_events(lastId){
    	// console.log("REQUEST NEXT EVENTS : " + lastId);
    	nextEventsReq = $.get(base_url + 'api/analysis_next/' + $scope.options.analysisId + '/' + lastId, function(data){
		  	//analysis.events = $.merge(analysis.events, data.events);
		  	for(i in data.events){analysis.events.push(data.events[i]);}
		  	$scope.control.endIndex = analysis.events.length - 1;
	    	$scope.$digest();
		  		
	  		if(data.events.length > 0){
	  			console.log("NEXT EVENTS");
	  			next_events(analysis.events[$scope.control.endIndex].OID);		  			
	  		}
	  		else{
	  			console.log("DATA REQUEST STOPPED");
	  		}
	    	
	    }, 'json')	;
    }
    
    // PLAY ANIMATION
    function play(){
    	
    	// Play for each group time (same addTime)
    	var next_time = null;
    	var elapseTime = 0;
    	var minAddTime = Number.MAX_VALUE;
    	var maxAddTime = 0;
    	var interval_time = 0;
    	var props = ['PASSSUCESS', 'PASSFAIL', 'OCCRATE', 'DISTANCE', 'VELOCITY'];
    	do{
	    	// init
	    	
	    	var i = $scope.control.curIndex;
	    	var data = analysis.events[i]; 
	    	var team = data.TEAMID == $scope.game.HOME_TEAMID?$scope.game.teams.HOME:(data.TEAMID == $scope.game.AWAY_TEAMID?$scope.game.teams.AWAY:null);
			
			elapseTime = data.addTime - $scope.from_time;
			minAddTime = Math.min(minAddTime, data.addTime);
			maxAddTime = data.addTime;
			
			// ASSIGN VALUE
			for(x in props){
				var p = props[x];
				var player = $scope.playersLink[data.PLAYERID];
				var oldData = isNaN(player[p])?0:Number(player[p]);// || 0;
				var newData = Number(data[p]);
				$scope.playersLink[data.PLAYERID][p]= newData;
			}
			$scope.playersLink[data.PLAYERID].x = data.X/$scope.game.PLAN.sportsWidth*$scope.field.width - 9;
			$scope.playersLink[data.PLAYERID].y = data.Y/$scope.game.PLAN.sportsHeight*$scope.field.height - 9;
			$scope.playersLink[data.PLAYERID].X = data.X;
			$scope.playersLink[data.PLAYERID].Y = data.Y;
			
			// CREATE LINE
			createLine(data.PLAYERID, $scope.playersLink[data.PLAYERID]);
			
			// next tick
			next_time = null;
	    	if(i < analysis.events.length-1 && i < $scope.control.endIndex){
	    		next_time = analysis.events[i+1].addTime - data.addTime;
	    		next_time = analysis.events[i+1].addTime - minAddTime;
	    		$scope.control.curIndex++;
	    		
				// REMOVE OLD DATA
	    		delete analysis.events[i];
	    	}
    	}while(next_time != null && next_time < 100);
    	
    	// check analysisteam index
    	while($scope.analysisteam[$scope.analysisteamIndex].addTime < maxAddTime)$scope.analysisteamIndex++;
    	var props2 = ['HOME_PASSSUCCESS', 'HOME_PASSFAIL', 'HOME_OCCRATE', 'HOME_DISTANCE', 'HOME_PULSEAVG', 'HOME_PULSEMAX', 'HOME_VELAVG', 'HOME_VELMAX',
    		'AWAY_PASSSUCCESS', 'AWAY_PASSFAIL', 'AWAY_OCCRATE', 'AWAY_DISTANCE', 'AWAY_PULSEAVG', 'AWAY_PULSEMAX', 'AWAY_VELAVG', 'AWAY_VELMAX'];
    	for(x in props2){
    		$scope.analysisreq[props2[x]] = Number($scope.analysisteam[$scope.analysisteamIndex][props2[x]]); 
    	}
    	
    	// time
    	elapseTime = elapseTime/1000;
		var tHour = Math.floor(elapseTime/3600); 
		var tMin = Math.floor(elapseTime%3600/60);
		var tSec = Math.floor(elapseTime%60);
		$scope.time =strPad(tMin, 2, 0) + ":" + strPad(tSec, 2, 0) ;
		$scope.timeProcent = elapseTime / ( ($scope.to_time - $scope.from_time)/1000) * 100;
		
		//AVG
		for(x in props){
			var avg = 0;
			for(p in $scope.game.teams.HOME.players){
				player = $scope.game.teams.HOME.players[p];
				if(!isNaN(player[props[x]])){
					avg += player[props[x]];
				}
			}
			$scope.game.teams.HOME[props[x]] = Math.floor(avg / $scope.game.teams.HOME.players.length * 100) / 100;
			var avg = 0;
			for(p in $scope.game.teams.AWAY.players){
				player = $scope.game.teams.AWAY.players[p];
				if(!isNaN(player[props[x]])){
					avg += player[props[x]];
				}
			}
			$scope.game.teams.AWAY[props[x]] = Math.floor(avg / $scope.game.teams.AWAY.players.length * 100) / 100;
		}
		
		
    	$scope.$digest();
    	canvasStroke();
    	
    	// Next Group Time
    	if(next_time !== null){
    		console.log("NEXT_TIME");
	    	if(next_time > 100)
	    		console.log("LONG NEXT TICK : " + next_time);
		    timeoutId = setTimeout(play, next_time);	
    	}
    	else{
    		// finish!
    		$scope.stop();
    	}
    	
    }
    
    // START TICK
    var tickId;
    function startTick(){
    	tickId = setInterval(function(){$scope.$digest();}, 200);
    }
    function stopTick(){
    	clearInterval(tickId);
    }
    
    // SHOW / HIDE LOADING STATE
    function loading(state){
    	// console.log("Loading : " + state);
    	var start = state == 'start';
    	$('button, select', '#options ').attr('disabled', start);
    	$('#bt-options-save').html(start?'Please Wait...':'Save Changes');
    }
    
    // HELPER
    function strPad(input, length, string) {
	    string = string || '0'; input = input + '';
	    return input.length >= length ? input : new Array(length - input.length + 1).join(string) + input;
	}
	
	// CANVAS AREA
	var ctxs = {};
	function initCanvas(){
		// console.log("INIT CANVAS");
		for(i in $scope.playersLink){
			var c=$('#canvas-' + i).get(0);
			ctxs[i] =c.getContext("2d");
			ctxs[i].beginPath();
			ctxs[i].strokeStyle = $scope.playersLink[i].color;
		}
	}
	function createLine(id, player){
		// console.log("MAKE A LINE");
		ctxs[id].lineTo(player.X , player.Y);
		//ctxs[id].stroke();
	}
	function canvasStroke(){
		for(i in $scope.playersLink){
			ctxs[i].stroke();
		}
	}
	
    
  }]);
  
