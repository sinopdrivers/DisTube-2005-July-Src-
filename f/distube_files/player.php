<?php
include("db.php");

if (empty($_GET["v"])) {
    die(); // Exit if no video ID is provided
}

$vid = $_GET["v"];

// Use prepared statements to prevent SQL injection
$stmt = $connect->prepare("SELECT * FROM videodb WHERE VideoID = ?");
$stmt->bind_param("s", $vid);
$stmt->execute();
$result = $stmt->get_result();
$vdf = $result->fetch_assoc();

// Exit if video not found
if (!$vdf) {
    die();
}

$VideoFile = $vdf['VideoFile'];
?>
<html>
<head>
<link href="main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div style="width:407px;height:390px;" class="videocontainer" id="video_height" oncontextmenu="return false;">
        <div style="overflow:hidden">
            <video width="407" height="320" id="video_player">
                <source src="./<?php echo htmlspecialchars($VideoFile, ENT_QUOTES, 'UTF-8'); ?>">
            </video>
        </div>
        <div id="video_controls" style="display:none">
            <div id="left" onclick="v_play()"></div>
            <div id="right" onclick="v_mute()"></div>
            <div id="mid"><div id="midin"></div></div>
        </div>
        <script>
            function v_play() {
                if (player.paused || player.ended) {
                    player.play();
                    document.getElementById("left").style.backgroundImage = "url('ply0.png')";
                } else {
                    player.pause();
                    document.getElementById("left").style.backgroundImage = "url('ply1.png')";
                }
            }

            function v_mute() {
                if (player.muted) {
                    player.muted = false;
                    document.getElementById("right").style.backgroundImage = "url('vol1.png')";
                } else {
                    player.muted = true;
                    document.getElementById("right").style.backgroundImage = "url('vol0.png')";
                }
            }

            const player = document.getElementById('video_player');

            if (!player.canPlayType || !player.canPlayType('video/mp4').replace(/no/, '')) {
                document.getElementById("video_controls").outerHTML = "";
                document.getElementById("video_height").style.height = "330px";
            }

            player.addEventListener('timeupdate', function() {
                const percentage = (100 / player.duration) * player.currentTime;
                document.getElementById('midin').style.width = percentage + "%";
            }, false);

            const progressBar = document.getElementById("mid");
            progressBar.addEventListener("click", function(e) {
                player.currentTime = (e.offsetX / this.offsetWidth) * player.duration;
                if (player.paused || player.ended) {
                    player.play();
                    document.getElementById("left").style.backgroundImage = "url('ply0.png')";
                }
            });

            player.addEventListener("ended", function() {
                document.getElementById("left").style.backgroundImage = "url('ply0.png')";
            });

            document.getElementById("video_controls").style.display = "block";
        </script>
    </div>
</body>
</html>
