function verifComm(f) {
  if (f.comment_content.value == "") {
    alert("Pas de commentaire vide thx =0");
    return false;
  } else {
    return true;
  }
}

var like_button = document.querySelectorAll('.like_button'),
    unlike_button = document.querySelectorAll('.unlike_button'),
    undeflike_button = document.querySelectorAll('.undeflike_button');


function Is_allready_Liked_ajax(id, Target) {
  var httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=Is_allready_Liked&id=" + id;
  httpRequest.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(httpRequest.responseText);
      if (httpRequest.responseText == 'allreadyliked') {
        Target.addEventListener('click', function(event) {
          event.preventDefault();
          UnLike(event);
        });
        Target.setAttribute('class', 'unlike_button');
        Target.innerHTML = "Unlike";
      } else if (httpRequest.responseText == 'notlikedyet') {
        Target.addEventListener('click', function(event) {
          event.preventDefault();
          Like(event);
        });
        Target.setAttribute('class', 'like_button');
        Target.innerHTML = "like";
      }
    }
  };
  httpRequest.send(params);
}

for (var i = 0; i < undeflike_button.length; i++) {
  var Target = undeflike_button[i];
  const Container = Target.parentNode;
  const currentPhoto = Container.firstElementChild;
  const id = currentPhoto.getAttribute("id");
  Is_allready_Liked_ajax(id, Target);
}


function Like(event){
  var Target = event.currentTarget;
  Target.setAttribute('class', 'unlike_button');
  Target.innerHTML = "Unlike";
  Target.removeEventListener('click', function(event) {
    event.preventDefault();
    Like(event);
  });
  Target.addEventListener('click', function(event) {
      event.preventDefault();
      UnLike(event);
  });
  const Container = Target.parentNode;
  const currentPhoto = Container.firstElementChild;
  const id = currentPhoto.getAttribute("id");
  NewLike_ajax(id);
}

function NewLike_ajax(id) {
  var httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=newlike&id=" + id;
  httpRequest.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Photo liked Response :\n" + httpRequest.responseText + "\n");
    }
  };
  httpRequest.send(params);
}

function UnLike(event){
  var Target = event.currentTarget;
  Target.setAttribute('class', 'like_button');
  Target.innerHTML = "Like";
  Target.removeEventListener('click', function(event) {
    event.preventDefault();
    UnLike(event);
  });
  Target.addEventListener('click', function(event) {
      event.preventDefault();
      Like(event);
  });
  const Container = Target.parentNode;
  const currentPhoto = Container.firstElementChild;
  const id = currentPhoto.getAttribute("id");
  DeleteLike_ajax(id);
}

function DeleteLike_ajax(id) {
  var httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=deletelike&id=" + id;
  httpRequest.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Photo Unliked Response :\n" + httpRequest.responseText + "\n");
    }
  };
  httpRequest.send(params);
}

// for (var i = 0; i < like_button.length; i++) {
//       like_button[i].addEventListener('click', function(event) {
//         event.preventDefault();
//         Like(event);
//     })
// }
//
// for (var i = 0; i < unlike_button.length; i++) {
//       unlike_button[i].addEventListener('click', function(event) {
//         event.preventDefault();
//         UnLike(event);
//     })
// }
