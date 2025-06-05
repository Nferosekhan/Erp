<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barcode Generator</title>
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      padding: 20px;
    }
    .container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }
    .barcode-preview {
      margin-top: 20px;
      text-align: center;
    }
    canvas {
      border: 1px solid #ddd;
      padding: 10px;
    }
    button {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #d32f2f;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      font-size: 14px;
    }
    input[type="text"], select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .barcode-label {
      font-size: 14px;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <style>
    #scanner-container {
      width: 100%;
      max-width: 480px;
      height: 320px;
      margin-top: 20px;
      border: 1px solid #ccc;
      display: none;
    }
    #barcode-result {
      font-size: 18px;
      margin-top: 10px;
    }
  </style>
  
 <h2>Barcode Scanner</h2>
  
  <!-- Button to start scanning -->
  <button id="start-scan" type="button">Start Scanning</button>
  
  <!-- Video container for barcode scanning -->
  <div id="scanner-container"></div>

  <!-- Result display -->
  <p>Detected Barcode: <span id="barcode-result">None</span></p>

  <script>
    // Function to start barcode scanning
    function startBarcodeScanner() {
      Quagga.init({
        inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#scanner-container'), // Scanning container
          constraints: {
            width: 480,
            height: 320,
            facingMode: "environment" // Use rear camera if available
          }
        },
        decoder: {
          readers: [
            "code_128_reader",  // Supports various barcode types
            "ean_reader",
            "ean_8_reader",
            "code_39_reader",
            "upc_reader",
            "upc_e_reader",
            "codabar_reader"
          ]
        }
      }, function(err) {
        if (err) {
          console.error(err);
          return;
        }
        Quagga.start();
        document.getElementById('scanner-container').style.display = 'block'; // Show scanner
      });

      // Detect barcode and display result
      Quagga.onDetected(function(result) {
        var code = result.codeResult.code;
        document.getElementById('barcode-result').textContent = code;
        console.log('Barcode detected:', code);

        // Stop scanning once barcode is detected
        Quagga.stop();
        document.getElementById('scanner-container').style.display = 'none'; // Hide scanner
      });
    }

    // Invoke the scanner when the button is clicked
    document.getElementById('start-scan').addEventListener('click', function() {
      startBarcodeScanner();
    });
  </script>
  <div class="container">
    <h2>Free Barcode Generator</h2>
    <form id="barcode-form">
      <!-- Barcode Type Selection -->
      <div class="form-group">
        <label for="barcode-type">Barcode type *</label><br>
        <select id="barcode-type">
          <option value="code128">Code-128</option>
          <option value="EAN13">EAN-13</option>
          <option value="UPC">UPC</option>
          <option value="code39">Code-39</option>
        </select>
      </div>

      <!-- Barcode Data Input -->
      <div class="form-group">
        <label for="barcode-data">Barcode data *</label>
        <input type="text" id="barcode-data" placeholder="Enter barcode data" required>
      </div>

      <!-- Include Barcode Title -->
      <div class="form-group">
        <label for="barcode-title">Include barcode title</label>
        <input type="text" id="barcode-title" placeholder="Enter barcode title">
      </div>

      <!-- Include Barcode Title -->
      <div class="form-group">
        <label for="barcode-branch">Include barcode branch</label>
        <input type="text" id="barcode-branch" placeholder="Enter barcode branch">
      </div>

      <!-- Include Barcode Note -->
      <div class="form-group">
        <label for="barcode-note">Include barcode note</label>
        <input type="text" id="barcode-note" placeholder="Enter barcode note">
      </div>

    <!-- Save Type Selection -->
    <div class="form-group">
      <label for="save-type">Save as:</label>
      <select id="save-type">
        <option value="png">PNG</option>
        <option value="jpg">JPG</option>
        <option value="svg">SVG</option>
      </select>
    </div>

      <!-- Generate Barcode Button -->
      <button type="button" id="generate-barcode">Generate Barcode</button>
    </form>

    <!-- Barcode Preview -->
    <div class="barcode-preview">
      <div class="barcode-label" id="barcode-title-label"></div>
      <div class="barcode-label" id="barcode-branch-label"></div>
      <svg id="barcode"></svg>
      <div class="barcode-label" id="barcode-note-label"></div>
    </div>

    <!-- Download Barcode Button -->
    <button id="download-barcode">Download Barcode</button>
  </div>

  <script>
  // Function to generate the barcode
  function generateBarcode() {
    var barcodeType = document.getElementById('barcode-type').value;
    var barcodeData = document.getElementById('barcode-data').value;
    var barcodeTitle = document.getElementById('barcode-title').value || null;
    var barcodeBranch = document.getElementById('barcode-branch').value || null;
    var barcodeNote = document.getElementById('barcode-note').value || null;

    if (barcodeData) {
      JsBarcode("#barcode", barcodeData, {
        format: barcodeType,
        lineColor: "#000",
        width: 2,
        height: 100,
        displayValue: true,
      });

      // Set the barcode title, branch, and note as text above and below the barcode
      document.getElementById('barcode-title-label').textContent = barcodeTitle ? barcodeTitle : '';
      document.getElementById('barcode-branch-label').textContent = barcodeBranch ? barcodeBranch : '';
      document.getElementById('barcode-note-label').textContent = barcodeNote ? barcodeNote : '';
    }
  }

  // Generate the barcode when the button is clicked
  document.getElementById('generate-barcode').addEventListener('click', function () {
    generateBarcode();
  });

  // Download the barcode as an image (PNG, JPG, SVG)
  document.getElementById('download-barcode').addEventListener('click', function () {
    var svg = document.getElementById('barcode');
    var svgData = new XMLSerializer().serializeToString(svg);
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext("2d");
    var img = new Image();

    // Barcode title, branch, and note values
    var barcodeTitle = document.getElementById('barcode-title').value || '';
    var barcodeBranch = document.getElementById('barcode-branch').value || '';
    var barcodeNote = document.getElementById('barcode-note').value || '';

    // Get the selected save type (png, jpg, svg)
    var saveType = document.getElementById('save-type').value;

    img.onload = function () {
      // Set canvas dimensions to accommodate the title, barcode, branch, and note
      var canvasWidth = img.width;
      var canvasHeight = img.height + 100; // Extra space for title, branch, and note
      canvas.width = canvasWidth;
      canvas.height = canvasHeight;

      // Clear the canvas and set background color to white
      ctx.fillStyle = "#fff";
      ctx.fillRect(0, 0, canvasWidth, canvasHeight);

      // Draw the barcode title at the top
      ctx.font = "16px Arial";
      ctx.fillStyle = "#000";
      ctx.textAlign = "center";
      if (barcodeTitle) {
        ctx.fillText(barcodeTitle, canvasWidth / 2, 20);
      }

      // Draw the barcode branch below the title
      if (barcodeBranch) {
        ctx.fillText(barcodeBranch, canvasWidth / 2, 40);
      }

      // Draw the barcode in the center
      ctx.drawImage(img, 0, 60);

      // Draw the barcode note at the bottom
      if (barcodeNote) {
        ctx.fillText(barcodeNote, canvasWidth / 2, canvasHeight - 10);
      }

      // Create a link and trigger download based on the selected format
      if (saveType === 'png' || saveType === 'jpg') {
        var imgFile = canvas.toDataURL("image/" + saveType);
        var link = document.createElement('a');
        link.download = 'barcode.' + saveType;
        link.href = imgFile;
        link.click();
      } else if (saveType === 'svg') {
        var link = document.createElement('a');
        link.download = 'barcode.svg';
        link.href = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
        link.click();
      }
    };

    img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
  });
  </script>

