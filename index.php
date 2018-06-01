<?php
if (!isset($_REQUEST)) return;
//Получаем и декодируем уведомление
$data = json_decode(file_get_contents('php://input'));
//Подготовливаем ответ Алисе
$answer = array(
    "response" => array(
        "text" => "",
        "tts" => "",
        "buttons" => array(),
    "end_session" => false,
    ),
    "session" => array(
        "session_id" => $data->session->session_id,
        "message_id" => $data->session->message_id,
        "user_id" => $data->session->user_id,
    ),
  "version" => $data->version,
);

if (($data->request->original_utterance == 'Запусти навык как найти работу в интернете') || ($data->request->original_utterance == 'Запусти навык подобрать способ заработка в интернете') || ($data->request->original_utterance == 'Скажи проверенный сайт для заработка'))
{
    $answer['response']['text'] = 'Здравствуйте! Выберите чем Вы больше всего любите заниматся и что лучше всего умеете делать. \nНажмите на кнопку, или произнесети её название.';
    $answer['response']['tts'] = 'Здраствуйте! - Выберите чем Вы больше всего любите заниматся и что лучше всего умеете делать. - - Нажмите на кнопку, - или произнесети её название.';
    $answer['response']['buttons'] = array(
        array(
            'title' => 'писать',
            'payload' => array('opt' => 'write'),
        ),
        array(
        'title' => 'фотографировать',
        'payload' => array('opt' => 'photo'),
        ),
        array(
        'title' => 'больше',
        'payload' => array('opt' => 'more'),
        ),
    );
}
elseif ($data->request->payload->opt == 'write' || $data->request->original_utterance == 'писать')
{
    $answer['response']['text'] = 'Написание текстов – устойчивый заработок. \nОзнакомьтесь с описаниями бирж, получите ссылки.';
    $answer['response']['tts'] = 'Если вы умеете излагать свои мысли письменно, - не дайте проп+асть способностям д+аром!';
    $answer['response']['buttons'] = array(
        array(
            'title' => 'Биржа eTXT',
            'url' => 'https://dawork.ru/?view=article&id=3',
        ),
        array(
            'title' => 'Биржа TextSale',
            'url' => 'https://dawork.ru/?view=article&id=1',
        ),
        array(
            'title' => 'Биржа Адвего',
            'url' => 'https://dawork.ru/?view=article&id=2',
        ),
    );
}
elseif ($data->request->payload->opt == 'photo' || $data->request->original_utterance == 'фотографировать')
{
    $answer['response']['text'] = 'Фотография – обязательный элемент контента на сайте. \nОзнакомьтесь с описаниями фотостоков получите ссылки.';
    $answer['response']['tts'] = 'Если у вас есть ф+ото к+амера, - продавайте фотографии!';
    $answer['response']['buttons'] = array(
        array(
            'title' => 'Фотобанк Лори',
            'url' => 'https://dawork.ru/?view=article&id=6',
        ),
        array(
            'title' => 'Биржа eTXT',
            'url' => 'https://dawork.ru/?view=article&id=4',
        ),
        array(
            'title' => 'Фотобанк Отражение',
            'url' => 'https://dawork.ru/?view=article&id=11',
        ),
    );
}
elseif ($data->request->payload->opt == 'more' || $data->request->original_utterance == 'больше')
{
    $answer['response']['text'] = 'Фриланс, опросы, сёрфинг.  \nОзнакомьтесь с описаниями получите ссылки.';
    $answer['response']['tts'] = 'Фриланс, - опросы, - серфинг.';
    $answer['response']['buttons'] = array(
        array(
            'title' => 'Биржа Фриланса',
            'url' => 'https://dawork.ru/?view=section&id=9',
        ),
        array(
            'title' => 'Платный Опрос',
            'url' => 'https://dawork.ru/?view=article&id=7',
        ),
        array(
            'title' => 'Сёрфинг',
            'url' => 'https://dawork.ru/?view=article&id=8',
        ),
    );
}
elseif($data->request->original_utterance == 'помощь')
{
    $answer['response']['text'] = 'Справка. \nЦель диалога: предложить пользователю сделать выбор вида заработка в интернете по душе. \n1. Пользователь спрашивает у Алисы: "Запусти навык как найти работу в интернете", или "Запусти навык подобрать способ заработка в интернете", или "Скажи проверенный сайт для заработка". \n2. В ответ получает голосовое и текстовое сообщения сделать выбор вида деятельности из выведенных кнопок путем нажатия кнопки, или голосом. \n3. В результате появляются кнопки для выбора подробных описаний с ссылками на проверенные ресурсы для заработка в интернете. \n4. После нажатия кнопки открывается ресурс в интернете. Сессия диалога заканчивается.';
}
else
{
    $answer['response']['text'] = 'Здравствуйте! Я ещё только учусь! \nВам поможет этот сайт!';
    $answer['response']['tts'] = 'Здравствуйте! - - Вот хороший сайт о доходах:';
    $answer['response']['buttons'][] = array(
        'title' => 'Заработок в интернете',
        'url' => 'https://dawork.ru/',
    );
    $answer['end_session'] = true;
}

header('Content-Type: application/json');
echo json_encode($answer);
