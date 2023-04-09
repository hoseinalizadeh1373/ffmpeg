<html lang="en">

<head>
  <title>Files Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes, viewport-fit=cover">
  {{-- <link href="./style.css" rel="stylesheet" /> --}}
  <style>.github-corner:hover .octo-arm {
    animation: octocat-wave 560ms ease-in-out
  }
  
  @keyframes octocat-wave {
  
    0%,
    100% {
      transform: rotate(0)
    }
  
    20%,
    60% {
      transform: rotate(-25deg)
    }
  
    40%,
    80% {
      transform: rotate(10deg)
    }
  }
  
  @media (max-width:500px) {
    .github-corner:hover .octo-arm {
      animation: none
    }
  
    .github-corner .octo-arm {
      animation: octocat-wave 560ms ease-in-out
    }
  }
  
  video {
    width: 400px;
  }
  </style>
</head>

<body>
  <h1>video-stream-merger demo</h1>

  <p>Merge and manipulate existing media.</p>

  <p>The below demo merges two MP4 and AAC files together.</p>

  <br><br>

  <button>Click to Start</button>
  <br>
  <video id="output"
        
        controls
        autoplay="autoplay"
        playsinline="playsinline"
        webkit-playsinline
        style="display:inline-block; height: 100px; background:black;"></video>
{{-- <video controls src="/3323.mp3" type="video/mp4"></video> --}}
  <script src="js/44.js"></script>

  <script>
    // we need to "warm up" the AudioContext with a user event
    document.querySelector('button').addEventListener('click', function () {
      var merger = new VideoStreamMerger()

      var mp4Element = document.createElement('video')
      var aacElement = document.createElement('audio')

      mp4Element.playsinline = true;
      aacElement.playsinline = true;

      mp4Element.muted = true
      aacElement.muted = true

      mp4Element.src = "/bbb_video.mp4"
      aacElement.src = "/3323.mp3"

      mp4Element.autoplay = true
      aacElement.autoplay = true

      mp4Element.loop = false
      mp4Element.play()

      var count = 100

      merger.addMediaElement('mp3', aacElement)
      merger.addMediaElement('mp4', mp4Element, {
        mute: true,
        draw: function (ctx, frame, done) {
        //   count++
    
          ctx.drawImage(frame, outputElement.width , outputElement.height , merger.width, merger.height)
          done()

       
        }
      })

      merger.start()

      var outputElement = document.querySelector('#output')
      outputElement.srcObject = merger.result
      console.log(merger.result)
      outputElement.autoplay = true

// const stream = getCanvasStream(); // we'll use a canvas stream so that it works in stacksnippet
const chunks = []; // this will store our Blobs chunks
const recorder = new MediaRecorder(merger.result);
recorder.ondataavailable = e => chunks.push(e.data); // a new chunk Blob is given in this event
recorder.onstop = exportVid; // only when the recorder stops, we do export the whole;
setTimeout(() => recorder.stop(), 10000); // will stop in 5s
recorder.start(1000); // all chunks will be 1s

function exportVid() {
  var blob = new Blob(chunks); // here we concatenate all our chunks in a single Blob
  var url = URL.createObjectURL(blob); // we creat a blobURL from this Blob
  var a = document.createElement('a');
  a.href = url;
  a.innerHTML = 'download';
  a.download = 'myfile.mp4';
  document.body.appendChild(a);
  // stream.getTracks().forEach(t => t.stop()); // never bad to close the stream when not needed anymore
}


function getCanvasStream() {
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');
  ctx.fillStyle = 'red';
  // a simple animation to be recorded
  let x = 0;
  const anim = t => {
    x = (x + 2) % 300;
    ctx.clearRect(0, 0, 300, 150);
    ctx.fillRect(x, 0, 10, 10);
    requestAnimationFrame(anim);
  }
  anim();
  document.body.appendChild(canvas);
  return canvas.captureStream(30);
}
      
    })
    
  </script>


  <!-- just a Github octocat, ignore! -->
  <a href="https://github.com/RationalCoding/video-stream-merger" class="github-corner"
    aria-label="View source on Github"><svg width="256" height="256" viewBox="0 0 250 250"
      style="fill:#151513; color:#fff; position: fixed; top: 0; border: 0; right: 0;" aria-hidden="true">
      <path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path>
      <path
        d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2"
        fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path>
      <path
        d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z"
        fill="currentColor" class="octo-body"></path>
    </svg></a>


    {{-- <video id="leftVideo" playsinline controls loop muted>
        {{-- <source src="../../../video/chrome.webm" type="video/webm"/> --}}
        {{-- <source src="/bbb_video.mp4" type="video/mp4"/>
        <p>This browser does not support the video element.</p>
    </video>

    <video id="rightVideo"  autoplay controls></video> --}} --}}

    <script>
//       (function(i, s, o, g, r, a, m) {
// i['GoogleAnalyticsObject']=r; i[r]=i[r]||function() {
//   (i[r].q=i[r].q||[]).push(arguments);
// }, i[r].l=1*new Date(); a=s.createElement(o),
//   m=s.getElementsByTagName(o)[0]; a.async=1; a.src=g; m.parentNode.insertBefore(a, m);
// })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

// ga('create', 'UA-48530561-1', 'auto');
// ga('send', 'pageview');
// 'use strict';
// const leftVideo = document.getElementById('leftVideo');
// const rightVideo = document.getElementById('rightVideo');

// leftVideo.addEventListener('canplay', () => {
//   let stream;
//   const fps = 0;
//   if (leftVideo.captureStream) {
//     stream = leftVideo.captureStream(fps);
//   } else if (leftVideo.mozCaptureStream) {
//     stream = leftVideo.mozCaptureStream(fps);
//   } else {
//     console.error('Stream capture is not supported');
//     stream = null;
//   }
//   rightVideo.srcObject = stream;
//   console.log(stream)
// });
      // const v = "/bbb_video.mp4";
      // const a = "/3323.mp3";

      // const mediaSource = new MediaSource();
      // const video_track = mediaSource.addTrack(v);
      // const audio_track = mediaSource.addTrack(a);

      // const mediaRecorder =new MediaRecorder(mediaSource);

      // mediaRecorder.setVideoEncodingBitRate(3000000);
      // mediaRecorder.setAudioEncodingBitRate(3000000);

      // mediaRecorder.start();
      // mediaRecorder.onstop = function(event){
      //   const blob = new Blob([event.data],{type:'video/mp4'});
      //   const url =URL.createObjectURL(blob);
      //   const downloadLink = url;
      //   downloadLink.href = url;
      //   downloadLink.download = 'output.mp4';
      //   downloadLink.click();
      // };

      // mediaRecorder.onerror = function(event){
      //   alert(event.error);
      // };
    </script>
</body>

</html>