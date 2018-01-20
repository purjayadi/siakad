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
            <div class="panel panel-flat">
            <div class="panel-body">
        <h2 style="margin-top:0px"><?php echo $button ?> Data Blok</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kode Blok <?php echo form_error('kode_blok') ?></label>
            <input type="text" class="form-control" name="kode_blok" id="kode_blok" placeholder="Kode Blok" value="<?php echo $kode_blok; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Blok <?php echo form_error('nama_blok') ?></label>
            <input type="text" class="form-control" name="nama_blok" id="nama_blok" placeholder="Nama Blok" value="<?php echo $nama_blok; ?>" />
        </div>
         <div class="form-group">
        <label">Kurikulum</label>
            <select name="table_kurikulum_id_kurikulum" id="table_kurikulum_id_kurikulum" class="select-search" placeholder="Pilih Kurikulum"  />
            <option>Pilih Kurikulum</option>
            <?php 
            $mahasiswa=$this->db->query("select * from table_kurikulum");

            foreach($mahasiswa->result() as $value){
              $selected= '';
              if($id_kurikulum == $value->id_kurikulum){
                $selected = 'selected';
              }

            ?>
              <option  value="<?php echo $value->id_kurikulum; ?>"  echo ' selected="selected"'; >
                <?php echo $value->tahun; ?>
              </option>
           <?php }?>

          </select>
        </div>
	    <div class="text-right">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
             <input type="hidden" name="id_blok" value="<?php echo $id_blok; ?>" /> 
              <a href="<?php echo site_url('blok') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i>  <?php echo $button ?></button> 
        </div>
        </div>
       
	</form>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>