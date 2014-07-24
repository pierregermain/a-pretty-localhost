<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
   <link rel="stylesheet" href="bootstrap-responsive.min.css">
   <link rel="stylesheet" href="bootstrap.min.css">
   <link rel='icon' type='image/png' href='/favicon.ico.png' />
   
   <title>Display Directory Contents</title>
   <style>
     *{
         padding:0;
         margin:0;
     }

	#container{
		padding:30px;
	}
  

   </style>

</head>
<body>

   <div id="container">
       <?php
         // opens this directory
         $myDirectory = opendir(".");

         // gets each entry
         while($entryName = readdir($myDirectory)) {
           $dirArray[] = $entryName;
         }

         // finds extention of file
         function findexts ($filename)
         {
           $filename = strtolower($filename) ;
           $exts = split("[/\\.]", $filename) ;
           $n = count($exts)-1;
           $exts = $exts[$n];
           return strtoupper($exts);
         }

         // closes directory
         closedir($myDirectory);

         //  counts elements in array
         $indexCount   = count($dirArray);

         // sorts files
         sort($dirArray);

         // print 'em
         print("<h1>Directory Contents</h1>");
         print("<table width='100%' cellspacing='10' class='table'>
                 <tr>
                   <td class='head'>Filename</td>
                   <td class='head'>Type</td>
                   <td class='head'>Size</td></tr>\n");

         // loops through the array of files and print them all
         for($index=0; $index < $indexCount; $index++) {
               if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
					if (findexts($dirArray[$index]) == strtoupper($dirArray[$index])) {
						echo "<tr><td><a href='$dirArray[$index]'>$dirArray[$index]/</a></td>"."<td> Folder </td>"."<td>".round(filesize($dirArray[$index])/1000,2)." Mb"."</td>"."</tr>\n";
					}else{
						echo "<tr><td><a href='$dirArray[$index]'>$dirArray[$index]</a></td>"."<td>".findexts($dirArray[$index])."</td>"."<td>".round(filesize($dirArray[$index])/1000,2)." Mb"."</td>"."</tr>\n";
					}
           	   }
         }
         echo "</table>\n";
       ?>
   </div>

</body>
</html>
