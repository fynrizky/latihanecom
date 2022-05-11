
<div class="cotn_principal">
  <div class="cont_centrar">

    <div class="cont_login">
      <div class="cont_info_log_sign_up">
        <div class="col_md_login">
          <div class="cont_ba_opcitiy">
            
            <h2>LOGIN</h2>
            <link rel="stylesheet" type="text/css" href="../css/style.css">  
            
            <p>Admin Login</p> 
            <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
          </div>
        </div>
        <div class="col_md_sign_up">
          <div class="cont_ba_opcitiy">
            <h2>SIGN UP</h2>

            
            <p>Admin Sign Up</p>

            <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
          </div>
        </div>
      </div>

      
      <div class="cont_back_info">
       <div class="cont_img_back_grey">
         <img src="http://anekatop10.com/wp-content/uploads/2015/11/Jakarta-Indonesia.jpg" alt="" />
       </div>
       
     </div>
     <div class="cont_forms" >
      <div class="cont_img_back_">
       <img src="http://anekatop10.com/wp-content/uploads/2015/11/Jakarta-Indonesia.jpg" alt="" />
     </div>
     
     <div class="cont_form_login">
      <a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons"></i></a>
      <h2>LOGIN</h2>
      <form action="proseslogin.php" method="post">
       <input type="text" name="nm_user" placeholder="User" required="" />
       <input type="password" name="password" class="form-control" placeholder="Password" required="" />
       <button class="btn_login" name="login" class="form-control" onclick="cambiar_login()">LOGIN</button>
     </form>
     
   </div>


   
   <div class="cont_form_sign_up">
    <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons"></i></a>
    <h2>SIGN UP</h2>
    <form action="prosesregister.php" method="post">
      <input type="text" name="email" placeholder="Email" required="" />
      <input type="text" name="nm_user" placeholder="User" required="" />
      <input type="password" name="password" class="form-control" placeholder="Password" required="" />
      <input type="password" name="password2" class="form-control" placeholder="Confirm Password" required="" />
      <button class="btn_sign_up" name="daftar" class="form-control" onclick="cambiar_sign_up()">SIGN UP</button>
    </form>
  </div>

</div>

</div>
</div>
</div>
<script>
    /* ------------------------------------ Click on login and Sign Up to  changue and view the effect
---------------------------------------
*/

function cambiar_login() {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";  
  document.querySelector('.cont_form_login').style.display = "block";
  document.querySelector('.cont_form_sign_up').style.opacity = "0";               

  setTimeout(function(){  document.querySelector('.cont_form_login').style.opacity = "1"; },400);  
  
  setTimeout(function(){    
    document.querySelector('.cont_form_sign_up').style.display = "none";
  },200);  
}

function cambiar_sign_up(at) {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
  document.querySelector('.cont_form_sign_up').style.display = "block";
  document.querySelector('.cont_form_login').style.opacity = "0";
  
  setTimeout(function(){  document.querySelector('.cont_form_sign_up').style.opacity = "1";
},100);  

  setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
},400);  


}    



function ocultar_login_sign_up() {

  document.querySelector('.cont_forms').className = "cont_forms";  
  document.querySelector('.cont_form_sign_up').style.opacity = "0";               
  document.querySelector('.cont_form_login').style.opacity = "0"; 

  setTimeout(function(){
    document.querySelector('.cont_form_sign_up').style.display = "none";
    document.querySelector('.cont_form_login').style.display = "none";
  },500);  
  
}




</script>