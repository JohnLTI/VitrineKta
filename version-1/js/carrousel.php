<head>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <style>
        /* swiper ------------------------------------------------------------------- */
        .latest {
            margin-top: 5rem;
            width: 70vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            margin: auto;
        }

        .latest .swiper-container {
            width: 100%;
            padding: 2rem 0;
            margin-top: 5rem;
            border: 2px solid #000;
            box-shadow: 0 5px 10px 5px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .latest .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 250px;
            height: 300px;


            border: 5px solid black;
        }

        .latest .comic-cover {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="latest">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="img/carro1.png" class="comic-cover" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="img/carro1.png" class="comic-cover" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="img/carro1.png" class="comic-cover" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="img/carro1.png" class="comic-cover" alt="">
                </div>
            </div>



            <div class="swiper-pagination"></div>
        </div>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },

            loop: true,
        });
    </script>
</body>