<?php include_once ROOT . '\App\Views\shared\_header.php' ?>

<div class="py-4"></div>
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class=" col-lg-9   mb-5 mb-lg-0">
        <article>
          <div class="post-slider mb-4">
            <img src="/<?= $post->cover_image ?>" class="card-img" alt="post-thumb">
          </div>
          
          <h1 class="h2"><?= $post->title ?> </h1>
          <ul class="card-meta my-3 list-inline">
            <li class="list-inline-item">
              <a href="/author/<?= $post->author->username ?>" class="card-meta-author">
                <img src="/<?= $post->author->picture_path ?>">
                <span><?= $post->author->full_name ?></span>
              </a>
            </li>
            <li class="list-inline-item">
              <i class="ti-timer"></i><?= $post->x_minutes_read ?> Min To Read
            </li>
            <li class="list-inline-item">
              <i class="ti-calendar"></i><?= $post->created_at ?>
            </li>
            <li class="list-inline-item">
              <ul class="card-meta-tag list-inline">
                <?php foreach( $post->decodeTags() as $tag ): ?>
									<li class="list-inline-item"><a href="/filter/tag=<?=$tag?>"><?=$tag?></a></li>
									<?php endforeach; ?>
              </ul>
            </li>
          </ul>
          <div class="content">
            <?= html_entity_decode($post->content) ?>
          </div>
        </article>
        
      </div>
    </div>
  </div>
</section>


<?php include_once ROOT . '\App\Views\shared\_footer.php' ?>