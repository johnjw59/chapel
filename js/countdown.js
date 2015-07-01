function count (target_date) {  
  var days, hours, minutes, seconds;
  var countdown = document.getElementById('countdown');
  
  // find the amount of "seconds" between now and target
  var current_date = new Date().getTime();
  var seconds_left = (target_date - current_date) / 1000;

  // do some time calculations
  if (seconds_left >= 0) {
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;
    
    hours = padZero(parseInt(seconds_left / 3600));
    seconds_left = seconds_left % 3600;
    
    minutes = padZero(parseInt(seconds_left / 60));
    seconds = padZero(parseInt(seconds_left % 60));
    
    // format countdown string + set tag value
    countdown.innerHTML = days + ':' + hours + ':' + minutes + ':' + seconds;
  }
  else {
    countdown.className = 'empty';
  }
}

function padZero (num) {
  if (('' + num).length <= 1) {
    return '0' + num;
  }
  return num;
}
