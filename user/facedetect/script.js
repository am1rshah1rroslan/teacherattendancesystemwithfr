const video = document.getElementById('video')
const labels = []
const nameDate = []

Promise.all([
  getTeacherName(),
  checkTeacher(),
  faceapi.nets.faceRecognitionNet.loadFromUri('models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
  faceapi.nets.faceExpressionNet.loadFromUri('models')
]).then(startVideo)

function startVideo() {
  navigator.getUserMedia(
      { video:{} },
      stream => video.srcObject = stream,
      err => console.error(err)
  )
  
  console.log('video added')
  document.getElementById("status").style.backgroundColor ='green';
  recognizeFaces()
}

async function recognizeFaces() {
  const labeledDescriptors = await loadLabeledImages()
  console.log(labeledDescriptors)
  const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.53)

  var newDate = new Date().toLocaleDateString('en-CA', {
    day : 'numeric',
    month : 'numeric',
    year : 'numeric'
  }).split(' ').join('-')

  var verifyName = ""
  var count = 0
  var indicator = []
  var tryCompare = ""
  var newStatus = 0
  var smileStatus = 0

  video.addEventListener('play', async () => {
      console.log('Playing')
      const canvas = faceapi.createCanvasFromMedia(video)
      document.body.append(canvas)

      const displaySize = { width: video.width, height: video.height }
      faceapi.matchDimensions(canvas, displaySize)

      const myinterval = setInterval(async () => {
          const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors().withFaceExpressions()

          const resizedDetections = faceapi.resizeResults(detections, displaySize)

          canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

          const results = resizedDetections.map((d) => {
            const mukaSiapa = faceMatcher.findBestMatch(d.descriptor);
            const senyum = resizedDetections[0].expressions.happy;
            return [mukaSiapa, senyum];
          })
          results.forEach( (result, i) => {
              const box = resizedDetections[i].detection.box
              const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
              faceapi.draw.drawFaceExpressions(canvas, resizedDetections)
        
              //**********************************************************************************************************
              //This part for extract detected faced name by using variable result
              //System also will compare each second either it same name or not. If not, it will reset the count
              //**********************************************************************************************************
              var passR = String(results[0]).split('(')[0]//separate name from string
              var smileDetect = String(results[0]).split(',')[1]//separate facial expression score from string
              
              if(verifyName != passR) 
              {
                count = 0
              }
              
              verifyName = passR
              count++

              //**********************************************************************************************************
              //This part for condition if system detect same face for specific period.
              //By default: 4 seconds
              //**********************************************************************************************************
              if(count == 4 && verifyName == passR && verifyName == "unknown ") // Adjust the count variable for timing
              {
                count = 0
                document.getElementById("notiOutput").value = "";
                document.getElementById("notiOutput").value = "Sorry, Your face is not in the database" + "\n" + "Please report this to your IT Officer";

              } 
              else if(count == 4 && verifyName == passR && verifyName != "unknown ")
              {
                
                count = 0
                indicator.length = 0
                
                if(nameDate.length == 0)
                {
                  nameDate.push([passR,newDate])
                  sendAttendace(passR)
                }
                else if(nameDate.length != 0)
                {
                  for(var x = 0; x < nameDate.length; x++)
                  {
                    tryCompare = (passR+","+newDate)

                    if(tryCompare == nameDate[x])
                    {
                      var varNoti = "Exist"
                      indicator.push([varNoti])
                    } 
                    else if(tryCompare != nameDate[x])
                    {
                      var varNoti = "NotExist"
                      indicator.push([varNoti])
                    } 
                  }

                  //**********************************************************************************************************
                  //This part to check array in indicator if there data with value "Ada"
                  //**********************************************************************************************************
                  newStatus = 0
                  
                  for(var varLoop = 0; varLoop < indicator.length; varLoop++)
                  {
                    if(indicator[varLoop] == "Exist")
                    {
                      newStatus = 1
                    }
                  }

                  //**********************************************************************************************************
                  //This part will compare newStatus either the data already in the DB or not.
                  //If exist in database, it will show notification
                  //If not exist in database, it will use function sendAttance
                  //**********************************************************************************************************
                  if(newStatus == 1)
                  {
                    document.getElementById("notiOutput").value = "";
                    document.getElementById("notiOutput").value = "Your attendance has been taken for today, THANK YOU!";
                  }
                  else if(newStatus == 0 && parseFloat(smileDetect)>=0.9) //face authenticator here
                  {
                    if(smileStatus == 1 && parseFloat(smileDetect)>=0.9)
                    {
                      nameDate.push([passR,newDate])
                      sendAttendace(passR)
                      smileStatus = 0;
                    }
                    else
                    {
                      document.getElementById("notiOutput").value = "";
                      document.getElementById("notiOutput").value = "Make sure your face is in natural state!";
                      smileStatus = 0;
                    }
                    
                  }

                  else if (newStatus == 0 && parseFloat(smileDetect)<0.9)
                  {
                    document.getElementById("notiOutput").value = "";
                    document.getElementById("notiOutput").value = "SMILE FOR 3 SECONDS!";
                    document.getElementById("notiOutput").innerHTML = "<span style='font-size:40px;'>&#128516</span>";
                    smileStatus = 1;
                  }

                }

              }
              else 
              {
                document.getElementById("notiCountdown").value = "Your face is beind scanned in " + (4-count) + " second."+ "\n";
              }
              
              drawBox.draw(canvas)
          })
      }, 1000)
      
  })
}


