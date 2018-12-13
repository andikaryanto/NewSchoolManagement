<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?php echo getLang('ui_data')?></h4>
                      <p class="card-category"> <?php echo getLang('ui_master_groupuser')?></p>
                    </div>
                    
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="<?php echo getLang('ui_add')?>" onclick="window.location.href='<?php echo base_url('mgroupuser/add');?>'">
                          <i class="material-icons">add</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                          <th># </th>
                          <th><?php echo  getLang('ui_name')?></th>
                          <th><?php echo  getLang('ui_description')?></th>
                          <th></th>
                      </thead>
                      <tbody>
											<?php
												foreach ($modeldetail as $value)
												{
											?>
													<tr>
														<td><?php echo $startnumber?></td>
														<td><?php echo $value->GroupName?></td>
														<td><?php echo $value->Description?></td>
														<td class = "td-actions text-right">
                              <button type="button" rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="<?php echo  getLang('ui_edit')?>" onclick="window.location.href='<?php echo base_url('mgroupuser/edit/').$value->Id;?>'">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="<?php echo  getLang('ui_role')?>" onclick="window.location.href='<?php echo base_url('mgroupuser/editrole/').$value->Id;?>'">
                                <i class="material-icons">face</i>
                              </button>
                              <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="<?php echo  getLang('ui_delete')?>" onclick="delete_disaster('<?php echo $value->Id?>','<?php echo $value->GroupName?>')">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
													</tr>
                      <?php
                          $startnumber++;
												}
											?>
                      </tbody>
                    </table>
                  </div>
									<div class="row">
                    <div class = "col ">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-primary">
                          
                          <?php if($currentpage > 3)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('m_groupuser');?>?page=<?php echo $currentpage-1?>&search=<?php echo $search?>#cardtabel" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <?php
                          }
                          ?>
                          <?php for ($i = $firstpage ; $i <= $lastpage; $i++)
                          {
                          ?>
                            <?php if ($currentpage == $i){
                            ?>
                              <li class="page-item">
                                <div class="page-link paging-active" ><?php echo $i?></div>
                              </li>
                            <?php
                            } else {
                            ?>
                            <li class="page-item">
                              <a class="page-link" href="<?php echo base_url('m_groupuser');?>?page=<?php echo $i?>&search=<?php echo $search?>#cardtabel"><?php echo $i?></a>
                            </li>
                            <?php
                            }
                            ?>
                          <?php
                          }
                          ?>
                          <?php if($currentpage < $totalpage - 2)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('m_groupuser');?>?page=<?php echo $currentpage+1?>&search=<?php echo $search?>#cardtabel" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </nav>
                    </div>
                    <div class = "col text-right">
                      Total Data : <?php echo $totalrow?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>

<script>

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
    window.location =" <?php echo base_url('m_groupuser');?>?search="+search;
  })   

  function delete_disaster(id, name){
    deleteData(name, function(result){
      if (result==true)
        window.location = "<?php echo base_url('mgroupuser/delete/');?>" + id;
    });
  } 
</script>
      