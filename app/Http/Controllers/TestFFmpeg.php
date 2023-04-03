<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FFMpeg;

class TestFFmpeg extends Controller
{
    //
    public function ffmpeg(){
        // $ffmpeg = FFMpeg::create();

        //  FFmpeg::open('/bbb_video.mp4');

        // $video->addFilter(new \FFMpeg\Filters\Audio\SimpleFilter(array('-i ' .'/3323.mp3', '-shortest')));

        // $video->save(new \FFMpeg\Format\Video\X264(), 'testoutput.mp4');
        FFMpeg::fromDisk('local')->open('/1.mp4')->addFilter(function ($filters) {
            $filters->resize(new \FFMpeg\Coordinate\Dimension(140, 80));
        });
    // ->export()
    // ->onProgress(function ($percentage, $remaining, $rate) {
    //     echo "{$remaining} seconds left at rate: {$rate}";
    // });
    }
}
