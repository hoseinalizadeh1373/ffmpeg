<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
           if (!crossOriginIsolated) SharedArrayBuffer = ArrayBuffer;
    </script>
    <video id="output-video" controls></video><br/>
    <input type="file" id="uploader">
    <p id="message"></p>
    <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.8.1/dist/ffmpeg.min.js"></script>
    <script src="/js/33.js"></script>
</body>
</html>