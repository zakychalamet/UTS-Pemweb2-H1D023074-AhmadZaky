<!DOCTYPE html>
<html>
<head>
    <title>Alumni Database</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Aplikasi Data Alumni Universitas</h1>
        
        <!-- Form Pencarian -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cari Alumni</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('alumni/search'); ?>" method="get" class="row g-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($search_name) ? $search_name : ''; ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="tahun" class="form-label">Tahun Lulus</label>
                        <select class="form-select" id="tahun" name="tahun">
                            <option value="">Semua Tahun</option>
                            <?php foreach($years as $year): ?>
                                <option value="<?php echo $year->year; ?>" <?php echo (isset($search_tahun) && $search_tahun == $year->year) ? 'selected' : ''; ?>>
                                    <?php echo $year->year; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Daftar Alumni -->
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Alumni</h5>
                <div>
                    <a href="<?php echo site_url('alumni/add'); ?>" class="btn btn-success btn-sm">Tambah</a>
                    <a href="<?php echo site_url('alumni/statistics'); ?>" class="btn btn-info btn-sm ms-2">Lihat Statistik</a>
                </div>
            </div>
            <div class="card-body">
                <?php if(empty($alumni)): ?>
                    <div class="alert alert-info">Tidak ada data alumni ditemukan.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Tahun Lulus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($alumni as $record): ?>
                                    <tr>
                                        <td><?php echo $record->alumni_id; ?></td>
                                        <td><?php echo $record->name; ?></td>
                                        <td><?php echo $record->tahun_lulus; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('alumni/edit/'.$record->alumni_id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?php echo site_url('alumni/delete/'.$record->alumni_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>