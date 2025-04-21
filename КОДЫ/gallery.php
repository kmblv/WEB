<?php include "setup.php";
include "menu.php"; 
include "styles.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студия дизайна интерьера</title>
	<style>/* Галерея проектов */
        .projects-gallery {
            padding: 60px 0;
            background-color: #121212;
        }

        .gallery-title {
            font-family: 'Neutral Face';
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .projects-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .project-item {
            width: calc(50% - 20px); /* Две колонки с отступами */
            margin-bottom: 60px;
        }

        .project-image {
            width: 100%; /* Изображение занимает 100% ширины контейнера */
            height: auto; /* Высота автоматически подстраивается */
            object-fit: cover; /* Изображение обрезается, чтобы заполнить контейнер */
            border-radius: 4px;
        }

        .project-divider {
            width: 100%;
            height: 2px;
            background: white;
            margin: 20px 0;
        }

        .project-caption {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .caption-left, .caption-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .project-name, .project-detail {
            font-family: 'Neutral Face';
            font-size: 1.2rem;
            color: white;
        }

        .project-year {
            font-family: 'Inter';
            font-size: 1rem;
            color: #666;
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .project-image {
                height: 400px; /* Высота для мобильных устройств */
            }

            .project-caption {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .caption-left, .caption-right {
                flex-wrap: wrap;
                gap: 15px;
            }

            .gallery-title {
                font-size: 2rem;
            }

            .project-item {
                width: 100%; /* Один проект на строку на мобильных устройствах */
            }
        }
</style>
</head>
<body>
<br><br>
<section class="projects-gallery">
    <div class="container">
        <h2 class="gallery-title">Галерея проектов</h2>
        <div class="projects-container">
            <!-- Проект 1 -->
            <div class="project-item">
                <img src="сп.jpg" alt="Проект 1" class="project-image">
                <div class="project-divider"></div>
                <div class="project-caption">
                    <div class="caption-left">
                        <span class="project-name">Озёрный</span>
                    </div>
                    <span class="project-year">2025</span>
                </div>
            </div>

            <!-- Проект 2 -->
            <div class="project-item">
                <img src="сп1.jpg" alt="Проект 2" class="project-image">
                <div class="project-divider"></div>
                <div class="project-caption">
                    <div class="caption-left">
                        <span class="project-name">Варшавское</span>
                    </div>
                    <span class="project-year">2024</span>
                </div>
            </div>
  
			
			            <!-- Проект 3 -->
            <div class="project-item">
                <img src="в1.jpg" alt="Проект 1" class="project-image">
                <div class="project-divider"></div>
                <div class="project-caption">
                    <div class="caption-left">
                        <span class="project-name">Варшавское</span>
                    </div>

                        <span class="project-year">2024</span>
                    </div>
                </div>
			
			            <!-- Проект 4 -->
            <div class="project-item">
                <img src="кг.jpg" alt="Проект 1" class="project-image">
                <div class="project-divider"></div>
                <div class="project-caption">
                    <div class="caption-left">
                        <span class="project-name">Зюзино</span>
                    </div>

                        <span class="project-year">2024</span>
                    </div>
                </div>

			
			            <!-- Проект 5 -->
            <div class="project-item">
                <img src="сп2.jpg" alt="Проект 1" class="project-image">
                <div class="project-divider"></div>
                <div class="project-caption">
                    <div class="caption-left">
                        <span class="project-name">Карла Маркса</span>
                    </div>

                        <span class="project-year">2025</span>
                    </div>
                </div>
            </div>
    </div>
</section>
</body>
</html>
