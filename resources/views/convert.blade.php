
 
  <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Page Title</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
	</head>
	<body>
		<script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
		{{-- <audio id="my-audio-track" src="/3323.mp3"></audio> --}}
		<video class="video-js" id="my-player"  controls>
			<source id="my-spanish-audio-track" src="/bbb_video.mp4" >
			<source id="my-audio-track" src="/3323.mp3" >
		   </video>
		 
		   <script type="text/javascript">
		   video = document.getElementById("my-player");
		   
	
// console.log(video);
// 		video.audioTracks[0].enabled=false;
// 		video.audioTracks[1].enabled=true;

		var player = videojs('my-player');

// Create a track object.
var track = new videojs.AudioTrack({
  id: 'my-spanish-audio-track',
  kind: 'tr',
  label: 'Spanish',
  language: 'es',
  default:true
});
var track2 = new videojs.AudioTrack({
  id: 'my-audio-track',
  kind: 'translation',
  label: 'italy',
  language: 'fr',
  default:true
});

// Add the track to the player's audio track list.
player.audioTracks().addTrack(track);
player.audioTracks().addTrack(track2);

var audioTrackList = player.audioTracks();
for (var i = 0; i < audioTrackList.length; i++) {
    var track = audioTrackList[i];
	console.log(track.label)
    if (track.enabled) {
    //   videojs.log(track.label);
	  
     
    }
  }
// Listen to the "change" event.
audioTrackList.addEventListener('change', function() {

  // Log the currently enabled AudioTrack label.
  for (var i = 0; i < audioTrackList.length; i++) {
    var track = audioTrackList[i];

    if (track.enabled) {
      videojs.log(track.label);
	  console.log(track.label)
      return;
    }
  }
});
// var track = player.audioTracks().getTrackById('my-spanish-audio-track');
// console.log(track)
// // Remove it from the audio track list.
// player.audioTracks().removeTrack(track);

		   </script>

		  
	</body>
</html>
    
