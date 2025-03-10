<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System</title>
    <link rel="stylesheet" href="homee.css">
</head>
<body>
<div class="carousel-container">
        <button class="arrow arrow-left" onclick="prevSlide()">&#10094;</button>
        <div class="container" id="carousel">
            <div class="card">
                <div class="header">
                    <img src="latoya.jpg" alt="Latoya Gay">
                    <div>
                        <div class="name">Latoya Gay</div>
                        <div class="title">7th and 8th Grade ELA Teacher</div>
                    </div>
                </div>
                <p>“I have used Quizizz to work on skills based on standards. ... <span class="highlight">This allows me to quickly formatively assess</span> which students need additional help to master certain standards.”</p>
            </div>
            <div class="card">
                <div class="header">
                    <img src="Tifarah Dial.jpg" alt="Tifarah Dial Gay">
                    <div>
                        <div class="name">Tifarah Dial Gay</div>
                        <div class="title">Middle/High School Math Teacher</div>
                    </div>
                </div>
                <p>“<span class="highlight">This extremely quiet shy kid was really excited.</span> He was high-fiving students, making excited exclamations, and really into it. This Quizizz exercise completely opened him up and brought out his personality.”</p>
            </div>
            <div class="card">
                <div class="header">
                    <img src="Heather Fraelle.jpg" alt="Heather Fraelle">
                    <div>
                        <div class="name">Heather Fraelle</div>
                        <div class="title">Special Education Teacher</div>
                    </div>
                </div>
                <p>“On an assigned quiz, students can choose to have the quiz read aloud. This allows my struggling readers to be <span class="highlight">more independent on their assignments.</span>”</p>
            </div>
            <div class="card">
                <div class="header">
                    <img src="Kimberly Cagle.jpg" alt="Kimberly Cagle">
                    <div>
                        <div class="name">Kimberly Cagle</div>
                        <div class="title">High School Math Teacher</div>
                    </div>
                </div>
                <p>“<span class="highlight">I love that</span> if I can't find exactly what I am looking for I can edit a current Quizizz and make it my own or just create a whole new Quizizz.”</p>
            </div>
            <div class="card">
                <div class="header">
                    <img src="jessica.jpg" alt="Jessica Mitchell">
                    <div>
                        <div class="name">Jessica Mitchell</div>
                        <div class="title">Middle School English Teacher</div>
                    </div>
                </div>
                <p>“<span class="highlight">I can use Quizizz for almost every topic I teach.</span> I have especially enjoyed the lessons because it makes lessons interactive without creating a whole new Nearpod presentation.”</p>
            </div>
            <div class="card">
                <div class="header">
                    <img src="fran.jpg" alt="Fran Birmingham">
                    <div>
                        <div class="name">Fran Birmingham</div>
                        <div class="title">5th Grade Teacher</div>
                    </div>
                </div>
                <p>“Students started coming into class and asking, <span class="highlight">"Are we doing a Quizizz today?" or "Can we do another one?"</span> We have time before class is over!”</p>
            </div>
        </div>
        <button class="arrow arrow-right" onclick="nextSlide()">&#10095;</button>
    </div>

    <!-- CTA Section -->
    <div class="cta-container">
        <h2>Start adapting your curriculum in minutes.</h2>
        <p>The best way to create, adapt, and deliver resources differentiated for every student.</p>
        <div class="cta-buttons">
            <a href="#" class="cta-btn teachers">Sign up for free</a>
            <a href="#" class="cta-btn admins">Learn more</a>
        </div>
        <div class="cta-grid"></div>
    </div>
    <footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="quizizz-logo.png" alt="Quizizz">
        </div>
        <div class="footer-links">
            <div class="column1">
                
                <a href="#">The Quizizz Blog</a>
                <a href="#">Teacher Resources</a>
                <a href="#">Certified Educators</a>
                <a href="#">Quizizz for Work</a>
                <a href="#">Help Center</a>
               
            </div>
            <div class="column2">
                
                <a href="#">About Us</a>
                
                <a href="#">Contact Support</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Privacy Center</a>
            </div>
        </div>
    </div>
</footer>



    <script>
        let index = 0;
        function showSlide() {
            const carousel = document.getElementById('carousel');
            const cards = document.querySelectorAll('.card');
            const totalSlides = cards.length;
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            carousel.style.transform = `translateX(${-index * 380}px)`;
        }
        function prevSlide() {
            index--;
            showSlide();
        }
        function nextSlide() {
            index++;
            showSlide();
        }
    </script>
</body>
</html>
