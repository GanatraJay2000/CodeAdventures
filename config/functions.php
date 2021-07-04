<?php
function sp($no=1){
    $no++;
    for($i=0;$i<$no;$i++){
        echo "<br>";
    }
}

function print_this($arr, $no=1, $attr="all")
{
    ksort($arr);
    foreach ($arr as $key=>$a) {
        print_r($key);
        print_r(" ==> ");
        if($attr !== "all"){print_r($a[$attr]);}
        else{print_r($a);}
        for($i=0;$i<$no;$i++){
            echo "<br>";
        }
    }
}

function getAttrArray($arr, $attr, $removeDuplicates=false){
    $attrArr = [];
    foreach($arr as $key=>$a){        
        array_push($attrArr, $a[$attr]);
    }
    if($removeDuplicates){
        $attrArr = array_values(array_unique($attrArr));
    }
    return $attrArr;
}


function getBindString($ch){
    $type = gettype($ch)[0];
    if($type !== 's' && $type !== 'i' && $type !== 'd') $type='s';
    return $type;
}


function getNumAccess($access_level){
    $access = 0;
    switch($access_level){
        case "super-admin":
            $access=3;
            break;
        case "admin":
            $access=2;
            break;
        case "user":
            $access=1;
            break;
        default:
            $access=0;
    }
    return $access;
}

function uploadFile($base_dir, $file){
    $error="";
    $extension=array("jpeg","jpg","png","pdf", "pptx", "docx", "xlsx", "svg");

    $file_name=$file["name"];
    $file_tmp=$file["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    $outputFile = $base_dir."/{$file_name}";
    $filetobeSaved = ltrim($outputFile, $outputFile[0]);       
    
    if(in_array($ext,$extension)) {
        if(!file_exists($outputFile)) {
            if(!move_uploaded_file($file_tmp=$file["tmp_name"],$outputFile)){
                $error = "Failed to upload File";
            }
        }            
    }
    else {
        $error = "Failed to upload File";
    }

    if(strlen($error) > 0){
        return $error;
    }
}




function merge_sort($my_array){
	if(count($my_array) == 1 ) return $my_array;
	$mid = count($my_array) / 2;
    $left = array_slice($my_array, 0, $mid);
    $right = array_slice($my_array, $mid);
	$left = merge_sort($left);
	$right = merge_sort($right);
	return merge($left, $right);
}
function merge($left, $right){
	$res = array();
	while (count($left) > 0 && count($right) > 0){
		if(($left[0]['student']->gpa > $right[0]['student']->gpa) && ($left[0]['student']->gpa !== $right[0]['student']->gpa)){
			$res[] = $right[0];
			$right = array_slice($right , 1);
		}else if(($left[0]['student']->total > $right[0]['student']->total) && ($left[0]['student']->gpa === $right[0]['student']->gpa)){
			$res[] = $right[0];
			$right = array_slice($right , 1);
		}else{
			$res[] = $left[0];
			$left = array_slice($left, 1);
		}
	}
	while (count($left) > 0){
		$res[] = $left[0];
		$left = array_slice($left, 1);
	}
	while (count($right) > 0){
		$res[] = $right[0];
		$right = array_slice($right, 1);
	}
	return $res;
}


function uploadImage($id, $file, $basePath){
    try{
        $info = pathinfo($file['name']);        
        $ext = $info['extension'] ?? "";
        $newname = $id . rand(999,99999) . '.' . $ext;
        $target = $basePath . $newname;
        move_uploaded_file($file['tmp_name'], $target);
        $url='external_signature/' . $newname;
    }catch(Exception $e){
        return [false, $e->getMessage()];
    }
    return [true, $url];
}