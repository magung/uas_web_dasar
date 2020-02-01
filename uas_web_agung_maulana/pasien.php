<!DOCTYPE html>
<html>
<head>
	<title>Klinik LP3I</title>
	<script >
		function f_search() {
			var $row1=document.getElementById("pasien").rows.length
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
	<h1>Data Pasien</h1>
	<input type="text" name="search" id="search"/>
	<button onclick=f_search()>Search</button>
	<div>
		<table border=1 id="pasien">
			<thead>
				<tr>
					<th>No</th>
					<th>ID Pasien</th>
					<th>Nama Pasien</th>
					<th>Kontak</th>
					<th>Alamat</th>
					<th>Foto</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$D = new Database();
					$sql = "SELECT * FROM `pasien`";
					$data = $D->getList($sql);
					// var_dump($data);
					for($key = 0; $key < count($data); $key++) {
				?>
						<tr id="<?php echo 'baris_'.($key + 1); ?>">
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $data[$key][0]; ?></td>
							<td id="<?php echo 'kolom_'.($key + 1); ?>"><?php echo $data[$key]["namapasien"]; ?></td>
							<td><?php echo $data[$key]["kontak"]; ?></td>
							<td><?php echo $data[$key]["alamat"]; ?></td>
							<td><img class="img" src=<?php echo "img/".$data[$key]["foto"]; ?> >	</td>
							<td><a href=<?php echo 'editpasien.php?id='.$data[$key]["idpasien"]; ?> >Edit</a> | <a href="pasien.php?action=hapus&id=<?php echo $data[$key]["idpasien"]; ?>">Hapus</a></td>
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
			$sqlpasien 		=  "DELETE FROM `uas_klinik`.`pasien` WHERE `pasien`.`idpasien` = '".$_REQUEST["id"]."'";
			$d->query($sqlpasien);
			header("location: pasien.php");
		}
	?>


</body>
</html>