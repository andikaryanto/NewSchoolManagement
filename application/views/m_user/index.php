<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?php echo $resource['res_data']?></h4>
                      <p class="card-category"> <?php echo $resource['res_master_user']?></p>
                    </div>
                    
                    <div class="col">
                      <div class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="<?php echo $resource['res_add']?>">
                          <i class="material-icons">add</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-success">
                          <th><?php echo  $resource['res_user']?></th>
                          <th><?php echo  $resource['res_group_user']?></th>
                          <th><?php echo  $resource['res_isactive']?></th>
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
                              <button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="<?php echo  $resource['res_edit']?>" href="href="<?php echo base_url('muser/edit/').$value->Id;?>>
                                <i class="material-icons">edit</i>
                              </button>
                              <?php if($value->IsActive == 1) { ?>
															  
                                <button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="<?php echo  $resource['res_deactivate']?>" onclick = "delete_user('<?php echo $value->Id?>','<?php echo $value->Username?>')">
                                  <i class="material-icons">power</i>
                                </button>
                              <?php } else { ?>
															  <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="<?php echo  $resource['res_activate']?>" onclick="activate_user('<?php echo $value->Id?>','<?php echo $value->Username?>')">>
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
          setNotification("<?php echo $msg[$i]; ?>", 2, "bottom", "right");
      <?php 
        }
      }

      if($this->session->flashdata('delete_msg'))
      {
        $msg = $this->session->flashdata('delete_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?php echo $msg[$i]; ?>", 2, "bottom", "right");
      <?php 
        }
      }

      if($this->session->flashdata('warning_msg'))
      {
        $msg = $this->session->flashdata('warning_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?php echo $msg[$i]; ?>", 3, "bottom", "right");
      <?php 
        }
      }
    ?>
  }
  $("#searchbutton").on("click",function() {
    var search = $("#search").val();
    //alert(search);
    window.location =" <?php echo base_url('m_user');?>?search="+search;
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
      