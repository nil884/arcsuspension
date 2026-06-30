  console.log("Push notifications are enabled!");  
if(isActive_oneSignal==1&&onesignalappid){

var oneSignal= window.OneSignal || [];
oneSignal.push(function(){
    oneSignal.init({
        appId:onesignalappid
    });
});

oneSignal.push(function() {
  /* These examples are all valid */
  var isPushSupported = oneSignal.isPushNotificationsSupported();
  if (isPushSupported) {
    oneSignal.isPushNotificationsEnabled(function(isEnabled) {
    if (isEnabled){
       console.log("Push notifications are enabled!");
        oneSignal.getUserId( function(userId) {
          console.log('player_id of the subscribed user is : ' + userId);
          // Make a POST call to your server with the user ID
      });
    }
    else{
          console.log("Push notifications are not enabled yet.");
        oneSignal.push(function() {
          oneSignal.showNativePrompt();
        });
    }

  });
  } else {
    // Push notifications are not supported
  }
});


}