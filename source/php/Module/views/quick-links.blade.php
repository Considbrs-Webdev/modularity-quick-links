<div class="modularity-quick-links" data-max-items="{{ $maxItemsPerRow }}" data-gap="{{ $gap ?? 0 }}"
    data-large-icons="{{ $largeIcons ? 'true' : 'false' }}"
    data-use-description="{{ $useShortDescription ? 'true' : 'false' }}" data-item-count="{{ count($links) }}"
    @if (!empty($quickLinksRootStyle ?? '')) style="{{ $quickLinksRootStyle }}" @endif>
    <div class="modularity-quick-links__grid">
        @foreach ($links as $linkItem)
            <a href="{{ $linkItem['link'] }}"
                @if (!empty($linkItem['target'])) target="{{ $linkItem['target'] }}" @endif
                @if (($linkItem['target'] ?? '') === '_blank') rel="noopener noreferrer" @endif
                class="modularity-quick-links__card {{ $largeIcons ? 'modularity-quick-links__card--large-icon' : '' }} {{ $useIcons ? 'modularity-quick-links__card--has-icon' : '' }}">
                @if ($useIcons && !empty($linkItem['icon']))
                    <div class="modularity-quick-links__icon">
                        @icon([
                            'icon' => $linkItem['icon'],
                            'size' => $largeIcons ? 'lg' : 'md'
                        ])
                        @endicon
                    </div>
                @endif

                @typography([
                    'element' => 'span',
                    'variant' => 'h4',
                    'classList' => ['modularity-quick-links__title', 'u-margin--0']
                ])
                    {{ $linkItem['title'] }}
                @endtypography

                @if ($useShortDescription && !empty($linkItem['description']))
                    <p class="modularity-quick-links__description">
                        {{ $linkItem['description'] }}
                    </p>
                @endif
            </a>
        @endforeach
    </div>
</div>
