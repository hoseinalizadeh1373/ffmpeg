<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>visualser</title>
    <link rel="stylesheet" href="/css/1.css">
</head>
<body>
    
    <div id="content" >
        <input type="file" id="thefile" accept="audio/*" />
        
        <canvas id="canvas2"  style="z-index: 2;">
          

        </canvas>
       
        <canvas id="canvas" class="box" style="z-index: 1;"></canvas>
   
 
        <audio id="audio" controls style="z-index:20"></audio>
      </div>
     

      

      <script src="/js/1.js"></script>
</body>
</html>