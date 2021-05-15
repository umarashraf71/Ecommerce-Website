<style>
    .bg__cat--3 {

        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(../assets/images/slider/front.jpg) !important;
        background-position: center !important;
        background-size: cover !important;
        background-attachment: fixed !important;
        /* min-height: 600px !important;
        height: 600px !important;
        max-height: 800px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important; */
    }

    @media (min-width:1025px) and (max-width: 1400px) {

        .slider__fixed--height {

            min-height: 600px !important;
            height: 600px !important;
            max-height: 800px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

    }


    @media (min-width:768px) and (max-width: 1024px) {

        .slider__fixed--height {

            /* min-height: 600px !important; */
            height: auto !important;
            /* max-height: 750px !important; */
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .slider__inner {

            padding-left: 140px !important;
        }

    }

    @media (min-width:200px) and (max-width: 767px) {

        .slider__fixed--height {

            min-height: 800px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .slider__inner h1 {

            font-size: 60px !important;
            text-align: center;
        }

        .slider__inner h2 {

            text-align: center;
        }

        .cr__btn {

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slide__thumb,
        .slide {

            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

    }

    .slider__inner h1 {

        color: white !important;
        font-family: 'Poppins', 'Old Standard TT' !important;
        font-weight: 500;
        margin-left: -5px !important;
        font-size: 70px;
    }

    .slider__inner h2 {

        color: white !important;
        font-family: 'Poppins', 'Old Standard TT' !important;
        font-weight: 500;
        margin-bottom: -20px !important;
    }

    .single__slide {

        padding: 0px 50px !important;

    }

    .owl-prev {

        margin-left: 25px !important;
    }

    .owl-next {

        margin-right: 25px !important;
    }

    .slide__thumb,
    .slide {

        display: flex !important;
        justify-content: flex-end;
        align-items: center;
    }

    .slide__thumb img {

        border: 5px solid #c43b68 !important;
    }
</style>

<!-- Start Slider Area -->
<div class="slider__container slider--one bg__cat--3 ">
    <div class="slide__container slider__activation__wrap owl-carousel">
        <!-- Start Single Slide -->
        <div class="single__slide animation__style01 slider__fixed--height">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>collection 2021</h2>
                                <h1>TABLE CHAIR SET</h1>
                                <div class="cr__btn">
                                    <a data-tilt href="cart.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5 ">
                        <div class="slide__thumb ">
                            <img data-tilt src="../../demo images/5.jpg" alt="slider images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
        <!-- Start Single Slide -->
        <div class="single__slide animation__style01 slider__fixed--height">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>collection 2021</h2>
                                <h1>BROWN GLASS TABLE</h1>
                                <div class="cr__btn">
                                    <a href="cart.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5 ">
                        <div class="slide__thumb">
                            <img class="js-tilt" data-tilt src="../../demo images/6.jpg" alt="slider images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
    </div>
</div>
<!-- Start Slider Area -->