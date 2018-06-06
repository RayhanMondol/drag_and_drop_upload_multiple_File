<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Drag and Drop upload and Delete multiple File by using PHP Ajax  JQuery</title>
<!-- css files-->
<link rel="stylesheet" type="text/css" href="../lib/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../lib/propeller.min.css">
<link rel="stylesheet" type="text/css" href=".././lib/main.css">
<style type="text/css">
.multi_img_upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
.allImgView{
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  margin-top: 30px;
  position: relative;
}
.imgView{
  flex-basis: 90%;
  margin: 10px;
  position: relative;
overflow: hidden;

}
.drop_div_style{
 border: 2px dashed #e93951;
   
}
.drop_div_over_style{
border: 2px dashed #54ea36;;
}
.drop_div{
  width: 70%;
  height: 200px;
  background-color: #fef9fc;
  text-align: center;
  margin: 0px auto;
}
.drop-help-text{
  line-height: 200px;
  color: #ce2e2e;
  font-size: 20px;
  font-weight: bold;
}
  @media only screen and (min-width: 762px){
  .imgView{
  flex-basis: 200px;
   }
}
</style>
</head>
<body>
<div class="wrapper pmd-z-depth ">
<h1 style="text-align: center;padding: 20px;font-weight: bold;">Drag and Drop upload and Delete multiple File by using PHP Ajax  JQuery</h1>

<div class="drop_div drop_div_style">
  <div class="drop-help-text">File Drop Here...</div>
</div>
<div id="allImgView" class="allImgView">
  
</div>
</div>

</div>
<!-- JS  files-->
<script src="../lib/jquery.min.js"></script>
<script src="../lib/bootstrap.min.js"></script>
<script src="../lib/propeller.min.js"></script>
<script type="text/javascript" src="../lib/sweetalert.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

  // Load Files
  loadFils();
  function loadFils(){
    var action = "loadFiles";
    $.ajax({
      url:"action_upload.php",
      method:"POST",
      data:{action:action},
      success:function(data){
        $("#allImgView").html(data);
      }
    })
  }

  $(document).on("click","#deleteFile",function(e){
    e.preventDefault();

   swal({
    title:"Are you sure delete this?",
    icon:"warning",
    buttons:true,
    dangerMode:true,
   }).then((ifDeleted)=>{
    if (ifDeleted) {
        var filePath =  $(this).attr("data-deleteFile");
   var action ="deleteFils";
   $.ajax({
    url:"action_upload.php",
    method:"POST",
    data:{filePath:filePath,action:action},
    success:function(data){
        loadFils();
      swal({
        title:"File Deleted successfull",
        icon:"success"
      })
    }
   });
    }else{
      return false;
    }
   })
  });
 $(document).on("dragover",".drop_div",function(e){
  e.preventDefault();
  $(this).addClass('drop_div_over_style');
 });
 $(document).on("dragleave",".drop_div",function(e){
  e.preventDefault();
  $(this).removeClass('drop_div_over_style');
 });

 $(document).on("drop",".drop_div",function(e){
  e.preventDefault();
  $(this).removeClass('drop_div_over_style');
  var action = "upload";
    var formObj =  new FormData();
   var getFiles =  e.originalEvent.dataTransfer.files;
   for(var i=0;i < getFiles.length;i++){
    formObj.append("files[]",getFiles[i]);
   }

   $.ajax({
    url:"action_upload.php",
    method:"POST",
    data:formObj,
    contentType:false,
    processData:false,
    cache:false,
    success:function(data){
        loadFils();
      swal({
        title:"File uploaded successfull",
        icon:"success"
      });
    }
   })
 });

 });
</script>
</body>

</html>