<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con =$db->conectar();
$id = isset($_GET['id'])? $_GET ['id']: '';
$token = isset($_GET['token'])?$_GET['token']: '';
if($id == ''||$token =='')
{
    echo'Error al procesar la peticion';
    exit;
}else{

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
if($token==$token_tmp){


    $sql =$con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
    $sql->execute([$id]);
    if($sql->fetchColumn()>0)
    {
        $sql =$con->prepare("SELECT Nombre, Descripcion, Precio, Descuento FROM productos WHERE id=? AND Activo=1
        LIMIT 1");
        $sql->execute([$id]);
        $row =$sql->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['Nombre'];
        $descripcion = $row['Descripcion'];
        $precio = $row['Precio'];
        $descuento =$row['Descuento'];
        $precio_desc = $precio - (($precio*$descuento)/100);
        $dir_images = 'images/productos/'.$id. '/';
        $rutaImg = $dir_images. '';
        if(!file_exists($rutaImg))
        {

            $rutaImg = 'productos2/no-photo.png';
        }
        $imagenes = array ();
        $dir = dir($dir_images);
        while(($archivo = $dir->read()) != false){
            if($archivo !='principal.png' &&(strpos($archivo, 'png')||strpos($archivo, 'jpeg'))){
                $imagenes [] = $dir_images. $archivo;

        } 

    }
    $dir->close();
  }


}else{
    echo ' Error al procesar la petición';
    exit;
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body> 
    <link rel="stylesheet" type="text/css" href="estilos2.css">
    
    <main>
    <div class="container">
        <div class="caja caja 1">
            <img src="<?php  echo $rutaImg?>">
        </div>
        
        <?php  foreach($imagenes as $img){?>
        <div class="caja caja 1">
            <img src="<?php  echo $img?>">
                
        </div>
      
        <?php } ?>
        </div>
        <div class="productitos">

    <h1><?php echo $nombre;?></h1>
<p><?php echo number_format($precio, 2, '.',',');?></p>
<p class="lead_robot"><?php echo $descripcion; ?></p>
<div class="buttonbuy">

    <button class="btn-buttoncomprar" type="button">Comprar ahora</button>
    <br>
    <br>
    
    <button class="btn-buttoncomprar2" type="button">Agregar al carrito</button>

</div>

        
    </div>






        


</body>
</html>

<?php

require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT Id, IdCategoria, Nombre, Precio FROM productos WHERE Activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    
</head>
<body>
    <header>        
        <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
          <div class="container">
            <a href="#" class="navbar-brand">
              <strong>Tienda Online</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Catálogo</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">Contacto</a>
                    </li>

                </ul>

                <a href="carrito.php" class="btn btn-primary">Carrito</a>
            </div>
          </div>
        </div>
      </header>

      <main>
        <div class="container">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                  <?php foreach($resultado as $row) {?>
                  <div class="col">
                    <div class="card shadow-sm">
                      <?php
                      $idProduc = $row['Nombre'];
                      $idCate = $row['IdCategoria'];
                      $imagen = "images/productos/" . $idCate . "/" . $idProduc . ".jpg";
                      if(!file_exists($imagen)){
                        $imagen = "images/no-photo.jpg";
                      }
                      ?>
                      <img src="<?php echo $imagen; ?>">         
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['Nombre']; ?></h5>
                        <p class="card-text">$<?php echo number_format($row['Precio'], 2, '.', ','); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="details.php?id=<?php echo $row['Id']; ?>&token=<?php echo hash_hmac('sha1', $row['Id'], KEY_TOKEN);?>" class="btn btn-primary">Detalles</a>
                          </div>
                          <a href="" class="btn btn-success">Agregar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
        </div>
      </main>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>