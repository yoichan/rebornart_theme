<?php
/*
 * thumbnailのサイズ設定
 */
add_image_size('thumbnail_300x300', 300, 300, true);

/*
 * 画像つきの最新の投稿のウィジェット
 */
class NewPostWithImg_Widget extends WP_Widget {
    /*コンストラクタ*/
    /*自作ウィジェットを登録するみたいな感じ*/
    function NewPostWithImg_Widget() {
        parent::__construct(
            false,
            $name = '最新の投稿（画像付）',
            array( 'description' => '最新の投稿を画像つきで表示します', )
        );
    }

    /*管理画面の設定とか表示用コードを書く*/
    function form($instance) {
?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('表示する投稿数:'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" size="3">
    </p>
<?php

    }

    /*管理画面で設定を変更した時の処理を書く*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = is_numeric($new_instance['limit']) ? $new_instance['limit'] : 5;
        return $instance;
    }
    
    /*ウィジェットを配置した時の表示用コードを書く*/
    function widget($args, $instance) {
        extract( $args );
        global $post;
    
        if($instance['title'] != ''){
            $title = apply_filters('widget_title', $instance['title']);
        }
        echo $before_widget;
        if( $title ){
            echo $before_title . $title . $after_title;
        }
?>
        <div class="img-new-post clearfix">
<?php
        $posts = get_posts(array('posts_per_page' => $instance['limit']));
        foreach ($posts as $post):
            setup_postdata($post);
?>
            <div class="post">
                <a href="<?php the_permalink(); ?>">
                     <?php if( has_post_thumbnail() ): ?>
                     <?php the_post_thumbnail('thumbnail_300x300');?>
                     <?php else: ?>
                     <img src="<?php bloginfo('template_url'); ?>/images/no-image.jpg" alt="">
                     <?php endif; ?>
                </a>
                <div class="description">
                    <div class="category"><?php the_category(' '); ?></div>
                    <div class="title"><?php the_title(); ?></div>
                    <div class="summary"><?php the_excerpt(); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
<?php
        wp_reset_postdata();
        echo $after_widget;
    }
}
register_widget('NewPostWithImg_Widget');

/*
 * もっと読むのリンク
 * */
function new_excerpt_more_jp( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">...もっと読む</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more_jp');

/* 
 * 親テーマのいらないフックを外す
 * 上書きしたいフックで親テーマの登録を削除したいときはここに追加していく
 * */
function child_theme_setup() {
    remove_filter( 'excerpt_more', 'new_excerpt_more');
}
add_action( 'after_setup_theme', 'child_theme_setup' );
