<?php include("../../includes/configuration.php");?>
<!doctype html>
<html lang='en'>
<head>
    <title><?php echo SITENAME; ?> : Shipping Gateway</title>
    <?php include('../commoncss.php') ?>
     <link rel="stylesheet" href="<?php echo SITEURL; ?>/css/dataTable/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="page-body-wrapper">
    <?php include('../header.php') ?>
    <?php include('../sidebar.php') ?>
    <div class="main-panel">
        <div class="dashbody">

            <div class="card">
                <div class="card-header sec-card-head justify-content-between align-items-center py-2">
                    <div><h2 class="card-head-title">Manual Shipping On Locations</h2></div>
                    <div class="btn-actions-pane-right">
                       <button type="button" class="btn btn-primary btn-sm" onclick="importfile()">Import</button>    <button type="button" class="btn btn-primary btn-sm" onclick="exportdata()">Export</button>

                    </div>
                </div>
                <form class="sms_gateway_form">
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-2"> <div class="form-group ">
                        <label>Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" maxlength="6"  />
                        </div>
                    </div>
                    <div class="col-md-2"> <div class="form-group ">
                        <label>Charges Per</label>
                        <div class="input-group ">      <input type="text" name="chargesPer" id="chargesPer" class="form-control" maxlength="7"  />
                        <div class="input-group-append">
                            <select class="form-control" name="chargesUnit" id="chargesUnit"><option value="gm">gm</option><option value="piece">piece</option></select>
                          </div>
                         </div>
                        </div>
                    </div>
                    <div class="col-md-2"> <div class="form-group ">
                        <label >Shipping Charges</label>
                        <input type="text" name="shiping_charges" id="shiping_charges" class="form-control" placeholder="Shipping Charges" maxlength="5"  />
                        </div>
                    </div>
                    <div class="col-md-2"> <div class="form-group ">
                        <label >Delivery In Days</label>
                        <select class="form-control" name="delivery" id="delivery"><? for($i=0;$i<=15;$i++){?> <option value="<?=$i; ?>"><?=$i; ?> <?=($i==0?" (Same Day)":""); ?> </option> <?} ?></select>
                        </div>
                    </div>
                    <div class="col-md-2"> <button type="button" name="create" id="submit" class="btn btn-primary" onclick="addpincode()">Add</button> </div>
                    </div>

                  </div>

                </form>
                <div class= "col-md-12 manualships">
                 <div id="tablereload">
                 <table class="table table-bordered shipping w-100" id="shipping">
                 <thead><th>#</th><th>Pincode</th><th>Charges Per</th><th>Shipping Charges</th><th>Delivery In Days</th><th>Edit</th><th>Remove</th></thead><tbody>
                <?   $getpin=selectQuery(MANUAL,"*","1 order by id DESC");
                    if(count($getpin)){  ?>
                       <? for($i=0;$i<count($getpin);$i++){ $row=$getpin[$i]; ?>
                       <tr><td><?=$i+1; ?></td><td><?=$row['pincode']; ?></td><td><?=$row['chargesPer']." ".$row['chargesUnit']; ?></td><td><?=($row['shipping_charges']!=0?$row['shipping_charges']:"-"); ?></td><td><?=$row['deliveryDays']; ?></td>
                        <td><button type="button" onclick="edit('<?=$row['id']; ?>','<?=$row['pincode']; ?>','<?=($row['shipping_charges']!=0?$row['shipping_charges']:""); ?>','<?=$row['chargesPer']; ?>','<?=$row['chargesUnit']; ?>','<?=$row['deliveryDays']; ?>')" class="editbtn btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></button></td>
                        <td><button type="button" onclick="del('<?=$row['id']; ?>')" class="deletebtn btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
                       </tr>
                        <? }
                }   ?>
                 </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
        <?php include('../footer.php');?>
    </div>
</div>
<div class="modal confirm-modal px-4" id="editpop">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h5 id="confirm_message" class="cc-fw-5 mb-3">&nbsp;</h5>
                <form>
                    <div class="form-group  mb-12">
                     <label class="label" >Pincode</label>
                      <input class="form-control" id="idedit" name="idedit" type="hidden" maxlength="6" >
                        <input class="form-control" id="pinedit" name="pinedit" type="text" maxlength="6" disabled>
                    </div>
                     <div class="mb-12"> <div class="form-group ">
                        <label>Charges Per</label>
                        <div class="input-group "> <input type="text" name="chargesPerEdit" id="chargesPerEdit" class="form-control" maxlength="7"  />
                        <div class="input-group-append">
                            <select class="form-control" name="chargesUnitEdit" id="chargesUnitEdit"><option value="gm">gm</option><option value="piece">piece</option></select>
                          </div>
                         </div>
                        </div>
                    </div>
                     <div class="form-group  mb-12">
                     <label class="label" >Shipping Charges</label>
                        <input class="form-control" id="chargedit" name="chargedit" type="text" maxlength="6" >
                    </div>
                    <div class="form-group  mb-12">
                        <label >Delivery In Days</label>
                        <select class="form-control" name="deliveryEdit" id="deliveryEdit"><? for($i=0;$i<=15;$i++){?> <option value="<?=$i; ?>"><?=$i; ?> <?=($i==0?" (Same Day)":""); ?> </option> <?} ?></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updateship()">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal confirm-modal px-4" id="importpop">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h5 id="confirm_message" class="cc-fw-5 mb-3">&nbsp;</h5>
               <form id="prodct_add_form" action="save_basic.php" method="post">
                    <div class="file-field">
                        <input type="file" id="filein" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        <div class="mt-2">Acepted File Format : .xls,.xlsx</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="importBtn" onclick="importnow()">Import</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo SITEURL ?>/js/validation.js"></script>

