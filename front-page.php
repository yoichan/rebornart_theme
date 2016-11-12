<?php get_header(); ?>

<div id="main_visual">
  <div class="wrap">
    <h2><?php echo nl2br(get_option('top_catchcopy'));?></h2>
    <p><?php echo nl2br(get_option('top_description'));?></p>
  </div><!-- .wrap -->
</div>

<div id="content">

<div id="main">
  <div class="main-inner">

<div id="popular_post_content" class="front-loop">

<h2><i class="fa fa-flag"></i> 人気のある記事</h2>
<div class="wrap">
  <div class="front-loop-cont">
<?php
      $i = 1;
      if ( have_posts() ) :
        // wp_reset_query();

        $args=array(
            'meta_query'=>
            array(
              array(  'key'=>'bzb_show_toppage_flag',
                         'compare' => 'NOT EXISTS'
              ),
              array(  'key'=>'bzb_show_toppage_flag',
                        'value'=>'none',
                        'compare'=>'!='
              ),
             'relation'=>'OR'
          ),
            'showposts'=>5,
            'meta_key'=>'views',
            'orderby'=>'meta_value_num',
            'order'=>'DESC'
          );
        query_posts($args);
        // query_posts('showposts=5&meta_key=views&orderby=meta_value_num&order=DESC');
        while ( have_posts() ) : the_post();

        $cf = get_post_meta($post->ID);
        $rank_class = 'popular_post_box rank-'.$i;
        // print_r($cf);
?>

  <article id="post-<?php echo the_ID(); ?>" <?php post_class($rank_class); ?>>
    <a href="<?php the_permalink(); ?>" class="wrap-a">

      <?php if( get_the_post_thumbnail() ) { ?>
      <div class="post-thumbnail">
        <?php the_post_thumbnail('small_thumbnail'); ?>
      </div>
      <?php } else{ ?>
        <img src="<?php echo get_template_directory_uri(); ?>/lib/images/noimage.jpg" alt="noimage" width="300" height="158" />
      <?php } // get_the_post_thumbnail ?>
    <p class="p_category"><?php $cat = get_the_category(); $cat = $cat[0]; {
        echo $cat->cat_name;
      } ?></p>
    <h3><?php the_title(); ?></h3>
    <p class="p_rank">NO.<span><?php echo $i; ?></span></p>
    
    </a>
  </article>

<?php
        $i++;
        endwhile;
      endif;
?>

</div><!-- /front-loop-cont -->

</div><!-- /wrap -->
</div><!-- popular_post_content -->

<div id="recent_post_content" class="front-loop">

<h2><i class="fa fa-clock-o"></i> 最近の投稿</h2>
<div class="wrap">
  <div class="front-loop-cont">
<?php
      $i = 1;
      wp_reset_query();

        $args=array(
            'meta_query'=>
            array(
              array(  'key'=>'bzb_show_toppage_flag',
                         'compare' => 'NOT EXISTS'
              ),
              array(  'key'=>'bzb_show_toppage_flag',
                        'value'=>'none',
                        'compare'=>'!='
              ),
             'relation'=>'OR'
          ),
            'showposts'=>5,
            'order'=>'DESC'
          );

      query_posts($args);
      
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();

        $cf = get_post_meta($post->ID);
        $recent_class = 'popular_post_box recent-'.$i;
?>

  <article id="post-<?php echo the_ID(); ?>" <?php post_class($recent_class); ?>>
      <a href="<?php the_permalink(); ?>" class="wrap-a"><?php if( get_the_post_thumbnail() ) { ?>
        <div class="post-thumbnail">
          <?php the_post_thumbnail(array('300','158')); ?>
        </div>
        <?php } else{ ?>
          <img src="<?php echo get_template_directory_uri(); ?>/lib/images/noimage.jpg" alt="noimage" width="300" height="158" />
        <?php } // get_the_post_thumbnail ?>
            <p class="p_category"><?php $cat = get_the_category(); $cat = $cat[0]; {
          echo $cat->cat_name;
        } ?></p>
            <h3><?php the_title(); ?></h3>
            <p class="p_date"><span class="date-y"><?php the_time('Y'); ?></span><span class="date-mj"><?php the_time('m/j'); ?></span></p></a>
  </article>

<?php
        $i++;
        endwhile;
      endif;
?>

</div><!-- /front-root-cont -->

</div><!-- /wrap -->
</div><!-- /recent_post_content -->




<!-- クローズアップ -->
<div id="front-contents" class="front-main-cont">
<?php
  $icon = 'none';
  $bzb_ruby = '';
  $bzb_catch = '';
  $title = '';
  $bzb_contents_header_array = get_option('bzb_contents_header');
  if(is_array($bzb_contents_header_array)){
    extract($bzb_contents_header_array) ;
  }
?>
  <header class="category_title main_title front-cont-header">
    <div class="cont-icon"><i class="<?php echo $icon;?>"></i></div>
    <h2 class="cont-title"><?php echo $title;?></h2>
    <p class="cont-ruby"><?php echo $ruby;?></p>
    <div class="tri-border"><span></span></div>
  </header>

