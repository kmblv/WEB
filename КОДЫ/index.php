<?php 
include "setup.php";
include "menu.php"; 
include "styles.php";


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студия дизайна интерьера</title>
</head>
<body>
<br><br>
    <div class="banner">
        <div class="banner-text">Студия дизайна интерьера</div>
    </div> <br><br>

<div class="solid-divider"></div>

    <section class="about-section">
        <div class="container">
            <div class="simple-gray-card">
                <h2>Кто мы и что делаем</h2>
                <div class="about-content">
                    <p>Мы - креативная студия дизайна интерьеров с 10-летним опытом работы. Специализируемся на:</p>
                    <ul class="modern-list">
                        <li>Жилых интерьерах</li>
                        <li>Коммерческих пространствах</li>
                        <li>Авторском надзоре</li>
                        <li>Комплексной реализации проектов</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
	<div class="solid-divider"></div>


    <section class="workflow">
        <div class="container">
            <h2>Как происходит работа</h2>
            <div class="steps">
                <div class="step">
                    <span>1</span>
                    <h3>Консультация</h3>
                    <p>Обсуждение ваших пожеланий и составление технического задания</p>
                </div>
                <div class="step">
                    <span>2</span>
                    <h3>Проектирование</h3>
                    <p>Разработка 3D-визуализации и рабочих чертежей</p>
                </div>
                <div class="step">
                    <span>3</span>
                    <h3>Реализация</h3>
                    <p>Подбор материалов и авторский надзор за выполнением работ</p>
                </div>
            </div>
        </div>
    </section>
	

<footer class="contacts">
        <div class="container">
            <h2>Контакты</h2>
            <div class="contact-info">

                <p class="black-text">Адрес: Москва, ул. Дизайнерская, 15</p>
                <p class="black-text">Телефон: <a href="tel:+74951234567" class="black-link">+7 (495) 123-45-67</a></p>
                <p class="black-text">Email: <a href="mailto:kambalovr@bk.ru" class="black-link">kambalovr@bk.ru</a></p>
				<p class="black-text">Часы работы: 09:00 - 21:00</p>
            </div>
        </div>
    </footer>
</body>
</html>

