<?php
include('lcheck.php');
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Reports' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd-m-Y';
}
$sqlbranch=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$branch=mysqli_fetch_array($sqlbranch);
if (isset($_POST['submitcustomizes'])) {
  $dates = mysqli_real_escape_string($con,(isset($_POST['date']))?'1':'0');
  $numbers = mysqli_real_escape_string($con,(isset($_POST['number']))?'1':'0');
  $names = mysqli_real_escape_string($con,(isset($_POST['name']))?'1':'0');
  $grandtotals = mysqli_real_escape_string($con,(isset($_POST['grandtotal']))?'1':'0');
  $sqlreport = mysqli_query($con,"update pairreports set dates='$dates',numbers='$numbers',names='$names',totals='$grandtotals' where createdid='$companymainid'");
    $csvMimes= array('application/vnd.ms-excel','text/plain','text/csv');
  if(!empty($_FILES['products'] ['name']) && in_array($_FILES['products'] ['type'], $csvMimes)){
    if(is_uploaded_file($_FILES['products'] ['tmp_name'])){
      $csvFile=fopen($_FILES['products'] ['tmp_name'],'r');
      fgetcsv($csvFile);
      $lines=[];
      while(($line=fgetcsv($csvFile))!==FALSE){
        $lines[]="('{$line[0]}','{$line[1]}','{$line[2]}','{$line[3]}','{$line[4]}','{$line[5]}')";
      }
        $sql="INSERT INTO pairproducts(id,productcode,productname,hsncode,intratax,intertax) VALUES ";
      $sql.=implode(",",$lines);
        $result=mysqli_query($con,$sql);
        if($result){
          // $success="products Upload Success";
        }
    else{
          die('error');
    }
    }
  }
  else{
    // $all="invalid products type";
  }
  $csvMimes= array('application/vnd.ms-excel','text/plain','text/csv');
  if(!empty($_FILES['customers'] ['name']) && in_array($_FILES['customers'] ['type'], $csvMimes)){
    if(is_uploaded_file($_FILES['customers'] ['tmp_name'])){
      $csvFile=fopen($_FILES['customers'] ['tmp_name'],'r');
      fgetcsv($csvFile);
      $lines=[];
      while(($line=fgetcsv($csvFile))!==FALSE){
        $lines[]="('{$line[0]}','{$line[1]}','{$line[2]}','{$line[3]}','{$line[4]}','{$line[5]}','{$line[6]}','{$line[7]}','{$line[8]}','{$line[9]}','{$line[10]}','{$line[11]}','{$line[12]}','{$line[13]}','{$line[14]}','{$line[15]}','{$line[16]}')";
      }
        $sql="INSERT INTO paircustomers(id,moduletype,customercode,primarysalutation,customername,billstreet,billcity,mobile,billpincode,email,billstate,billcountry,website,gstrtype,gstin,placeos,workphone) VALUES ";
      $sql.=implode(",",$lines);
        $result=mysqli_query($con,$sql);
        if($result){
          // $success="customers Upload Success";
        }
    else{
          die('error');
    }
    }
  }
  else{
    // $all="invalid customers type";
  }
  $csvMimes= array('application/vnd.ms-excel','text/plain','text/csv');
  if(!empty($_FILES['prosale'] ['name']) && in_array($_FILES['prosale'] ['type'], $csvMimes)){
    if(is_uploaded_file($_FILES['prosale'] ['tmp_name'])){
      $csvFile=fopen($_FILES['prosale'] ['tmp_name'],'r');
      fgetcsv($csvFile);
      $lines=[];
      while(($line=fgetcsv($csvFile))!==FALSE){
        $lines[]="('{$line[0]}','{$line[1]}')";
      }
        $sql="INSERT INTO pairprosale(productid,salemrp) VALUES ";
      $sql.=implode(",",$lines);
        $result=mysqli_query($con,$sql);
        if($result){
          // $success="prosale Upload Success";
        }
    else{
          die('error');
    }
    }
  }
  else{
    // $all="invalid prosale type";
  }
  header("Location:reportviews.php");
}
$sqlreportview = mysqli_query($con,"select * from pairreports where createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
?>
<html>
    <head>
        
    </head>
    <body>
        <button onclick="generate()">Generate PDF</button>
<?php
$invfrom = mysqli_real_escape_string($con, $_GET['invfrom']);
$invto = mysqli_real_escape_string($con, $_GET['invto']);
?>
<input type="hidden" name="invfrom" id="invfrom" value="<?= $invfrom ?>">
<input type="hidden" name="invto" id="invto" value="<?= $invto ?>">
<table id="basic-table" style="display: none;">
  <thead>
    <tr>
<td class="text-uppercase" style="text-align: left !important;border:1px solid #eee;padding-left: 10px;"><span style="font-size:12px;color:black;"> GSTIN/UIN</span></td>
<td class="text-uppercase" style="text-align: left !important;border:1px solid #eee;padding-left: 10px;"><span style="font-size:12px;color:black;"> INVOICE DATE</span></td>
<td class="text-uppercase" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="font-size:12px;color:black;"> REVERSE CHARGE</span></td>
<td class="text-uppercase" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="font-size:12px;color:black;"> TAXABLE Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="font-size:12px;color:black;"> IGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="font-size:12px;color:black;"> CGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="font-size:12px;color:black;"> SGST Amount</span></td>
<!-- <td class="text-uppercase" style="text-align: right !important;"><span style="font-size:13px;color:black;"> CESS AMOUNT </span></td> -->
</tr>
  </thead>
  <tbody>
      <?php
$sql=mysqli_query($con, "select customername,gstno,pos,invoiceno,grandtotal,invoicedate,productvalue,sum(cgst25) as cgst25,sum(cgst6) as cgst6,sum(cgst9) as cgst9,sum(cgst14) as cgst14,sum(sgst25) as sgst25,sum(sgst6) as sgst6,sum(sgst9) as sgst9,sum(sgst14) as sgst14,sum(gst25) as igst25,sum(gst6) as igst6,sum(gst9) as igst9,sum(gst14) as igst14 from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and gstrtype='Registered Business - Regular' and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."') GROUP BY invoicedate, invoiceno order by invoicedate asc, invoiceno desc");
while($info=mysqli_fetch_array($sql))
{
?>
   <tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;">
<?=substr($info['customername'], 0, 15)?>
<br>
<?=$info['gstno']?>
<br>
Place of Supply : <?=$info['pos']?>
<br>
Invoice Number : <?=$info['invoiceno']?>
<br>
Amount : <?=number_format((float)$info['grandtotal'],2,'.','')?>
</td>
<td data-label="INVOICE DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;">
<?=$info['invoicedate']?>
</td>
<td data-label="REVERSE CHARGE" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"></td>
<td data-label="TAXABLE AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=number_format((float)$info['productvalue'],2,'.','')?>
</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=number_format((float)$info['igst25'],2,'.','')?>
<br>
<?=number_format((float)$info['igst6'],2,'.','')?>
<br>
<?=number_format((float)$info['igst9'],2,'.','')?>
<br>
<?=number_format((float)$info['igst14'],2,'.','')?>
</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=number_format((float)$info['cgst25'],2,'.','')?>
<br>
<?=number_format((float)$info['cgst6'],2,'.','')?>
<br>
<?=number_format((float)$info['cgst9'],2,'.','')?>
<br>
<?=number_format((float)$info['cgst14'],2,'.','')?>
</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">
<?=number_format((float)$info['sgst25'],2,'.','')?>
<br>
<?=number_format((float)$info['sgst6'],2,'.','')?>
<br>
<?=number_format((float)$info['sgst9'],2,'.','')?>
<br>
<?=number_format((float)$info['sgst14'],2,'.','')?>
</td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
   
  </tbody>
</table>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/simonbengtsson/jsPDF@requirejs-fix-dist/dist/jspdf.debug.js"></script>
<script type="text/javascript" src="https://unpkg.com/jspdf-autotable@2.3.2/dist/jspdf.plugin.autotable.js"></script>
<script>
    /*function generate() {
 (function(API){
    API.myText = function(txt, options, x, y) {
        options = options ||{};
        if( options.align == "center" ){
            // Get current font size
            var fontSize = this.internal.getFontSize();

            // Get page width
            var pageWidth = this.internal.pageSize.width;

            // Get the actual text's width
            txtWidth = this.getStringUnitWidth(txt)*fontSize/this.internal.scaleFactor;

            // Calculate text's x coordinate
            x = ( pageWidth - txtWidth ) / 2;
        }

        // Draw text at x,y
        this.text(txt,x,y);
    }
})(jsPDF.API);
  var doc = new jsPDF('p',  'pt');

  var res = doc.autoTableHtmlToJson(document.getElementById("basic-table"));
  // doc.autoTable(res.columns, res.data, {margin: {top: 60,bottom: 30}, styles : { halign : 'center',fillColor: [255,255,255],lineColor: [204, 204, 204], lineWidth: 0.1}, headStyles :{fillColor : [255, 255, 255]}, alternateRowStyles: {fillColor : [255, 255, 255]}, tableLineColor: [204, 204, 204], tableLineWidth: 0.1,theme: 'plain'});

  var header = function(data) {
    doc.setFontSize(15);
    doc.setTextColor(40);
    doc.setFontStyle('normal');
    //doc.addImage(headerImgData, 'JPEG', data.settings.margin.left, 20, 50, 50);
    var pageCount = doc.internal.getNumberOfPages(); //Total Page Number
for(i = 0; i < pageCount; i++) { 
  doc.setPage(i); 
    doc.myText("franchisename", {align: "center"}, 15,15);
    doc.myText("Registered", {align: "center"}, 30,30);
    // var fromtopdf = document.getElementById("datefromto").innerHTML;
    doc.myText("fromtopdf", {align: "center"}, 45,45);
  let pageCurrent = doc.internal.getCurrentPageInfo().pageNumber; //Current Page
  doc.setFontSize(13);
  doc.myText('Page: ' + pageCurrent + ' of ' + pageCount,{align: "center"}, data.settings.margin.left+213, doc.internal.pageSize.height - 10);
}
  };

  var options = {
    theme: 'plain',
     styles : { halign : 'center',fillColor: [255,255,255],lineColor: [204, 204, 204], lineWidth: 0.1},
      headStyles :{fillColor : [255, 255, 255]},
      alternateRowStyles: {fillColor : [255, 255, 255]},
      tableLineColor: [204, 204, 204],
      tableLineWidth: 0.1,
    beforePageContent: header,
    margin: {
      top: 60,bottom: 30
    },
    startY: doc.autoTableEndPosY() + 60
  };

  doc.autoTable(res.columns, res.data, options);

  doc.save("table.pdf");
}*/
function generate() {

  var doc = new jsPDF('p', 'pt');
  var res = doc.autoTableHtmlToJson(document.getElementById("basic-table"));
  var totalPagesExp = "100";
  
  var header = function(data) {
    doc.setFontSize(15);
    doc.setTextColor(40);
    doc.setFontStyle('normal');
    //doc.addImage(headerImgData, 'JPEG', data.settings.margin.left, 20, 50, 50);
    
    var headtext = "franchisename",
    xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(headtext) * doc.internal.getFontSize() / 2); 
    doc.text(headtext, xOffset, 25);
    
    var headtext1 = "Registered",
    xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(headtext1) * doc.internal.getFontSize() / 2); 
    doc.text(headtext1, xOffset, 45);
    
    var headtext2 = "fromtopdf",
    xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(headtext2) * doc.internal.getFontSize() / 2); 
    doc.text(headtext2, xOffset, 65);
     
  };
  var footer = function(data) {
    // Footer
      var str = 'Page ' + doc.internal.getNumberOfPages()
      // Total page number plugin only available in jspdf v1.0+
      if (typeof doc.putTotalPages === 'function') {
             str = str + " of " + totalPagesExp;
        }
      doc.setFontSize(10)

      // jsPDF 1.4+ uses getHeight, <1.4 uses .height
      var pageSize = doc.internal.pageSize
      var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
 
      xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(str) * 10 / 2); 
      
      doc.text(str, xOffset, pageHeight - 20);
  };

  var options = {
     "theme": "plain", 
    "pageBreak": "auto", 
    "tableWidth": "auto", 
    "showHead": "everyPage", 
    "showFoot": "everyPage", 
    "tableLineWidth": 0, 
    "tableLineColor": 50, 
    rowPageBreak: 'auto',
    bodyStyles: { valign: 'top' },
    styles: { overflow: "linebreak", cellWidth: "wrap", rowPageBreak: "avoid", halign: "justify", fontSize: "8", lineColor: 100, lineWidth: ".25" },   
    columnStyles: {1:{halign: "justify",cellWidth: "wrap"}},
      headStyles :{fillColor : [255, 255, 255]},
      alternateRowStyles: {fillColor : [255, 255, 255]},
      
      tableLineWidth: 0.1,
    beforePageContent: header,
    afterPageContent: footer,
    margin: {
      top: 80,
      bottom: 35
    },
    startY: 80,
  };

  doc.autoTable(res.columns, res.data, options);
