<?php
include("header.php");
include("auth.php");
?>
<title>My Profile</title>
<center>
    <h1>My Profile</h1>
    <h4>Set information you want others to see</h4>
    <form action='setdesc.php' method='POST' name='setdesc' id='setdesc' onsubmit="return validateTextarea()">
        <br>
        <textarea rows="4" cols="50" maxlength="500" name="desc" id="desc" form="setdesc" placeholder="Input your About Me here..." style="margin: 0px; height: 67px; width: 352px; resize: none;" required=""></textarea>
        <p>500 character limit.</p>
        <input type='submit' name="submit">
        <p id="error-desc" style="color: red; display: none;">Please enter a description.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Name       :
        <input type='text' id='name' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_name">
        <p id="error-name" style="color: red; display: none;">Please enter your name.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateAge()">
        Age       :
        <input type='number' id='age' style="width: 250px;" name='textbox' min="13" max="99">
        <input type="submit" value="Submit" name="prof_age">
        <p id="error-age" style="color: red; display: none;">Please enter a valid age between 13 and 99.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        City       :
        <input type='text' id='city' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_city">
        <p id="error-city" style="color: red; display: none;">Please enter your city.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Hometown       :
        <input type='text' id='hometown' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_hometown">
        <p id="error-hometown" style="color: red; display: none;">Please enter your hometown.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Country       :
        <input type='text' id='country' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_country">
        <p id="error-country" style="color: red; display: none;">Please enter your country.</p>
    </form>
    <br>
    <br>
    <!--
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Occupation       :
        <input type='text' id='occupation' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_occupation">
        <p id="error-occupation" style="color: red; display: none;">Please enter your occupation.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Interests and Hobbies       :
        <input type='text' id='interests' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_interests">
        <p id="error-interests" style="color: red; display: none;">Please enter your interests and hobbies.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Music       :
        <input type='text' id='music' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_music">
        <p id="error-music" style="color: red; display: none;">Please enter your favorite music.</p>
    </form>
    <br>
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Books       :
        <input type='text' id='books' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_books">
        <p id="error-books" style="color: red; display: none;">Please enter your favorite books.</p>
    </form>
    <br>
    <br>
    -->
    <!--
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Movies and Shows       :
        <input type='text' id='movies' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_movies">
        <p id="error-movies" style="color: red; display: none;">Please enter your favorite movies and shows.</p>
    </form>
    <br>
    -->
    <br>
    <form action="setinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this)">
        Website       :
        <input type='text' id='website' style="width: 250px;" name='textbox'>
        <input type="submit" value="Submit" name="prof_website">
        <p id="error-website" style="color: red; display: none;">Please enter your website.</p>
    </form>
    <br>
    <br>
</center>
<br>
<?php include("footer.php"); ?>

<script>
function validateTextarea() {
    const desc = document.getElementById('desc').value.trim();
    if (desc === '') {
        document.getElementById('error-desc').style.display = 'block';
        return false;
    } else {
        document.getElementById('error-desc').style.display = 'none';
        return true;
    }
}

function validateForm(form) {
    const textbox = form.querySelector('input[name="textbox"]').value.trim();
    const errorId = `error-${form.querySelector('input[type="submit"]').name.split('_')[1]}`;
    if (textbox === '') {
        document.getElementById(errorId).style.display = 'block';
        return false;
    } else {
        document.getElementById(errorId).style.display = 'none';
        return true;
    }
}

function validateAge() {
    const ageInput = document.getElementById('age');
    const age = ageInput.value.trim();
    if (age === '' || isNaN(age) || age < 13 || age > 99) {
        document.getElementById('error-age').style.display = 'block';
        return false;
    } else {
        document.getElementById('error-age').style.display = 'none';
        return true;
    }
}
</script>
