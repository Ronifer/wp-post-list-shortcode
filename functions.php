<?php 

function custom_post_list_shortcode($atts)
{
    $terms = $atts['terms'] ? explode(";", $atts['terms']) : ["cursos"];
    $from = $atts['from'] ? $atts['from'] : "category";
    $limit = $atts['limit'] ? $atts['limit'] : false;
    $per_page = $atts['per_page'] ? $atts['per_page'] : 6;
    $customHtml = "";
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
    'post_type' => 'post',
    'post_status'=>'publish',
    'orderby'=> 'modified',
    'order'=> 'DESC', );
    if ($from == 'category') {
        $queryCategory = implode(",", $terms);
        $args['category_name' ] = $queryCategory;
    } else {
        $args['tag' ] = $terms;
    }
    if($limit) {
        $args['posts_per_page'] = $limit;
    }else{
        $args['posts_per_page'] = $per_page;
        $args['paged'] = $paged;
    }

    $postslist = new WP_Query($args);
    $count = 1;
    if ($postslist->have_posts()) :
        while ($postslist->have_posts()) : $postslist->the_post();
            $content = [
                'title' => get_the_title(),
                'link' => esc_url(get_the_permalink()),
                'thumbnail' => wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0],
                'excerpt' => get_custom_excerpt(90),
                'category' => get_the_category(),
                'tags' => get_the_tags()
            ];
        endwhile;

    $big = 999999999;
    $pagination =  paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' =>  $postslist->max_num_pages
    ));
   
    wp_reset_postdata();
    endif;
    if(!$limit){
        // Here is used to remove pagination from page if has limit attr
        $customHtml .= $pagination;
    }
    return $customHtml;
}
add_shortcode('custom_post_list', 'custom_post_list_shortcode');