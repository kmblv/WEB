<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Стили</title>
<style>
    body {
        font-family: Inter;
        margin: 0;
        padding: 0;
        background-color: #121212; /* Цвет фона страницы */
        color: white; /* Цвет текста */
    }
			@font-face {
            font-family: Neutral Face;
            src: url('NeutralFace-Bold.otf') format('otf');
        }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background: #333;
        border-radius: 16px;
        overflow: hidden;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #444;
    }
    h2, h1 {
        font-family: Neutral Face;
        font-size: 30px;
    }

		.banner {
            width: 100%;
            height: 500px;
			background-image: url('gg.jpg');
            background-size: cover;
            background-position: center;
        }
		
		        .banner-text {
            position: absolute;
            top: 45%; 
            left: 50%;
            transform: translate(-50%, -50%); 
            color: white;
            text-align: center;
			white-space: nowrap;
			        font-family: Neutral Face;
        font-size: 100px;
        }

        input, textarea, button {
            margin: 5px;
            padding: 8px;
            background: #444;
            border: 1px solid #555;
            color: white;
            width: calc(100% - 20px);
            box-sizing: border-box;
        }
        button {
            cursor: pointer;
            background: #555;
            border: none;
        }
        button:hover {
            background: #666;
        }
		/* Основные стили */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
	color: white;
}

/* Баннер */
.banner {
    position: relative;
    margin-top: 20px;
}

.banner-image {
    width: 100%;
    height: 600px;
    object-fit: cover;
}

.banner-text {
    position: absolute;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 72px;
    font-family: 'Neutral Face';
    color: white;

    font-weight: bold; /* Добавлено для жирного текста */
}


/* Секции */
section {
    padding: 50px 0;
}

.about-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
}

/* Блоки с шагами */
.steps {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.step {
    text-align: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px; 
	font-family: Neutral Face;
        font-size: 16px;
}

/* Контакты */
.contacts {
    background: #f5f5f5;
    padding: 40px 0;
}

.contact-info {
    text-align: left;
}

.social-links img {
    width: 32px;
    margin: 10px;
}
/* Разделительная линия после баннера */
.section-divider {
    border: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent 10%, #888 50%, transparent 90%);
    margin: 40px auto;
    width: 100%;
}

/* Стили для блока "Кто мы" */
.about-section {
    padding: 50px 0;
	color: black;
}

.about-card {
    background: #f5f5f5;
    border-radius: 20px;
    padding: 40px;
    position: relative;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.about-card:hover {
    transform: translateY(-5px);
}

.about-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
}

.styled-list {
    list-style: none;
    padding-left: 0;
}

.styled-list li {
    padding: 12px 0;
    position: relative;

}

.li-decoration {
    color: #666;
    margin-right: 15px;
}

.decorative-element {
    position: absolute;
    top: -20px;
    left: -20px;
    width: 60px;
    height: 60px;
    background: #ddd;
    clip-path: polygon(0 0, 100% 0, 100% 35%, 35% 100%, 0 100%);
}

.icon-container {
    text-align: center;
}

.section-icon {
    width: 200px;
    opacity: 0.8;
    transition: transform 0.3s ease;
}

.section-icon:hover {
    transform: rotate(-5deg) scale(1.05);
}

/* Стили для контактов */
.contacts {
    background: #fafafa;
    padding: 40px 0;
}

.black-text {
    color: #000 !important;
}

.black-link {
    color: #000 !important;
    text-decoration: underline;
}

.black-link:hover {
    color: #444 !important;
}
/* Новая разделительная линия */
.solid-divider {
    border-bottom: 3px solid #888;
    width: 80%;
    margin: 40px auto;
}

/* Обновленный блок "Кто мы" */
.simple-gray-card {
    background: rgba(250,250,250,1.0);
    border-radius: 12px;
    padding: 30px;
    margin: 20px 0;
}

.modern-list {
    list-style: none;
    padding: 0;
    margin: 20px 0;
	        font-family: Neutral Face;
        font-size: 14px;
}

.modern-list li {
    padding: 12px;
    margin: 8px 0;
    background: rgba(0,0,0,0.9);
    border-radius: 6px;
    position: relative;
    transition: transform 0.2s ease;
}

.modern-list li:hover {
    transform: translateX(10px);
}

/* Общие корректировки цветов */
.about-section h2,
.about-section p {
    color: #333;
	
}
p{
	    font-family: Neutral Face;
        font-size: 14px;
}

.contacts h2 {
    color: #333;
}
</style>
</head>
<body> 
</body>
</html>
