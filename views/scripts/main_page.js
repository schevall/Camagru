function verifComm(f) {
  if (f.comment_content.value == "") {
    alert("Pas de commentaire vide thx =0");
    return false;
  } else {
    return true;
  }
}

let like_button = document.querySelectorAll('.like_button'),
    unlike_button = document.querySelectorAll('.unlike_button'),
    img_container = document.querySelectorAll('.img_container_main'),
    Nb_of_like = document.querySelectorAll('.nb_like'),
    undeflike_button = document.querySelectorAll('.undeflike_button');


function Is_allready_Liked_ajax(id, Button) {
  let httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  let params = "action=Is_allready_Liked&id=" + id;
  httpRequest.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (httpRequest.responseText == 'allreadyliked') {
        Button.setAttribute('class', 'unlike_button');
        Button.innerHTML = "Unlike";
      } else if (httpRequest.responseText == 'notlikedyet') {
        Button.setAttribute('class', 'like_button');
        Button.innerHTML = "like";
      }
      Attribute_events(Button);
    }
  };
  httpRequest.send(params);
}

window.addEventListener("load", function(event) {
  for (let i = 0; i < img_container.length; i++) {
    let Container = img_container[i];
    let id = Container.querySelector(".gallery_photo").getAttribute("id");
    let Target = Container.querySelector(".nb_like");
    Number_of_like(id, Target);
  }
  for (let i = 0; i < undeflike_button.length; i++) {
    let Button = undeflike_button[i];
    let Container = Button.parentNode;
    let id = Container.querySelector(".gallery_photo").getAttribute("id");
    let Target = Container.querySelector(".nb_like");
    Is_allready_Liked_ajax(id, Button);
  }
});

function Attribute_events(Button) {
  Button.addEventListener('click', function(event) {
      event.preventDefault();
      Like(event);
  },false);
}


function Like(event) {
  let Container = event.currentTarget.parentNode;
  let Button = Container.querySelector('.like_button');
  let UnButton = Container.querySelector('.unlike_button');
  let id = Container.firstElementChild.getAttribute("id");
  Like_ajax(id, Container, Button, UnButton);
}

function Like_ajax(id, Container, Button, UnButton) {
  let httpRequest = new XMLHttpRequest();
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  let params = "action=newlike&id=" + id;
  httpRequest.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (httpRequest.responseText == "more") {
          Button.setAttribute('class', 'unlike_button');
          Button.innerHTML = "Unlike";
      } else if (httpRequest.responseText == "less") {
        UnButton.setAttribute('class', 'like_button');
        UnButton.innerHTML = "like";
      }
      Number_of_like(id, Container.querySelector('.nb_like'));
    }
  };
  httpRequest.send(params);
}

function Number_of_like(id, Target) {
  let httpRequest = new XMLHttpRequest()
  httpRequest.open("POST", 'Controllers/ajax.php', true);
  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  let params = "action=Nb_of_like&id=" + id;
   httpRequest.onreadystatechange= function() {
    if (this.readyState == 4 && this.status == 200) {
      Target.innerHTML = "Photo liké " + httpRequest.responseText + " fois";
    }
  };
  httpRequest.send(params);
}
