<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=product_data.csv');

$output = fopen('php://output', 'w');

// Column headers
fputcsv($output, ['Product Name', 'Manufacturer', 'Unit', 'HSN', 'Inter Tax', 'Intra Tax', 'Rate', 'Stock on Hand']);

include 'lcheck.php'; // Ensure database connection is included

$sqli = mysqli_query($con, "SELECT id,intratax,intertax,productname,category,defaultunit,hsncode FROM pairproducts WHERE createdid='$companymainid' AND ((franchisesession='" . $_SESSION["franchisesession"] . "' AND pvisiblity='PRIVATE') OR pvisiblity='PUBLIC') AND itemmodule='Products' GROUP BY id ORDER BY productname ASC LIMIT 4000,500");

while ($info = mysqli_fetch_array($sqli)) {
    // Fetch stock details
    $sqlstocktotal = mysqli_query($con, "SELECT sum(quantity) as total FROM pairbatch WHERE createdid='$companymainid' AND franchisesession='" . $_SESSION["franchisesession"] . "' AND productid='" . $info['id'] . "'");
    $infostocktotal = mysqli_fetch_array($sqlstocktotal);
    
    // Fetch tax details
    $sqlitax = mysqli_query($con, "SELECT tax, taxname FROM pairtaxrates WHERE id='" . $info['intratax'] . "'");
    $infotax = mysqli_fetch_array($sqlitax);
    $sqlitaxinter = mysqli_query($con, "SELECT tax, taxname FROM pairtaxrates WHERE id='" . $info['intertax'] . "'");
    $infotaxinter = mysqli_fetch_array($sqlitaxinter);
    $intra_tax = $infotax ? (float)$infotax['tax'] : 0;
    $inter_tax = $infotaxinter['tax'] ?? 0;
    $purchaseqtys = $con->prepare("SELECT SUM(productrate) AS totprovalues FROM pairbills WHERE franchisesession = ? AND createdid = ? AND productid = ? AND (billdate > '2024-09-11') AND cancelstatus = '0' GROUP BY productid ORDER BY billdate DESC LIMIT 1");
    $purchaseqtys->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $info['id']);
    $purchaseqtys->execute();
    $purchaseqty = $purchaseqtys->get_result();
    $purchasesellingpriceans = 0;
    if(mysqli_num_rows($purchaseqty)>0){
        $purchaseqtyfet=$purchaseqty->fetch_array();
        $purchasesellingpriceans = $purchaseqtyfet['totprovalues'];
    }
    $salesqtys = $con->prepare("SELECT SUM(productrate) AS sellingprice FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND productrate!=0 AND productid = ? AND ((invoicedate = '2024-09-11' AND invoicetime >= '21:52:11') OR (invoicedate > '2024-09-11')) AND cancelstatus = '0' GROUP BY productid ORDER BY invoicedate DESC LIMIT 1");
    $salesqtys->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $info['id']);
    $salesqtys->execute();
    $salesqty = $salesqtys->get_result();
    $salesellingpriceans = 0;
    if(mysqli_num_rows($salesqty)>0){
        $salesqtyfet=$salesqty->fetch_array();
        $salesellingpriceans = $salesqtyfet['sellingprice'];
    }
    if ($purchasesellingpriceans<=0) {
        $sellingpriceans = $salesellingpriceans;
    }
    else{
        $sellingpriceans = $purchasesellingpriceans;
    }
    if($sellingpriceans<=0){
        $presentsellingstocksprosell = $con->prepare("SELECT salecost FROM pairprosale WHERE productid = ? AND itemmodule='Products' GROUP BY productid");
        $presentsellingstocksprosell->bind_param("s", $info['id']);
        $presentsellingstocksprosell->execute();
        $presentsellingstockprosell = $presentsellingstocksprosell->get_result();
        $sellingpriceans = 0;
        if(mysqli_num_rows($presentsellingstockprosell)>0){
            $presentsellingproductsell=$presentsellingstockprosell->fetch_array();
            $sellingpriceans = $presentsellingproductsell['salecost'];
        }
    }
    
    // Prepare row
    $row = [
        $info['productname'],
        $info['category'],
        $info['defaultunit'],
        $info['hsncode'],
        $inter_tax,
        $intra_tax,
        $sellingpriceans,
        $infostocktotal['total']
    ];
    
    // Write to CSV
    fputcsv($output, $row);
}

fclose($output);
?>