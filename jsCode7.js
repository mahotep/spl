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
    alert ("head1");
    //takeScreenShot() ;
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

    alert ("head2");

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

  var __PDF_DOC,
  __CURRENT_PAGE,
  __TOTAL_PAGES,
  __PAGE_RENDERING_IN_PROGRESS = 0,
  __CANVAS = $('#pdf-canvas').get(0),
  __CANVAS_CTX = __CANVAS.getContext('2d');

    function showPDF(pdf_url) {
        $("#pdf-loader").show();

        PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
            __PDF_DOC = pdf_doc;
            __TOTAL_PAGES = __PDF_DOC.numPages;
            
            // Hide the pdf loader and show pdf container in HTML
            $("#pdf-loader").hide();
            $("#pdf-contents").show();
            $("#pdf-total-pages").text(__TOTAL_PAGES);

            // Show the first page
            showPage(1);
        }).catch(function(error) {
            // If error re-show the upload button
            $("#pdf-loader").hide();
            $("#upload-button").show();
            
            alert(error.message);
        });;
    }

    function showPage(page_no) {
        __PAGE_RENDERING_IN_PROGRESS = 1;
        __CURRENT_PAGE = page_no;

        // Disable Prev & Next buttons while page is being loaded
        $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

        // While page is being rendered hide the canvas and show a loading message
        $("#pdf-canvas").hide();
        $("#page-loader").show();
        $("#download-image").hide();

        // Update current page in HTML
        $("#pdf-current-page").text(page_no);
        
        // Fetch the page
        __PDF_DOC.getPage(page_no).then(function(page) {
            // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
            var scale_required = __CANVAS.width / page.getViewport(1).width;

            // Get viewport of the page at required scale
            var viewport = page.getViewport(scale_required);

            // Set canvas height
            __CANVAS.height = viewport.height;

            var renderContext = {
                canvasContext: __CANVAS_CTX,
                viewport: viewport
            };
            
            // Render the page contents in the canvas
            page.render(renderContext).then(function() {
                __PAGE_RENDERING_IN_PROGRESS = 0;

                // Re-enable Prev & Next buttons
                $("#pdf-next, #pdf-prev").removeAttr('disabled');

                // Show the canvas and hide the page loader
                $("#pdf-canvas").show();
                $("#page-loader").hide();
                $("#download-image").show();
            });
        });
    }

    // Upon click this should should trigger click on the #file-to-upload file input element
    // This is better than showing the not-good-looking file input element
    $("#upload-button").on('click', function() {
    $("#file-to-upload").trigger('click');
    });

    // When user chooses a PDF file
    $("#file-to-upload").on('change', function() {
    // Validate whether PDF
    if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }

    $("#upload-button").hide();

    // Send the object url of the pdf
    showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
    });

    // Previous page of the PDF
    $("#pdf-prev").on('click', function() {
    if(__CURRENT_PAGE != 1)
        showPage(--__CURRENT_PAGE);
    });

    // Next page of the PDF
    $("#pdf-next").on('click', function() {
    if(__CURRENT_PAGE != __TOTAL_PAGES)
        showPage(++__CURRENT_PAGE);
    });

    // Download button
    $("#download-image").on('click', function() {
    $(this).attr('href', __CANVAS.toDataURL()).attr('download', 'page.png');
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

