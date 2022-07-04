var files;

function showData(i) {
    let file_name = document.getElementById("file-name"); // الحصول  على عنصر اسم الملف
    let file_size = document.getElementById("file-size"); // الحصول على عنصر حجم الملف
    let file_type = document.getElementById("file-type"); // الحصول على عنصر صيغة الملف
    let file_upload = document.getElementById("file-upload"); // الحصول على وقت الرفع
    let file_url = document.getElementById("file-url"); // الحصول على وقت الرفع

    //تغيير نص العنصر حسب المعلومات في الملف .
    file_name.innerText = files[i].name;
    file_size.innerText = files[i].size;
    file_type.innerText = files[i].type;
    file_upload.innerText = files[i].upload_day;
    file_url.innerText = files[i].d_link;

}

function list_files() {
    let list_div = document.getElementById("list"); // الحصول على عنصر القائمة

    for (let i = 0; i < files.length; i++) {
        const element = files[i];
        const node = document.createElement("div"); //انشاء العنصر الجديد
        node.innerText = files[i].name; //تغيير النص الذي داخل العنصر
        node.addEventListener("click", function() { showData(i); }); // اضافة onclick event
        list_div.append(node); // اضافة العنصر الجديد الى عنصر القائمة
    }
}

function retreive_files() {
    let xhr = new XMLHttpRequest(); // انشاء طلب ajax
    xhr.open('POST', "manager/filemanager.php");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            files = JSON.parse(xhr.response);
            list_files();
        }
    }
    let fd = new FormData();
    fd.append("listing", true);
    xhr.send(fd);
}

retreive_files();