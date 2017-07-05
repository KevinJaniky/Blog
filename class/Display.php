<?php

class Display
{

    public function head($titre)
    {

        echo "<head>
    <title>$titre | Yuna Création</title>

    <meta charset=\"utf-8\">
    <meta name=\"description\" content=\"\">
    <meta property=\"og:title\" content=\"Titre\"/>
    <meta property=\"og:description\" content=\"Description\"/>
    <meta property=\"og:image\" content=\"URL_image\"/>
    <meta property=\"og:url\" content=\"\">
    <link rel='icon' href='/media/favicon.png'>
    <link rel=\"stylesheet\" href=\"/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"/owl-carousel/assets/owl.carousel.min.css\">
    <link rel=\"stylesheet\" href=\"/css/style.css\">

    <script src=\"/js/jquery.js\"></script>
    <script src=\"/js/bootstrap.min.js\"></script>
    <script src=\"/owl-carousel/owl.carousel.min.js\"></script>
    <script src=\"/js/script.js\"></script>
</head>";
    }

    public function navTop()
    {
        echo "
        <nav class=\"navbar navbar-default navbar-static-top top_nav\">
            <div class=\"container-fluid\">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\"
                            data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </button>
                </div>
        
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                    <ul class=\"nav navbar-nav\">
                        <li><a href=\"/Home\"><span class=\"glyphicon glyphicon-home\"></span></a></li>
                        <li><a href=\"/Contact\" rel='nofollow'>Contact</a></li>
                        <li><a href=\"/A-propos-de-moi\">A propos de moi</a></li>
                    </ul>
                    <ul class=\"nav navbar-nav navbar-right\">
                       <li><a href=\"#\" >
                <img class='logo-reseaux-sociaux' src='/media/Social_network/Facebook.png'  alt='facebook logo'></a></li>
                        <li><a href=\"#\"><img class='logo-reseaux-sociaux' src='/media/Social_network/Twitter.png' alt='twitter logo' ></a></li>
                        <li><a href=\"#\"><img class='logo-reseaux-sociaux' src='/media/Social_network/Instagram.png' alt='instagram logo' ></a></li>
                        <li><a href=\"#\"><img class='logo-reseaux-sociaux' src='/media/Social_network/Youtube.png' alt='youtube logo' ></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>";
    }

    public function header()
    {
        echo "<header><h1 class=\"text-center\" >
        <img src='/media/logo.png' alt='Logo element'>
    </h1>
    <nav class=\"navbar navbar-default \">
        <div class=\"container-fluid\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\"
                        data-target=\"#bs-example-navbar-collapse-2\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-2\">
                <ul class=\"nav navbar-nav\">
                    <li><a href=\"/Categorie/Musique\"><img src='/media/Icone/music_black.png' class='icone_image' alt='musique icon'>Musique</a></li>
                    <li><a href=\"/Categorie/Web\"><img src='/media/Icone/web_black.png' class='icone_image' alt='musique icon'>Web</a></li>
                    <li><a href=\"/Categorie/Lifestyle\"><img src='/media/Icone/lifestyle_black.png' class='icone_image' alt='musique icon'>Lifestyle</a></li>
                    <li><a href=\"/Categorie/Culture\"><img src='/media/Icone/Culture_black.png' class='icone_image' alt='musique icon'>Culture</a></li>
                    <li><a href=\"/Categorie/Humeur\"><img src='/media/Icone/humeur_black.png' class='icone_image' alt='musique icon'>Humeur</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>";
    }

