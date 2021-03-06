<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('ui_edit_data')?></h4>
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
                  <form method = "post" action = "<?= base_url('mschoolyear/editsave');?>">
                    <input hidden name ="idclass" id="idclass" value="<?= $model->Id?>">
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
      </section>
      <script>
        $(document).ready(function() {    
         init();
        });

        function init(){
          <?php 
          if($this->session->flashdata('edit_warning_msg'))
          {
            $msg = $this->session->flashdata('edit_warning_msg');
            for($i=0 ; $i<count($msg); $i++)
            {
          ?>
              setNotification("<?= lang($msg[$i]); ?>", 3, "bottom", "right");
          <?php 
            }
          }
          ?>
        }
      </script>