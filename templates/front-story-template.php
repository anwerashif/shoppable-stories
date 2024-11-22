<div class="shoppable-story">
    <h2><?php the_title(); ?></h2>
    <div class="story-content"><?php the_content(); ?></div>
    <div class="story-products">
        <?php
        $product_ids = get_post_meta( get_the_ID(), '_tagged_products', true );
        if ( $product_ids ) {
            foreach ( explode( ',', $product_ids ) as $product_id ) {
                $product = wc_get_product( $product_id );
                if ( $product ) {
                    echo '<a href="' . esc_url( $product->get_permalink() ) . '">' . esc_html( $product->get_name() ) . '</a>';
                }
            }
        }
        ?>
    </div>
</div>