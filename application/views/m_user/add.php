      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('ui_add_data')?></h4>
                      <p class="card-category"> <?= lang('ui_master_user')?></p>
                    </div>
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('muser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('muser/addsave');?>">
                    <input hidden id = "groupid" type="text" class="form-control" name = "groupid" value="<?= $model->GroupId?>">
                    <div class="form-group bmd-form-group">
                      <label class = ""><?= lang('ui_name')?></label>
                      <input id="named" type="text"  class="form-control " name = "named" value="<?= $model->Username?>" required>
                    </div>
                    <div class="form-group">
                      <label><?= lang('ui_group_user')?></label>
                      <div class="input-group has-success">
                        
                        <input id = "groupname" type="text" class="form-control custom-readonly"  value="<?= $model->M_groupusers()->GroupName?>" readonly>
                        <!-- <span class="form-control-feedback text-primary">
                            <i class="material-icons">search</i>
                        </span> -->
                        <div class="input-group-append">
                          <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalGroupUser"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      <label><?= lang('ui_password')?></label>
                      <input id="password" type="password" class="form-control" name = "password" value="<?= $model->Password?>">
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

<!-- modal -->
<div id="modalGroupUser" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">Group User</h5>
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
                  <table data-page-length="<?= $_SESSION['usersettings']['RowPerpage']?>" id = "tableModalGroupUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th><?=  lang('ui_group_user')?></th>
                        <!-- <th><?=  lang('ui_description')?></th> -->
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <!-- <th># </th> -->
                        <th><?=  lang('ui_group_user')?></th>
                        <!-- <th><?=  lang('ui_description')?></th> -->
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      //print_r($modeldetail);
                        foreach ($datamodal['modal_group'] as $value)
                        {
                      ?>
                          <tr class = "rowdetail" role = "row" id = <?= $value->Id?>>
                            <td><?= $value->GroupName?></td>
                            <!-- <td><?= $value->Description?></td> -->
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

<script type = "text/javascript">
  $(document).ready(function() {    
    init();
    loadModalGroup("#tableModalGroupUser");
  });

  function loadModalGroup(idtable){
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

        $("#groupid").val(id);
        $("#groupname").val(data[0]);
        $('#modalGroupUser').modal('hide');
     } );
  }

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
    ?>
  }

  function showModalGroup(){

  }
  // function getModalGroup(page)
  // {
  //   removeModalGroupUserComponent();
  //   var search = $('#searchInput').val();
  //   $.ajax({
  //     type: "POST",
  //     url: "<?= base_url('M_groupuser/groupusermodal')?>",
  //     data:{
  //           page: page,
  //           search : search
  //         },
  //     success:function(data){
  //       var groupuser = $.parseJSON(data);
  //       console.log(groupuser);
  //       setResourceModalGroupUser();

  //       var detail = groupuser['m_groupuser']['modeldetailmodal'];
  //       var firstrow = groupuser['m_groupuser']['firstrowmodal']
  //       for(var i = 0; i < detail.length; i++)
  //       {
  //         $("#tblGroupUserLookUp").append("<tr onclick='chooseGroupName("+detail[i].Id+","+'"'+detail[i].GroupName+'"'+");'><td>" + firstrow + "</td><td>" + detail[i].GroupName + "</td></tr>");
  //         firstrow++;
  //       }

  //       var previous = "";
  //       var pages = "";
  //       var next = "";
  //       var append = "";
  //       if(groupuser['m_groupuser']['currentpagemodal'] > 3)
  //       {
  //         previous += "<li class='page-item'>";
  //         previous += "<a class='page-link' href='#' onclick = 'getModalGroup("+(groupuser['m_groupuser']['currentpagemodal']-1)+")' aria-label='Previous'>";
  //         previous += "<span aria-hidden='true'>&laquo;</span>";
  //         previous += "<span class='sr-only'>Previous</span>";
  //         previous += "</a>" ;
  //         previous += "</li>";
  //       }

  //       for (var i = groupuser['m_groupuser']['firstpagemodal'] ; i <= groupuser['m_groupuser']['lastpagemodal']; i++){
  //         if(groupuser['m_groupuser']['currentpagemodal'] == i){
  //           pages += " <li class='page-item ' >";
  //           pages += "<a class='page-link paging-active' href='#' onclick = 'getModalGroup("+i+")'>"+i+"</a>";
  //           pages += "</li>";
  //         } else {
  //           pages += " <li class='page-item ' >";
  //           pages += "<a class='page-link' href='#' onclick = 'getModalGroup("+i+")'>"+i+"</a>";
  //           pages += "</li>";
  //         }
  //       }

  //       if(groupuser['m_groupuser']['currentpagemodal'] < groupuser['m_groupuser']['totalpagemodal'] - 2)
  //       {
  //         next += "<li class='page-item'>";
  //         next += "<a class='page-link' href='#' onclick = 'getModalGroup("+(1+groupuser['m_groupuser']['currentpagemodal'])+")' aria-label='Next'>";
  //         next += "<span aria-hidden='true'>&raquo;</span>";
  //         next += "<span class='sr-only'>Next</span>";
  //         next += "</a>" ;
  //         next += "</li>";
  //       }

  //       append += "<div id = 'modalGroupUserPaging' class='row'>";
  //       append += "<div class = 'col-lg-6'>";
  //       append += "<nav aria-label='Page navigation example'>";
  //       append += "<ul class='pagination'>";
  //       append += previous;
  //       append += pages;
  //       append += next;
  //       append += "</ul>";
  //       append += "</nav>";
  //       append += "</div>";
  //       append += "<div class = 'col-lg-6 icon-custom-table-header'>";
  //       append += "<?= lang('ui_showing')?>"+" "+groupuser['m_groupuser']['firstrowmodal']+" "+"<?= lang('ui_to')?>"+" "+groupuser['m_groupuser']['lastrowmodal']+" "+"<?= lang('ui_of')?>"+" "+groupuser['m_groupuser']['totalrowmodal']+" "+"<?= lang('ui_data')?>";
  //       //append +="Total Data : "+groupuser['m_groupuser']['firstrow'];
  //       append += "</div>";
  //       append += "</div>";
        
  //       $("#cardModalBody").append(append);
  //     }
  //   });
  // };

  // function chooseGroupName(Id, Name)
  // {
  //   $("#groupid").val(Id);
  //   $("#groupname").val(Name);
  //   $('#modalGroupUser').modal('hide');
  // }

  // $("#modalGroupUser").on('hidden.bs.modal', function(){
  //   removeModalGroupUserComponent();
  // });

  // function removeModalGroupUserComponent()
  // {
  //   $("#tblGroupUserLookUp").find("tr:gt(0)").remove();
  //   $("#modalGroupUserPaging").remove();
  // }

  // function setResourceModalGroupUser()
  // {
  //   $("#searchbutton").innerHtml = "<?= lang('ui_search')?>";
  //   $("#groupUserModalLabel").text = "<?= lang('ui_groupuser')?>";
  // }
</script>