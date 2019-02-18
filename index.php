<!-- This is the Index PHP file normally located in wp-content/themes/theme/ -->
<section class="filter-wrap">
    <div class="category">
        <div class="field-title">Category</div>
        <?php $categories = get_categories(array('hide_empty' => 0)); ?>
            <select class="filter-category">
                <option value="all">All</option>
                <!-- START Loop all Categories -->
                <?php if ( $categories ) : foreach ( $categories as $category ) :
                    echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                endforeach; endif; ?>
                <!-- END Loop all Categories -->
            </select>
        </div>
        <div class="date">
            <div class="field-title">Sort by</div>
            <select class="filter-date">
                <option value="new">Newest</option>
                <option value="old">Oldest</option>
            </select>
        </div>
</section>

<section class="posts">
    <div class="filtered-posts">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-id-<?php the_id(); ?>">
            <a href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3>
        </article>
    <?php endwhile; endif; ?>
    </div>
</section>