<script src="/views/public/Efeitos/SlidesJS/source/jquery.slides.js"></script>
<link rel="stylesheet" type="text/css" href="/views/public/Efeitos/SlidesJS/examples/playing/css/font-awesome.min.css">

<!-- SlidesJS Optional: If you'd like to use this design -->
  <style>
    body {
      -webkit-font-smoothing: antialiased;
      font: normal 15px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #232525;
    }

    #slides {
      display: none
    }

    #slides .slidesjs-navigation {
      margin-top:5px;
    }

    a.slidesjs-next,
    a.slidesjs-previous,
    a.slidesjs-play,
    a.slidesjs-stop {
      background-image: url(/views/public/Efeitos/SlidesJS/examples/playing/img/btns-next-prev.png);
      background-repeat: no-repeat;
      display:block;
      width:12px;
      height:18px;
      overflow: hidden;
      text-indent: -9999px;
      float: left;
      margin-right:5px;
    }

    a.slidesjs-next {
      margin-right:10px;
      background-position: -12px 0;
    }

    a:hover.slidesjs-next {
      background-position: -12px -18px;
    }

    a.slidesjs-previous {
      background-position: 0 0;
    }

    a:hover.slidesjs-previous {
      background-position: 0 -18px;
    }

    a.slidesjs-play {
      width:15px;
      background-position: -25px 0;
    }

    a:hover.slidesjs-play {
      background-position: -25px -18px;
    }

    a.slidesjs-stop {
      width:18px;
      background-position: -41px 0;
    }

    a:hover.slidesjs-stop {
      background-position: -41px -18px;
    }

    .slidesjs-pagination {
      margin: 7px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
      background-image: url(/views/public/Efeitos/SlidesJS/examples/playing/img/pagination.png);
      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: hidden
    }
  </style>
  <!-- End SlidesJS Optional-->

  <!-- SlidesJS Required: These styles are required if you'd like a responsive slideshow -->
  <style>
    #slides {
      display: none
    }

    .container {
      margin: 0 auto
    }

    /* For tablets & smart phones */
    @media (max-width: 767px) {
      body {
        padding-left: 20px;
        padding-right: 20px;
      }
      .container {
        width: auto
      }
    }

    /* For smartphones */
    @media (max-width: 480px) {
      .container {
        width: auto
      }
    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
      .container {
        width: 724px
      }
    }

    /* For larger displays */
    @media (min-width: 1200px) {
      .container {
        width: 1170px
      }
    }
  </style>

<div class="container">
    <div id="slides">
      <img src="/public/images/site/Banner/banner_site1.jpg" alt="Primeiro Banner">
      <img src="/public/images/site/Banner/banner_site2.jpg" alt="Segunda Banner">
      <img src="/public/images/site/Banner/banner_site3.jpg" alt="Terceiro Banner">
      <img src="/public/images/site/Banner/banner_site4.jpg" alt="Quarto Banner">
      <img src="/public/images/site/Banner/banner_site5.jpg" alt="Quinto Banner">
      <img src="/public/images/site/Banner/banner_site6.jpg" alt="Sexto Banner">
      <img src="/public/images/site/Banner/banner_site7.jpg" alt="Sétimo Banner">
      <img src="/public/images/site/Banner/banner_site8.jpg" alt="Oitavo Banner">
      <img src="/public/images/site/Banner/banner_site9.jpg" alt="Nono Banner">
      <img src="/public/images/site/Banner/banner_site10.jpg" alt="Décimo Banner">
    </div>
</div>

<script>
	$(function() {
	  $('#slides').slidesjs({
	    width: 1024,
	    height: 240,
	    play: {
	      active: true,
	      auto: true,
	      interval: 4000,
	      swap: true
	    }
	  });
	});
</script>

<style type="text/css">
	.container {
		width: 100%;
	}
</style>