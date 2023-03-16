<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JSON2Video\Movie;
use JSON2Video\Scene;
use Symfony\Component\Process\Process;

class ToImageController extends Controller
{
   
    public function tovideo (){

        // $var = public_path('london-%d.jpg');
        // $var2 = public_path('test1.mp4');
        // $command1="ffmpeg -r 1 -i ".$var."  ".$var2."";
        $var = public_path('u2.mp4');
        $var2 = public_path('london-1.jpg');
        $var3 = public_path('output22.mp4');

        //$command1='ffmpeg -loop 1 -framerate 1  -i '.$var.'  -i '.$var2.' -filter_complex "overlay=(W-w)/2:(H-h)/2:shortest=1,format=yuv420p" -c:v libx264 -r 30 -movflags +faststart '.$var3.'';
        $command1='ffmpeg -i '.$var.'  -i '.$var2.' -filter_complex "[1:v]colorkey=0xffffff:0.5:0.2[ckout];[0:v][ckout]overlay[out]" -map "[out]"  '.$var3.'';

        // $command1 = "ffmpeg -i ".$var2." -preset veryfast ".$var3."";
        //command for every 1 second image change in video

       $r = exec($command1);
       dd($command1);
        dd($r);
    }


}
