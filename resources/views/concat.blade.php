<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
       <script src="https://vjs.zencdn.net/5.15/video.js"></script>
<link href="https://vjs.zencdn.net/5.15/video-js.css" rel="stylesheet" />
</head>
<body>
    {{-- <script>
           if (!crossOriginIsolated) SharedArrayBuffer = ArrayBuffer;
    </script> --}}
    {{-- <video id="output-video" controls></video><br/>
    <input type="file" id="uploader">
    <p id="message"></p>
    <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.8.1/dist/ffmpeg.min.js"></script>
    <script src="/js/33.js"></script> --}}

 


<audio id="my-player" class="video-js" controls>
    <source id='my-spanish-video-track' src="1.mp4" type="video/mp4" />
  <source id="my-spanish-audio-track" src="https://www.w3schools.com/html/horse.ogg" type="audio/ogg">
    
</audio>
<video ><source id='my-spanish-video-track' src="1.mp4" type="video/mp4" /></video>
<script>
    var player = videojs('my-player');
    var track = new videojs.AudioTrack({
  id: 'my-spanish-audio-track',
  kind: 'translation',
  label: 'Spanish',
  language: 'es'
});
var tr = new videojs.VideoTrack({
    id: 'my-spanish-video-track',
  kind: 'translation',
  label: 'Spanish',
  language: 'es'
});


// Add the track to the player's audio track list.
player.audioTracks().addTrack(track);
player.videoTracks().addTrack(tr);
// player.videoTracks().addTrack()
</script> 

{{-- <video
id="my-video"
class="video-js"
controls
preload="auto"
width="640"
height="264"
poster="MY_VIDEO_POSTER.jpg"
data-setup="{}"
>
<source src="/asset/Ringtone-3.mp3" type="audio/ogg" />
<source src="1.mp4" type="video/mp4" />

<p class="vjs-no-js">
  To view this video please enable JavaScript, and consider upgrading to a
  web browser that
  <a href="https://videojs.com/html5-video-support/" target="_blank"
    >supports HTML5 video</a
  >
</p>
</video> --}}

<script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
</body>
</html>