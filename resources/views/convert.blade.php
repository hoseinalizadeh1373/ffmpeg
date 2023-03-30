
<body>
    <video id="player" controls></video>
    <input type="file" id="uploader">
   <script>
           if (!crossOriginIsolated) SharedArrayBuffer = ArrayBuffer;
    </script>
    <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.8.1/dist/ffmpeg.min.js"></script>
    <script>
      const { createFFmpeg, fetchFile } = FFmpeg;
      const ffmpeg = createFFmpeg({ log: true });
      const sourceBuffer = await fetch("/1.mp4").then(r => r.arrayBuffer());

// create the FFmpeg instance and load it
const ffmpeg = createFFmpeg({ log: true });
// await ffmpeg.load();

// write the AVI to the FFmpeg file system
ffmpeg.FS(
  "writeFile",
  "/1.mp4",
  new Uint8Array(sourceBuffer, 0, sourceBuffer.byteLength)
);

// run the FFmpeg command-line tool, converting the AVI into an MP4
await ffmpeg.run("-i", "/1.mp4", "/outputdsds.mp4");

// read the MP4 file back from the FFmpeg file system
const output = ffmpeg.FS("readFile", "outputdsds.mp4");

// ... and now do something with the file
const video = document.getElementById("video");
video.src = URL.createObjectURL(
  new Blob([output.buffer], { type: "video/mp4" })
);
      document
        .getElementById('uploader').addEventListener('change', transcode);
    </script>
    
  </body>