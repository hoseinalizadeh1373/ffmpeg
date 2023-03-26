<!-- License MIT, Author Special Agent Squeaky (specialagentsqueaky.com) -->
<!doctype html>
<html lang="en">
<head>
    <title>My Eq</title>

    <style>

        body {
            overflow: hidden;
            /* background: yellowgreen; */
        }
        img{
            width: 70%;
            height: 40%;
            position: absolute;
        }
        .background {
            position: absolute;

            top: 350px;
            right: -50px;
            bottom: -50px;
            left: -50px;

            /* background-image: url("2.jpg"); */
            background-position: center center;
            background-size: cover;

            filter: blur(15px);

        }

        .track-title {

            position: absolute;

            top: 200px;
            right: 0;
            left: 0;

            color: rgb(3, 1, 1);
            font-family: Calibri;
            font-size: 100px;
            text-align: center;

        }

        .visualizer-container {
            position: absolute;

            bottom: 450px;
            right: 0;
            left: 0;

            text-align: center;
        }

        .visualizer-container__bar {
background-color: aqua;
            display: inline-block;
            background: rgb(202, 38, 38);
            margin: 0 0.3px;
            width: 25px;
           

        }
        #vis{
              position: absolute;
             height: 150px;
            font-size: larger;
                top: 450px;
            right: 0;
            left: 0;

            text-align: center;
            background-image: url("/img/2.jpg"); 
            background-position: center center;
            background-size: cover;
            
        }

    </style>

</head>
<body>
    <div style="display: none;">
        <video controls autoplay playsinline id="preview-video"></video>
    </div>
    <button id="btn-start-recording">Start Recording</button>
    <button id="btn-stop-recording" disabled>Stop Recording</button>
    <input type="file" id="thefile" accept="audio/*" />

<audio id="audio" controls></audio>

<div class="background" id="back"></div>
<!-- <img src="2.jpg"  class="background" > -->

<div class="track-title" onclick="h()" id="sss">Awesome song</div>

<div class="visualizer-container" id="vis"></div>





<canvas id="background-canvas" style="position:absolute; top:-99999999px; left:-9999999999px;"></canvas>
<script src="/js/4.js"></script>
<!-- <script src="44.js"></script> -->
<script src="https://www.webrtc-experiment.com/html2canvas.min.js"></script>

<script>
    window.onload = function() {
        var file = document.getElementById("thefile");
        var audio = document.getElementById("audio");
        var elementToRecord = document.getElementById('vis');

        var canvas2d = document.getElementById('background-canvas');
        var context = canvas2d.getContext('2d');

        canvas2d.width = elementToRecord.clientWidth;
        
    canvas2d.height = elementToRecord.clientHeight;


var isRecordingStarted = false;
var isStoppedRecording = false;
    
(function looper() {
    if(!isRecordingStarted) {
        return setTimeout(looper, 500);
    }

    html2canvas(elementToRecord,{allowTaint:true}).then(function(canvas) {
        context.clearRect(0, 0, canvas2d.width, canvas2d.height);
        context.drawImage(canvas, 0, 0, canvas2d.width, canvas2d.height);

        if(isStoppedRecording) {
            return;
        }

        requestAnimationFrame(looper);
    });
})();

var recorder = new RecordRTC(canvas2d, {
    type: 'canvas'
});

document.getElementById('btn-start-recording').onclick = function() {
    this.disabled = true;
    
    isStoppedRecording =false;
    isRecordingStarted = true;

    recorder.startRecording();
    document.getElementById('btn-stop-recording').disabled = false;
};

document.getElementById('btn-stop-recording').onclick = function() {
    this.disabled = true;
    
    recorder.stopRecording(function() {
        isRecordingStarted = false;
        isStoppedRecording = true;

        var blob = recorder.getBlob();
        // document.getElementById('preview-video').srcObject = null;
        document.getElementById('preview-video').src = URL.createObjectURL(blob);
        document.getElementById('preview-video').parentNode.style.display = 'block';
        elementToRecord.style.display = 'none';

        document.getElementById("preview-video").click();
        // window.open(URL.createObjectURL(blob));
    });
};
    file.onchange = function() {
        const NBR_OF_BARS = 400;

var files = this.files;
 audio.src = URL.createObjectURL(files[0]);
 audio.load();
 audio.play();
const ctx = new AudioContext();

// Create an audio source
const audioSource = ctx.createMediaElementSource(audio);

// Create an audio analyzer
const analayzer = ctx.createAnalyser();

// Connect the source, to the analyzer, and then back the the context's destination
audioSource.connect(analayzer);
audioSource.connect(ctx.destination);

// Print the analyze frequencies
const frequencyData = new Uint8Array(analayzer.frequencyBinCount);
analayzer.getByteFrequencyData(frequencyData);
console.log("frequencyData", frequencyData);

// Get the visualizer container
const visualizerContainer = document.querySelector(".visualizer-container");

// Create a set of pre-defined bars
for( let i = 0; i < NBR_OF_BARS; i++ ) {

    const bar = document.createElement("DIV");
    bar.setAttribute("id", "bar" + i);
    bar.setAttribute("class", "visualizer-container__bar");
    visualizerContainer.appendChild(bar);

}

// This function has the task to adjust the bar heights according to the frequency data
function renderFrame() {

    // Update our frequency data array with the latest frequency data
    analayzer.getByteFrequencyData(frequencyData);

    for( let i = 0; i < NBR_OF_BARS; i++ ) {

        // Since the frequency data array is 1024 in length, we don't want to fetch
        // the first NBR_OF_BARS of values, but try and grab frequencies over the whole spectrum
        const index = (i + 10) * 2;
        // fd is a frequency value between 0 and 255
        const fd = frequencyData[index];

        // Fetch the bar DIV element
        const bar = document.querySelector("#bar" + i);
        if( !bar ) {
            continue;
        }

        // If fd is undefined, default to 0, then make sure fd is at least 4
        // This will make make a quiet frequency at least 4px high for visual effects
        const barHeight = Math.max(5, fd || 0);
        bar.style.height = barHeight + "px";

    }

    // At the next animation frame, call ourselves
    window.requestAnimationFrame(renderFrame);

}

renderFrame();

audio.volume = 0.10;
audio.play();
}
    }
  

</script>

</body>
</html>