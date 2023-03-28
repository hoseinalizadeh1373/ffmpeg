<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/1.css">
</head>
<body>
    <input type="file" id="file-input" accept="audio/*" />
    <button id="stop" style="cursor: pointer;z-index: 999999; position: relative;left: 40%;top: 50%;" onclick="stop()">stop</button>
      <button id="start" style="cursor: pointer;z-index: 999999; position: relative;left: 45%;top: 50%;" >start</button>
      <video id="output-video" controls="controls" style="cursor: pointer;z-index: 999999; position: absolute;left: 80%;"></video>
      <a id="dl" href="" download="download.mp4" style="cursor: pointer;z-index: 999999; position: absolute;left: 80%;"></a>
      <video id="myVideo" controls="controls" style="cursor: pointer;z-index: 999999; position: absolute;left: 30%;"></video>
    <canvas id="canvas" width="500" height="300"></canvas>
    <h3 id="name"></h3>

    <img src="/img/2.jpg" width="8" height="8" id="img">
    <audio id="audio" controls></audio>
    
    
    <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.8.1/dist/ffmpeg.min.js"></script>
     <script src="/js/3.js"></script>  
    <script>
 window.onload = function() {

const file = document.getElementById("file-input");
const canvas = document.getElementById("canvas");
const h3 = document.getElementById('name')
const audio = document.getElementById("audio");
var ctx;
file.onchange = function() {

  const files = this.files; // FileList containing File objects selected by the user (DOM File API)
  console.log('FILES[0]: ', files[0])
  audio.src = URL.createObjectURL(files[0]); // Creates a DOMString containing the specified File object

  const name = files[0].name
  h3.innerText = `${name}` // Sets <h3> to the name of the file

  ///////// <CANVAS> INITIALIZATION //////////
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
   ctx = canvas.getContext("2d");
  ///////////////////////////////////////////


  const context = new AudioContext(); // (Interface) Audio-processing graph
  let src = context.createMediaElementSource(audio); // Give the audio context an audio source,
  // to which can then be played and manipulated
  const analyser = context.createAnalyser(); // Create an analyser for the audio context

  src.connect(analyser); // Connects the audio context source to the analyser
  analyser.connect(context.destination); // End destination of an audio graph in a given context
  // Sends sound to the speakers or headphones


  /////////////// ANALYSER FFTSIZE ////////////////////////
  // analyser.fftSize = 32;
  // analyser.fftSize = 64;
  // analyser.fftSize = 128;
  // analyser.fftSize = 256;
  analyser.fftSize = 512;
  // analyser.fftSize = 1024;
  // analyser.fftSize = 2048;
  // analyser.fftSize = 4096;
  // analyser.fftSize = 8192;
//   analyser.fftSize = 16384;
  // analyser.fftSize = 32768;

  // (FFT) is an algorithm that samples a signal over a period of time
  // and divides it into its frequency components (single sinusoidal oscillations).
  // It separates the mixed signals and shows what frequency is a violent vibration.

  // (FFTSize) represents the window size in samples that is used when performing a FFT

  // Lower the size, the less bars (but wider in size)
  ///////////////////////////////////////////////////////////


  const bufferLength = analyser.frequencyBinCount; // (read-only property)
  // Unsigned integer, half of fftSize (so in this case, bufferLength = 8192)
  // Equates to number of data values you have to play with for the visualization

  // The FFT size defines the number of bins used for dividing the window into equal strips, or bins.
  // Hence, a bin is a spectrum sample, and defines the frequency resolution of the window.

  const dataArray = new Uint8Array(bufferLength); // Converts to 8-bit unsigned integer array
  // At this point dataArray is an array with length of bufferLength but no values
  console.log('DATA-ARRAY: ', dataArray) // Check out this array of frequency values!

  const WIDTH = canvas.width;
  const HEIGHT = canvas.height;
  console.log('WIDTH: ', WIDTH, 'HEIGHT: ', HEIGHT)

  const barWidth = (WIDTH / bufferLength) * 13;
  console.log('BARWIDTH: ', barWidth)

  console.log('TOTAL WIDTH: ', (117*10)+(118*barWidth)) // (total space between bars)+(total width of all bars)

  let barHeight;
  let x = 0;
   //make_image();


  function renderFrame() {
    requestAnimationFrame(renderFrame); // Takes callback function to invoke before rendering

    x = 0;

    analyser.getByteFrequencyData(dataArray); // Copies the frequency data into dataArray
    // Results in a normalized array of values between 0 and 255
    // Before this step, dataArray's values are all zeros (but with length of 8192)
   
    // ctx.fillStyle = "rgba(0,0,0,0.2)"; // Clears canvas before rendering bars (black with opacity 0.2)
    // ctx.fillRect(0, 0, WIDTH, HEIGHT); // Fade effect, set opacity to 1 for sharper rendering of bars
    // make_image();
     draw(WIDTH,HEIGHT);
    
    
    let r, g, b;
    let bars = 118 // Set total number of bars you want per frame

    for (let i = 0; i < bars; i++) {
      barHeight = (dataArray[i] * 2.5);

      if (dataArray[i] > 210){ // pink
        r = 250
        g = 0
        b = 255
      } else if (dataArray[i] > 200){ // yellow
        r = 250
        g = 255
        b = 0
      } else if (dataArray[i] > 190){ // yellow/green
        r = 204
        g = 255
        b = 0
      } else if (dataArray[i] > 180){ // blue/green
        r = 0
        g = 219
        b = 131
      } else { // light blue
        r = 0
        g = 199
        b = 255
      }

      // if (i === 0){
      //   console.log(dataArray[i])
      // }

      ctx.fillStyle = `rgb(${r},${g},${b})`;
      ctx.fillRect(x, (HEIGHT - barHeight), barWidth, barHeight);
      // (x, y, i, j)
      // (x, y) Represents start point
      // (i, j) Represents end point

      x += barWidth + 10 // Gives 10px space between each bar
    }
  }

  audio.play();
  renderFrame();
};
function make_image(){
        baseimage = new Image();
        baseimage.src = '/img/2.jpg';
      
      
        baseimage.onload =function(){
            ctx.drawImage(baseimage,0,0,window.innerWidth,window.innerHeight);
            // ctx2.drawImage(canvas, 0, 0);
        }
        
    }
    function draw(width,height) {
      // var c = document.getElementById("myCanvas");
      // var ctx = c.getContext("2d");
     // ctx2.clearRect(0, 0, window.innerWidth,window.innerHeight); 
      var img = document.getElementById("img")
      var pat = ctx.createPattern(img, 'no-repeat');
      ctx.rect(0, 0, window.innerWidth,window.innerHeight);
      ctx.fillStyle = pat;
      ctx.fill();
    }
};


    </script>
</body>
</html>