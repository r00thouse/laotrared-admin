$(document).ready(function(){
  var messageEl = document.getElementById('message');
  if (!messageEl) { return; }

  var message = messageEl.innerHTML,
    type = messageEl.dataset.type
    notificationDuration = 1;
  notie.alert(type, message, notificationDuration)
});
