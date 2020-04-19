<?php
//product_edit
if(!empty($_FILES['image']['name'])){

        move_uploaded_file($_FILES['image']['tmp_name'],"images/".$_FILES['image']['name']);
        //salvare nume de fisier in baza de date
}
?>
<html>
<body>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit"/>
</form>

</body>
</html>