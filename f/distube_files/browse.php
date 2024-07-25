<?php
include("header.php");

$category = isset($_GET['category']) ? $_GET['category'] : 'recent';
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

$offset = ($page - 1) * 300;
$count = 0;
$pages = 0;

$sql_count = mysqli_query($connect, "SELECT COUNT(*) as total FROM videodb");
$total_videos = mysqli_fetch_assoc($sql_count)['total'];
$pages = ceil($total_videos / 300);

if ($category == 'popular') {
  $sql = "SELECT * FROM videodb ORDER BY ViewCount DESC LIMIT $offset, 300";
  $title = "Most Popular";
} else {
  $sql = "SELECT * FROM videodb ORDER BY UploadDate DESC LIMIT $offset, 300";
  $title = "Most Recent";
}

$vidlist = mysqli_query($connect, $sql);
?>

<title>Browse - DisTube</title>
<table width="790" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
  <tbody>
  <tr>
    <td><img src="img/box_login_tl.gif" width="5" height="5"></td>
    <td><img src="img/pixel.gif" width="1" height="5"></td>
    <td><img src="img/box_login_tr.gif" width="5" height="5"></td>
  </tr>
  <tr>
    <td><img src="img/pixel.gif" width="5" height="1"></td>
    <td width="780">
      <div class="moduleTitleBar">
        <table cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <tr valign="top">
              <td width="260">
                <div class="moduleTitle"><?= $title ?></div>
              </td>
              <td width="260" align="center">
                <div style="font-weight: normal; font-size: 11px; color: #444444">
                  <a href="browse.php?category=recent" style="margin-right: 10px;">Most Recent</a>
                  <a href="browse.php?category=popular">Most Popular</a>
                </div>
              </td>
              <td width="260" align="right"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="moduleFeatured">
        <table width="770" cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <?php
            $count = 0;
            while ($fetch = mysqli_fetch_assoc($vidlist)) {
              $idvideolist = $fetch['VideoID'];
              $namevideolist = htmlspecialchars($fetch['VideoName']);
              $uploadervideolist = htmlspecialchars($fetch['Uploader']);
              $uploadvideolist = $fetch['UploadDate'];
              $viewsvideolist = htmlspecialchars($fetch['ViewCount']);

              if($count == 0) {
                echo "<tr valign='top'>";
              }
              echo "<td width='20%' align='center'>
                      <a href='watch.php?v=".$idvideolist."'><img src='./content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" width='120' height='90' class='moduleFeaturedThumb'></a>
                      <div class='moduleFeaturedTitle'><a href='watch.php?v=".$idvideolist."'>".$namevideolist."</a></div>
                      <div class='moduleFeaturedDetails'>
                        Added: ".$uploadvideolist."<br>
                        by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
                      </div>
                      <div class='moduleFeaturedDetails'>
                        Views: ".$viewsvideolist."
                      </div>
                    </td>";
              $count++;
              if($count == 4) {
                echo "</tr>";
                $count = 0;
              }
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- begin paging -->
      <div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px;">
        <?php
        echo "Browse Pages: ";
        for ($pagecount = 1; $pagecount <= $pages; $pagecount++) {
          echo "<span style='background-color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;'>
                  <a href='browse.php?category=".$category."&page=".$pagecount."'>".$pagecount."</a>
                </span>";
        }
        ?>
      </div>
      <!-- end paging -->
    </td>
    <td><img src="img/pixel.gif" width="5" height="1"></td>
  </tr>
  <tr>
    <td><img src="img/box_login_bl.gif" width="5" height="5"></td>
    <td><img src="img/pixel.gif" width="1" height="5"></td>
    <td><img src="img/box_login_br.gif" width="5" height="5"></td>
  </tr>
  </tbody>
</table>
<?php include("footer.php"); ?>
