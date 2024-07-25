<?php
include("header.php");
include("auth.php");
$username = $_SESSION["username"];
$upload_msg = "";
$donotcontinue = 0;

function randstr($len, $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-"){
    return substr(str_shuffle($charset),0,$len);
}

function delete_directory($dirname) {
    if (is_dir($dirname)) {
        $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    } else {
        return false;
    }
}

$url_id = randstr(11);
$folder_id = randstr(26);
$vid_id = randstr(26);

if(isset($_POST["upload"]) && isset($_SESSION["username"])) {
    $vextension  = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    $target_file = "content/preload/".$folder_id."/".$vid_id.".".$vextension;
    $target_folder = "content/video/".$folder_id;
    $preload_folder = "content/preload/".$folder_id;
    $target_thumb = "content/thumbs/".$url_id.".png";
    $thumbcmd = "ffmpeg -i ".$target_file." -vframes 1 -an -s 160x120 -ss 3 ".$target_thumb;

    if (!file_exists($target_folder)) {
        mkdir($target_folder, 0777, true);
    }
    if (!file_exists($preload_folder)) {
        mkdir($preload_folder, 0777, true);
    }

    $name = $_FILES['fileToUpload']['name'];  
    $temp_name = $_FILES['fileToUpload']['tmp_name'];

    if(move_uploaded_file($temp_name, $target_file) && $donotcontinue == 0) {
        if($vextension != "mp4" && $vextension != "mkv" && $vextension != "wmv" && $vextension != "flv" && $vextension != "avi") {
            echo "<center><h1>Your video is an incompatible format.<br>To continue uploading this video, convert it to a supported format.</h1></center>";
            die();
        }
        // Thumbnail generation and video processing code for all videos
        exec("ffmpeg -i ".$target_file." -vf scale=-320:240 -c:v libx264 -b:v 277K -b:a 75k -strict experimental content/video/".$folder_id."/".$vid_id.".mp4");
        if (filesize("content/video/".$folder_id."/".$vid_id.".mp4") == 0) {
            unlink("content/video/".$folder_id."/".$vid_id.".mp4");
            delete_directory($preload_folder);
            echo "<center><h1>Your video was unable to be uploaded.<br>If you see this screen, report it to staff/admin.</h1></center>";
            die();
        }
        exec($thumbcmd);
        $datenow = date("Y-m-d");
        $stmt = $connect->prepare("INSERT INTO videodb (VideoID, VideoName, VideoDesc, Uploader, UploadDate, VideoFile) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $url_id, $_POST['title'], $_POST['desc'], $username, $datenow, $target_file);
        $target_file = $target_folder . "/" . $vid_id . ".mp4";
        $stmt->execute();
        $stmt = $connect->prepare("UPDATE users SET recent_vid = ? WHERE username = ?");
        $stmt->bind_param("ss", $url_id, $username);
        $stmt->execute();
        delete_directory($preload_folder);
        echo "<script>window.location.replace('upload_success.php?v=".$url_id."');</script>"; // Redirect to upload success page
    } else {
        $upload_msg = 'You should select a file to upload!';
    }
}

?>
<div id="uploadVid">
<div class="tableSubTitle">Video Upload (Step 2 of 2)</div>
  <form name="uploadForm" id="uploadForm" method="post" action="my_videos_upload_2.php" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo $_POST["title"]; ?>" hidden>
        <textarea name="desc" maxlength="500" form="uploadForm" style="width:295px;overflow:hidden;resize:none" rows="3" hidden><?php echo $_POST["desc"]; ?></textarea>
        <center>
            <table class="dataEntryTableSmall">
                <tbody>
                    <tr>
                        <td width="125px" valign="top" align="right"><span style="font-size: 14px;font-weight:bold;">File:</span></td>
                        <td style="background-color:#FEFFE0; color:#808536; padding:13px;">
                            <input type="file" name="fileToUpload" id="fileToUpload" style="color:black" accept="video/mp4" required=""><br>
                            <p><b>Max file size: 50 MB. No copyrighted or obscene material.</b><br>After uploading, you can edit or remove this video at anytime under the "My Videos" ink on the top of the page.</p>
                            <p style="color:#808536;"><b>More Ways You Can Do:<br><p style="color:DarkOrange">Share Your Friends, Family, World!</p>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align="right"><span></span></td>
                        <td><br><h3>PLEASE BE PATIENT, THIS MAY TAKE SEVERAL MINTUES. ONCE COMPLETED, YOU WILL SEE A CONFIRMATION MESSAGE.</h3></td>
                    </tr>
                    <tr>
                        <td width="" align="right" style="white-space: nowrap;"></td>
                        <td>
                            <br>
                            <input type="submit" id="upload" name="upload" value="Upload Video">
                        </td>
                    </tr>   
                </tbody>
            </table>
        </center>
    </form>
</div>
<?php include("footer.php"); ?>
