<?php
include("header.php");
$db=database_connection();
?>

<h1>Photo Gallery</h1>

<table>
    <tr>
        <td class="adjust"></td>
        <td style="width: 100%">
            <div class="row_gallery">
                <div class="column_gallery">
                    <img src="images/gym-small.jpg" onclick="open_modal_gallery();current_slide(1)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/gym2-small.jpg" onclick="open_modal_gallery();current_slide(2)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/workout0-small.jpg" onclick="open_modal_gallery();current_slide(3)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/workout1-small.jpg" onclick="open_modal_gallery();current_slide(4)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/workout2-small.jpg" onclick="open_modal_gallery();current_slide(5)" class="hover-shadow_gallery">
                </div>
            </div>

            <div class="row_gallery">
                <div class="column_gallery">
                    <img src="images/workout3-small.jpg" onclick="open_modal_gallery();current_slide(6)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/workout4-small.jpg" onclick="open_modal_gallery();current_slide(7)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/workout5-small.jpg" onclick="open_modal_gallery();current_slide(8)" class="hover-shadow_gallery">
                </div>
                <div class="column_gallery">
                    <img src="images/workout6-small.jpg" onclick="open_modal_gallery();current_slide(9)" class="hover-shadow_gallery">
                </div>

            </div>
        </td>
        <td class="adjust"></td>
    </tr>
</table>

<!-- The Modal/Lightbox -->
<div id="myModal" class="modal_background_gallery">
    <span class="close_gallery cursor" onclick="close_modal_gallery()">&times;</span>
    <div class="modal-content_gallery">

        <div class="my_slides_gallery">
            <div class="number_text_gallery">1 / 10</div>
            <img src="images/gym.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">2 / 10</div>
            <img src="images/gym2.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">3 / 10</div>
            <img src="images/workout0.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">4 / 10</div>
            <img src="images/workout1.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">5 / 10</div>
            <img src="images/workout2.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">6 / 10</div>
            <img src="images/workout3.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">7 / 10</div>
            <img src="images/workout4.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">8 / 10</div>
            <img src="images/workout5.jpg" class="center_gallery">
        </div>

        <div class="my_slides_gallery">
            <div class="number_text_gallery">9 / 10</div>
            <img src="images/workout6.jpg" class="center_gallery">
        </div>


        <a class="prev_gallery" onclick="plus_slides(-1)">&#10096;</a>
        <a class="next_gallery" onclick="plus_slides(1)">&#10097;</a>

        <!-- Caption text -->
        <div class="caption-container_gallery">
            <p id="caption"></p>
        </div>

        <!-- Thumbnail image controls -->
        <div class="column_gallery">
            <img class="demo_gallery" src="images/gym-small.jpg" onclick="current_slide(1)" alt="SRA FIT Gym">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/gym2-small.jpg" onclick="current_slide(2)" alt="SRA FIT Gym">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout0-small.jpg" onclick="current_slide(3)" alt="Crossfit Group">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout1-small.jpg" onclick="current_slide(4)" alt="Full Body Workout Group">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout2-small.jpg" onclick="current_slide(5)" alt="Full Body Workout Group">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout3-small.jpg" onclick="current_slide(6)" alt="Pilates Group">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout4-small.jpg" onclick="current_slide(7)" alt="Zumba Group">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout5-small.jpg" onclick="current_slide(8)" alt="Fitness Group">
        </div>

        <div class="column_gallery">
            <img class="demo_gallery" src="images/workout6-small.jpg" onclick="current_slide(9)" alt="Crossfit Group">
        </div>


    </div>
</div>

<?php
    close_db_connection($db);
?>