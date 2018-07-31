biblioglobus.com
Сайт гипотетической библиотечной сети, позволяющий просматривать информацию о книгах, хранящихся в фондах и авторах.

1. index.php - "главная страница". Отображает рейтинг 5 самых комментируемых книг, 5 авторов, написавших больше всего книг и 5 последних комментариев.
Состоит из index.php и шаблона template-index.php

2. biblioteka.php - страница "Библиотеки". Работает в двух режимах, с параметром bibliotekaid и без параметров. В последнем случае отображается список всех библиотек сети с возможностью перехода на страницу конкретной библиотеки (Например: biblioteka.php/?bibliotekaid=2).

В режиме с параметром (Например: bibliotekaid=3) отображается таблица со списком книг, хранящихся в фондах данного филиала. Для упращения работы со списком доступна паджинация (разбиение списка на страницы) и фильтр по автору.
Состоит из biblioteka.php и шаблона template-biblioteka.php
В шаблоне подключается модуль формирования таблицы книг booktable.php

3. book.php - страница "Книги". Работает в двух режимах, с параметром bookid и без параметров. В последнем случае отображается список всех книг, хранящихся в фондах всех библиотек сети с возможностью перехода на страницу конкретной книги (Например: book.php/?bookid=7).

В режиме с параметром (Например: bookid=2) отображается информация о книге, с возможностью перехода на страницу автора(ов) и список библиотек, в фондах которых эта книга доступна.
Состоит из book.php и шаблона template-book.php
В шаблоне подключается модуль формирования таблицы книг booktable.php