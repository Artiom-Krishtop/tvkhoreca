/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/
//User Behaviour Tracking
var UBT_Logic = function() {
    this.ActiveTimeout = 120; //1min
    this.IdleTimeout = 60; //1min
    this.IntervalId = 0;
    this.TimeFlag = "UBT_TimeFlag";
    this.TimeMsgFlag = "UBT_TimeMsgFlag";
    this.LastActiveTimeFlag = "UBT_LastActiveTimeFlag";
    this.LastUserActivityTimeFlag = "UBT_LastUserActivityTimeFlag";
};

UBT_Logic.prototype.StartFunc = function () {
    //here can be some additional logic
    ubtLogic.InitTimeFlag();
};

UBT_Logic.prototype.InitTimeFlag = function(){
    var now = Math.floor((new Date().getTime()) / 1000);
    if ((typeof localStorage[ubtLogic.LastActiveTimeFlag]) == "undefined") {
        localStorage[ubtLogic.LastActiveTimeFlag] = now;
        localStorage[ubtLogic.TimeFlag] = 0;
        localStorage[ubtLogic.TimeMsgFlag] = 0;
    } else {
        var t = parseInt(localStorage[ubtLogic.LastActiveTimeFlag]);
        if (t <= 0 || t + 300 < now || t > now) {
            localStorage[ubtLogic.LastActiveTimeFlag] = now;
            localStorage[ubtLogic.TimeFlag] = 0;
            localStorage[ubtLogic.TimeMsgFlag] = 0;
        }
    }
    if ((typeof localStorage[ubtLogic.TimeFlag]) == "undefined") {
        localStorage[ubtLogic.TimeFlag] = 0;
        localStorage[ubtLogic.TimeMsgFlag] = 0;
    } else {
        var t = parseInt(localStorage[ubtLogic.TimeFlag]);
        if (t < 0 || t > now) {
            localStorage[ubtLogic.TimeFlag] = 0;
            localStorage[ubtLogic.TimeMsgFlag] = 0;
        }
    }
    if ((typeof localStorage[ubtLogic.TimeMsgFlag]) == "undefined")
        localStorage[ubtLogic.TimeMsgFlag] = 0;
    else {
        var t = parseInt(localStorage[ubtLogic.TimeMsgFlag]);
        if (t != 0 && t != 1) localStorage[ubtLogic.TimeMsgFlag] = 0;
    }
    localStorage[ubtLogic.LastUserActivityTimeFlag] = now;
    document.onmousemove = function (event) {
        localStorage[ubtLogic.LastUserActivityTimeFlag] = Math.floor((new Date().getTime()) / 1000);
    };
    document.onkeydown = function (event) {
        localStorage[ubtLogic.LastUserActivityTimeFlag] = Math.floor((new Date().getTime()) / 1000);
    };
    IntervalId = setInterval(ubtLogic.TimeFunc, 300);
};

UBT_Logic.prototype.TimeFunc = function () {
    var now = Math.floor((new Date().getTime()) / 1000);
    //console.log(now);
    var lastActiveTimeFlag = parseInt(localStorage[ubtLogic.LastActiveTimeFlag]);
    if (lastActiveTimeFlag < now) {
        localStorage[ubtLogic.LastActiveTimeFlag] = now;
        var timeFlag = parseInt(localStorage[ubtLogic.TimeFlag]);
        timeFlag++;
        localStorage[ubtLogic.TimeFlag] = timeFlag;
        var timeMsgFlag = parseInt(localStorage[ubtLogic.TimeMsgFlag]);
        var lastUserActivityTimeFlag = parseInt(localStorage[ubtLogic.LastUserActivityTimeFlag]);
        if (timeMsgFlag == 0) {
            if (timeFlag >= ubtLogic.ActiveTimeout) {
                localStorage[ubtLogic.TimeMsgFlag] = 1;
                ubtLogic.ActiveTimeoutFunc();
            }
            else if (lastUserActivityTimeFlag + ubtLogic.IdleTimeout <= now) {
                localStorage[ubtLogic.TimeMsgFlag] = 1;
                ubtLogic.IdleTimeoutFunc();
            }
        }
        if (localStorage[ubtLogic.TimeMsgFlag] != 0) {
            clearInterval(IntervalId);
        }
    }
};

UBT_Logic.prototype.ActiveTimeoutFunc = function () {
    //todo: do something
    yaCounter42317129.reachGoal("time-2min");
    //console.log("ActiveTimeout");
    //console.log("прошло 2 минуты");
};

UBT_Logic.prototype.IdleTimeoutFunc = function () {
    //todo: do something
    //...
};

var ubtLogic = new UBT_Logic();
ubtLogic.StartFunc();