<?php
require_once 'db/connect.php';
require_once 'db/security.php';

//Ist gegeben, dass eine neue Seite hinzugefügt werden soll?
if (isset($_POST['name1'])){
    $send = array(1=>false, 2=>false, 3=>false, 4=>false, 5=>false);
    
    //Pruefen ob alle Variablen einen Wert haben
    for ($i=1; $i<6; $i++){
        if ($_POST['name'.$i] != "" && $_POST['url'.$i] != "" && $_POST['icon'.$i] != "" && $_POST['category'.$i] != ""){
            $send[$i] = true;
        }
    }

    //Wenn alle Variablen einen Wert haben, in die Datenbank einfügen
    for ($i=1; $i<6; $i++){
        if ($send[$i] == true){
            $name = escape($_POST['name'.$i]); $url = escape($_POST['url'.$i]);
            $icon = escape($_POST['icon'.$i]); $cat = escape($_POST['category'.$i]);
            $insert = $sqli->prepare("INSERT INTO pages (name, url, icon, category) VALUES (?, ?, ?, ?)");
            $insert->bind_param('ssss', $name, $url, $icon, $cat);

            if ($insert->execute()){
                header('Location: index.php');
                die();
            }
        }
    }

}

//Soll ein wert gelöscht werden?
if (isset($_POST['toRemove'])){
    if (isset($_POST['password']) && val_pw_ret_sha1($_POST['password'])['valid'] == true){
        $pw = val_pw_ret_sha1($_POST['password'])['pw'];
        if ($pw == val_pw_ret_sha1('startpage')['pw']){
            $sql = "DELETE FROM pages WHERE name='".$_POST['toRemove']."'";
            if($sqli->query($sql) === TRUE) {
                echo 'Entry successfully removed.';
            } else {
                echo 'Error removing entry.';
            }
        } else {
            echo 'Error removing entry.';
        }
    } else {
        echo 'Error removing entry.';
    }
}
?>

<html>
<head>
    <title>Startpage</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
    <header class="boxshadow">
        Welcome to my custom startpage
    </header>

    <section id="pages">

    </section>

    <section id="control" class="boxshadow">
        <button id="addPage" onclick="addLinks()">Add Page</button>
        <button id="removePage" onclick="removeLinks()">Remove Page</button>
        <form class="addLinks" method="POST" action="index.php">
            <table>
                <thead>
                    <tr><td>Name</td><td>Url</td><td>Icon</td><td>Category</td></tr>
                </thead>
                <tbody>
                    <tr id="add1">
                        <td><input type="text" name="name1" class="name"></td>
                        <td><input type="text" name="url1" class="url"></td>
                        <td><input type="text" name="icon1" class="icon"></td>
                        <td><input type="text" name="category1" class="category"></td>
                    </tr>
                    <tr id="add2">
                        <td><input type="text" name="name2" class="name"></td>
                        <td><input type="text" name="url2" class="url"></td>
                        <td><input type="text" name="icon2" class="icon"></td>
                        <td><input type="text" name="category2" class="category"></td>
                    </tr>
                    <tr id="add3">
                        <td><input type="text" name="name3" class="name"></td>
                        <td><input type="text" name="url3" class="url"></td>
                        <td><input type="text" name="icon3" class="icon"></td>
                        <td><input type="text" name="category3" class="category"></td>
                    </tr>
                    <tr id="add4">
                        <td><input type="text" name="name4" class="name"></td>
                        <td><input type="text" name="url4" class="url"></td>
                        <td><input type="text" name="icon4" class="icon"></td>
                        <td><input type="text" name="category4" class="category"></td>
                    </tr>
                    <tr id="add5">
                        <td><input type="text" name="name5" class="name"></td>
                        <td><input type="text" name="url5" class="url"></td>
                        <td><input type="text" name="icon5" class="icon"></td>
                        <td><input type="text" name="category5" class="category"></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Confirm">
        </form>
        <form class="removeLinks" id="removeLink" method="POST" action="index.php">
            <input type="hidden" id="toRemove" name="toRemove" value="default">
            <input type="submit" value="Confirm"><input type="password" id="password" name="password">
        </form>
    </section>

<script src="db/javascript.js"></script>
<script src="db/jquery-3.1.0.min.js"></script>
<script>
    $(document).ready(buildPage());
</script>

</body>
</html>