<?php
$data = json_decode(file_get_contents('php://input'));

$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $data->text . '<p>Телефон: ' . $data->phone . '</p><p>Email: ' . $data->email);
$modx->mail->set(modMail::MAIL_FROM, $data->email);
$modx->mail->set(modMail::MAIL_FROM_NAME, $data->fio);
$modx->mail->set(modMail::MAIL_SUBJECT, 'Новое сообщение с сайта protsvetnoy.com!');
$modx->mail->address('to','info@protsvetnoy.com');
$modx->mail->setHTML(true);
if (!$modx->mail->send()) {
    $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$modx->mail->mailer->ErrorInfo);
    return json_encode(array("error" => 'Ошибка отрправки сообщения! Вы можете связаться с нами по телефону или попробовать позднее.'));
}
$modx->mail->reset();
return json_encode(array("message" => 'Ваше сообщение было отправленно! Мы обязательно ответим Вам.'));
?>