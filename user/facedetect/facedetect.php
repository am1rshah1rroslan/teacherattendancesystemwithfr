<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Teacher Attendance</title>
  <script defer src="face-api.min.js"></script>
  <script defer src="script.js"></script>
 
  <style>
    body {
      background-color: blanchedalmond;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    canvas {
      position: absolute;
      top: 75px;
      right: 450px;
    }

    .textareasize {
      resize: none;
      width: 500px; 
      height: 30px;
    }
    .textarea2 {
      resize: none;
      width: 500px; 
      height: 80px;
    }
    .square {
      margin:auto;
      text-align:center;
      height: 10px;
      width: 300px;
      background-color: red;
    }

    .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }
        .loader {            
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255, 255, 255, 0.2);
            border-right: 1.1em solid rgba(255, 255, 255, 0.2);
            border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
            border-left: 1.1em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        #loadingDiv {
            position:fixed;;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color:grey;
        }

  </style>
</head>
<body>
  <h1>PLEASE SCAN YOUR FACE FOR ATTENDANCE</h1>
  <div id="status" class="square"></div>
  <video id="video" width="600" height="400" muted controls></video>
  <br>
  <br>
  <br>
  <textarea id="notiCountdown" class="textareasize"></textarea>
  <br>
  <textarea id="notiOutput" class="textarea2"></textarea>
  <br>
  <a href="#" onclick="history.go(-1)">GO BACK</a>
  <script>

    if (document.getElementById("notiOutput").value != null)
    {
      setInterval(
      function() {
        document.getElementById("notiOutput").value = "";
      }, 10000);
    }

  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
    $(window).on('load', function(){
      setTimeout(removeLoader, 15000); //wait for page load PLUS two seconds.
    });
    function removeLoader(){
        $( "#loadingDiv" ).fadeOut(500, function() {
          // fadeOut complete. Remove the loading div
          $( "#loadingDiv" ).remove(); //makes page more lightweight 
      });  
    }
  </script>
</body>


</html>