</body>
</html>
<!---
  function generateBarcode() {
    var content = "<?=$info['barcode']?>";
    var format = "<?=$info['barcodeformat']?>";
    var barcodetitle = "<?=$info['barcodetitle']?>";
    var barcodenotes = "<?=$info['barcodenotes']?>";

    JsBarcode("#barcodeleft", content, {
      format: format,
      width: 3,
      height: 90,
      textAlign: "center",
      displayValue: true
    });
    document.getElementById('barcodeleft').style.display = 'none';
  }

  function downloadBarcode() {
    generateBarcode();

    // Create a canvas for the combined image
    var canvas = document.createElement("canvas");
    canvas.width = 189; // Total width: 189 (left) + 189 (right)
    canvas.height = 130; // Height remains the same

    var ctx = canvas.getContext("2d");

    // Draw the left barcode
    var leftSvg = document.getElementById('barcodeleft');
    var leftSvgData = new XMLSerializer().serializeToString(leftSvg);
    var leftImg = new Image();
    leftImg.onload = function() {
      ctx.drawImage(leftImg, 0, 0);

        // Convert the canvas to PNG and download
        var pngFile = canvas.toDataURL("image/png");
        var downloadLink = document.createElement("a");
        downloadLink.href = pngFile;
        downloadLink.download = "<?=$info['barcode']?>.png";
        downloadLink.click();

    };

    // Set the source for the left image
    leftImg.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(leftSvgData)));
  }

  generateBarcode();
  --->