function custom_post_grid_shortcode($atts) {
    ob_start();

    // Shortcode attributes
    $atts = shortcode_atts([
        'category' => 'all',
        'posts' => 8,
        'skip' => 0,
    ], $atts);

    $posts_per_page = intval($atts['posts']);
    $offset = intval($atts['skip']);

    // Query args
    $args = [
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
    ];

    if (strtolower($atts['category']) !== 'all') {
        $categories = explode(',', $atts['category']);
        $categories = array_map('trim', $categories);
        $args['category_name'] = implode(',', $categories);
    }

    $query = new WP_Query($args);
    $total_posts = $query->post_count;

    ?>
    <style>
    .custom-post-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin: 20px 0;
    }

    .custom-post-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .custom-post-card:hover {
        transform: translateY(-5px);
    }

    .custom-post-card.four-per-row {
        width: calc(25% - 15px);
    }

    .custom-post-card.dynamic-width-1 { width: 100%; }
    .custom-post-card.dynamic-width-2 { width: calc(50% - 10px); }
    .custom-post-card.dynamic-width-3 { width: calc(33.33% - 13.3px); }

    @media screen and (max-width: 1024px) {
        .custom-post-card {
            width: calc(50% - 10px) !important;
        }
    }

    @media screen and (max-width: 600px) {
        .custom-post-card {
            width: 100% !important;
        }
    }

    .post-image {
        background-size: cover;
        background-position: center;
        height: 180px;
        position: relative;
    }

    .category-badge {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: #000;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        font-size: 14px;
        border-radius: 3px;
    }

    .post-content {
        padding: 15px;
        flex-grow: 1;
    }

    .post-content h4 {
        margin: 0 0 10px;
        font-size: 18px;
        font-weight: bold;
    }

    .post-content p {
        margin: 0 0 15px;
        color: #444;
    }

    .read-more {
        font-weight: bold;
        color: #f9a825;
        text-decoration: none;
    }
    </style>
    <?php

    if ($query->have_posts()) {
        echo '<div class="custom-post-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $category = get_the_category();
            $cat_name = !empty($category) ? $category[0]->name : 'Uncategorized';
            $image = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: 'https://via.placeholder.com/400x250';

            // Trimmed excerpt or fallback content
            $raw_excerpt = get_the_excerpt();
            $excerpt = wp_trim_words(!empty($raw_excerpt) ? $raw_excerpt : strip_shortcodes(get_the_content()), 10);

            // Choose layout class
            $classes = 'custom-post-card';
            if ($total_posts >= 4) {
                $classes .= ' four-per-row';
            } else {
                $classes .= ' dynamic-width-' . $total_posts;
            }

            ?>
            <div class="<?php echo esc_attr($classes); ?>">
                <div class="post-image" style="background-image:url('<?php echo esc_url($image); ?>');">
                    <span class="category-badge"><?php echo esc_html($cat_name); ?></span>
                </div>
                <div class="post-content">
                    <h4><?php the_title(); ?></h4>
                    <p><?php echo esc_html($excerpt); ?></p>
                    <a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<p>No posts found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('custom_posts', 'custom_post_grid_shortcode');
