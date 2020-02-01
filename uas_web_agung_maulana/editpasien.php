<!DOCTYPE html>
<html>
<head>
	<title>Klinik LP3I</title>
	<style type="text/css">
		img {
			max-width: 100px;
			max-height: 100px;
		}
	</style>
</head>
<body>
	<?php 
		include("database.php");
		include("upload.php");
		$id = date("YmdHis");
		$d = new Database(); 
		$idpasien = (!isset($_REQUEST["id"]))? null : $_REQUEST["id"];

		$sqlpendaftaran = "SELECT pd.*, ps.namapasien, ps.kontak, ps.alamat, ps.foto FROM `pendaftaran` as pd INNER JOIN `pasien` as ps on ps.idpasien = pd.idpasien WHERE ps.idpasien = '".$idpasien."'";
		$datapendaftaran = $d->getList($sqlpendaftaran);
		$data 			= $datapendaftaran[0];
		$iddaftar 		= $data["iddaftar"];
		$idpasien 		= $data["idpasien"];
		$jenisdaftar 	= $data["jenisdaftar"];
		$biaya 			= $data["biaya"];
		$namapasien 	= $data["namapasien"];
		$alamat 		= $data["alamat"];
		$kontak 		= $data["kontak"];
		$foto 			= $data["foto"];
		$action = (!isset($_REQUEST["action"]))? null : $_REQUEST["action"];
		if($action == null){
	 ?>
	<h1>Edit Pendaftaran Pasien</h1>
	<div>
		<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
			<div>
				<label>ID Daftar</label><br>
				<input type="text" name="id_daftar" value=<?php echo $iddaftar; ?> readonly />
			</div>
			<div>
				<label>Jenis Daftar</label>
				<div class="col-xs-2">
		          <label class="radio-inline">
		            <input type="radio" name="jenisdaftar" id="" value="ada"> Ada kartu pasien
		          </label>
		        </div>
		        <div class="col-xs-2">
		            <label class="radio-inline">
		                <input type="radio" name="jenisdaftar" id="" value="belum" checked> Belum ada kartu pasien
		            </label>
		        </div>
			</div>
			<div>
				<label>ID Pasien</label><br>
				<input type="text" name="id_pasien" value=<?php echo $idpasien; ?> readonly/>
			</div>
			<div>
				<label>Nama Pasien</label><br>
				<input type="text" name="namapasien" value=<?php echo $namapasien; ?> />
			</div>
			<div>
				<label>Alamat</label><br>
				<textarea rows="4" cols="50" name="alamat"><?php echo $alamat; ?> </textarea>
			</div>
			<div>
				<label>Kontak</label><br>
				<input type="text" name="kontak" value=<?php echo $kontak; ?> />
			</div>
			<div>
				<label>Foto</label><br>
				<input type="file" name="foto_pasien"/>
				<img src="<?php echo 'img/'.$foto; ?> ">
				<a href="editpasien.php?action=hapus_foto&iddaftar=<?php echo $_REQUEST["iddaftar"];?>">Hapus Foto</a>
			</div>
			<div>
				<label>Biaya Daftar</label><br>
				<input type="text" name="biaya" value=<?php echo $biaya; ?> />
			</div>
			<div>
				<input type="submit" name="action" value="Edit"/>
				<a href="pasien.php">Batal</a>
			</div>
		</form>

	</div>
	<?php 
		} elseif ($action == "Edit") {
			$id_daftar   	= $_POST["id_daftar"];
			$jenisdaftar 	= $_POST["jenisdaftar"];
			$id_pasien 		= $_POST["id_pasien"];
			$namapasien 	= $_POST["namapasien"];
			$alamat 		= $_POST["alamat"];
			$kontak 		= $_POST["kontak"];
			$biaya 			= $_POST["biaya"];
			$foto 			= $_FILES["foto_pasien"];
			// // var_dump($idadmin);
			// var_dump($foto);
			// die();
			$u= new Upload();
			$hasil = $u->unggah($foto);
			if ($hasil["status"] == "0") {
		      die ("Upload Foto gagal <a href='#' onclick='window.history.back()'>coba lagi</a>");
		    } elseif($hasil["status"] == "4") {
		    	$foto = $data["foto"];
		    } else {
		    	$foto = $hasil["info"];
		    }
			$sqlpasien 		= "UPDATE `uas_klinik`.`pasien` SET `namapasien` = '".$namapasien."', `kontak` = '".$kontak."', `alamat` = '".$alamat."', `foto` = '".$foto."' WHERE `pasien`.`idpasien` = '".$id_pasien."'";
			$sqlpendaftaran = "UPDATE `uas_klinik`.`pendaftaran` SET `biaya` = '".$biaya."', `jenisdaftar` = '".$jenisdaftar."' WHERE `pendaftaran`.`iddaftar` = '".$iddaftar."'";
			$d->query($sqlpasien);
			$d->query($sqlpendaftaran); 
			header("location: pasien.php");
		    
		} elseif ($action == "hapus_foto") {
			$h = new Upload();
			$h->hapusFile($foto);
			$sqlpasien 		= "UPDATE `uas_klinik`.`pasien` SET `foto` = '' WHERE `pasien`.`idpasien` = '".$idpasien."'";
			$d->query($sqlpasien);
			header("location: editpasien.php?idpasien=".$_REQUEST["idpasien"]);
		}
	?>
</body>
</html>