//registered images will be trained in this function
//change i value to the number of images to be trained
function loadLabeledImages() {
  
  return Promise.all(
      labels.map(async (label)=>{
          const descriptions = []
          for(let i=1; i<=5; i++) {
              const img = await faceapi.fetchImage(`http://localhost/attendance/user/facedetect/labeled_images/${label}/${i}.jpg`)
              const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor().withFaceExpressions()
              console.log(label + i + JSON.stringify(detections))
              descriptions.push(detections.descriptor)
          }
          
          return new faceapi.LabeledFaceDescriptors(label, descriptions)
      })
  )
}

//Send attendance to DB
function sendAttendace(attendName) {

  var ajax = new XMLHttpRequest()
  var method = "GET"
  var url = "sendAttendance.php?"
  var asynchronous = true
  const dateForAttend = new Date()

  var newDate = dateForAttend.getFullYear()+"-"+(dateForAttend.getMonth()+1)+"-"+dateForAttend.getDate()
  var newTime = dateForAttend.getHours()+":"+dateForAttend.getMinutes()+":"+dateForAttend.getSeconds()

  ajax.open(method, url+"name="+attendName+"&nDate="+newDate+"&nTime="+newTime, asynchronous)

  ajax.onreadystatechange = function() {//Call a function when the state changes.
    if(ajax.readyState == 4 && ajax.status == 200) {
      document.getElementById("notiOutput").value = "";
      document.getElementById("notiOutput").value = "Attendance RECORDED!"+ "\n" + "Name: " + attendName + "\n"+ "Date: "+ newDate + "\n" + "Time: "+ newTime;
    }
  }
  ajax.send()
}

//**********************************************************************************************************
//This part to get DB to array for compare asyncronously in the system
//**********************************************************************************************************
function checkTeacher() 
{
  var ajax = new XMLHttpRequest()
  var method = "GET"
  var url = "checkExist.php?"
  var asynchronous = true

  ajax.open(method, url, asynchronous)
  ajax.send()
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState === 4)
    {
      if(ajax.status === 200)
      {
        var data = JSON.parse(ajax.responseText)

        for(var a = 0; a < data.length; a++)
        {
          nameDate.push([data[a].teacherName,data[a].attendanceDate]) 
        }
      }
    }
  }
}

//**********************************************************************************************************
//This part to get teacher name from DB for system requirement
//**********************************************************************************************************
function getTeacherName() 
{
  var ajax = new XMLHttpRequest()
  var method = "GET"
  var url = "data.php"
  var asynchronous = true

  ajax.open(method, url, asynchronous)
  ajax.send()
  
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState === 4)
    {
      if(ajax.status === 200)
      {
        var data = JSON.parse(ajax.responseText)

        for(var a = 0; a < data.length; a++)
        {
          labels.push(data[a].teacherName)
        }
      }
    }
  }
}
