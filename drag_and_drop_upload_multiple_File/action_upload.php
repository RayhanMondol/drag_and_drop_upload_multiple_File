<?php 
	$result = '';
	if (isset($_FILES['files']['name'][0])) {
		foreach ($_FILES['files']['name'] as $file => $value) {
			$name_ext = explode('.', $_FILES['files']['name'][$file]);
			$newFileName =  substr(rand(), 0,6).'.'.$name_ext[1];
			$filesDestination = "upload/".$newFileName;
			move_uploaded_file($_FILES['files']['tmp_name'][$file], $filesDestination);

		}
	}

	if (isset($_POST['action'])) {
		if ($_POST['action']=="loadFiles") {
			$getfile = glob("upload/*.*");

			foreach ($getfile as $file) {
				$result .= ' <div id="imgView"  class="imgView">
			    <img style="width: 200px;height: 135px;display: block;" src="'.$file.'">
			    <button id="deleteFile" data-deleteFile="'.$file.'"  style="color:#111d11;font-size:60px;position: absolute;text-align: center;top: -6px;margin-left: 80%;color: #fff;font-weight:bold" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>';
			}

			echo $result;
		}

		if ($_POST['action']=="deleteFils") {
			unlink($_POST['filePath']);
		}
	}

?>