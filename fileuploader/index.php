<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>رفع الملفات</title>
</head>

<body>

    <h1 class="main-title">رفع الملفات</h1>
    <div class="container">
        <div id="list" class="file-list">
            <h2> الملفات المرفوعة</h2>
        </div>
        <div class="file-management">
            <div>
                الاسم:  <div id="file-name"></div>
                <br>
               الحجم:  <div id="file-size"></div>
               <br>
               نوع الملف: <div id="file-type"></div>
               <br>
              تاريخ الرفع:  <div id="file-upload"></div>
              <br>
               الرابط: <a  id="file-url"></a>

            </div>
            <div class="manager">
                <form action="manager/filemanager.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="file_name" id="file-name">
                    <input type="file" name="file" id="file">
                    <input type="submit" name="submit" value="رفع">
                </form>
            </div>
        </div>
    </div>
    <script src="filemanager.js"></script>
</body>

</html>