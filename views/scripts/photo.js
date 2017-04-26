var errorCallback = function(e) {
  console.log('Reeeejected!', e);
};

  navigator.getUserMedia({video: true, audio: false}, function(localMediaStream) {
  var video = document.querySelector('video');
  video.src = window.URL.createObjectURL(localMediaStream);

  video.onloadedmetadata = function(e) {
  };
}, errorCallback);


var video = document.querySelector('video');
var canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');
var localMediaStream = null;
canvas.height = canvas.width / (640/480);

function snapshot() {
  if (localMediaStream) {
    var props="";
    var obj = video;
    for (prop in obj){ props+= prop +  " => " +obj[prop] + "\n"; }
    // alert (props);

    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    document.querySelector('img').src = canvas.toDataURL('image/webp');
  }
}

video.addEventListener('click', snapshot, false);

navigator.getUserMedia({video: true}, function(stream) {
  video.src = window.URL.createObjectURL(stream);
  localMediaStream = stream;
}, errorCallback);
