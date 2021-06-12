<?php require_once "includes/headers/header.php"; ?>

<!--Caja principal-->
<div class="main" style="height:500px;">

    <div class="pricipal" style="text-align:center;">
    
        <h1 style="margin: 20px;margin-bottom:50px;">Inicia sesion en el sistema</h1>
            <form action="loggin.php" method="POST" style="display:block;border:1px solid #000;width: 50%;height:auto;margin-left:300px">
                <label for="email" style="display:block;margin: 10px 0">Email:</label>
                <input type="email" name="email" style="width: 270px;">

                <label for="password" style="display:block;margin: 10px 0">Contraseña:</label>
                <input type="password" name="password" style="width: 270px;margin-bottom: 10px"></br>

                <input type="submit" vlaue="Enviar" style="width: 100px;height: 30px;margin-bottom: 20px;background-color:#42b881;color:#fff "/>
            </form>
    </div>  
    
    

</div>

<?php require_once "includes/footer.php";?>