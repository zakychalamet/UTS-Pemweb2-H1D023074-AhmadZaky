<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($alumni) ? 'Edit Alumni' : 'Add Alumni'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4"><?php echo isset($alumni) ? 'Edit Alumni' : 'Tambah Alumni'; ?></h1>
        
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo isset($alumni) ? 'Update Informasi Alumni' : 'Informasi Alumni'; ?></h5>
            </div>
            <div class="card-body">
                <form action="<?php echo isset($alumni) ? site_url('alumni/update/'.$alumni->alumni_id) : site_url('alumni/insert'); ?>" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($alumni) ? $alumni->name : set_value('name'); ?>" required>
                        <?php echo form_error('name', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" min="1963" max="<?php echo date('Y'); ?>" value="<?php echo isset($alumni) ? $alumni->tahun_lulus : set_value('tahun_lulus'); ?>" required>
                        <?php echo form_error('tahun_lulus', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="<?php echo site_url('alumni'); ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>