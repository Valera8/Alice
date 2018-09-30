<?php
if (!isset($_REQUEST)) return;
//Получаем и декодируем уведомление
$dataRow = file_get_contents('php://input');
$data = json_decode($dataRow);
//Подготовливаем ответ Алисе
if ($data->request->original_utterance == "" && $data->session->message_id == 0)
{
    $answer = array(
        "response" => array(
            "text" => "Навык \"Заработок в интернете - финансово-выгодный\" \nНабери, или произнеси одну из активационных фраз: \nЗапусти навык выбор заработка в интернете \nСкажи проверенный сайт для заработка",
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
}
else
{
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
    $orig = $data->request->original_utterance;
    $opt = $data->request->payload->opt;
    $orig = trim($orig);
    $orig = strtolower($orig);
    if ($orig == 'запусти навык выбор заработка в интернете' || $orig == 'Запусти навык выбор заработка в интернете')
    {
        $answer['response']['text'] = 'Добро пожаловать! Выбери: чем больше всего любишь заниматься и что лучше всего умеешь делать.';
        $answer['response']['tts'] = 'Добро пожаловать! Выбери: - чем больше всего любишь заниматься и что лучше всего умеешь делать. - Нажми на кнопку, или произнеси её название.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'писАть',
                'payload' => array('opt' => 'write'),
            ),
            array(
                'title' => 'фотографировать',
                'payload' => array('opt' => 'photo'),
            ),
            array(
                'title' => 'другой выбор',
                'payload' => array('opt' => 'more'),
            ),
        );
    }
    elseif ($opt == 'write' || $orig == 'писать')
    {
        $answer['response']['text'] = 'Если умеешь излагать свои мысли письменно, получи ссылки с описаниями бирж. \n"eTXT" произносится как "е т икс т", "TextSale" произносится как "текст саль"';
        $answer['response']['tts'] = 'Если умеешь излагать свои мысли письменно, - не дай проп+асть способностям д+аром!';
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
    elseif ($orig == 'биржа е т икс т')
    {
        $answer['response']['text'] = 'Биржа eTXT';
        $answer['response']['tts'] = 'Интернет-ресурс для специалистов копирайтинга, рерайтинга, перевода текстов. Если нет опыта, ресурс бесплатно научит пис+ать правильные тексты. - Заработок зависит от вида и сложности работы и составляет в среднем - 20, - 50 рублей за 1000 символов.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Переход на сайт',
                'url' => 'https://www.etxt.ru/?r=vgoru',
            )
        );
    }
    elseif ($orig == 'биржа текст саль')
    {
        $answer['response']['text'] = 'Биржа TextSale';
        $answer['response']['tts'] = 'Супермаркет уникального контента. Предоставляет удаленную работу копирайтерам, журналистам, переводчикам. Величина заработка зависит от мастерства. Установлена минимальная цена - 100 рублей за 1000 знаков качественного копирайта.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Переход на сайт',
                'url' => 'https://www.textsale.ru/team98295.html',
            )
        );
    }
    elseif ($orig == 'биржа адвего')
    {
        $answer['response']['text'] = 'Биржа Адвего';
        $answer['response']['tts'] = 'Заработок путем напис+ания текстов на заказ, продажи готовых статей, выполнения переводов, участия в опросах и голосованиях, предоставления консультаций. Работу можно найти в любое время дня и ночи как опытному копирайтеру, так и начинающему пис+ать. Минимальная цена за 1000 символов статьи копирайтинга - 0,35 $, или 25 рублей.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Переход на сайт',
                'url' => 'http://advego.ru/9R3Jt7KsxB',
            )
        );
    }
    elseif ($opt == 'photo' || $orig == 'фотографировать')
    {
        $answer['response']['text'] = 'Продавай фотографии на фотостоках!';
        $answer['response']['tts'] = 'Если есть ф+ото к+амера, или гаджет с сильной камерой - продавай фотографии!';
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
    elseif ($orig == 'фотобанк лори')
    {
        $answer['response']['text'] = 'Фотобанк Лори';
        $answer['response']['tts'] = 'Заработок в Интернете фотографам, дизайнерам, операторам. Это площадка для продажи своих авторских картинок, видеофайлов. Самый маленький доход автора – 45 рублей за фото размером 816 на 612 пикселей для стандартной лицензии и самый большой – 3600 рублей за фото для наружной рекламы';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Переход на сайт',
                'url' => 'https://lori.ru/?ref=42279',
            )
        );
    }
    elseif ($orig == 'биржа е т икс т')
    {
        $answer['response']['text'] = 'Биржа eTXT';
        $answer['response']['tts'] = 'Позволяет увеличить достаток на продаже своих фотографий. Обязательное условие – фотография должна быть авторская, и после продажи автор теряет все права на неё. Стоимость фотографии назначает автор. Хочешь – продавай за 5 рублей, а хочешь – за 1000 рублей - и больше! Лишь бы покупали!';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Переход на сайт',
                'url' => 'https://www.etxt.ru/?r=vgoru',
            )
        );
    }
    elseif ($orig == 'фотобанк отражение')
    {
        $answer['response']['text'] = 'Фотобанк Отражение';
        $answer['response']['tts'] = 'Площадка для общения любителей фотографии, а также для получения дохода от продажи своих авторских фотографий. Работает по лицензии Роялти-Фри. Самая маленькая стоимость фото – 20 рублей, самая большая – 1999 рублей.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Переход на сайт',
                'url' => 'https://ergofoto.ru?ref=990',
            )
        );
    }
    elseif ($opt == 'more' || $orig == 'другой выбор')
    {
        $answer['response']['text'] = 'Фриланс, опросы, сёрфинг. Нажми на кнопку.';
        $answer['response']['tts'] = 'Пожалуйста, - фриланс, - опросы, - сёрфинг! Выбор сделай нажатием на кнопку.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Биржа Фриланса',
                'url' => 'https://dawork.ru/?view=article&id=9',
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
    elseif ($orig == 'Скажи проверенный сайт для заработка' || $orig == 'скажи проверенный сайт для заработка')
    {
        $answer['response']['text'] = 'Выбирай:';
        $answer['response']['tts'] = 'Выбирай и жми на кнопку: - биржа фриланса - fl.ru, - - платный опрос - platnijopros.ru, - - сёрфинг - web-ip.ru.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'Биржа Фриланса fl.ru',
                'url' => 'https://www.fl.ru/?ref=57809',
            ),
            array(
                'title' => 'Платный Опрос platnijopros.ru',
                'url' => 'https://www.platnijopros.ru/ru/Users/Registration/Referal/552337',
            ),
            array(
                'title' => 'Сёрфинг по сайтам web-ip.ru',
                'url' => 'https://www.web-ip.ru/index.php?reflog=moisey',
            ),
        );
    }
    elseif($orig == 'помощь' || $opt == 'help')
    {
        $answer['response']['text'] = 'Цель диалога: предложить пользователю сделать выбор вида заработка в интернете по душе. \n1. Пользователь спрашивает у Алисы: "Запусти навык выбор заработка в интернете", или "Запусти навык подобрать работу в интернете". \n2. В ответ получает голосовое и текстовое сообщения сделать выбор путем нажатия кнопки, или голосом. \n3. В результате появляются кнопки для выбора подробных описаний заработков с ссылками на проверенные ресурсы для заработка в интернете. \nЗдесь опять выбор можно сделать голосом. \n4. После нажатия кнопки открывается ресурс в интернете. \n5. Если пользователь спрашивает у Алисы: "Скажи проверенный сайт для заработка", то предлагается выбрать кнопкой переход на соответсвующий ресурс для фриланса, опросов, сёрфинга.';
        $answer['response']['tts'] = 'Цель диалога: предложить пользователю сделать в+ыбор вида з+аработка в интернете по душ+е. Пользователь спрашивает у Алисы: "Запусти н+авык выбор з+аработка в интернете", или - "Запусти н+авык подобрать работу в интернете". - В ответ получает голосов+ое и текстов+ое сообщения сделать в+ыбор - путем нажатия кнопки, или голосом. - В результате появляются кнопки для в+ыбора подробных описаний з+аработков с ссылками на проверенные ресурсы для з+аработка в интернете. - Здесь опять в+ыбор можно сделать голосом. - - После нажатия кнопки открывается ресурс в интернете. - Если пользователь спрашивает у Алисы: - "Скажи проверенный сайт для з+аработка", то предлагается в+ыбрать кнопкой переход на соответсвующий ресурс для - фриланса, - опросов, - сёрфинга.';
        $answer['response']['buttons'] = array(
            array(
                'title' => 'писАть',
                'payload' => array('opt' => 'write'),
            ),
            array(
                'title' => 'фотографировать',
                'payload' => array('opt' => 'photo'),
            ),
            array(
                'title' => 'другой выбор',
                'payload' => array('opt' => 'more'),
            ),
        );
    }
    elseif ($orig != '' || $orig != 'запусти навык выбор заработка в интернете' || $orig != 'запусти навык подобрать работу в интернете' || $orig != 'писать' || $orig != 'биржа е т икс т' || $orig != 'биржа текст саль' || $orig != 'биржа адвего' || $orig != 'фотографировать' || $orig != 'фотобанк лори' || $orig != 'фотобанк отражение' || $orig != 'другой выбор' || $orig != 'скажи проверенный сайт для заработка' || $orig != 'помощь')
    {
        if ($data->session->message_id == ($_SESSION['id'] + 1))
        {
            $answer['response']['text'] = 'Ошибка! Пожалуйста, повтори, или нажми на кнопку "Помощь"!';
            $answer['response']['tts'] = 'Извини, я не расслышала! - Пожалуйста, повтори, - или нажми на кнопку "Помощь"!';
            $answer['response']['buttons'] = array(
                array(
                    'title' => 'Помощь',
                    'payload' => array('opt' => 'help'),
                ),
            );
        }
        elseif ($data->session->message_id == ($_SESSION['id'] + 2) || $data->session->message_id == ($_SESSION['id'] + 4))
        {
            $answer['response']['text'] = 'Это ошибка! А этот замечательный сайт о заработке в интернете решит проблему!';
            $answer['response']['tts'] = 'Ошибка ввода! А этот замечательный сайт о заработке в интернете решит проблему!';
            $answer['response']['buttons'] = array(
                array(
                    'title' => 'Заработок в интернете',
                    'url' => 'https://dawork.ru/',
                ));
            if (isset($_SESSION['id']))
            {
                unset($_SESSION['id']);
                //session_destroy();
            }
        }
        else
        {
            $id = $data->session->session_id;
            session_id($id);
            session_start();
            if (!isset($_SESSION['id'])) $_SESSION['id'] = [];
            array_push($_SESSION['id'], $data->session->message_id);
            $answer['response']['text'] = 'Пожалуйста, сделай выбор путем нажатия кнопки, или голосом любимого вида деятельности. \nПолучишь подробные описания заработков с ссылками на проверенные ресурсы в интернете!';
            $answer['response']['tts'] = 'Пожалуйста, сделай выбор пут+ем наж+атия кнопки, или голосом любимого вида деятельности. -  \nПолучишь подробные опис+ания з+аработков с сс+ылками на проверенные ресурсы в интернете.';
            $answer['response']['buttons'] = array(
                array(
                    'title' => 'писАть',
                    'payload' => array('opt' => 'write'),
                ),
                array(
                    'title' => 'фотографировать',
                    'payload' => array('opt' => 'photo'),
                ),
                array(
                    'title' => 'другой выбор',
                    'payload' => array('opt' => 'more'),
                ),
            );
        }
    }
    else
    {
        if ($opt == '')
        {
            $answer['response']['text'] = 'В твоём редком случае поможет только этот сайт!';
            $answer['response']['tts'] = 'В твоём редком случае поможет только этот сайт!';
            $answer['response']['buttons'] = array(
                array(
                    'title' => 'Заработок в интернете',
                    'url' => 'https://dawork.ru/',
                ));
        }
    }
}
header('Content-Type: application/json');
echo json_encode($answer);

