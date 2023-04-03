<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
       <script src="https://vjs.zencdn.net/5.15/video.js"></script>
<link href="https://vjs.zencdn.net/5.15/video-js.css" rel="stylesheet" />
</head>
 {{-- <script> in body
           if (!crossOriginIsolated) SharedArrayBuffer = ArrayBuffer;
    </script> --}}
<body>
   <button onclick="blob()">dffs</button>
   <video controls id="video"></video>
  <script>
    let video = document.getElementById('video');
    const audioUrl = '/3323.mp3';
    var audioBlob;
    fetch(audioUrl)
   .then(res => res.blob())
    .then(blob => {audioBlob = blob});

    const videoUrl = '/bbb_video.mp4';
    var videoBlob;
    fetch(videoUrl)
   .then(res => res.blob())
    .then(blob => {videoBlob = blob});
function blob(){
  const sib =[];
  sib.push(audioBlob);
  sib.push(videoBlob);
  const array = sib; // an array consisting of a single string
const blob = new Blob(array, { type: "video/mpeg" }); // the blob
video.src = URL.createObjectURL(new Blob( [ blob ] ) );
console.log(blob);
// const myFile = new File([blob], '/asset/image.mp4', {
//     type: blob.type,
// });
var myFile = blobToFile(blob, "/my-image.mp4");
console.log(myFile)

}
function blobToFile(theBlob, fileName){
    //A Blob() is almost a File() - it's just missing the two properties below which we will add
    theBlob.lastModifiedDate = new Date();
    theBlob.name = fileName;
    return theBlob;
}
var MyBlobBuilder = function() {
  this.parts = [];
}
MyBlobBuilder.prototype.append = function(part) {
  this.parts.push(part);
  this.blob = undefined; // Invalidate the blob
};

MyBlobBuilder.prototype.getBlob = function() {
  if (!this.blob) {
    this.blob = new Blob(this.parts, { type: "video/mpeg" });
  }
  return this.blob;
};
var myBlobBuilder = new MyBlobBuilder();

// const videoElement = document.createElement('video');
// navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
//   const mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm' });
//   mediaRecorder.start();
//   setTimeout(() => mediaRecorder.stop(), 5000);
//   mediaRecorder.onstop = () => {
//     const videoBlob = new Blob(mediaRecorder.recordedBlobs, { type: 'video/webm' });
//     const captureStream = videoElement.captureStream();
//     const finalStream = new MediaStream();
//     finalStream.addTrack(captureStream.getTracks()[0]);
//     finalStream.addTrack(audioBlob.stream.getTracks()[0]);
//     const finalMediaRecorder = new MediaRecorder(finalStream, { mimeType: 'video/webm' });
//     finalMediaRecorder.start();
//     setTimeout(() => finalMediaRecorder.stop(), 5000);
//   }
// });
  </script>
</body>
</html>