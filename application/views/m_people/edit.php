<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            
            <div class="row">
              <div class="col">
                <h4 class="card-title "><?= lang('ui_edit_data')?></h4>
                <p class="card-category"> <?= lang('ui_master_people')?></p>
              </div>
              <div class="col">
                <div class="text-right">
                  <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('mpeople');?>'">
                    <i class="material-icons">list</i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">                 
            <form method = "post" action = "<?= base_url('mpeople/editsave');?>">
              <input hidden name ="idpeople" id="idpeople" value="<?= $model->Id?>">
              <div class = "row">
                  <div class = "col-md-6">
                    <div class="form-group">
                      <label><?= lang('ui_name')?></label>
                      <input id="named" type="text"  class="form-control" name = "named" value="<?= $model->Name?>" required>
                    </div>
                  </div>
                  <div class = "col-md-6">
                    <div class="form-group">
                      <label><?= lang('ui_village')?></label>
                      <div class="input-group has-success">
                        <input hidden id = "villageid" type="text" class="form-control" name = "villageid" value="<?= $model->M_Village_Id?>">
                        <input id = "villagename" type="text" class="form-control custom-readonly"  value="<?= $model->get_M_Village()->Name?>" readonly>
                    
                        <div class="input-group-append">
                          <button id="btnVillageModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalVillages"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class = "row">
                  <div class = "col-md-12">
                    <div class="form-group">       
                      <label><?= lang('ui_address')?></label>
                      <textarea id="address" type="text" class="form-control" name = "address" ><?= $model->Address?></textarea>
                    </div>
                  </div>
                </div>
                <div class = "row">
                  <div class = "col-md-8">
                    <div class="form-group">       
                      <label><?= lang('ui_postcode')?></label>
                      <input id="postcode" type="text" class="form-control" name = "postcode" value = "<?= $model->PostCode?>">
                    </div>
                  </div>
                  <div class = "col-sm-4">
                      <label><?= lang('ui_bloodtype')?></label>
                      <div class="dropdown bootstrap-select ">   
                        <?php $blood = empty($model->BloodType) ? lang('ui_bloodtype') : getEnumName("BloodType", $model->BloodType)?>
                        <select id = "bloodtype" name ="bloodtype" class="selectpicker" data-style="select-with-transition" title ="<?= $blood ?>">
                          <?php 	
                          foreach ($enums['bloodtypeenums'] as $value)
                          { 
                          ?>
                            <option value ="<?= $value->Id?>"><?= $value->EnumName?></option>
                          <?php 
                          }
                          ?>
                        </select>
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

  
               <!-- modal -->
<div id="modalVillages" tabindex="-1" role="dialog" aria-labelledby="VillageModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="VillageModalLabel" class="modal-title"><?= lang('ui_village')?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="card-body">
        <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar
                                  -->
        </div>
        <div class="material-datatables">
          <div id = "datatables_wrapper" class = "dataTables_wrapper dt-bootstrap4">
            <!-- <div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatables_length"><label>Show <select name="datatables_length" aria-controls="datatables" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="datatables_filter" class="dataTables_filter"><label><span class="bmd-form-group bmd-form-group-sm"><input type="search" class="form-control form-control-sm" placeholder="Search records" aria-controls="datatables"></span></label></div></div></div> -->
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table data-page-length="<?= $_SESSION['usersettings']['RowPerpage']?>" id = "tablemodalVillages" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th><?=  lang('ui_village')?></th>
                        <th><?=  lang('ui_subcity')?></th>
                        <th><?=  lang('ui_city')?></th>
                        <th><?=  lang('ui_province')?></th>
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <th><?=  lang('ui_village')?></th>
                        <th><?=  lang('ui_subcity')?></th>
                        <th><?=  lang('ui_city')?></th>
                        <th><?=  lang('ui_province')?></th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach ($datamodal['modal_village'] as $value)
                        {
                      ?>
                          <tr class = "rowdetail" role = "row" id = <?= $value->Id?>>
                            <td><?= $value->Name?></td>
                            <td><?= $value->get_M_Subcity()->Name?></td>
                            <td><?= $value->get_M_Subcity()->get_M_City()->Name?></td>
                            <td><?= $value->get_M_Subcity()->get_M_City()->get_M_Province()->Name?></td>
                            
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
  </div>
</div>


<script>
  $(document).ready(function() {    
    init();
    loadModal("#tablemodalVillages");
    $("#bloodtype").val("<?= $model->BloodType?>");
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

  function loadModal(idtable){
    console.log(idtable);
    $(idtable).DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
      }
    });

    var table = $(idtable).DataTable();
     // Edit record
     table.on( 'click', '.rowdetail', function () {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        var id = $tr.attr('id');

        $("#cityid").val(id);
        $("#cityname").val(data[0]);
        $('#modalSubcities').modal('hide');
     } );
  }
</script>