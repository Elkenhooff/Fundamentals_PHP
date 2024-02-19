document.getElementById("toggleCadastra").addEventListener("click", function () {
    document.getElementById("login").style.display = "none";
    document.getElementById("cadastra").style.display = "block";
  });
  
   
  
  document.getElementById("toggleLogin").addEventListener("click", function () {
    document.getElementById("cadastra").style.display = "none";
    document.getElementById("login").style.display = "block";
  });

  var nav = true;
  function ativaNav(){
    if (nav){
      document.getElementById("navUsuario").classList.toggle("ativada");
      nav = false;
    }
    else{
      document.getElementById("navUsuario").classList.remove("ativada");
      nav = true;
    }
  }