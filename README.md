Bank Respublika interview-nun 2ci mərhələsində verilən Core PHP taskı.

Kod təkrarının qarşısını almaq üçün custom helper-lər yazmışam.
DataBase-ə connection edərkən mənimsətdiyim dəyişəni global dəyişən olaraq funksiyalara tanıtmışam və artıq hər dəfə sorğu yazanda db connection kodunu təkrar yazmaq
məcburiyyətində qalmıram.

Helper-lərdə olan funksiyalar və işlədilmə qaydası :
                  General.php
                  
1)alert(string $type, string $message); 
$type - mesajin tipi (məsələn : success, danger, warning)
$message - ekrana çıxarmaq istədiyiniz mesaj

2)uploadImage(string $target_dir, string $imageName, string $imageTmpName, int $imageSize);

$target_dir   - şəkili yükləmək istədiyiniz folder-in path-i (məsələn : 'images/blogs/')
$imageName    - $_FILES['fileToUpload']['name']
$imageTmpName - $_FILES['fileToUpload']['tmp_name']
$imageSize    - $_FILES['fileToUpload']['size']
Bu funksiya array return edir və arrayin key-ləri bunlardır : uploadOk, message. Əgər uploadOk 1 rəqəminə bərabərdirsə deməli fayl uğurla yüklənib, 0- dısa xəta baş verib.

3)card(string $image_path, string $image_alt = null, string $title = null, string $desc = null, string $link = null);
Bu funksiyadan istifadə edərək bootstrap-ın card-ını əldə edə bilərsiz.
$image_path - card-da olan şəkilin source(src) bölməsinə yazılır (daxil etməyiniz vacibdir.)
$image_alt  - card-da olan img teqinin alt elementinə yazılır
$title - card-ın başlıq hissəsinə yazılır
$desc - card-ın açıqlama hissəsinə yazılır
$link - card da əgər yönlədirmə butonu olacaqsa onda bu parametr-i daxil etməlisiniz. Bu parametr yönləndiriləcək səhifənin linkidi (Daha ətraflı bax butonuna click edəndə açılan səhifənin linki)

                Crud.php

1)create(string $table, array $cols ,array $values);
Bu funksiya database-ə data insert etmək üçün istifadə olunur.
$table - cədvəlin adı, string olaraq verməlisiniz
$cols  - insert etdiyiniz table-ın columnları siyahısı, array olaraq verməlisiniz
$values  - insert etmək istədiyiniz dataların siyahısı, array olaraq verməlisiniz

Verilən parametrlər query-də belə istifadə olunur :
INSERT INTO `$table` ($cols) VALUES ($values)

2)select(string $table, $cols = '*');
Bu funksiya table-dan istədiyiniz dataları götürmək üçün istifadə olunur.
$table - cədvəlin adı, string olaraq verməlisiniz
$cols - select etmək istədiyiniz column-ların siyahısı, array olaraq verməlisiniz (bu parametr-i qeyd etmək məcbur deyil)
Əgər $cols parametr-ini verməsəniz onda table-dan bütün dataları götürəcək.

Verilən parametrlər query-də belə istifadə olunur :
SELECT $cols FROM $table

$cols parametrini vermədikdə :
SELECT * FROM $table
