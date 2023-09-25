<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">User</h5>
        <?php
            if ($this->session->flashdata('berhasil')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $this->session->flashdata('berhasil') ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            } elseif ($this->session->flashdata('gagal')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                    foreach ($this->session->flashdata('gagal') as $row) {
                ?>
                    <p><?= $row ?></p>
                <?php
                    }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            }
        ?>

        <a href="<?= site_url('admin/user/add') ?>" class="btn btn-primary"><i class="ti ti-plus"></i></a>
        <div class="table-responsive mt-4">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Foto</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($user->result() as $row) {
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row->nama_user ?></td>
                            <td><?= $row->username ?></td>
                            <td>
                                <?php
                                    if ($row->foto <> '') {
                                ?>
                                    <img src="<?= base_url($row->foto) ?>" width="60">    
                                <?php
                                    } else {
                                        echo '<i class="text-danger">Belum ada foto</i>';
                                    }
                                ?>
                            </td>
                            <td><?= $row->role ?></td>
                            <td>
                                <a href="<?=base_url('admin/user/edit/'.$row->id)?>" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <?php
                                    if ($this->session->userdata('id_admin') <> $row->id) {
                                ?>
                                    <a href="<?=base_url('admin/user/delete/'.$row->id)?>" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>