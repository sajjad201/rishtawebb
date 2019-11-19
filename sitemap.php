<?php 
require 'inc/connection/connect.php';

$base_url="http://localhost/rishtawebb/check-category/caste/";

$query = "SELECT url FROM caste";
$result = mysqli_query($conn, $query);

header("Content-type: text/xml");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
while($row = mysqli_fetch_array($result)){
    echo '<url>' . PHP_EOL;
    echo '<loc>'.$base_url. $row["url"] .'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;

?>