<?php
  $i = 1;
  $bzb_contents = get_option('bzb_contents');
  if(is_array($bzb_contents)){
    $left_right = "";
  foreach((array)$bzb_contents as $key => $value){
    $left_right = ($i % 2 == 1) ? 'left' : 'right';
    extract(make_info_4top($value));
?>
  <section id="front-contents-1" class="c_box c_box_<?php echo $left_right;?>">
    <div class="wrap">
      <div class="c_box_inner">
        <div class="c_title">
          <p class="c_number"><?php echo $i;?></p>
          <h3><?php echo $title; ?></h3>
          <p class="c_english"><?php echo $bzb_ruby;?></p>
        </div>
        <div class="c_img_box" style="background-image:url(<?php echo $image;?>)"></div>
        <div class="c_text">
          <h4><?php echo nl2br($bzb_catch);?></h4>
          <p><?php echo $content;?></p>
          <?php if($button_url != ''){ ?>
          <p class="c_btn"><a href="<?php echo $button_url;?>" class="btn"><?php echo $button_text;?></a></p>
          <?php }else{ ?>
          <p class="c_btn"><a href="<?php echo $url;?>" class="btn">詳しく見る</a></p>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
<?php 
  $i++;
    }
  } 
?>


</div><!-- /front-contents -->



<!-- サービス紹介 -->
<?php
  $icon = 'none';
  $title = '';
  $bzb_ruby = '';
  $bzb_catch = '';
  $bzb_service_header_array = get_option('bzb_service_header');
  if(is_array($bzb_service_header_array)){
    extract($bzb_service_header_array) ;
  }

?>
<div id="front-service" class="front-main-cont">

  <header class="category_title main_title front-cont-header">
    <div class="cont-icon"><i class="<?php echo $icon;?>"></i></div>
    <h2 class="cont-title"><?php echo $title;?></h2>
    <p class="cont-ruby"><?php echo $ruby;?></p>
    <div class="tri-border"><span></span></div>
  </header>


  <div class="wrap">
    <div class="front-service-inner">

<?php
  $i = 1;
  $bzb_service = get_option('bzb_service');
  if(isset($bzb_service)){
  foreach((array)$bzb_service as $key => $value){
    extract(make_info_4top($value));
?>
      <section id="front-service-1" class="c_box">
        <div class="c_title">
          <h3><?php echo $title;?></h3>
          <p class="c_english"><?php echo $bzb_ruby;?></p>
        </div>
        <div class="c_text">
          <h4><?php echo nl2br($bzb_catch);?></h4>
          <p><?php echo $service;?></p>
          <?php if(isset($button_text) && $button_text !== '') { ?>
            <p class="c_btn"><a href="<?php echo $button_url;?>" class="btn"><?php echo $button_text;?></a></p>
          <?php }else{ ?>
            <p class="c_btn"><a href="<?php echo $url;?>" class="btn">詳しく見る</a></p>
          <?php } ?>
        </div>
      </section>
  <?php
    }
  }
  ?>    
    </div>
  </div>

</div><!-- /front-contents -->

<!-- 会社概要 -->
<div id="front-company" class="front-main-cont">
  <?php 
    $companies = get_option('company');
    $use_company_map = get_option('use_company_map');
    $company_map = "";
    $company_map_class = '';
    
    if(isset($use_company_map) && $use_company_map !== ''){
      $company_map = get_option('company_map');
    }else{
      $company_map_class='no-company-map';
    }

  $icon = 'none';
  $titile = '';
  $ruby = '';
  $bzb_company_header_array = get_option('bzb_company_header');
  if(is_array($bzb_company_header_array)){
    extract($bzb_company_header_array) ;
  }

  ?>

  <header class="category_title main_title front-cont-header">
    <div class="cont-icon"><i class="<?php echo $icon;?>"></i></div>
    <h2 class="cont-title"><?php echo $title;?></h2>
    <p class="cont-ruby"><?php echo $ruby;?></p>
    <div class="tri-border"><span></span></div>
  </header>


  <section id="front-contents-1" class="c_box c_box_left <?php echo $company_map_class; ?>">
    <div class="c_img_box">
      <?php echo $company_map;?>
    </div>

    <div class="wrap">
      <div class="c_box_inner">
        <?php 
        if(isset($companies) && $companies !== ''){
          $i = 1;
          foreach((array)$companies as $key => $company){
            echo '<dl id="front-company-'.$i.'">';
            echo "<dt><span>" . $company['name'] . "</span></dt><dd><span>" . $company['val'] . "</span></dd>";
            echo "</dl>";
            $i++;
          }
        }
        ?>
      </div>
    </div>
  </section>
</div><!-- front-company -->

<!-- お問い合わせ -->
<div id="front-contact" class="front-main-cont">
  <?php 

  $icon = 0;
  $titile = '';
  $ruby = '';
  $bzb_contact_header_array = get_option('bzb_contact_header');
  if(is_array($bzb_contact_header_array)){
    extract($bzb_contact_header_array) ;
  }

  $bzb_contact_textarea = get_option('bzb_contact_textarea');
  ?>

  <header class="category_title main_title front-cont-header">
    <div class="cont-icon"><i class="<?php echo $icon;?>"></i></div>
    <h2 class="cont-title"><?php echo $title;?></h2>
    <p class="cont-ruby"><?php echo $ruby;?></p>
    <div class="tri-border"><span></span></div>
  </header>

  <section id="front-contents-1" class="c_box c_box_left">
    <div class="wrap">
      <div class="c_box_inner">
        <?php echo $content = apply_filters( 'the_content', $bzb_contact_textarea, 10 ); ?>
      </div>
    </div>
  </section>
</div><!-- front-contact -->


  </div><!-- /main-inner -->
</div><!-- /main -->
  
</div><!-- /content -->
<?php get_footer(); ?>


