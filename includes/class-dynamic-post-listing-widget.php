<?php
/**
 * Dynamic Post Listing with Custom Field Widget Class
 *
 * @package Dynamic Post Listing
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Dynamic_Post_Listing_With_Custom_Field_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'dynamic-post-listing';
    }

    public function get_title() {
        return __( 'Dynamic Post Listing', 'dynamic-post-listing-with-custom-field' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Post Settings', 'dynamic-post-listing-with-custom-field' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Category
        $this->add_control(
            'category',
            [
                'label' => __( 'Category', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_categories_list(),
                'default' => '',
            ]
        );

        // Posts per page
        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts Per Page', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        // Exclude Post IDs
        $this->add_control(
            'exclude_post_ids',
            [
                'label' => __( 'Exclude Post IDs', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter comma-separated Post IDs', 'dynamic-post-listing-with-custom-field' ),
                'description' => __( 'Enter up to 10 post IDs to exclude, separated by commas (e.g., 1,2,3).', 'dynamic-post-listing-with-custom-field' ),
            ]
        );

        // Show Image
        $this->add_control(
            'show_image',
            [
                'label' => __( 'Show Image', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'dynamic-post-listing-with-custom-field' ),
                'label_off' => __( 'No', 'dynamic-post-listing-with-custom-field' ),
                'default' => 'yes',
            ]
        );

        // Image Size
        $this->add_control(
            'image_size',
            [
                'label' => __( 'Image Size', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_image_sizes(),
                'default' => 'medium',
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        // Show Excerpt
        $this->add_control(
            'show_excerpt',
            [
                'label' => __( 'Show Excerpt', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'dynamic-post-listing-with-custom-field' ),
                'label_off' => __( 'No', 'dynamic-post-listing-with-custom-field' ),
                'default' => 'yes',
            ]
        );

        // Content Length
        $this->add_control(
            'content_length',
            [
                'label' => __( 'Excerpt Length (words)', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 55,
                'min' => 10,
                'max' => 200,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        // Link Post Title
        $this->add_control(
            'link_title',
            [
                'label' => __( 'Link Post Title', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'dynamic-post-listing-with-custom-field' ),
                'label_off' => __( 'No', 'dynamic-post-listing-with-custom-field' ),
                'default' => 'yes',
            ]
        );

        // Show Read More Button
        $this->add_control(
            'show_read_more',
            [
                'label' => __( 'Show Read More Button', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'dynamic-post-listing-with-custom-field' ),
                'label_off' => __( 'No', 'dynamic-post-listing-with-custom-field' ),
                'default' => 'no',
            ]
        );

        // Enable Pagination
        $this->add_control(
            'enable_pagination',
            [
                'label' => __( 'Enable Pagination', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'dynamic-post-listing-with-custom-field' ),
                'label_off' => __( 'No', 'dynamic-post-listing-with-custom-field' ),
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __( 'Layout Settings', 'dynamic-post-listing-with-custom-field' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Items per row
        $this->add_control(
            'items_per_row',
            [
                'label' => __( 'Items Per Row', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1', 'dynamic-post-listing-with-custom-field' ),
                    '2' => __( '2', 'dynamic-post-listing-with-custom-field' ),
                    '3' => __( '3', 'dynamic-post-listing-with-custom-field' ),
                    '4' => __( '4', 'dynamic-post-listing-with-custom-field' ),
                ],
                'default' => '3',
            ]
        );

        $this->end_controls_section();

        // Custom Field Section
        $this->start_controls_section(
            'custom_field_section',
            [
                'label' => __( 'Custom Fields', 'dynamic-post-listing-with-custom-field' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Custom Fields Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'custom_field_key',
            [
                'label' => __( 'Custom Field Key', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter custom field key', 'dynamic-post-listing-with-custom-field' ),
            ]
        );

        $repeater->add_control(
            'field_label',
            [
                'label' => __( 'Field Label', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter display label (optional)', 'dynamic-post-listing-with-custom-field' ),
            ]
        );

        $this->add_control(
            'custom_fields',
            [
                'label' => __( 'Custom Fields', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ field_label || custom_field_key }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'dynamic-post-listing-with-custom-field' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_spacing',
            [
                'label' => __( 'Post Spacing', 'dynamic-post-listing-with-custom-field' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dpl-post-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_categories_list() {
        $categories = get_categories();
        $options = [ '' => __( 'All Categories', 'dynamic-post-listing-with-custom-field' ) ];
        foreach ( $categories as $category ) {
            $options[ $category->term_id ] = $category->name;
        }
        return $options;
    }

    private function get_image_sizes() {
        $sizes = get_intermediate_image_sizes();
        $options = [];
        foreach ( $sizes as $size ) {
            $options[ $size ] = ucfirst( str_replace( '_', ' ', $size ) );
        }
        $options['full'] = 'Full';
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Set custom excerpt length
        if ( ! empty( $settings['show_excerpt'] ) && ! empty( $settings['content_length'] ) ) {
            add_filter( 'excerpt_length', function() use ( $settings ) {
                return absint( $settings['content_length'] );
            }, 999 );
        }

        // Query args for preliminary query to get all eligible post IDs
        $pre_query_args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1, // Get all posts
            'fields' => 'ids', // Only fetch IDs for performance
        ];

        if ( ! empty( $settings['category'] ) ) {
            $pre_query_args['cat'] = $settings['category'];
        }

        $pre_query = new WP_Query( $pre_query_args );
        $post_ids = $pre_query->posts;

        // Handle excluded post IDs
        $exclude_ids = [];
        if ( ! empty( $settings['exclude_post_ids'] ) ) {
            $exclude_ids = array_map( 'absint', array_filter( explode( ',', $settings['exclude_post_ids'] ) ) );
            $exclude_ids = array_slice( $exclude_ids, 0, 10 ); // Limit to 10 IDs
            $post_ids = array_diff( $post_ids, $exclude_ids ); // Remove excluded IDs
        }

        wp_reset_postdata();

        // Main query args
        $args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $settings['posts_per_page'],
        ];

        if ( ! empty( $post_ids ) ) {
            $args['post__in'] = $post_ids;
            $args['orderby'] = 'post__in'; // Preserve order of filtered IDs
        } else {
            // Fallback if no posts remain after exclusion
            $args['post__in'] = [0]; // Ensures no posts are returned
        }

        if ( ! empty( $settings['category'] ) ) {
            $args['cat'] = $settings['category'];
        }

        if ( 'yes' === $settings['enable_pagination'] ) {
            $args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        }

        $query = new WP_Query( $args );

        ?>
        <div class="dpl-posts-listing" data-items-per-row="<?php echo esc_attr( $settings['items_per_row'] ); ?>">
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="dpl-post-item">
                        <?php if ( 'yes' === $settings['link_title'] ) : ?>
                            <h2><a href="<?php echo esc_url( get_permalink() ); ?>" class="dpl-post-title"><?php the_title(); ?></a></h2>
                        <?php else : ?>
                            <h2><?php the_title(); ?></h2>
                        <?php endif; ?>
                        <?php if ( 'yes' === $settings['show_image'] && has_post_thumbnail() ) : ?>
                            <div class="dpl-post-thumbnail"><?php the_post_thumbnail( $settings['image_size'] ); ?></div>
                        <?php endif; ?>
                        <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                            <div class="dpl-post-content"><?php the_excerpt(); ?></div>
                        <?php endif; ?>
                        <?php if ( 'yes' === $settings['show_read_more'] ) : ?>
                            <div class="dpl-read-more">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="dpl-read-more-button"><?php esc_html_e( 'Read More', 'dynamic-post-listing-with-custom-field' ); ?></a>
                            </div>
                        <?php endif; ?>

                        <?php
                        // Display custom fields
                        if ( ! empty( $settings['custom_fields'] ) ) {
                            echo '<div class="dpl-custom-meta">';
                            foreach ( $settings['custom_fields'] as $field ) {
                                if ( function_exists( 'get_field' ) && ! empty( $field['custom_field_key'] ) ) {
                                    $value = get_field( $field['custom_field_key'] );
                                    if ( $value ) {
                                        if ( ! empty( $field['field_label'] ) ) {
                                            echo '<div class="dpl-custom-field"><strong>' . esc_html( $field['field_label'] ) . ':</strong> ' . esc_html( $value ) . '</div>';
                                        } else {
                                            echo '<div class="dpl-custom-field">' . esc_html( $value ) . '</div>';
                                        }
                                    }
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                <?php endwhile; ?>

                <?php if ( 'yes' === $settings['enable_pagination'] ) : ?>
                    <div class="dpl-pagination">
                        <?php
                        // Sanitize pagination output
                        $pagination = paginate_links( [
                            'total' => $query->max_num_pages,
                            'current' => max( 1, get_query_var( 'paged' ) ),
                            'prev_text' => __( 'Previous', 'dynamic-post-listing-with-custom-field' ),
                            'next_text' => __( 'Next', 'dynamic-post-listing-with-custom-field' ),
                        ] );
                        echo wp_kses_post( $pagination );
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
        wp_reset_postdata();
        remove_all_filters( 'excerpt_length', 999 );
    }

    protected function content_template() {
        ?>
        <?php // Note: <# and #> are Elementor/Underscore.js template delimiters for JavaScript rendering in the editor. ?>
        <#
        var posts = <?php echo wp_json_encode( array_fill( 0, $settings['posts_per_page'] ?? 6, [ 'title' => 'Sample Post', 'excerpt' => 'Lorem ipsum...' ] ) ); ?>;
        #>
        <div class="dpl-posts-listing" data-items-per-row="{{{ settings.items_per_row }}}">
            <# _.each( posts, function( post ) { #>
                <div class="dpl-post-item">
                    <# if ( settings.link_title === 'yes' ) { #>
                        <h2><a href="#" class="dpl-post-title">{{{ post.title }}}</a></h2>
                    <# } else { #>
                        <h2>{{{ post.title }}}</h2>
                    <# } #>
                    <# if ( settings.show_image === 'yes' ) { #>
                        <div class="dpl-post-thumbnail"></div>
                    <# } #>
                    <# if ( settings.show_excerpt === 'yes' ) { #>
                        <div class="dpl-post-content">{{{ post.excerpt }}}</div>
                    <# } #>
                    <# if ( settings.show_read_more === 'yes' ) { #>
                        <div class="dpl-read-more">
                            <a href="#" class="dpl-read-more-button"><?php esc_html_e( 'Read More', 'dynamic-post-listing-with-custom-field' ); ?></a>
                        </div>
                    <# } #>
                    
                    <# if ( settings.custom_fields && settings.custom_fields.length ) { #>
                        <div class="dpl-custom-meta">
                            <# _.each( settings.custom_fields, function( field ) { #>
                                <# if ( field.field_label ) { #>
                                    <div class="dpl-custom-field"><strong>{{{ field.field_label }}}:</strong> Sample Value</div>
                                <# } else { #>
                                    <div class="dpl-custom-field">Sample Value</div>
                                <# } #>
                            <# }); #>
                        </div>
                    <# } #>
                </div>
            <# }); #>

            <# if ( settings.enable_pagination === 'yes' ) { #>
                <div class="dpl-pagination">
                    <a href="#"><?php esc_html_e( 'Previous', 'dynamic-post-listing-with-custom-field' ); ?></a>
                    <a href="#"><?php esc_html_e( 'Next', 'dynamic-post-listing-with-custom-field' ); ?></a>
                </div>
            <# } #>
        </div>
        <?php
    }
}
?>