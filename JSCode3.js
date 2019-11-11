// by Chtiwi Malek on CODICODE.COM  ccccccc
var mousePressed = false;
var lastX, lastY;
var ctx;
var x = 0;
var y = 0;
var x1 = 0;
var y1 = 0;
var x2 = 0;
var y2 = 0;
var lastX = 0;
var lastY = 0;
var touch1 = 0;
var touch = 0;
var img;

function InitThis() {

  var link_to_confirmation;
  var spl_file_name
  spl_file_name = document.getElementById("spl_file_name").innerHTML ;
  var mypath = "./spl/Produkcja/"+spl_file_name;
  showPDF(mypath);
  
  ctx = document.getElementById("myCanvas").getContext("2d");

  $("#myCanvas").mousedown(function(e) {
    mousePressed = true;
    Draw(
      e.pageX - $(this).offset().left,
      e.pageY - $(this).offset().top,
      false
    );
  });

  $("#myCanvas").mousemove(function(e) {
    if (mousePressed) {
      Draw(
        e.pageX - $(this).offset().left,
        e.pageY - $(this).offset().top,
        true
      );
    }
  });

  $("#myCanvas").mouseup(function(e) {
    mousePressed = false;
  });

  $("#myCanvas").mouseleave(function(e) {
    mousePressed = false;
  });

  var box3 = document.getElementById("myCanvas");
  box3.addEventListener("touchstart", function(e) {
    e.preventDefault();
    touch1 = e.targetTouches[0];
    var elml_Left1 = box3.offsetLeft;
    var elml_Top1 = box3.offsetTop;
    x2 = e.touches[0].clientX - elml_Left1;
    y2 = e.touches[0].clientY - elml_Top1;
    lastX = x2;
    lastY = y2;
  });

  box3.addEventListener("touchmove", function(e) {
    e.preventDefault();
    ctx = document.getElementById("myCanvas").getContext("2d");
    touch = e.targetTouches[0];
    var elml_Left = box3.offsetLeft;
    var elml_Top = box3.offsetTop;
    x = touch.clientX - elml_Left - window.pageXOffset;
    y = touch.clientY - elml_Top - window.pageYOffset;
    if (x < $(this).width() && x > 0) {
      if (y < $(this).height() && y > 0) {
        //CODE GOES HERE
        console.log(touch.pageY + " " + touch.pageX);
        if (e.targetTouches.length == 1) {
          Draw1(x, y, true);
        }
      }
    }
  });
} //koniec load

function Draw(x, y, isDown) {
  if (isDown) {
    ctx.beginPath();
    ctx.strokeStyle = $("#selColor").val();
    ctx.lineWidth = $("#selWidth").val();
    ctx.lineJoin = "round";
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(x, y);
    ctx.closePath();
    ctx.stroke();
  }
  lastX = x;
  lastY = y;
}

function Draw1(x, y, isDown) {
  if (isDown) {
    ctx.beginPath();
    ctx.strokeStyle = $("#selColor").val();
    ctx.lineWidth = $("#selWidth").val();
    ctx.lineJoin = "round";
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(x, y);
    ctx.closePath();
    ctx.stroke();
  }
  lastX = x;
  lastY = y;
}

function clearArea() {
  // Use the identity matrix while clearing the canvas
  ctx.setTransform(1, 0, 0, 1, 0, 0);
  ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}

function myclearArea1() {

  html2canvas($("#mypdf"), {
    onrendered: function(canvas) {
      saveAs(canvas.toDataURL(), 'file-name.png');
    }
  });
}

function saveAs(uri, filename) {

  var link = document.createElement('a');

  if (typeof link.download === 'string') {

      link.href = uri;
      link.download = filename;
      //Firefox requires the link to be in the body
      document.body.appendChild(link);
      //simulate click
      link.click();
      //remove the link when done
      document.body.removeChild(link);
  } else {
      window.open(uri);
  }
}
 //save pdf
 function takeScreenShot() {
    html2canvas(document.getElementById("mypdf"), {
      useCORS: true,  
      onrendered: function (canvas) {
        n = GetFormatDate();
        document.getElementById("epochdate").innerHTML = n;
        var sesa = document.getElementById("sesa").innerHTML ;
        var podkreslenie ="_";
        var pdfpath=document.getElementById("spl_file_name").innerHTML ;
        var pdfpath2= pdfpath.slice(0, -4); 
        var link_to_confirmation=pdfpath2+podkreslenie+sesa+podkreslenie+String(n);
        document.getElementById("link_to_confirmation").innerHTML=link_to_confirmation;
          img = canvas.toDataURL("image/png");
                var pdf = new jsPDF("p", "pt", "letter");
                pdf.addImage(img, "JPEG", 5, 5);
                pdf.save(link_to_confirmation);
        },
        width:1220,
        height:1920
    });
}

function GetFormatDate() {
  var todayTime = new Date();
  var month = todayTime .getMonth() + 1;
  var day = todayTime .getDate();
  var year =todayTime .getFullYear();
  return year + "-" + month + "-" + day;
}