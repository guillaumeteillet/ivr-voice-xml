<?php
// get our caller id to help identify the recording
$callerid = $_REQUEST['callerid'];
if ($_FILES["recording"]["error"] > 0) {
// oops, something went wrong. let's let our app know
  header("HTTP/1.1 500 Internal Server Error");
  echo "Return Code: " . $_FILES["recording"]["error"] . "
";
} else {
// copy our temp file to our real file name and save it on the server.
  move_uploaded_file($_FILES["recording"]["tmp_name"],"./recordings/" . $callerid . "-" . date("His") . ".wav");
}
?>
<vxml version = "2.1" >
   <form>
      <block>
         <exit/>
      </block>
   </form>
</vxml>
