var tag = document.createElement('script');
tag.id = 'iframe-demo';
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
 
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('yubtubVid', {
    events: {
        'onStateChange': onPlayerStateChange
      }
  });
}

function changeBorderColor(playerStatus) {
  if (playerStatus == -1) {
  } else if (playerStatus == 0) {
        $("#youtubeReplacementOver").animate({opacity:1},1000);  
  } else if (playerStatus == 1) {
        $("#youtubeReplacementOver").animate({opacity:0},1000);  
  }

}
function onPlayerStateChange(event) {
    changeBorderColor(event.data);
}
  
function exploreScroll()
{
    $("#mr_docContainer").animate({scrollTop:(parseInt($("#mr_docContainer").css("width"))-60)+"px"},200);
    //For now, just go to the about page.
    location.replace("about.php");
}