<?php

require "../controller/MasterController.php";
$gets = new MasterController();
$res = $gets->subirPost();

include_once $res;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Fotaza</title>
    <link rel="icon" href="../img/titulo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/subir.css">

</head>

<body style="background: url(../img/pano.jpg) no-repeat center center; background-size: 100%; ">
    <div class="container"><br>
        <center>
            <h1 class="titulo">Publica tus Fotos por aqui!!!</h1>
        </center>
        <?php 
        if(isset($error))
        { 
            
            foreach($error as $er) 
            {
                echo "<p class='error_echo'>".$er."</p>";
            }    
        }
        
        if(isset($error2))
        { 
            
            foreach($error2 as $er2) 
            {
                echo "<p class='error_echo'>".$er2."</p>";
            }    
        }
        ?>
        <br>
        <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name1" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Titulo:</h4>
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control inputstl" name="titulo" placeholder="Un titulo">
                </div>
            </div>
            <div class="form-group">
                <label for="gender1" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Categoria:</h4>
                </label>
                <div class="col-sm-3">
                    <select class="form-control inputstl" name="categoria" id="gender1">
                        <option>Selecciona</option>
                        <optgroup label="Casual" class="btn-success">
                            <option value="Amigos">Amigos</option>
                            <option value="Viajes">Viaje</option>
                            <option value="Relax">Relax</option>
                            <option value="Familia">Familia</option>
                        </optgroup>
                        <optgroup label="Trabajo" class="btn-success">
                            <option value="Reunion">Reunion</option>
                            <option value="Oficina">Oficina</option>
                            <option value="Break">Break</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="Donde" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Donde:</h4>
                </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control inputstl" name="donde" id="Donde" placeholder="De que lugar es">
                </div>
            </div>
            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Descripcion:</h4>
                </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Comentario">
                </div>
                <label for="precio" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Precio$$:</h4>
                </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="precio" id="precio" placeholder="$$$">
                </div>
            </div>
            <div class="form-group">
                <label for="claves" class="col-sm-3">
                    <h4 style="color: #e8f017; font-size: 2vw;">Palabras claves:</h4>
                </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="palabra1" id="claves" placeholder="palabra 1">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="palabra2" id="claves" placeholder="palabra 2">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="palabra3" id="claves" placeholder="palabra 3">
                </div>
            </div>
            <div class="form-group">
                <label for="selphoto" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Seleciona una:</h4>
                </label>
                <div class="col-sm-5">
                    <input type="file" class="inputstl" id="selphoto" name="sentfile">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">Permisos:</h4>
                </label>
                <div class="col-sm-4">
                    <select class="form-control inputstl" name="imagen_marca" id="">
                        <option value="">Selecciona Marca de Agua</option>
                        <option value="texto_copyright">Marca de agua: Copyright</option>
                        <option value="texto_copyleft">Marca de agua: Copyleft </option>
                        <option value="texto_creative">Marca de agua: Creative Commons</option>
                        <option value="texto_fotaza">Imagen de agua: Fotaza</option>
                    </select>
                </div>
                <label for="" class="control-label">
                    <h4 style="color: #e8f017; font-size: 2vw;">*opcional</h4>
                </label>
            </div>
            <div class="form-group">
                <label for="selphoto" class="col-sm-2 control-label">
                    <h5 style="color:#e8f017; ">Privada:</h5>
                </label>
                <div class="col-sm-5">
                    <input type="checkbox" class="" id="selphoto" name="privada" value="1">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" name="subir" class="btn btn-lg btn-block btn-primary">Publicar Ahora</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $('#selphoto').filestyle({
            buttonName: 'btn-primary',
            buttonText: ' Upload an Image',
            iconName: 'glyphicon glyphicon-upload'
        });

    </script>
</body>

</html>
