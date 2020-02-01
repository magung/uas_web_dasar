<!DOCTYPE html>
<html>
<head>
	<title>Klinik LP3I</title>
	<script >
		function f_search() {
			var $row1=document.getElementById("pendaftaran").rows.length
			for (var $i = 1; $i <= $row1; $i++) {
				var a=document.getElementById("kolom_"+$i).innerHTML.toLowerCase();
				var b=document.getElementById("search").value.toLowerCase();
				document.getElementById("baris_"+$i).style.display =
				(a.indexOf(b)==-1?"none":"")
			}
		}
	</script>
</head>
<body>
	<?php 
		include("header.php");
		include("database.php");
		include("upload.php");
		$action = (!isset($_REQUEST["action"]))? null : $_REQUEST["action"];
	?>
	<h1>Data Pendaftaran</h1>
	<div>
		<input type="text" name="search" id="search"/>
		<button onclick=f_search()>Search</button>
		<table border=1 id="pendaftaran">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Daftar</th>
					<th>Nama Pasien</th>
					<th>Tanggal Daftar</th>
					<th>Admin</th>
					<th>Biaya</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$D = new Database();
					$sql = "SELECT pd.*, ps.namapasien, adm.namaadmin FROM `pendaftaran` as pd INNER JOIN `pasien` as ps ON ps.idpasien = pd.idpasien INNER JOIN `admin` as adm ON adm.nip = pd.idadmin";
					$data = $D->getList($sql);
					// var_dump($data);die();
					for($key = 0; $key < count($data); $key++) {
				?>
						<tr id="<?php echo 'baris_'.($key + 1); ?>">
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $data[$key]["iddaftar"]; ?></td>
							<td id="<?php echo 'kolom_'.($key + 1); ?>" ><?php echo $data[$key]["namapasien"]; ?></td>
							<td><?php echo $data[$key]["tgldaftar"]; ?></td>
							<td><?php echo $data[$key]["namaadmin"]; ?></td>
							<td><?php echo $data[$key]["biaya"]; ?></td>
							<td><a href="editpendaftaran.php?iddaftar=<?php echo $data[$key]["iddaftar"]; ?>">Edit</a> | <a href="datapendaftaran.php?action=hapus&id=<?php echo $data[$key]["iddaftar"]; ?>">Hapus</a></td>
						</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<?php 
		if($action == "hapus") {
			$d = new Database();
			$h = new Upload();
			$h->hapusFile($foto);
			$sqlpasien 		=  "DELETE FROM `uas_klinik`.`pendaftaran` WHERE `pendaftaran`.`iddaftar` = '".$_REQUEST['id']."'";
			$d->query($sqlpasien);
			header("location: datapendaftaran.php");
		}
	?>
</body>
</html>