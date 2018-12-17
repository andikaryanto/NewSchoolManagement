<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?php echo lang('ui_data')?></h4>
                      <p class="card-category"> <?php echo lang('ui_master_user')?></p>
                    </div>
                    
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="<?php echo lang('ui_add')?>" onclick="window.location.href='<?php echo base_url('muser/add');?>'">
                          <i class="material-icons">add</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- <div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" id="datatables_length">
                        <label>Show 
                          <select name="datatables_length" aria-controls="datatables" class="custom-select custom-select-sm form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="-1">All</option>
                          </select> entries
                        </label>
                      </div>
                    </div> -->
                    <div class="col text-right">
                      <label>
                        <span class="bmd-form-group bmd-form-group-sm">
                          <input id="search" type="search" class="form-control form-control-sm" placeholder="Search records" aria-controls="datatables" value = "<?php echo $search?>">
                        </span>
                      </label>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                          <th><?php echo  lang('ui_user')?></th>
                          <th><?php echo  lang('ui_group_user')?></th>
                          <th><?php echo  lang('ui_isactive')?></th>
                          <th></th>
                      </thead>
                      <tbody>
                      <?php
												foreach ($modeldetail as $value)
												{
											?>
													<tr>
														<td><?php echo $value->Username?></td>
														<td><?php echo $value->GroupName?></td>
                            <?php 
                            if($value->IsActive == 1 ) {
                            ?>
                            <td><a><i class='fa fa-check'></i></a></td>
                            <?php
                            } else {
                            ?>
                              <td><a><i class='fa fa-close'></i></a></td>
                            <?php
                            }  
                            ?>
                            
                            <td class="td-actions text-right">
                              <!-- <button type="button" rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="<?php echo  lang('ui_edit')?>" onclick="window.location.href='<?php echo base_url('muser/edit/').$value->Id;?>'">
                                <i class="material-icons">edit</i>
                              </button> -->
                              <?php if($value->IsActive == 1) { ?>
															  
                                <button type="button" rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="<?php echo  lang('ui_deactivate')?>" onclick = "delete_user('<?php echo $value->Id?>','<?php echo $value->Username?>')">
                                  <i class="material-icons">power</i>
                                </button>
                              <?php } else { ?>
															  <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="<?php echo  lang('ui_activate')?>" onclick="activate_user('<?php echo $value->Id?>','<?php echo $value->Username?>')">
                                  <i class="material-icons">power</i>
                                </button>
                              <?php } ?>
                            </td>
													</tr>
											<?php
												}
											?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script type = "text/javascript">
  $(document).ready(function() {    
    init();
  });

  function init(){
    <?php 
      if($this->session->flashdata('success_msg'))
      {
        $msg = $this->session->flashdata('success_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?php echo lang($msg[$i]); ?>", 2, "bottom", "right");
      <?php 
        }
      }

      if($this->session->flashdata('delete_msg'))
      {
        $msg = $this->session->flashdata('delete_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?php echo lang($msg[$i]); ?>", 2, "bottom", "right");
      <?php 
        }
      }

      if($this->session->flashdata('warning_msg'))
      {
        $msg = $this->session->flashdata('warning_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?php echo lang($msg[$i]); ?>", 3, "bottom", "right");
      <?php 
        }
      }
    ?>
  }

  $("#search").on("keyup",function(e) {
    if (e.keyCode == 13) {
      var search = $("#search").val();
      //alert(search);
      window.location ="<?php echo base_url('m_user');?>?search="+search;
    }
  })   

  function delete_user(id, name){
    deleteData(name, function(result){
      if (result==true)
        window.location = "<?php echo base_url('muser/delete/');?>" + id;
    });
  } 
  function activate_user(id){
    window.location = "<?php echo base_url('muser/activate/');?>" + id;
  }
</script>
      