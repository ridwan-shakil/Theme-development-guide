<?php
the_post_thumbnail_url('large');    

get_the_tags(); 

get_cat_name($catid); 

// =============================
// get categories 
// =============================
  $categories = get_categories(array(
         'orderby' => 'name',
         'order'   => 'ASC'
      ));
      foreach ($categories as $category) {
         echo $category->name . '<br> ';
      }



// Getting all the terms of a texonomy 
 $cats = get_terms('portfolio-cat');
 
// Getting terms full array of a post
get_the_terms( $post->ID, 'taxonomy' );

// Getting all terms name of a post ( separate with comma )
the_category(' , ')


// =============================
// Tags
// =============================

 <?php echo get_the_tag_list(); ?> 
      

 <?php $post_tags = get_the_tags();
                  if ($post_tags) :
                     foreach ($post_tags as $tag) :  ?>
                        <a href="<?php the_permalink() ?>" class="tag-cloud-link"><?php echo $tag->name; ?></a>
                  <?php endforeach;
                  endif; ?>






=============================
 Related posts 
=============================
           <?php
            $orig_post = $post;
            global $post;
            $tags = wp_get_post_tags($post->ID);

            if ($tags) {
               $tag_ids = array();
               foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
               $args = array(
                  'tag__in' => $tag_ids,
                  'post__not_in' => array($post->ID),
                  'posts_per_page' => 5, // Number of related posts that will be shown.
                  'ignore_sticky_posts' => 1
               );

               $my_query = new wp_query($args);
               if ($my_query->have_posts()) {

                  echo '<div id="relatedposts"><br><br><h3>Related Posts</h3><br><div class="row">';

                  while ($my_query->have_posts()) {
                     $my_query->the_post(); ?>


                     <div class="col-md-4">
                        <div class="relatedthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php the_post_thumbnail_url(''); ?>" alt="" width="100%" height="auto"></a></div>
                        <div class="relatedcontent">
                           <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
                           <?php the_time('M j, Y') ?>
                        </div>
                     </div>


            <?php }
                  echo '</div></div>';
               }
            }
            $post = $orig_post;

            wp_reset_query(); ?>

