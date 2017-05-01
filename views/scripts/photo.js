(function() {
// Pour la video
var streaming = false,
    video        = document.querySelector('#video'),
    canvas       = document.querySelector('#canvas'),
    fileUploaded = document.querySelector('#fileUploaded'),
    uploadbutton   = document.querySelector('#uploadbutton'),
    gallery       = document.querySelector('#gallery'),
    take_pic  = document.querySelector('#take_pic'),
    delete_button = document.querySelectorAll('.delete_button'),
    filter      = document.querySelector('#filter-selector'),
	  save_pic  = document.querySelector('#save_pic'),
    width = 320,
    height = 0;

navigator.getMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);

navigator.getMedia(
  {
    video: true,
    audio: false
  },
  function(stream) {
    if (navigator.mozGetUserMedia) {
      video.mozSrcObject = stream;
    } else {
      var vendorURL = window.URL || window.webkitURL;
      video.src = vendorURL.createObjectURL(stream);
    }
    video.play();
  },
  function(err) {
    console.log("An error occured! " + err);
  }
);

video.addEventListener('canplay', function(ev){
  if (!streaming) {
    height = video.videoHeight / (video.videoWidth/width);
    video.setAttribute('width', width);
    video.setAttribute('height', height);
    canvas.setAttribute('width', video.width);
    canvas.setAttribute('height', video.height);
    streaming = true;
  }
}, false);

// Pour enregistrer les photos

function DeletePhoto(event){
  const Container = event.currentTarget.parentNode;

  const currentPhoto = Container.firstElementChild;
  const id = currentPhoto.getAttribute("id");

  gallery.removeChild(Container);
  Delete_ajax(id);
}


function AddPhoto(id_photo, data) {
  const newPhoto = document.createElement('img');
  newPhoto.setAttribute('id', id_photo);
  newPhoto.setAttribute('class', 'side_photo');
  newPhoto.setAttribute('alt', 'photo');
  newPhoto.setAttribute('src', data);

  const newiconDelete = document.createElement('img');
  newiconDelete.setAttribute('class', 'delete_button');
  newiconDelete.setAttribute('alt', 'delete');
  newiconDelete.setAttribute('src', 'config/icons/delete_icon.png');

  const newDelete = document.createElement('div');
  newDelete.setAttribute('class', 'delete_button');
  newDelete.addEventListener('click', function(ev){
    DeletePhoto(ev);
  }, false);
  newDelete.appendChild(newiconDelete);

  const newContainer = document.createElement('div');
  newContainer.setAttribute('class', 'img-container flex-item');
  newContainer.appendChild(newPhoto);
  newContainer.appendChild(newDelete);
  gallery.insertBefore(newContainer, gallery.firstChild);
}

function Add_ajax(data) {
     var httpRequest = new XMLHttpRequest();
     httpRequest.open('POST', 'Controllers/ajax.php', true);
     httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     var params = "action=save&data=" + data;
     httpRequest.onreadystatechange = function () {
       if (this.readyState == 4 && this.status == 200) {
         var MyJson = httpRequest.responseText;
         var MyObj = JSON.parse(MyJson);
         AddPhoto(MyObj.id, MyObj.src);
       }
     };
     httpRequest.send(params);
}

save_pic.addEventListener('click', function(event) {
  event.preventDefault();
  const data = canvas.toDataURL('image/png').split(',')[1];
	Add_ajax(data);
}, false);

function takepicture() {
  canvas.width = width;
  canvas.height = height;
  canvas.getContext('2d').drawImage(video, 0, 0, width, height);
}

take_pic.addEventListener('click', function(event) {
  event.preventDefault();
  takepicture();
  const data = canvas.toDataURL('image.png').split(',')[1];
}, false);

function Delete_ajax(id) {
  var httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=delete&id=" + id;
  httpRequest.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Deleted ! Response :\n" + httpRequest.responseText + "\n");
    }
  };
  httpRequest.send(params);
}


})();