<script src="<?php echo SITEURL; ?>/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script>
 loaddatatable();
function loaddatatable(){$('.shipping').DataTable({ "scrollX": true });}

function addpincode(){
    pincode=$("#pincode").val();  shiping_charges = $("#shiping_charges").val();
     shippingPer=$("#chargesPer").val(); shippingUnit=$("#chargesUnit option:selected").val();   delivery=$("#deliveryEdit option:selected").val();
    if(pincode!=""&&(shiping_charges!=""&&!isNaN(shiping_charges))){
         var info = {pincode: pincode, shiping_charges: shiping_charges, shippingPer:shippingPer, shippingUnit:shippingUnit,delivery:delivery, action:'add_manual_pincode'};
        $.ajax({
            type: "POST",
            url: "ajax_hyperlocal.php",
            data: info,
            success: function(response){
                if (response == 1){
                    $('.alert_msgs').fadeIn().removeClass("failactionmsg").addClass("successactionmsg").html("Pincode added for manual shipping").delay(3000).fadeOut();
                    $("#tablereload").load(" #tablereload");  setTimeout(function(){ loaddatatable();}, 500);
                }else{
                    $('.alert_msgs').fadeIn().removeClass("successactionmsg").addClass("failactionmsg").html(response).delay(5000).fadeOut();
                }

            }
        });
    }else{
         $('.alert_msgs').fadeIn().removeClass("successactionmsg").addClass("failactionmsg").html("Please enter pincode").delay(5000).fadeOut();
    }
}

  function del(id) {
        if (id != "") {
            if (confirm("Are You Sure To Delete This Pincode? ")) {
                var info = { id: id, action: "delPincode"};
                $.ajax({
                    type: "POST",url: "ajax_hyperlocal.php", data: info,
                    success: function(response) {
                        if (response == 1) {
                            $('.alert_msgs').fadeIn().removeClass("failactionmsg").addClass("successactionmsg").html("Itinery Deleted Successfully").delay(5000).fadeOut();
                            $("#tablereload").load(" #tablereload");    setTimeout(function(){ loaddatatable();}, 500);
                        } else {
                            $('.alert_msgs').fadeIn().removeClass("successactionmsg").addClass("failactionmsg").html("Error..").delay(5000).fadeOut();
                        }
                    }
                });
            }
        }
    }

    function edit(id,pincode,shipping,chargesper,chargesunit,delivery=0){
      $("#idedit").val(id);$("#pinedit").val(pincode);$("#chargedit").val(shipping);  $("#chargesPerEdit").val(chargesper); $('#chargesUnitEdit option').attr("selected",false);    $('#chargesUnitEdit option[value="' + chargesunit + '"]').attr("selected",true);   $('#deliveryEdit option[value="' + delivery + '"]').attr("selected",true);
      $("#editpop").modal("show");
    }
    function updateship(){
        id=$("#idedit").val();pincode=$("#pinedit").val();shipping=$("#chargedit").val();  shippingPer=$("#chargesPerEdit").val(); shippingUnit=$("#chargesUnitEdit option:selected").val();  delivery=$("#deliveryEdit option:selected").val();
        if(shipping==""||(shipping!=""&&!isNaN(shipping))){
          var info = {id:id,pincode: pincode, shipping: shipping, shippingPer:shippingPer,shippingUnit:shippingUnit,delivery:delivery,action:'update_pincode'};
            $.ajax({
                type: "POST",
                url: "ajax_hyperlocal.php",
                data: info,
                success: function(response){
                    if (response == 1){
                        $('.alert_msgs').fadeIn().removeClass("failactionmsg").addClass("successactionmsg").html("Pincode Data Updated").delay(3000).fadeOut();
                        $("#tablereload").load(" #tablereload");  $("#editpop").modal("hide");     setTimeout(function(){ loaddatatable();}, 500);
                    }else{
                        $('.alert_msgs').fadeIn().removeClass("successactionmsg").addClass("failactionmsg").html("Error").delay(5000).fadeOut();
                    }

                }
            });
        }
    }

    function exportdata(){
        var info = {action:'export'};
          $.ajax({
                type: "POST",
                url: "ajax_hyperlocal.php",
                data: info,
                success: function(response){
                  var $a = $("<a>");
                    $a.attr("href",response);
                    $("body").append($a);
                    $a.attr("download",response);
                    $a[0].click();
                    $a.remove();

                }
            });
    }

     function importfile(){
      $("#importpop").modal("show");
    }

    function importnow(){
    if($('#filein').val()!=""){
        $("#importBtn").attr("disabled",true).html("Importing Data...");
        var attachment = $('#filein').prop('files')[0];
        var attachmenttype = ($('#filein'))[0].files[0].type;
        var form_data1 = new FormData();
        form_data1.append('attachment', attachment);
        form_data1.append('action', "importdata");
        $.ajax({
            type:"POST",
            url:"ajax_hyperlocal.php",
            data:form_data1,
            cache: false,
            contentType: false,
            processData: false,
            success:function(response){
                $("#importBtn").attr("disabled",false).html("Import Data");
                if(response==1){
                    $('.alert_msgs').fadeIn().removeClass("failactionmsg").addClass("successactionmsg").html("Data Uploaded Successfully").delay(10000).fadeOut();
                    $("#tablereload").load(" #tablereload"); $("#filein").val("");     $("#importpop").modal("hide");     setTimeout(function(){ loaddatatable();}, 500);
                }else{
                    $("#filein").val("");     $('.alert_msgs').fadeIn().removeClass("successactionmsg").addClass("failactionmsg").html(response).delay(10000).fadeOut();
                }
            }
        });
    }
}
</script>
</body>
</html>