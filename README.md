# URL Shorter

Приложение имеет форму для ввода URL для получения короткой ссылки. Помимо этого Вы можете ввести свой вариант сокращенной ссылке. 

При создании короткой ссылки, приложение производит валидацию а так же запрос к url ресурсу.

При обращении к короткому url происходит переадресация. 
Кол-во обращений фиксируется в БД.

## API

Для получения короткой ссылки через API выполните следующее:

POST: http://url.topmotels.ru/api/url <br/>
Content-type: application/json <br/>
POST body: <br/>
{ <br/>
  "url":"your url here" <br/>
}

ОТВЕТ: <br/>
{ <br/>
  "origin_url": "https://www.yandex.ru/search/?lr=39&offline_search=1&text=%D0%BA%D0%BE%D1%82%D0%B8%D0%BA%D0%B8", <br/>
  "short_url": "http://url.topmotels.ru/aRuSxGRC", <br/>
  "expired": "1525376299" <br/>
}
