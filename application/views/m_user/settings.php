<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?php echo lang('ui_usersetting')?></h4>
                    </div>
                    <div class="col">
                      <!-- <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?php echo base_url('mgroupuser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?php echo base_url('mgroupuser/addsave');?>">
                    <div class="form-group">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="dropdown bootstrap-select show-tick">
                          <select class="selectpicker" data-style="select-with-transition" title="<?php echo lang('ui_language')?>">
                            <?php 	
                            foreach ($enums['languageenums'] as $value)
                            { 
                            ?>
                              <option value ="<?php echo $value->Id?>"><?php echo $value->Name?></option>
                            <?php 
                            }
                            ?>
                          </select>
                          <!-- <button type="button" class="btn dropdown-toggle select-with-transition bs-placeholder" data-toggle="dropdown" role="button" title="Choose City" aria-expanded="true"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Choose City</div></div> </div><div class="ripple-container"></div></button> -->
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="<?php echo lang('ui_save')?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

<script>
  $(document).ready(function() {    
    init();
  });

  function init(){
    <?php 
    if($this->session->flashdata('add_warning_msg'))
    {
      $msg = $this->session->flashdata('add_warning_msg');
      for($i=0 ; $i<count($msg); $i++)
      {
    ?>
        setNotification("<?php echo lang($msg[$i]); ?>", 3, "bottom", "right");
    <?php 
      }
    }
    ?>
  }

</script>