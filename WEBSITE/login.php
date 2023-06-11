<head>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript">
        var attempt = 3; 
    function validate(){
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if ( username == "abc" && password == "123"){
            alert ("Login successfully");
            window.location = "index.php"; 
            return false;
        }
        else{
            
            attempt --;
            alert("Wrong credentials entered. You have left only "+attempt+" attempt;");
            
            document.getElementById("username").value="";
            document.getElementById("password").value="";
            
            if( attempt == 0){
            document.getElementById("username").value="";
            document.getElementById("password").value="" ;
            document.getElementById("username").disabled = true;
            document.getElementById("password").disabled = true;
            document.getElementById("submit").disabled = true;
            return false;
        }
        
    }
}
    </script>
</head>

<div class="wrapper fadeInDown">
    <div id="formContent">
       

      
        <div class="fadeIn first">
            <h2>Login</h2>
        </div>

    
        <form>
            <input type="text" id="username" class="fadeIn second" name="login" placeholder="Username">
            <input type="password" id="password" class="fadeIn third" name="login" placeholder="Password">
            <input type="button" value="Login" id="submit" onclick="validate()"/>
        </form>

    </div>
</div>