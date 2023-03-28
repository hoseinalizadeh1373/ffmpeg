const { createFFmpeg, fetchFile } = FFmpeg;
const ffmpeg = createFFmpeg({ log: true });

const concat = async ({ target: { files } }) => {
  //const message = document.getElementById('message');
  const { name } = files[0];
//   const {name2} = files[1];
 // message.innerHTML = 'Loading ffmpeg-core.js';
  await ffmpeg.load();
  //message.innerHTML = 'Start trimming';
  ffmpeg.FS('writeFile', name, await fetchFile(files[0]));
  await ffmpeg.run('-i', name, '-i', "/asset/Ringtone-3.mp3", ' -shortest',  'output.mp4');
  message.innerHTML = 'Complete trimming';
  const data = ffmpeg.FS('readFile', 'output.mp4');

  const video = document.getElementById('output-video');
  video.src = URL.createObjectURL(new Blob([data.buffer], { type: 'video/mp4' }));
}
const elm = document.getElementById('uploader');
elm.addEventListener('change', concat);