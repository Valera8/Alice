<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 08.04.2018
 * Time: 17:00
 */
/*Установка внутренней кодировки скрипта*/
//mb_internal_encoding("UTF-8");
if (!isset($_REQUEST)) return;
//Получаем и декодируем уведомление
$data = json_decode(file_get_contents('php://input'));
//Подготовливаем ответ Алисе
$answer = array(
    "response" => array(
        "text" => "",
        "tts" => "",
        "buttons" => array(
            "title" => "",
            "payload" => array(),
            "url" => "",
            "hide" => false,
        ),
    "end_session" => true,
    ),
    "session" => array(
        "session_id" => $data->session->session_id,
        "message_id" => $data->session->message_id,
        "user_id" => $data->session->user_id,
    ),
  "version" => $data->version,
);

if (($data->request->original_utterance == 'Алиса запусти работа в интернете') || ($data->request->original_utterance == 'Алиса запусти заработок в интернете'))
{
    $answer['response']['text'] = 'Здравствуйте! Вот хороший сайт об этом:';
    $answer['response']['tts'] = 'Здравствуйте! Вот хор+оший сайт об этом:';
    $answer['response']['buttons']['title'] = 'О заработке в интернете';
    $answer['response']['buttons']['url'] = 'https://dawork.ru/';

    echo json_encode($answer);
}
