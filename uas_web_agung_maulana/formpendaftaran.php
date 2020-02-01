<!DOCTYPE html>
<html>
<head>
	<title>Klinik LP3I</title>
</head>
<body>
	<?php 
		include("header.php");
		include("database.php");
		include("upload.php");
		$id = date("YmdHis");
		$action = (!isset($_REQUEST["action"]))? null : $_REQUEST["action"];
		if($action == null){
	 ?>
	<h1>Tambah Pendaftaran Pasien</h1>
	<div>
		<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
			<div>
				<label>ID Daftar</label><br>
				<input type="text" name="id_daftar" value=<?php echo "DF".$id; ?> readonly />
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
				<input type="text" name="id_pasien" value=<?php echo "P".$id; ?> readonly/>
			</div>
			<div>
				<label>Nama Pasien</label><br>
				<input type="text" name="namapasien"/>
			</div>
			<div>
				<label>Alamat</label><br>
				<textarea rows="4" cols="50" name="alamat"></textarea>
			</div>
			<div>
				<label>Kontak</label><br>
				<input type="text" name="kontak"/>
			</div>
			<div>
				<label>Foto</label><br>
				<input type="file" name="foto_pasien"/>
			</div>
			<div>
				<label>Biaya Daftar</label><br>
				<input type="text" name="biaya"/>
			</div>
			<div>
				<input type="submit" name="action" value="Simpan"/>
				<input type="reset" name="batal" value="Batal"/>
			</div>
		</form>

	</div>
	<?php 
		} elseif($action == "Simpan") {
			$id_daftar = $_POST["id_daftar"];
			$jenisdaftar = $_POST["jenisdaftar"];
			$id_pasien = $_POST["id_pasien"];
			$namapasien = $_POST["namapasien"];
			$alamat = $_POST["alamat"];
			$kontak = $_POST["kontak"];
			$biaya = $_POST["biaya"];
			$foto = $_FILES["foto_pasien"];
			$tgldaftar = date("Y-m-d H:i:s");
			session_start();
			$idadmin = isset($_SESSION['nip']) ? $_SESSION["nip"] : NULL;
			// var_dump($idadmin);
			// var_dump($id_pasien);
			// die();
			$u= new Upload();
			$hasil= $u->unggah($foto);
		    if ($hasil["status"]== "0") {
		      die ("Upload Foto gagal <a href='#' onclick='window.history.back()'>coba lagi</a>");
		    } else {
		    	$d = new Database(); 
				$sqlpasien = "INSERT INTO `uas_klinik`.`pasien` (`idpasien`, `namapasien`, `kontak`, `alamat`, `foto`) VALUES ('".$id_pasien."', '".$namapasien."', '".$kontak."', '".$alamat."', '".$hasil['info']."')"; 
				$sqlpendaftaran = "INSERT INTO `uas_klinik`.`pendaftaran` (`iddaftar`, `idpasien`, `tgldaftar`, `idadmin`, `biaya`, `jenisdaftar`) VALUES ('".$id_daftar."', '".$id_pasien."', '".$tgldaftar."', '".$idadmin."', '".$biaya."', '".$jenisdaftar."')";
				$d->query($sqlpasien);
				$d->query($sqlpendaftaran); 
				header("location: datapendaftaran.php");
		    }

		}
	?>
</body>
</html>