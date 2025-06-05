<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=product_data.csv');

$output = fopen('php://output', 'w');

// Column headers
fputcsv($output, ['Vendor Name', 'Address', 'Mobile', 'Email', 'Gst No', 'DL No 20', 'DL No 21']);

include 'lcheck.php'; // Ensure database connection is included

$sqli = mysqli_query($con, "select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Vendors') order by customername asc");

while ($info = mysqli_fetch_array($sqli)) {
    
    // Prepare row
    $row = [
        $info['customername'],
        $info['billcity'],
        $info['mobile'],
        $info['email'],
        $info['gstin'],
        $info['dlno20'],
        $info['dlno21']
    ];
    
    // Write to CSV
    fputcsv($output, $row);
}

fclose($output);
?>