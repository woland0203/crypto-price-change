## Запуск проекта
./vendor/bin/sail up -d

Сервис запучтиться 

## Методы API
### Список
curl -X GET 'http://localhost/api/crypto-price-change/'

###  Список с пагинацией
curl -X GET 'http://localhost/api/crypto-price-change/?limit=5&offset=2'


### Один элемент
curl -X GET http://localhost/api/crypto-price-change/IOTABTC


### Создать
curl -X POST \
http://localhost/api/crypto-price-change/ \
-H 'content-type: application/x-www-form-urlencoded' \
-d 'name=bla&availableQuantity=11&price=10.01'


###  Обновить
curl -X PUT \
http://localhost/api/crypto-price-change/BNBBTC/ \
-d 'availableQuantity=11&price=10.01'


###  Удалить
curl -X DELETE http://localhost/api/crypto-price-change/BNBBTC/ 



## Вопрос: "Где бы вы размещали логику, объединяющую несколько не связанных между собой модулей?"

Сделал бы для этого отдельный сервис. Условно назовем его Посредник, так как задача похожа на ту которая подпадает под паттерн Посредник.
В конструктор Посредника инекцируем не связанные сервисы.
В посреднике делаем медоты для реализации логики по взаимодействию.
Сервис посредник может также включать(инекция) дополнительные сервисы. Их надо добавлять по мере надобности.
Зависит от задачи, но при разработке Посредника(ов) и его вспомогательных сервисов, нужно понимать что они делают, разделять сервисы по мере надобности, учитывая "принцип единой ответственности"
