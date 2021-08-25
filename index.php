<?php

include "config.php";
include "oop.php";

$go = new oop();
$tabel = 'databuku';
$field = array(
    'kode' => @$_POST['kode'],
    'judul' => @$_POST['judul'],
    'pengarang' => @$_POST['pengarang'],
    'penerbit' => @$_POST['penerbit'],
);

@$redirect = '?menu=databuku';
@$where = "no = $_GET[no]";

if(isset($_POST['simpan'])){
    $field = array( 'kode' => @$_POST['kode'],
    				'judul' => @$_POST['judul'],
                    'pengarang' => @$_POST['pengarang'],
                    'penerbit' => @$_POST['penerbit']
            );
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['update'])){
	$field = array( 'kode' => @$_POST['kode'],
    				'judul' => @$_POST['judul'],
                    'pengarang' => @$_POST['pengarang'],
                    'penerbit' => @$_POST['penerbit']
            );
    $go->ubah($con, $tabel, $field, $where, $redirect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Data Perpustakaan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    
</body>
</html>

<form method="post">
    <div class="container">
        <table align="center">
            <h3 align="center">INPUT DATA BUKU</h3>
            <div class="mb-3">
                <label class="form-label">Kode Item</label>
                <input type="text" name="kode" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-control">
            </div>
            <div class="mb-3">
                <?php if (@$_GET['no'] == "") ?>
                <input class="btn btn-info" type="submit" name="simpan" value="SIMPAN">
        </table>
</form>

<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-grey">
				<tr>
                    <th>No</th>
					<th>ID Buku</th>
					<th>Judul</th>
					<th>Penerbit</th>
					<th>Pengarang</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$a = $go->tampil($con, $tabel);
				$no = 0;
				if ($a == "")
				{
					echo "
					<tr>
						<td colspan='5' align='center'>No Record</td>
					</tr>
					";
				}
				else
				{
					foreach ($a as $r)
					{
						$no++; ?>
					<tr>
						<td>
				<?php echo $r['id'] ?></td>
						<td>
				<?php echo $r['kode'] ?></td>
                        <td>
				<?php echo $r['judul'] ?></td>
						<td>
				<?php echo $r['pengarang'] ?></td>
						<td>
				<?php echo $r['penerbit'] ?></td>
					<td><a href="?menu=databuku=<?php echo $r['id'] ?>">Edit</a></td>
					<td><a href="?menu=databuku=<?php echo $r['id'] ?>">Delete</a></td>
					</tr>
					<?php
					}
				} ?>
			<tbody>
		</table>