    public function aside()
    {
        echo "
        <aside role='presentation'>
            <article>
                <h3>A propos de moi</h3>
                <img src=\"/media/presentation.jpg\" alt=\"Photo Yuna Creation\">
                <p>
                   
                    Hello ! bienvenue sur Yuna Création ! Je m’appelle Audrey, je suis actuellement étudiante en communication. 
                    Ce blog est mon petit coin de paradis. Bonne lecture à vous !
                </p>
            </article>
            <article>
                <div class=\"newsletter\">
                    <form method=\"post\" action='/add_newsletter.php'>
                        <div class=\"form-group\">
                            <h3><label for=\"mail\">Newsletter</label></h3>
                            <input type=\"email\" class=\"form-control\" name=\"newsletter\" id=\"mail\"
                                   placeholder=\"Adresse mail\">
                        </div>
                        <input type='hidden' value='" . $_SERVER['REQUEST_URI'] . "' name='url'>
                        <input type=\"submit\" value=\"S'abonner\" class=\"btn btn-primary\">
                    </form>
                </div>
            </article>
            <article>
                <a href='#'>
                <div class=\"youtube_visuel\">
                   <img src='/media/visuel_youtube.png' alt='visuel acces youtube'>
                </div>
                </a>
            </article>
            
            
            
            ";
        $this->audioPlayer();
        echo '
        <script>
        var audioPlayer = document.querySelector(\'.green-audio-player\');
    var playPause = audioPlayer.querySelector(\'#playPause\');
    var playpauseBtn = audioPlayer.querySelector(\'.play-pause-btn\');
    var loading = audioPlayer.querySelector(\'.loading\');
    var progress = audioPlayer.querySelector(\'.progress\');
    var sliders = audioPlayer.querySelectorAll(\'.slider\');
    var volumeBtn = audioPlayer.querySelector(\'.volume-btn\');
    var volumeControls = audioPlayer.querySelector(\'.volume-controls\');
    var volumeProgress = volumeControls.querySelector(\'.slider .progress\');
    var player = audioPlayer.querySelector(\'audio\');
    var currentTime = audioPlayer.querySelector(\'.current-time\');
    var totalTime = audioPlayer.querySelector(\'.total-time\');
    var speaker = audioPlayer.querySelector(\'#speaker\');

    var draggableClasses = [\'pin\'];
    var currentlyDragged = null;

    window.addEventListener(\'mousedown\', function(event) {

        if(!isDraggable(event.target)) return false;

        currentlyDragged = event.target;
        var handleMethod = currentlyDragged.dataset.method;

        this.addEventListener(\'mousemove\', window[handleMethod], false);

        window.addEventListener(\'mouseup\', () => {
            currentlyDragged = false;
        window.removeEventListener(\'mousemove\', window[handleMethod], false);
    }, false);
    });

    playpauseBtn.addEventListener(\'click\', togglePlay);
    player.addEventListener(\'timeupdate\', updateProgress);
    player.addEventListener(\'volumechange\', updateVolume);
    player.addEventListener(\'loadedmetadata\', () => {
        totalTime.textContent = formatTime(player.duration);
    });
    player.addEventListener(\'canplay\', makePlay);
    player.addEventListener(\'ended\', function(){
        playPause.attributes.d.value = "M18 12L0 24V0";
        player.currentTime = 0;
    });

    volumeBtn.addEventListener(\'click\', () => {
        volumeBtn.classList.toggle(\'open\');
    volumeControls.classList.toggle(\'hidden\');
    })

    window.addEventListener(\'resize\', directionAware);

    sliders.forEach(slider => {
        var pin = slider.querySelector(\'.pin\');
    slider.addEventListener(\'click\', window[pin.dataset.method]);
    });

    directionAware();

    function isDraggable(el) {
        var canDrag = false;
        var classes = Array.from(el.classList);
        draggableClasses.forEach(draggable => {
            if(classes.indexOf(draggable) !== -1)
        canDrag = true;
    })
        return canDrag;
    }

    function inRange(event) {
        var rangeBox = getRangeBox(event);
        var rect = rangeBox.getBoundingClientRect();
        var direction = rangeBox.dataset.direction;
        if(direction == \'horizontal\') {
            var min = rangeBox.offsetLeft;
            var max = min + rangeBox.offsetWidth;
            if(event.clientX < min || event.clientX > max) return false;
        } else {
            var min = rect.top;
            var max = min + rangeBox.offsetHeight;
            if(event.clientY < min || event.clientY > max) return false;
        }
        return true;
    }

    function updateProgress() {
        var current = player.currentTime;
        var percent = (current / player.duration) * 100;
        progress.style.width = percent + \'%\';

        currentTime.textContent = formatTime(current);
    }

    function updateVolume() {
        volumeProgress.style.height = player.volume * 100 + \'%\';
        if(player.volume >= 0.5) {
            speaker.attributes.d.value = \'M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z\';
        } else if(player.volume < 0.5 && player.volume > 0.05) {
            speaker.attributes.d.value = \'M0 7.667v8h5.333L12 22.333V1L5.333 7.667M17.333 11.373C17.333 9.013 16 6.987 14 6v10.707c2-.947 3.333-2.987 3.333-5.334z\';
        } else if(player.volume <= 0.05) {
            speaker.attributes.d.value = \'M0 7.667v8h5.333L12 22.333V1L5.333 7.667\';
        }
    }

    function getRangeBox(event) {
        var rangeBox = event.target;
        var el = currentlyDragged;
        if(event.type == \'click\' && isDraggable(event.target)) {
            rangeBox = event.target.parentElement.parentElement;
        }
        if(event.type == \'mousemove\') {
            rangeBox = el.parentElement.parentElement;
        }
        return rangeBox;
    }

    function getCoefficient(event) {
        var slider = getRangeBox(event);
        var rect = slider.getBoundingClientRect();
        var K = 0;
        if(slider.dataset.direction == \'horizontal\') {

            var offsetX = event.clientX - slider.offsetLeft;
            var width = slider.clientWidth;
            K = offsetX / width;

        } else if(slider.dataset.direction == \'vertical\') {

            var height = slider.clientHeight;
            var offsetY = event.clientY - rect.top;
            K = 1 - offsetY / height;

        }
        return K;
    }

    function rewind(event) {
        if(inRange(event)) {
            player.currentTime = player.duration * getCoefficient(event);
        }
    }

    function changeVolume(event) {
        if(inRange(event)) {
            player.volume = getCoefficient(event);
        }
    }

    function formatTime(time) {
        var min = Math.floor(time / 60);
        var sec = Math.floor(time % 60);
        return min + \':\' + ((sec<10) ? (\'0\' + sec) : sec);
    }

    function togglePlay() {
        if(player.paused) {
            playPause.attributes.d.value = "M0 0h6v24H0zM12 0h6v24h-6z";
            player.play();
        } else {
            playPause.attributes.d.value = "M18 12L0 24V0";
            player.pause();
        }
    }

    function makePlay() {
        playpauseBtn.style.display = \'block\';
        loading.style.display = \'none\';
    }

    function directionAware() {
        if(window.innerHeight < 250) {
            volumeControls.style.bottom = \'-54px\';
            volumeControls.style.left = \'54px\';
        } else if(audioPlayer.offsetTop < 154) {
            volumeControls.style.bottom = \'-164px\';
            volumeControls.style.left = \'-3px\';
        } else {
            volumeControls.style.bottom = \'52px\';
            volumeControls.style.left = \'-3px\';
        }
    }
        </script>
        
        ';


        echo"</aside>
        ";


    }

    public function instagram()
    {
        /*  echo '<section class="instagram_feed">';

          for ($i = 0; $i < 6; $i++) {

              echo '<div class="item_instagram">
                      <img src="http://pipsum.com/500x350.jpg">
                  </div>';

          }
          echo '</section>';*/
    }

    public function footer()
    {
        echo "
        <footer>
    <div class=\"info_site\">
        <div class=\"link_info_site\">
            <div>© 2017 copyright.</div>
            <div>
                <a href=\"/Mentions-Legales\">Mentions Légales</a>
            </div>
        </div>
        <div class=\"link_social_site\">
            <ul>
                <li><a href=\"#\" >
                <img class='logo-reseaux-sociaux' src='/media/Social_network/Facebook.png'  alt='facebook logo'></a></li>
                        <li><a href=\"#\"><img class='logo-reseaux-sociaux' src='/media/Social_network/Twitter.png' alt='twitter logo' ></a></li>
                        <li><a href=\"#\"><img class='logo-reseaux-sociaux' src='/media/Social_network/Instagram.png' alt='instagram logo' ></a></li>
                        <li><a href=\"#\"><img class='logo-reseaux-sociaux' src='/media/Social_network/Youtube.png' alt='youtube logo' ></a></li>
            </ul>
        </div>

    </div>
</footer>";
    }

    public function audioPlayer(){
        echo '<div class="audio green-audio-player">
    <div class="loading">
        <div class="spinner"></div>
    </div>
    <div class="play-pause-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24">
            <path fill="#566574" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause"/>
        </svg>
    </div>

    <div class="controls">
        <span class="current-time">0:00</span>
        <div class="slider" data-direction="horizontal">
            <div class="progress">
                <div class="pin" id="progress-pin" data-method="rewind"></div>
            </div>
        </div>
        <span class="total-time">0:00</span>
    </div>

    <div class="volume">
        <div class="volume-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#566574" fill-rule="evenodd" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z" id="speaker"/>
            </svg>
        </div>
        <div class="volume-controls hidden">
            <div class="slider" data-direction="vertical">
                <div class="progress">
                    <div class="pin" id="volume-pin" data-method="changeVolume"></div>
                </div>
            </div>
        </div>
    </div>

    <audio crossorigin>
        <source src="/media/Music/music.mp3" type="audio/mp3">
    </audio>
</div>';
    }

}