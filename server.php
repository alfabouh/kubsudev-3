<?php
    $data = $_POST;

    $name = $data['name'];
    $mobile = $data['mobile'];
    $mail = $data['mail'];
    $bdate = $data['bdate'];
    $bio = $data['bio'];
    $gen = $data['gen'];
    $lang = $data['lang'];

    if (empty(trim($name)) || !preg_match('/^[a-zA-Zа-яА-Я\s]+$/', $name)) {
        http_response_code(400);
        print_r("Неправильно заполнено ФИО");
        exit;
    }

    if (empty(trim($mobile)) || !ctype_digit($mobile)) {
        http_response_code(400);
        print_r("Неправильно заполнен телефон");
        exit;
    }
    
    if (empty(trim($mail))) {
        http_response_code(400);
        print_r("Неправильно заполнена почта");
        exit;
    }
    
    if (empty(trim($bdate))) {
        http_response_code(400);
        print_r("Неправильно заполнена дата рождения");
        exit;
    }
    
    if (empty(trim($gen))) {
        http_response_code(400);
        print_r("Неправильно заполнен пол");
        exit;
    }

    if (empty(trim($lang))) {
        http_response_code(400);
        print_r("Неправильно заполнен любимый ЯП");
        exit;
    }

    print_r($data);
    sentToDB($name, $mobile, $mail, $bdate, $bio, $gen, $lang);
    
    function sentToDB($name, $mobile, $mail, $bdate, $bio, $gen, $lang) {
        $db = new PDO('mysql:host=localhost;dbname=u67290', 'u67290', '8654116', [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $sql = 'INSERT INTO users (name, mobile, mail, bdate, bio, gen) VALUES (:name, :mobile, :mail, :bdate, :bio, :gen)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':bdate', $bdate);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':gen', $gen);
        $stmt->execute();

        $sql = 'INSERT INTO users_lang (lang) VALUES (:lang)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':lang', $lang);
        $stmt->execute();

        print_r('DB sent');
    }
?>