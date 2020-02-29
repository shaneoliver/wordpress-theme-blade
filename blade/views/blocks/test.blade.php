<div class="block">
    <div class="block__heading">
        <h1>{{ esc_html( $heading ) }}</h1>
    </div>
    <div class="block__image">
        {!! wp_get_attachment_image( $image, 'full' ) !!}
    </div>
    <div class="block__content">
        {!! apply_filters( 'the_content', $content ) !!}
    </div>
</div>

