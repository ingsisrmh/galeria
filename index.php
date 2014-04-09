<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"DTD/xhtml-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" langa="en">
<meta charset="utf-8">
<head>
	<title>Proyecto 6-2: Crea una galería de imágenes</title>
</head>

<style type="text/css">
	ul{
		list-style-type: none;
	}

	li{
		float: left;
		padding: 10px;
		margin: 10px;
		font: bold 10px Verdana, sans-serif;
	}

	img{
		display: block;
		border: 1px solid #333300;
		margin-bottom: 5px;
	}
</style>

<body>
	<h2>Proyecto 6-2: Crea una galería de imágenes</h2>
	
	<br>
	<form action="subir_archivo.php" method="post" enctype="multipart/form-data">
		<label for="archivo">Archivo:</label>
		<input type="file" name="archivo" id="archivo" />
		<br/>
		<input type="submit" value="Enviar" />
	</form>
	<br>

	<ul>
<?php
	//define la ubicacion de las imágenes
	//debe ser una ubicación accesible para el dueño del script
	$dirFotos = './postales';

	//define cuáles extensiones de archivo son imágenes
	$extFotos = array('gif', 'jpg', 'jpeg', 'tif', 'tiff', 'bmp', 'png');

	//inicializa la matriz para conservar los nombres de archivo de las imágenes encontradas
	$listaFotos = array();

	//lee el contenido del directorio
	// contruye una lista de fotos
	if (file_exists($dirFotos)){
		$dp = opendir($dirFotos) or die ('ERROR: No es posible abrir el directorio');
		while($archivo = readdir($dp)){
			if($archivo != '.' && $archivo != '..')
			{
				$datosArchivo = pathinfo($archivo);
				if(in_array($datosArchivo['extension'], $extFotos))
				{
					$listaFotos[] = "$dirFotos/$archivo";
				}
			}
		}
		closedir($dp);
	}
	else
	{
		die('ERROR: El directorio no existe.');
	}

	//itera sobre la lista de fotos
	//muestra cada foto y el nombre de archivo
	if(count($listaFotos) > 0)
	{
		for($x=0; $x<count($listaFotos); $x++)
		{
?>
			<li>
			<img height="150" with="200"
			src="<?php echo utf8_encode($listaFotos[$x]); ?>" />
			<?php echo basename(utf8_encode($listaFotos[$x])); ?><br/>
			<?php echo round(filesize($listaFotos[$x])/10240) . 'KB'; ?>
			</li>
<?php
		}
	}
	else
	{
		die('ERROR: No se encontraron imágenes en el directorio.');
	}
?>
	</ul>
</body>
</html>