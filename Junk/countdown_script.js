var CountDownDate = new Date("Jan 6, 2019 9:00:00").getTime();
var update = setInterval(function() {
  var now = new Date().getTime();
  var timeLeft = CountDownDate - now;
  var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
  var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
  document.getElementById("InnerText").innerHTML = "~"+ days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  if (timeLeft < 0) {
    clearInterval(update);
    document.getElementById("InnerText").innerHTML = "The Competition is Released!";
  }
}, 1000);
//Thank you W3Schools for this code template
