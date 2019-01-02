<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('ui_add_data')?></h4>
                      <p class="card-category"> <?= lang('ui_master_schoolyear')?></p>
                    </div>
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('mschoolyear');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('mschoolyear/addsave');?>">
                    <!-- <div class = "row">
                      <div class = "col-md-12">
                        <div class="togglebutton text-right">
                          <label>
                            <input type="checkbox" checked="" name = "isactive">
                            <span class="toggle"></span>
                            <?= lang('ui_isactive') ?>
                          </label>
                        </div>
                      </div>
                    </div> -->
                    <div class = "row">
                      <div class = "col-md-12">
                        <div class="form-group">
                          <label><?= lang('ui_name')?></label>
                          <input id="named" type="text"  class="form-control" name = "named" value="<?= $model->Name?>" required>
                        </div>
                      </div>
                    </div>
                    <div class = "row">
                      <div class = "col-md-12">
                        <div class="form-group">       
                          <label><?= lang('ui_datestart')?></label>
                          <input id="datestart" type="text" class="form-control datepicker" name = "datestart" value = "<?= $model->DateStart?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
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
        setNotification("<?= lang($msg[$i]); ?>", 3, "bottom", "right");
    <?php 
      }
    }
    
    if($this->session->flashdata('success_msg'))
    {
      $msg = $this->session->flashdata('success_msg');
      for($i=0 ; $i<count($msg); $i++)
      {
    ?>
        setNotification("<?= lang($msg[$i]); ?>", 2, "bottom", "right");
    <?php 
      }
    }
    ?>
  }

</script>