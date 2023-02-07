<?php  
// ORI
	if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "instansi") {
			header("location:instansi/index.php");
		} else if ($_SESSION['level'] == "bendahara"){
			header("location:bendahara/index.php");
		} else if ($_SESSION['level'] == "it"){
			header("location:it/index.php");
		} else {
			header("location:index.php");
		}
	}

//DIRUBAH JOHAN
//	if (isset($_SESSION['login'])) {
//		if ($_SESSION['level'] == "instansi") {
//			header("location:index.php");
//		} else if ($_SESSION['level'] == "bendahara"){
//			header("location:index.php");
//		} else if ($_SESSION['level'] == "it"){
//			header("location:index.php");
//		} else {
//			header("location:index.php");
//		}
//	}

?>