var errorCallback = function(e) {
  console.log('Rejected!', e);
};

  navigator.getUserMedia({video: true, audio: false}, function(localMediaStream) {
  var video = document.querySelector('video');
  video.src = window.URL.createObjectURL(localMediaStream);

  video.onloadedmetadata = function(e) {
  };
}, errorCallback);

var init = 0;
var video = document.querySelector('video');
var canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');
var localMediaStream = null;
canvas.height = canvas.width / (640/480);

function snapshot() {
  if (localMediaStream) {
    init = 1;
    var props="";
    var obj = canvas;
    for (prop in obj){ props+= prop +  " => " +obj[prop] + "\n"; }
    // alert (props);
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    // document.querySelector('img').src = canvas.toDataURL('image/png');
    // alert(canvas.toDataURL('image/png'));
  }
}
var take_pic=document.getElementById("take_pic");
take_pic.addEventListener('click', snapshot, false);


navigator.getUserMedia({video: true}, function(stream) {
  video.src = window.URL.createObjectURL(stream);
  localMediaStream = stream;
}, errorCallback);

function Request_SavePic() {
  if (init == 1) {
    init = 0;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
  	if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
  		alert("OK");
  	}
    };

    xhr.open('POST', 'Controllers/SavePic.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("data="+encodeURIComponent(canvas.toDataURL('image/png')));
  }
}

// function readData(sData) {
// 		if (sData != null) {
// 		alert("C'est bon");
// 	} else {
// 		alert("Y'a eu un problème");
// 	}
// }

var save_pic=document.getElementById("save_pic");
save_pic.addEventListener('click', Request_SavePic, false);
//
// var newLink = document.createElement('img');
// newLink.id    = 'saved_pic';
// document.getElementById('saved_pic').appendChild(newLink);
