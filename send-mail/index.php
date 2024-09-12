<?

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'Exception.php';
	require 'PHPMailer.php';
	require 'SMTP.php';

	$errors = [];
	$errorMessage = '';

	$fio    	= stripslashes(trim($_POST['fio']));
	$phone   	= stripslashes(trim($_POST['phone']));
	$email_user 		= stripslashes(trim($_POST['email'])) ?? '';
	$address 	= stripslashes(trim($_POST['address']));

    if (empty($fio)) {
        $errors[] = 'fio is empty';
    }

    if (empty($phone)) {
        $errors[] = 'phone is empty';
    }

    if (empty($address)) {
        $errors[] = 'address is empty';
    }

	$email = "noreply@mail.ru";

    if (empty($errors)) {
        $mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'sreda@sreda.guru';                 // SMTP username
		$mail->Password = 'Suv34660';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->CharSet = 'UTF-8';
		$mail->IsHTML(true);  
		$mail->setFrom('sreda@sreda.guru');
		$mail->addAddress('info@sreda.guru');     // Add a recipient
		$mail->addAddress('natalya.vaschenko@sreda.guru');               // Name is optional
		$mail->addAddress('arthur.makarov@sreda.guru');               // Name is optional
		$mail->addAddress('alexander.polezhaev@sreda.guru');               // Name is optional
		$mail->addAddress('alexander.krysin@sreda.guru');               // Name is optional

		$mail->Subject = 'данные из формы';
		$mail->Body     = "<html><body>
		<p><b>ФИО: </b> ".$fio."</p>
		<p><b>Телефон: </b> ".$phone."</p>
		<p><b>Email: </b> ".$email_user."</p>
		<p><b>Адрес: </b> ".$address."</p>
		</body></html>";

		if(!$mail->send()) {
            $errorMessage = $mail->ErrorInfo;
		} else {
		    echo 'Ваша заявка принята! Менеджер свяжется с вами и согласует дату доставки';
		}
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }

?>
