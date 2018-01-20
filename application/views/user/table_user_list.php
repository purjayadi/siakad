<?php
$this->load->view('template/head');
$this->load->view('template/navbar');
$this->load->view('template/secnavbar');
?>
 <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

        <h2 style="margin-top:0px">Data Users</h2>
        <div class="row" style="margin-bottom: 10px">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/user/create'),'Create', 'class="btn btn-success"'); ?>
            </div>
            
            <div class="col-md-6 text-right">
                <form action="<?php echo site_url('admin/user/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/user'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-success" type="submit">Search</button>
                        </span>
                    </div>
                </form>
           </div>
        </div>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        <div class="panel panel-flat">
        <div class="table-responsive">
         <table class="table table table-xxs">
            <tr class="border-solid">
                <th>No</th>
		<th>First Name</th>
		<th>last Name</th>
		<th>Username</th>
		<th>Email</th>
        <th>Status</th>
		<th>Action</th>
            </tr><?php
            foreach ($user_data as $user)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $user->first_name ?></td>
			<td><?php echo $user->last_name ?></td>
			<td><?php echo $user->username ?></td>
			<td><?php echo $user->email ?></td>

            <td><?php
            if($user->active == 1){
                echo"Active";
            }else{
                echo"Deactive";
            }
            ?></td>
			<td style="text-align:center" width="200px">
				<ul class="icons-list ">
                     <li><a href="<?php echo site_url() ?>auth/deactivate/<?php echo $user->id;?>" class="btn btn-info  btn-xs" data-popup="tooltip" title="Deactive" ><i class="icon-user-block text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>auth/activate/<?php echo $user->id;?>" class="btn btn-success  btn-xs" data-popup="tooltip" title="Active" ><i class=" icon-user-check text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>auth/edit_user/<?php echo $user->id;?>" class="btn btn-warning  btn-xs" data-popup="tooltip" title="Ubah" ><i class="icon-pencil text-white"></i></a></li>
                    <li><a href="<?php echo site_url() ?>admin/user/delete/<?php echo $user->id;?>" class="btn btn-danger btn-xs" data-popup="tooltip" title="Hapus"   onClick='return confirm("Anda yakin ingin menghapus data ini?")'><i class="icon-bin text-white" ></i></a></li>
                </ul>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div> 
 </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-success">Total Record : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>