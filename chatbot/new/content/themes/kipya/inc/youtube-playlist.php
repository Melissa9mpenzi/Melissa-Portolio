<?php //Custom Post :: Video Gallery

//YouTube API Helper 
function fetch_youtube_playlist_items($api_key, $playlist_id, $max_results = 5) {
    $api_url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=$max_results&playlistId=$playlist_id&key=$api_key";

    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) return [];

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['items'])) return [];

    $videos = [];
    foreach ($data['items'] as $item) {
        $video_id = $item['snippet']['resourceId']['videoId'];
        $videos[] = [
            'title' => $item['snippet']['title'],
            'link' => 'https://www.youtube.com/embed/' . $video_id,
            'thumbnail' => $item['snippet']['thumbnails']['medium']['url']
        ];
    }
    return $videos;
}



/** =================================================================
 *  SHORTCODE - Playlist - Home PAGE
 *===================================================================*/
function youtube_api_videos_shortcode($atts) {
    $atts = shortcode_atts(array(
        'api_key' => '',
        'playlist_id' => '',
        'number' => 5
    ), $atts, 'youtube-videos');

    if (empty($atts['api_key']) || empty($atts['playlist_id'])) return 'Missing API Key or Playlist ID.';

    $videos = fetch_youtube_playlist_items($atts['api_key'], $atts['playlist_id'], $atts['number']);

    ob_start();

    if (!empty($videos)) {
        ?>
        <div class="video-gallery">
            <div class="video-main">
                <iframe id="main-video-frame" width="100%" height="400" src="<?php echo esc_url($videos[0]['link']); ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="video-thumbnails columns is-mobile is-multiline mt-3">
                <?php foreach ($videos as $index => $video) : ?>
                    <div class="column is-narrow thumbnail" style="cursor:pointer;">
                        <figure class="image is-16by9" style="width:160px;">
                            <img src="<?php echo esc_url($video['thumbnail']); ?>" data-link="<?php echo esc_url($video['link']); ?>">
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            document.querySelectorAll('.video-thumbnails .thumbnail img').forEach((img, index) => {
                img.addEventListener('click', function() {
                    document.getElementById('main-video-frame').src = this.dataset.link;
                });
            });
        </script>
        <?php
    }

    return ob_get_clean();
}
add_shortcode('youtube-videos', 'youtube_api_videos_shortcode');



function exploreug_youtube_gallery_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'videos' => '', // comma-separated YouTube URLs or IDs
        ),
        $atts
    );

    if (empty($atts['videos'])) {
        return '<p>No videos provided.</p>';
    }

    $videos = array_map('trim', explode(',', $atts['videos']));
    $video_ids = [];

    foreach ($videos as $video) {
        if (preg_match(
            '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $video,
            $matches
        )) {
            $video_ids[] = $matches[1];
        } elseif (strlen($video) === 11) {
            $video_ids[] = $video;
        }
    }

    if (empty($video_ids)) {
        return '<p>Invalid video list.</p>';
    }

    ob_start(); ?>
    
    <div class="youtube-gallery">
        <div class="youtube-main">
            <iframe
                id="yt-main-player"
                src="https://www.youtube.com/embed/<?php echo esc_attr($video_ids[0]); ?>"
                allowfullscreen
                loading="lazy">
            </iframe>
        </div>

        <div class="youtube-thumbs">
            <?php foreach ($video_ids as $id): ?>
                <div class="youtube-thumb" data-video="<?php echo esc_attr($id); ?>">
                    <img src="https://img.youtube.com/vi/<?php echo esc_attr($id); ?>/hqdefault.jpg" alt="">
                    <span class="play-btn">▶</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    document.querySelectorAll('.youtube-thumb').forEach(thumb => {
        thumb.addEventListener('click', function () {
            document.getElementById('yt-main-player').src =
                'https://www.youtube.com/embed/' + this.dataset.video;
        });
    });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('youtube_gallery', 'exploreug_youtube_gallery_shortcode');

