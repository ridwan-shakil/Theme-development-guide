<?php
?>


==================================================
Get the post you want to show 
==================================================
( set wp_query before below code )
<?php
                    if ($query->current_post < 1) {
                      //gives first post
                    }elseif ($query->current_post < 3) {
                    //gives second and third post
                    }
                    ?>
