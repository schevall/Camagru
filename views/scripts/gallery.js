(function() {

var delete_button = document.querySelectorAll('.delete_button'),
    gallery = document.querySelector('.gallery');


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


for (var i = 0; i < delete_button.length; i++) {
    delete_button[i].addEventListener('click', function(event) {
        event.preventDefault();
        DeletePhoto(event);
    })
}


})();
