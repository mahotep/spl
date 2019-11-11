<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="./pdf/pdf.js"></script>
<script src="./pdf/pdf.worker.js"></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
      integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="./html2canvas.js"></script>
    <script type="text/javascript" src="./JsCode3.js"></script>
	<script>
		//save pdf
		window.takeScreenShot = function() {
    html2canvas(document.getElementById("mypdf"), {
        onrendered: function (canvas) {
          img = canvas.toDataURL("image/png");
                var pdf = new jsPDF("p", "pt", "letter");
                pdf.addImage(img, "JPEG", -5, 0);
                pdf.save("test.pdf"); 
            //document.body.appendChild(canvas);
        },
        width:1220,
        height:1920
    });
}
	</script>
</head>

<body onload="InitThis();">
<div id="mypdf"> 
<?php
          echo "<h2> Potwierdzenie szkolenia</h2>";
          $zm = $_GET['a'];
          require "connection.php";
          connection();
          if($result = mysqli_query($link,"select DISTINCT * from spl_all_spls WHERE id='$zm'  ")){
            while($row = mysqli_fetch_assoc($result)) {
                $val4 = $row['title'];
                
            }
          }
    
      ?>

		<div>
          <p >Tytuł : <?php echo $val4; ?>
		</div> 

	<div id="pdf-main-container">
		<div id="pdf-loader">Loading document ...</div>
		<div id="pdf-contents">
			<canvas id="pdf-canvas" width="400"></canvas>
			<div id="page-loader">Loading page ...</div>
		</div>
	</div>
	<h2> Podpis elektroniczny</h2>

    <div id="mypdf2">
      <canvas
        id="myCanvas"
        width="540"
        height="260"
        style="border:2px solid black;margin:20px;"
      ></canvas>
      
      <br />
      <button onclick="javascript:myclearArea1();return false;">
        Zapisz do PNG
      </button>
      <button onclick="takeScreenShot()">to pdf</button>
      
      <br />
      <button onclick="javascript:clearArea();return false;">Clear Area</button>
      Line width :
      <select id="selWidth">
        <option value="1">1</option>
        <option value="3" selected="selected">3</option>
        <option value="5">5</option>
        <option value="7">7</option>
        <option value="9" >9</option>
        <option value="11">11</option>
      </select>
      Color :
      <select id="selColor">
        <option value="black">black</option>
        <option value="blue" selected="selected">blue</option>
        <option value="red">red</option>
        <option value="green">green</option>
        <option value="yellow">yellow</option>
        <option value="gray">gray</option>
      </select>
    </div>
    <br>
  </div>
<script>

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

</script>
 </div> 
</body>
</html>