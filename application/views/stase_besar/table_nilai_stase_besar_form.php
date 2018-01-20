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
        <h2 style="margin-top:0px">Entry Nilai Koas</h2>
        <form class="stepy-validation" action="<?php echo $action; ?>" method="post">
         <fieldset title="1">
                                <legend class="text-semibold">FORMATIF</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pilih Mahasiswa</label>
                                            <select name="table_koas_nim" id="table_koas_nim"
                                             autocomplete="off" 
                                             data-placeholder="Pilih..." class="select-search ">
                                            <option value=""></option>>
                                             
                                            </select>

                                           

                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>MINI-CEX</label>
                                            <input type="text"   name="investasi_awal" id="investasi_awal" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"   name="investasi_awal" id="investasi_awal" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CBD</label>
                                            <input type="text" name="kd_proyek" id="kd_proyek" class="form-control" >
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="kd_proyek" id="kd_proyek" class="form-control" >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DOPS</label>
                                            <input type="text" name="g_benefit" id="g_benefit" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="text" name="g_benefit" id="g_benefit" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PYLHN</label>
                                            <input type="text" name="name" id="man_pemerintah" class="form-control">
                                        </div>
                                         <div class="form-group">
                                            <input type="text" name="name" id="man_pemerintah" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>J. READING</label>
                                            <input type="text" name="g_cost" id="g_cost" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="g_cost" id="g_cost" class="form-control" >
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>N. FORM %</label>
                                            <input type="text" readonly="readonly" name="g_cost" id="g_cost" class="form-control bg-success" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                   

                                </div>
                            </fieldset>

                            <fieldset title="2">
                                <legend class="text-semibold">SUMATIF</legend>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UJIAN LISAN</label>
                                            <input type="text" maxlength="3" pattern="^[0-9]$" class="form-control"  onchange="sum();" onkeyup="sum();" name="bunga" id="bunga"   />
                                          
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NILAI %</label>
                                            <input type="text" readonly="readonly" onkeydown="return numbersonly(this, event);" onchange="sum();" onkeyup="sum();"  name="waktu" id="waktu" class="form-control bg-success" />
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UJIAN TULIS</label>
                                            <input type="text"  id="fp" name="fp" class="form-control"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NILAI %</label>
                                            <input type="text" readonly="readonly" name="pf" id="pf" class="form-control bg-success"/>
                                        </div>
                                    </div>
                                </div>
                               
                            </fieldset>

                            <fieldset title="3">
                                <legend class="text-semibold">Hasil</legend>

                                 <div class="row" id="my-list">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label>KONDITE</label>
                                            <input type="text"   name="investasi_awal" id="investasi_awal" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NILAI ANGKA</label>
                                            <input type="text" readonly="readonly" name="investasi_awal" id="investasi_awal" class="form-control bg-success">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NILAI HURUF</label>
                                            <input type="text" readonly="readonly" name="kd_proyek" id="kd_proyek" class="form-control bg-success" >
                                            </select>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="t_benefit_kd_benefit" id="t_benefit_kd_benefit" placeholder="T Benefit Kd Benefit"  />
                                            <input type="hidden" class="form-control" name="t_cost_kd_cost" id="t_cost_kd_cost" placeholder="T Cost Kd Cost"  />
                                           <input type="hidden" class="form-control" name="bcr" id="bcr" placeholder="Bcr"  />
                                           <input type="hidden" class="form-control" name="hasil" id="hasil" placeholder="Hasil"  />
                                            <input type="hidden" name="kd_bcr"  /> 
                                        </div>
                                    </div>
                                </div>
 
                               
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish"><i class="icon-floppy-disk"></i> Simpan</button>
                        </form>
<?php
$this->load->view('template/foot');
?>
<?php
$this->load->view('template/js');
?>
