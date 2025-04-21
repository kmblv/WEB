-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 21 2025 г., 18:45
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd33`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `КодЗаказчика` int(11) NOT NULL,
  `ФИО` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Почта` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Номертелефона` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Логин` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Пароль` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `VisitsCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`КодЗаказчика`, `ФИО`, `Почта`, `Номертелефона`, `Логин`, `Пароль`, `VisitsCount`) VALUES
(1, 'Плаксина Марина Александровн', 'plaksinamarina@icloud.com', '987576576', 'jh', '55', 41),
(2, 'Кузнецов Ярослав Викторович', 'qwe@yandex.ru', '73666342111', 'kuznyar', '544', 2),
(3, 'Зайцев Михаил Романович', 'wriuy@yandex.ru', '79864630000', 'zayts', '192837zay', 0),
(4, 'Соколов Андрей Николаевич', 'sokolovandr@bk.ru', '79865914441', 'sokolovandr', 'sok12', 0),
(5, 'Иава виаи', 'khadj@bk.ru', '09876543211', 'ivv', 'ivv', 0),
(6, 'jhf jhg ', 'jhfh@bk.ru', '09876543246', 'aaa', 'aaa', 0),
(8, 'olo olo', 'wreqq@bk.ru', '0987654322', 'qwer', 'qwer', 0),
(9, 'sgfds gfds fd', 'hjgf@bk.ru', '12345678944', 'uy', 'uy', 0),
(10, 'Романов Роман Романович', 'rommm@mail.ru', '54354376587', 'rr', 'rr', 0),
(11, 'jtgd jhgfj hgf', 'uyt@bk.ru', '67544343434', '5re', '5re', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `dogovori`
--

CREATE TABLE `dogovori` (
  `КодДоговора` int(11) NOT NULL,
  `Номердоговора` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Датазаключения` date NOT NULL,
  `Площадьобъекта` decimal(10,2) NOT NULL,
  `Адресобъекта` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `КодСотрудника` int(11) DEFAULT NULL,
  `КодЗаказчика` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dogovori`
--

INSERT INTO `dogovori` (`КодДоговора`, `Номердоговора`, `Датазаключения`, `Площадьобъекта`, `Адресобъекта`, `КодСотрудника`, `КодЗаказчика`) VALUES
(2, '121-111', '2025-02-04', '99.00', 'г. Москва ул.Варшавское шоссе д.15 кв.5', 6, 4),
(3, '124-222', '2025-03-02', '52.00', 'г. Москва ул. Люсиновская д.21к1 кв.9', 3, 2),
(4, '131-555', '2025-04-01', '123.00', 'морпрпаьр орпа', 1, 3),
(10, '571-808', '2025-04-20', '150.00', 'Москва, Московская, 15, 77', NULL, 1),
(11, '827-273', '2025-04-21', '333.00', 'рпаопр', NULL, 1),
(12, '848-805', '2025-04-21', '123.00', 'Test test', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `содержат`
--

CREATE TABLE `содержат` (
  `КодДоговора` int(11) NOT NULL,
  `КодУслуги` int(11) NOT NULL,
  `Статус` enum('В процессе','Завершен') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `содержат`
--

INSERT INTO `содержат` (`КодДоговора`, `КодУслуги`, `Статус`) VALUES
(2, 1, 'Завершен'),
(3, 4, 'Завершен'),
(4, 1, 'В процессе'),
(10, 1, 'В процессе'),
(10, 4, 'Завершен'),
(11, 1, 'Завершен'),
(12, 2, 'В процессе'),
(12, 3, 'В процессе');

-- --------------------------------------------------------

--
-- Структура таблицы `сотрудники`
--

CREATE TABLE `сотрудники` (
  `КодСотрудника` int(11) NOT NULL,
  `ФИО` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Должность` enum('Инженер','Дизайнер','Администратор','Менеджер') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Опыт работы` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Номер телефона` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Логин` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Пароль` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `сотрудники`
--

INSERT INTO `сотрудники` (`КодСотрудника`, `ФИО`, `Должность`, `Опыт работы`, `Номер телефона`, `Логин`, `Пароль`) VALUES
(1, 'Камбалов Роман Андреевич', 'Дизайнер', '4 года 4 месяца', '98324735644', 'kjhgjh', '87687'),
(2, 'Мишин Михаил Михайлович', 'Инженер', '3 года 3 месяца', '88888888841', 'mshmich', '123m'),
(3, 'Бурина Анастасия Романовна', 'Инженер', '1 год 2 месяца', '790247355757', 'anasbur', '86876g'),
(4, 'Громова Алина Вячеславовна', 'Менеджер', '5 лет 5 месяцев', '71342422222', 'gromalina', 'ggg1'),
(5, 'Сидоров Евгений Алексеевич', 'Администратор', '10 лет 1 месяц', '79333333333', 'sidevg', '111evg'),
(6, 'Щурина Дарья Андреевна', 'Дизайнер', '9 лет 1 месяц', '79527781289', 'dariashur', 'd13sh');

-- --------------------------------------------------------

--
-- Структура таблицы `услуги`
--

CREATE TABLE `услуги` (
  `КодУслуги` int(11) NOT NULL,
  `Название` enum('Визуализации','Скетчи','Альбом чертежей','Обмерный план') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Описание` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Стоимость` int(11) NOT NULL,
  `КодТипаУслуги` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `услуги`
--

INSERT INTO `услуги` (`КодУслуги`, `Название`, `Описание`, `Стоимость`, `КодТипаУслуги`) VALUES
(1, 'Визуализации', 'Реалистичные и детализированные изображения на основе согласованной концепции интерьера.', 50000, 1),
(2, 'Скетчи', 'Недетализированные изображения, скомпанованные в одном месте для отображения общего вида интерьера', 25000, 1),
(3, 'Альбом чертежей', 'Состоит из обмерного плана, плана коммуникаций и электрики, развёртки по стенам', 30000, 2),
(4, 'Обмерный план', 'План с указанием расстояний помещений, высот потолков, окон и дверных проёмов', 15000, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `типуслуг`
--

CREATE TABLE `типуслуг` (
  `КодТипаУслуги` int(11) NOT NULL,
  `Вид услуги` enum('Дизайн-проект','Инженерный проект') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Описание` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `типуслуг`
--

INSERT INTO `типуслуг` (`КодТипаУслуги`, `Вид услуги`, `Описание`) VALUES
(1, 'Дизайн-проект', 'Дизайн-проект включает в себя создание общей концепции интерьера. К этому относятся коллажи, визуализации на основе подобранной мебели, цвета.'),
(2, 'Инженерный проект', 'Включает в себя следующие планы: обмерный, расстановки мебели, коммуникаций, электрики, развёртки. Указываются размеры в миллиметрах');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`КодЗаказчика`);

--
-- Индексы таблицы `dogovori`
--
ALTER TABLE `dogovori`
  ADD PRIMARY KEY (`КодДоговора`),
  ADD KEY `КодСотрудника` (`КодСотрудника`),
  ADD KEY `fk_заказчики` (`КодЗаказчика`);

--
-- Индексы таблицы `содержат`
--
ALTER TABLE `содержат`
  ADD PRIMARY KEY (`КодДоговора`,`КодУслуги`),
  ADD KEY `fk_услуги` (`КодУслуги`);

--
-- Индексы таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD PRIMARY KEY (`КодСотрудника`);

--
-- Индексы таблицы `услуги`
--
ALTER TABLE `услуги`
  ADD PRIMARY KEY (`КодУслуги`),
  ADD KEY `fk_типуслуги` (`КодТипаУслуги`);

--
-- Индексы таблицы `типуслуг`
--
ALTER TABLE `типуслуг`
  ADD PRIMARY KEY (`КодТипаУслуги`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `КодЗаказчика` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `dogovori`
--
ALTER TABLE `dogovori`
  MODIFY `КодДоговора` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  MODIFY `КодСотрудника` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `услуги`
--
ALTER TABLE `услуги`
  MODIFY `КодУслуги` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `типуслуг`
--
ALTER TABLE `типуслуг`
  MODIFY `КодТипаУслуги` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dogovori`
--
ALTER TABLE `dogovori`
  ADD CONSTRAINT `fk_заказчики` FOREIGN KEY (`КодЗаказчика`) REFERENCES `customers` (`КодЗаказчика`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_сотрудники` FOREIGN KEY (`КодСотрудника`) REFERENCES `сотрудники` (`КодСотрудника`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `содержат`
--
ALTER TABLE `содержат`
  ADD CONSTRAINT `fk_договоры` FOREIGN KEY (`КодДоговора`) REFERENCES `dogovori` (`КодДоговора`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_услуги` FOREIGN KEY (`КодУслуги`) REFERENCES `услуги` (`КодУслуги`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `услуги`
--
ALTER TABLE `услуги`
  ADD CONSTRAINT `fk_типуслуги` FOREIGN KEY (`КодТипаУслуги`) REFERENCES `типуслуг` (`КодТипаУслуги`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
