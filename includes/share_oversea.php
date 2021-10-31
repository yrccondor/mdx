<li class="mdui-menu-item">
    <a href="https://telegram.me/share/url?url=<?php echo mdx_get_now_url(); ?>&text=<?php the_title(); ?>" class="mdui-ripple" target="_blank">
        <svg class="mdx-share-icon mdui-menu-item-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
            <path d="M417.28 795.733l11.947-180.48L756.907 320c14.506-13.227-2.987-19.627-22.187-8.107L330.24 567.467 155.307 512c-37.547-10.667-37.974-36.693 8.533-55.467l681.387-262.826c31.146-14.08 61.013 7.68 49.066 55.466L778.24 795.733c-8.107 38.827-31.573 48.214-64 30.294L537.6 695.467l-84.907 82.346c-9.813 9.814-17.92 17.92-35.413 17.92z"/>
        </svg> <?php _e( '分享到 Telegram', 'mdx' ); ?></a>
</li>
<li class="mdui-menu-item">
    <a href="https://www.facebook.com/sharer.php?u=<?php echo mdx_get_now_url(); ?>" class="mdui-ripple" target="_blank">
        <svg class="mdx-share-icon mdui-menu-item-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
            <path d="M567.893 988.587V537.643h151.382L741.888 361.9H567.893V249.684c0-50.858 14.123-85.546 87.083-85.546h93.056V6.87C731.947 4.78 676.736 0 612.437 0 478.293 0 386.432 81.92 386.432 232.32V361.9H234.667v175.743h151.765v450.944h181.46z"/>
        </svg> <?php _e( '分享到 Facebook', 'mdx' ); ?></a>
</li>
<li class="mdui-menu-item">
    <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo mdx_get_now_url(); ?>" class="mdui-ripple" target="_blank">
        <svg class="mdx-share-icon mdui-menu-item-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
            <path d="M962.267 233.18q-38.253 56.027-92.598 95.45.584 7.973.584 23.992 0 74.313-21.724 148.26t-65.975 141.97-105.398 120.32T529.7 846.63t-184.54 31.157q-154.842 0-283.427-82.87 19.968 2.267 44.544 2.267 128.585 0 229.156-78.848-59.977-1.17-107.447-36.864t-65.17-91.136q18.87 2.853 34.89 2.853 24.575 0 48.566-6.292-64-13.165-105.984-63.707T98.304 405.798v-2.268q38.84 21.723 83.456 23.405-37.742-25.16-59.977-65.682t-22.31-87.99q0-50.324 25.162-93.112 69.12 85.14 168.302 136.266t212.26 56.832q-4.534-21.723-4.534-42.277 0-76.58 53.98-130.56t130.56-53.978q80.018 0 134.875 58.295 62.317-11.996 117.175-44.544-21.14 65.682-81.116 101.742 53.175-5.706 106.277-28.6z"/>
        </svg> <?php _e( '分享到 Twitter', 'mdx' ); ?></a>
</li>