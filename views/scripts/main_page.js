(function() {

    photo        = document.querySelector('.photo'),
    delete_button = document.querySelectorAll('.delete_button'),
    comments = document.querySelectorAll('.comment'),
    likes = document.querySelectorAll('.like'),

navigator.getMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);


function DeletePhoto(event){
  const Container = event.currentTarget.parentNode;

  const currentPhoto = Container.firstElementChild;
  const id = currentPhoto.getAttribute("id");

  gallery.removeChild(Container);
  Delete_ajax(id);
}

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
