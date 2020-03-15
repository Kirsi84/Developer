<?php    
function callFunctions($no_of_records_per_page, $offset)
{
       

        // $no_of_records_per_page = 10;
        // $offset = ($pageno-1) * $no_of_records_per_page;


        $palvelin   = "localhost";
        $kayttaja   = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
        $salasana   = "";
        $tietokanta = "sakila";

        $conn=mysqli_connect($palvelin,$kayttaja,$salasana,$tietokanta);
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM film";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        
        echo "rivejä: " .  $total_rows;


        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM film order by title LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);

        echo "<table><tr><th>Nimi</th><th>Kuvaus</th><th>Ikäraja</th><th>Julkaisuvuosi</th></tr>";

        while($row = mysqli_fetch_array($res_data)){
           
           $title = $row['title'];
           $description = $row["description"]; 
           $release_year = $row["release_year"];
           $rating = $row["rating"];
          
       
           echo "<tr><td>$title</td><td>$description</td><td>$rating</td><td>$release_year</td></tr>";

        }
        echo "</table>";
       
        mysqli_close($conn);
        
        return   $total_pages;
    }


    ?>