<?php include "header.php"; ?>33
<div class="container">


<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;
switch ($view) {
	default:
	?>
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Data Jabatan
					</h3>
				</div>

				<div class="panel-body">
					<a href="data_jabatan.php?view=tambah" style="margin-bottom:10px" class="btn btn-primary">Tambah Data</a>
					<tabel class="table table-bordered table-striped">
						<tr>
							<th>No</th>
							<th>Kode Jabatan</th>
							<th>Nama Jabatan</th>
							<th>Gaji Pokok</th>
							<th>Tunjangan Jabatan</th>
							<th>Aksi</th>
						</tr>
						<?php
						$sql = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
						$no=1;

						while($d=mysqli_fetch_array($sql)){
							echo "<tr>
								<td width='40px' align='center'>$no</td>
								<td>$d[kode_jabatan]</td>
								<td>$d[anama_jabatan]</td>
								<td>$d[gapok]</td>
								<td>$d[tunjangan_jabatan]</td>
								<td width='160px' align='center'>
									<a class='btn btn-warning btn sm'
										href='data_jabatan.php?view=edit&id=$d[kode_jabatan]'>edit</a>
									<a class='btn btn-danger btn sm'
										href='aksi_jabatan.php?act=del&id=$d[kode_jabatan]'>hapus</a>

								</td>
							</tr>";
							$no++;
						}
						?>
					</tabel>
				</div>
			</div>
		</div>
	<?php

	break;
	case 'tambah':
		//membuat kode jabatan otomatis
		$simbol = "J";
		$query = mysqli_query($konek, "SELECT max(kode_jabatan) AS last FROM jabatan WHERE kode_jabatan LIKE '$simbol%'");
		$data = mysqli_fetch($query);

		$kodeterakhir = $data['last'];
		$nomorterakhir = substr($kodeterakhir, 1, 2);
		$nextNomor = $nomorterakhir + 1;
		$nextKode = $simbol.sprintf('%02s', $nextNomor);
	?>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Tambah Data Jabatan
					</h3>
				</div>

				<div class="panel-body">

					<form method="post" action="aksi_jabatan.php?act=insert">
						<table class="table">
							<tr>
								<td width="160px">Kode Jabatan</td>
								<td>
									<input  class="form-control" type="text" name="kodejabatan" value="<?php
										echo $nextKode; ?>"readonly>

								</td>
							</tr>
							<tr>
								<td>Nama Jabatan</td>
								<td>
									<input class="form-control" type="text" name="namajabatan" required>
								</td>
							</tr>
							<tr>
								<td>Gaji Pokok</td>
								<td>
									<input  class="form-control" type="number" name="gajipokok" required>
								</td>
							</tr>
							<tr>
								<td>Tunjangan Jabatan</td>
								<td>
									<input  class="form-control" type="number" name="tunjanganjabatan" required>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Simpan">
									<a class="btn btn-danger" href="data_jabatan.php">Kembali</a> 
								</td>
							</tr>

						</table>
					</form>

				</div>
			</div>
		</div>

	<?php	
	break;
	case "edit" :
		//kode

	break;
}
?>

</div>
<?php include "footer.php"; ?>