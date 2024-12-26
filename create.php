<!doctype html>
<html lang="en">
<head>
    <?php include('header.php'); ?>
</head>
<body>
    <?php include('navbar.php'); ?>
    <main role="main" class="container">
        <div class="container mt-5 pt-5">
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="mb-4">Unggah Resep Baru!</h5>
                    <form action="controller/inventory.php?action=store" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Masukkan Foto Makanan/Minuman</label>
                            <input class="form-control" type="file" id="formFile" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Resep</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan nama resep" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Bahan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bahan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea2" class="form-label">Cara</label>
                            <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="cara" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Unggah</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>