if (typeof doc.putTotalPages === 'function') { 
    doc.putTotalPages(totalPagesExp);
}

  doc.save("table.pdf");
}
</script>
<script>
    function generate3() {
         var doc = new jsPDF("landscape");
var res = doc.autoTableHtmlToJson(document.getElementById("basic-table"));
var totalPagesExp = "{total_pages_count_string}";

var pdfObject = { 
    "startY": 45, 
    "styles": { "overflow": "linebreak", "cellWidth": "wrap", "rowPageBreak": "avoid", "halign": "justify", "fontSize": "8", "lineColor": "100", "lineWidth": ".25" }, 
    "columnStyles": { "[0]": { "halign": "left" }, "[1]": { "halign": "left", "cellWidth": "auto" }, "[2]": { "halign": "left"}, "[3]": { "halign": "left", "cellWidth": "auto" }, "[4]": {  "halign": "left", "cellWidth": "auto" }, "[5]": {  "halign": "left", "cellWidth": "auto" }, "[6]": {  "halign": "left", "cellWidth": "auto" } }, 
    "theme": "striped", 
    "pageBreak": "auto", 
    "tableWidth": "auto", 
    "showHead": "everyPage", 
    "showFoot": "everyPage", 
    "tableLineWidth": 0, 
    "tableLineColor": 200, 
    "margin": { "top": 30 },
    didDrawPage: function (data) {
        doc.setFontSize(20);
        doc.setTextColor(40);
        doc.setFontStyle('normal');
        doc.text("Equipment Out On Jobs", data.settings.margin.left, 22);
        
        
        doc.setFontSize(20);
        doc.setTextColor(40);
        doc.setFontStyle('normal');
        doc.text("Job Numbers: 104319419,104319136", data.settings.margin.left, 30);
        
        // Footer
        var str = "Page " + doc.internal.getNumberOfPages()
        // Total page number plugin only available in jspdf v1.0+
        if (typeof doc.putTotalPages === 'function') {
             str = str + " of " + totalPagesExp;
        }
        
        doc.setFontSize(10);
        doc.setTextColor(40);
        doc.setFontStyle('normal');
        
        var pageSize = doc.internal.pageSize;
        var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
        
        doc.text(str, data.settings.margin.left, pageHeight - 10);
        
    }
};


doc.autoTable( res.columns, res.data, pdfObject);
// Total page number plugin only available in jspdf v1.0+
if (typeof doc.putTotalPages === 'function') { 
    doc.putTotalPages(totalPagesExp);
}

doc.save('myPDF.pdf');
}

</script>



    </body>
</html>