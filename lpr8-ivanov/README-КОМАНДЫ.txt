ЛПР №8 — вариант 8 "Кинотеатр" — Иванов Кубрат, N=8
=====================================================

Этот архив — готовые файлы для проекта myproject.loc.
Вам нужно распаковать его и ЗАМЕНИТЬ/ДОБАВИТЬ файлы в проект
C:\OSPanel\home\myproject.loc, сохраняя ту же структуру папок:

  routes/web.php                              -> заменить
  app/Http/Controllers/CatalogController.php  -> добавить (или заменить, если создавали артизаном)
  app/Http/Controllers/PageController.php     -> добавить (или заменить)
  resources/views/layouts/app.blade.php       -> создать папку layouts и файл
  resources/views/catalog/index.blade.php     -> создать папку catalog и файл
  resources/views/catalog/show.blade.php      -> добавить в ту же папку
  resources/views/feedback.blade.php          -> добавить
  config/lab.php                              -> добавить
  env-additions.txt                           -> НЕ копировать как файл, а вручную
                                                  вставить его содержимое в .env

Проще всего: скопируйте папки app, config, resources, routes из этого архива
прямо в C:\OSPanel\home\myproject.loc, подтвердив замену файлов.

ПОСЛЕДОВАТЕЛЬНОСТЬ КОМАНД (в консоли OSPanel, не забудьте сначала "osp use PHP-8.3"):

cd C:\OSPanel\home\myproject.loc

:: если ещё не инициализировали git в этом проекте:
git init
git config user.name "Иванов Кубрат"
git config user.email "ваша_почта@example.com"
git add .
git commit -m "ЛПР8 п.1: установка Laravel"

:: после того как вставите содержимое env-additions.txt в .env:
php artisan tinker --execute="echo config('lab.code');"
git add .
git commit -m "ЛПР8 п.2: настройки .env и config/lab.php"

:: после того как скопируете routes/web.php:
git add .
git commit -m "ЛПР8 п.3: маршрут с параметром"

:: после того как скопируете контроллеры (CatalogController.php, PageController.php):
git add .
git commit -m "ЛПР8 п.4: контроллер каталога"

:: после того как скопируете resources/views (layouts/app.blade.php, catalog/*.blade.php):
git add .
git commit -m "ЛПР8 п.5: Blade-шаблоны"

:: запустить сервер (в отдельном окне консоли, держите открытым):
php artisan serve --port=8108

:: открыть в браузере: http://127.0.0.1:8108/catalog

:: после того как скопируете resources/views/feedback.blade.php и проверите форму:
git add .
git commit -m "ЛПР8 п.6: POST-форма"

:: в самом конце:
git log --date=iso --stat > git-log-lpr8.txt

НЕ ЗАБУДЬТЕ перед занятием:
1) заменить LAB_GROUP и LAB_CODE в .env на реальные значения;
2) выполнить наблюдения 1-4 из методички (это нужно сделать лично,
   просто скопировав файлы, отчёт не защитить).
