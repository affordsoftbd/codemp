<?php

try {

	$targetFolder = '/home/mamuhin/public_html/amar_neta/storage/app/public';

	$linkFolder = '/home/mamuhin/public_html/amar_neta/public/storage';

	symlink($targetFolder, $linkFolder);

	echo 'Done!';
}
catch (\Exception $e) {
    return $e->getMessage();
}