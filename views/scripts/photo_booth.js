(function() {
// Pour la video
var streaming     = false,
    init          = 0,
    video         = document.querySelector('#video'),
    canvas        = document.querySelector('#canvas'),
    file_Upload  = document.querySelector('#file_Upload'),
    upload_button  = document.querySelector('#upload_button'),
    gallery       = document.querySelector('#gallery'),
    take_pic      = document.querySelector('#take_pic'),
    delete_button = document.querySelectorAll('.delete_button'),
    filter        = document.querySelector('#filter-selector'),
	  save_pic      = document.querySelector('#save_pic'),
    width         = 320,
    height        = 0;

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
     var params = "action=save&data=" + data + "&filter=" + filter.value;
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
  if (init == 0) {
    alert("Prendre une photo thx =0");
    return ;
  }
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
  init = 1;
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

function Add_ajax(data) {
     var httpRequest = new XMLHttpRequest();
     httpRequest.open('POST', 'Controllers/ajax.php', true);
     httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     var params = "action=save&data=" + data + "&filter=" + filter.value;
     httpRequest.onreadystatechange = function () {
       if (this.readyState == 4 && this.status == 200) {
         var MyJson = httpRequest.responseText;
         var MyObj = JSON.parse(MyJson);
         AddPhoto(MyObj.id, MyObj.src);
       }
     };
     httpRequest.send(params);
}


function handleImage(event){
    if (file_Upload.files && file_Upload.files[0]) {
      const reader = new FileReader();
      reader.onload = function(event){
        const verif = reader.result;
        const fileinfo = verif.split(',')[0];
        const filetype = fileinfo.split(';')[0];
        const fileencode = fileinfo.split(';')[1];
        if (filetype != 'data:image/png' || fileencode != 'base64') {
          alert ('Mauvais type de fichier : ' + filetype);
          return ;
        }
        const img = new Image();
        img.onload = function(){
          init = 1;
          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
      }
        img.src = event.target.result;
    }
    reader.readAsDataURL(file_Upload.files[0]);
  }
  else
    alert("Mettre un fichier thx =0");
}

  upload_button.addEventListener('click', function(event) {
      handleImage(event);
      event.preventDefault();
    }, false);


})();
