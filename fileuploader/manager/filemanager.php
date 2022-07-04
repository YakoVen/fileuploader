<?php


$target_dir = "../user/0/files/"; // مسار حفظ الملفات ...


// استقبال الملفات
if (isset($_POST["file_name"])  && isset($_POST["submit"])) // الأمر لا يشتغل الا اذا كان يوجد البيانات اللازمة في الطلب 
{



    if (!file_exists($target_dir))
        mkdir($target_dir, 0777, true);
    $can_be_uploaded = 1; //الملف قابل للرفع
    $FILE_TYPE =  strtolower(pathinfo($target_dir . basename($_FILES["file"]["name"]), PATHINFO_EXTENSION)); // تحديد نوع الملف
    $file_path = $target_dir . $_POST["file_name"] . "." . $FILE_TYPE; //  مسار الملف المرفوع

    //  تأكد أن الملف لم يسبق أن رفع بنفس الاسم
    if (file_exists($file_path)) {
        echo "أسف الملف موجود سابقا";
        $can_be_uploaded = 0;
    }

    // تحديد الحجم الأكبر للملف المرفوع
    if ($_FILES["file"]["size"] > 500000) {
        echo "الملف كبير جدا";
        $can_be_uploaded = 0;
    }

    // تحديد صيغة الملفات
    if ($FILE_TYPE != "jpg" && $FILE_TYPE != "png" && $FILE_TYPE != "jpeg"    && $FILE_TYPE != "gif" && $FILE_TYPE != "pdf") {
        echo "الصيغة غير مسموحة" . $FILE_TYPE;
        $can_be_uploaded = 0;
    }

    // can_be_uploaded ارفع اذا كان الأمر مسموح 
    if ($can_be_uploaded == 0) { // غير مسموح
        echo "لا يمكن الرفع";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
            echo "تم رفع  " . htmlspecialchars(basename($_FILES["file"]["name"]));
            header("location: ../ ");
        } else {
            echo "حصل خطأ أثناء الرفع";
        }
    }
}



class FileInfos
{
    public $name;
    public $size;
    public $upload_day;
    public $type;
    public $d_link;
}





if (isset($_POST["listing"])) {

    $list = array();
    foreach (scandir($target_dir) as $filename) {
        if (!is_dir($target_dir . $filename)) {
            $file = new FileInfos();
            $file->name = $filename;
            $file->size = filesize($target_dir . $filename)/1000000 ." mb";
            $file->type = filetype($target_dir . $filename);
            $file->upload_day = date("F d Y H:i:s.",  filectime($target_dir . $filename));
            $file->d_link = str_replace($target_dir . $filename,"..","");
            array_push($list, $file);
        }
    }
    echo json_encode($list);
}
