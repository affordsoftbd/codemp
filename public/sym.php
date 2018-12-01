<?php

try {

	$targetFolder = '/home/amarneta/amar_neta/storage/app/public';

	$linkFolder = '/home/amarneta/public_html/storage';

	$sym = symlink($targetFolder, $linkFolder);

	if($sym){
		echo 'Done!';
	}
	else{
		echo "failed!";
	}
}
catch (\Exception $e) {
    return $e->getMessage();
}