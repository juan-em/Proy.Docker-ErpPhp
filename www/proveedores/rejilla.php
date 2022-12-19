<?php
include ("../conectar.php");

@$codproveedor=$_POST["codproveedor"];
@$nombre=$_POST["nombre"];
@$nif=$_POST["nif"];
@$codprovincia=$_POST["cboProvincias"];
@$localidad=$_POST["localidad"];
@$telefono=$_POST["telefono"];
@$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codproveedor <> "") { $where.=" AND codproveedor='$codproveedor'"; }
if ($nombre <> "") { $where.=" AND nombre like '%".$nombre."%'"; }
if ($nif <> "") { $where.=" AND nif like '%".$nif."%'"; }
if ($codprovincia > "0") { $where.=" AND codprovincia='$codprovincia'"; }
if ($localidad <> "") { $where.=" AND localidad like '%".$localidad."%'"; }
if ($telefono <> "") { $where.=" AND telefono like '%".$telefono."%'"; }

$where.=" ORDER BY nombre ASC";
$query_busqueda="SELECT count(*) as filas FROM proveedores WHERE borrado=0 AND ".$where;
$rs_busqueda=mysqli_query($descriptor,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");
?>
<html>
	<head>
		<title>Proveedores</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function ver_proveedor(codproveedor) {
			parent.location.href="ver_proveedor.php?codproveedor=" + codproveedor + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function modificar_proveedor(codproveedor) {
			parent.location.href="modificar_proveedor.php?codproveedor=" + codproveedor + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function eliminar_proveedor(codproveedor) {
			parent.location.href="eliminar_proveedor.php?codproveedor=" + codproveedor + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (indi>numfilas) { 
				indi=1; 
			}
			parent.document.form_busqueda.filas.value=numfilas;
			parent.document.form_busqueda.paginas.innerHTML="";		
			while (contador<=numfilas) {
				texto=contador + "-" + parseInt(contador+9);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+10;
			}
		}
		</script>
	</head>

	<body onload=inicio()>	
		
	</body>
</html>
