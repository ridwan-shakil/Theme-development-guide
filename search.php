 
//here is  only the search result part 

<?php
        $s = get_search_query();
        $args = array(
            's' => $s
        );
        // The Query
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
            _e("<h2 style='font-weight:bold;color:#000';display:block>Search Results for: " . get_query_var('s') . "</h2>");
        ?>

            <div class="row d-flex">
                <?php while ($the_query->have_posts()) {
                    $the_query->the_post();
                ?>
                    <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
                        <div class="blog-entry align-self-stretch">
                            <a href="<?php the_permalink() ?>" class="block-20 rounded" style="background-image: url('<?php the_post_thumbnail_url('large') ?>');">
                            </a>
                            <div class="text p-4">
                                <div class="meta mb-2">
                                    <div><a href="#"><?php the_date() ?></a></div>
                                    <div><a href="#"><?php the_author() ?></a></div>
                                    <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> <?php echo get_comments_number() ?></a></div>
                                </div>
                                <h3 class="heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        <?php
        } else {
        ?>
            <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
            <div class="alert alert-info ">
                <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
            </div>
        <?php } ?>
