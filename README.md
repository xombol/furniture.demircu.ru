## Status - ```process```

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out
of development by easing common tasks used in many web projects, such as:

```console 
sail artisan migrate. 
```

```console 
sail artisan db:seed --class=FurnitureSeed.
```

### Выполнено

1. Созданы все необходимые таблицы (их 5)
2. Созданы связи между таблицами
3. Под каждую модель созданы ```factories```
4. Создан ```seed``` - ```FurnitureSeed``` для заполнения рандомными записями
5. Фронт уже внутри путь ```resources/js``` - ```interia``` под капотом, чтобы отдельно не пилить 
6. Сейчас в проекте стоит sail для локальной среды [sail](https://laravel.com/docs/10.x/sail)

### В процессе

1. Таблицы для перемещения мебели между складами. Возможные варианты или ```database``` или как инкремент на ```redis```
2. Перемещение через очереди во избежание косяков - драйвер или ```redis``` или ```sync``` 
3. Написание rest api 
4. поднятие фронта
