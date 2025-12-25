<div class="flex space-2 gap-2">
    <a class="px-3 py-1 border rounded-md" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
        target="_blank" class="btn btn-facebook">
        <i class="fab fa-facebook-f"></i>
    </a>

    <a class="px-3 py-1 border rounded-md"
        href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($text) }}" target="_blank"
        class="btn btn-twitter">
        <i class="fab fa-twitter"></i>
    </a>
    <a class="px-3 py-1 border rounded-md"
        href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($url) }}&title={{ urlencode($title) }}&summary={{ urlencode($summary) }}"
        target="_blank" class="btn btn-linkedin">
        <i class="fab fa-linkedin-in"></i>
    </a>
    <a class="px-3 py-1 border rounded-md" href="https://api.whatsapp.com/send?text={{ urlencode($text . ' ' . $url) }}"
        target="_blank" class="btn btn-whatsapp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <button onclick="navigator.clipboard.writeText('{{ $url }}')" class="btn btn-copy">
        <i class="fas fa-link"></i> Copy Link
    </button>
</div>