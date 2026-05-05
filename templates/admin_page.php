<?php
?>
<div class ="wrap">
    <h1>Enhanced comic management control panel</h1>
    <hr>
    <div id="aa_menu_s1">
        <hr>
        <h2>Select a comic post</h2>
        <form action="" id="comicposts_form">
            <label for="comicposts">Select a comic post to enrich:</label>

                <select name="comicposts" id="comicposts">
                <?php
                    $i=0;
                    foreach($this->storage as $post){
                    $title=$post["title"];
                    $ID=$post["ID"];
                    $option="<option value='".$title."' data-id='".$ID."'>".$title."</option>";
                    $i++;
                    echo $option;
                    }
                ?>
        
                </select>
                <br><br>
            <input id="comicname" type="submit" value="Submit" class="">
            <p id='step1_check' class="aa_none">&#9989</p>
        </form>
    </div>
    <div id="aa_menu_s2" class="aa_none">
        <hr>
        <h2>Enhance or De-enhance the comic post?</h2>
        <form action="" id="action_form">
            <label for="enhcXdeenhc">Choose an option</label>
            <select name="enhcXdeenhc" id="enhcXdeenhc">
                <option value="enhance">enhance</option>
                <option value="de-enhance">de-enhance</option>
            </select>
            <br><br>
            <input id='eXde' type="submit" value="submit option" class="">
            <p id='step2_check' class="aa_none">&#9989</p>
        </form>
    </div>
    <div id="aa_menu_s3a" class="aa_none">
        <hr>
        <h2>Load the image assets</h2>
            <p>Upload the enriched comic's images.</p>
            <a href="./media-new.php" target="_blank">Open the upload menu in a new window</a>
            <br><br>
            <form action="" id="date_form">
                <label for="uploadmonth">Select the month when you upload these images</label>
                    <select name="uploadmonth" id="uploadmonth">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">November</option>
                    </select>
                    <select name="uploadyear" id="uploadyear">
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                    </select>
                    <br><br>
                <input id='selectedmonth' type="submit" value="submit month and year" class="">
                <p id='step3a_check' class="aa_none">&#9989</p>
            </form>
    </div>
    <div id="aa_menu_s3b" class="aa_none">
        <hr>
        <h2>Confirm you want to de-enhance the comic post</h2>
        <form action="">
            <label for="deenhance">Choose an option</label>
            <input id='deenhance' type="button" value="confirm" class="">
            <p id='step3b_check' class="aa_none">&#9989</p>
        </form>

    </div>
    <div id="aa_menu_s4" class="aa_none">
        <hr>
        <h2>Load the Json</h2>
            <form action="" id="JSON_form">
                <label for="comicjson">copy paste the json here:</label>
                <textarea name="comicjson" id="comicjson" rows="4" cols="50">put your json here</textarea>
                <br><br>
                <input id="uploadcomicjson" type="submit" value="enrich the page">
                <p id='step4_check' class="aa_none">&#9989</p>
            </form>

    </div>
    <div id="aa_menu_s5" class="aa_none">
        <hr>
        <h2>Reset</h2>
            <form action="">
            <label for="reset">Start again</label>
            <input id='reset' type="button" value="reset" class="">
        </form>
    </div>
    <hr>
</div>