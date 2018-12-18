<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?php echo lang('ui_changepassword')?></h4>
                      <p class="card-category"> <?php echo lang('ui_user')?></p>
                    </div>
                    <div class="col">
                      <!-- <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?php echo base_url('muser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-body">
                 
                  <form method = "post" action = "<?php echo base_url('saveChangePassword');?>">
                    <div class="form-group">
                      <label><?php echo lang('ui_oldpassword')?></label>
                      <input id="oldpassword" type="password" class="form-control" name = "oldpassword" value="<?php echo $model['oldpassword']?>" required>
                    </div>
                    <div class="form-group">
                      <label><?php echo lang('ui_newpassword')?></label>
                      <input id="newpassword" type="password" class="form-control" name = "newpassword" value="<?php echo $model['newpassword']?>" required>
                    </div>
                    <div class="form-group">
                      <label><?php echo lang('ui_confirmpassword')?></label>
                      <input id="confirmpassword" type="password" class="form-control" name = "confirmpassword" value="<?php echo $model['confirmpassword']?>" required>
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
  
</script>