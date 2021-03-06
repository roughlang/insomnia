<?php
include(__DIR__."/include/common.php");
// echo basename(get_page_template());
?>
<!DOCTYPE html>
<html lang="ja">
<?php include("include/header.php"); ?>
<body>
<div class="topbar"></div>
<?php include("include/nav.php"); ?>
	
	<div class="container lw-contents-block blog-contents-block mt60 mb60">
		<div class="row">
			<div class="col-md-9 blog">
				<h2 class="mb60"><?php echo $blog_title; ?></h2>
				<div class="breadcrumb">
					<ul>
						<li class="parent"><a href="/">Home</a></li>
						<li><a href="<?php echo home_url(); ?>"><?php echo $blog_title; ?></a></li>
						<!-- <li class="parent"><a href="#">Category</a></li>
						<li><a href="#">Blog title</a></li> -->
					</ul>
				</div>


        <div class="container document-menu mb200">
          <div class="row">
            <a href="/ac/menu_of_philosophy/">
              <div class="menu-index menu-index-1" id="menu-index-1">
                <span class="text">Philosophy</span>
                <img src="/assets/img/top/bl_009.png" class="menu-index-img menu-index-img-1">
              </div>
            </a>
            <a href="/ac/archives">
              <div class="menu-index menu-index-2" id="menu-index-2">
                <span class="text">Archive</span>
                <img src="/assets/img/top/bl_002.png" class="menu-index-img menu-index-img-2">
              </div>
            </a>
            <a href="/ac/category/technology-system/">
              <div class="menu-index menu-index-3" id="menu-index-3">
                <span class="text">System</span>
                <img src="/assets/img/top/bl_003.png" class="menu-index-img menu-index-img-3">
              </div>
            </a>
          </div>
        </div>


				<?php if(have_posts()): ?>
					<?php while(have_posts()): the_post(); ?>
						<h4 class="blog-top-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="tags float-end">
							<?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?>
						</div><br clear="both">
						<?php
						$content = get_the_content();
						$content = adjust_content_text($content);
						$content = mb_substr($content,0,200);
						echo "<p class='top-content'>";
						
						// if (!empty(the_post_thumbnail_url())) {
						// 	echo "<img src='".the_post_thumbnail_url()."' class='blog-icatch'>";
						// }
						$thumbnail = get_the_post_thumbnail_url();
						if (empty(get_the_post_thumbnail_url())) {
							// nothing
						} else {
							echo "<img src='".$thumbnail."' class='blog-icatch'>";
						}
            $content = strip_tags($content);
						echo $content."..."."</p>";
						?>
						<div class="blog-meta mb50">
							
							<p class="datetime float-end"><?php the_time('Y.m.d'); ?></p>
							<?php the_category(); ?>
						</div>
					<?php endwhile; ?>
				<?php else: ?>
					<!-- ??????????????????????????????????????????????????? -->
				<?php endif; ?>

				<?php
				the_posts_pagination(
					array(
						'mid_size'      => 2, // ????????????????????????????????????????????????????????????
						'prev_next'     => true, // ????????????????????????????????????????????????????????????true
						'prev_text'     => __( '&lt;'), // ????????????????????????????????????
						'next_text'     => __( '&gt;'), // ????????????????????????????????????
						'type'          => 'list', // ?????????????????? (plain/list)
					)
				); ?>
			</div>

			<div class="col-md-3 blog">
				<?php if ( is_active_sidebar('main-sidebar') ) : ?>
					<ul class="menu">
						<?php dynamic_sidebar('main-sidebar'); ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php include("include/footer.php"); ?>
</body>
</html>





