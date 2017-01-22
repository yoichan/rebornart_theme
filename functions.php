<?php

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
        <ul class="img-new-post clearfix">
<?php
        $posts = get_posts(array('posts_per_page' => $instance['limit']));
        foreach ($posts as $post):
            setup_postdata($post);
?>
            <li>
                <?php if( has_post_thumbnail() ): ?>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(400,400) ); ?></a>
                <?php else: ?>
                <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/no-image.jpg" alt=""></a>
                <?php endif; ?>
                <div>
                    <p>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                        <span class="img-new-post-date"><?php echo get_the_date('Y/n/j'); ?></span>
                    </p>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
<?php
        wp_reset_postdata();
        echo $after_widget;
    }
}
/*自作ウィジェットを使えるようにする処理*/
register_widget('NewPostWithImg_Widget');
