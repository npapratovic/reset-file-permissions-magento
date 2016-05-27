<?php 

/**
 * Reseting file and folder permissions for magento
 *
 * @version    1.0.0
 * @author     Nikola Papratović <nikola.papratovic@gmail.com> 
 * @copyright  Copyright (c) 2016 Nikola Papratović 
 * @link       nikolapapratovic.iz.hr
 *
 * Instructions: place the following script inside the root direcotory of your magento and open in browser:
 *
 * http://yourwebsite.com/reset-file-permissions.php
 *
 */

$start_dir = '/'; // Starting directory name no trailing slashes. 
$perms['file'] = 0644; // chmod value for files don't enclose value in quotes. 
$perms['folder'] = 0755; // chmod value for folders don't enclose value in quotes. 

function chmod_file_folder($dir) { 
    global $perms; 
             
    $dh=@opendir($dir); 
     
    if ($dh) { 
         
        while (false !==($file = readdir($dh))) { 
             
            if($file != "." && $file != "..") { 
                 
                $fullpath = $dir .'/'. $file; 
                if(!is_dir($fullpath)) { 
                     
                    chmod($fullpath, $perms['file']); 
                }else { 
                    chmod($fullpath, $perms['folder']); 
                    chmod_file_folder($fullpath); 
                } 
            } 
        } 
        closedir($dh); 
    } 
} 

chmod_file_folder($start_dir); 

?>