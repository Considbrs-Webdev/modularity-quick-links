@if (!empty($links))
    <nav class="modularity-quick-links" aria-labelledby="{{ $navId }}"
        data-max-items="{{ $maxItemsPerRow }}" data-gap="{{ $gap ?? 0 }}"
        data-large-icons="{{ $largeIcons ? 'true' : 'false' }}"
        data-use-description="{{ $useShortDescription ? 'true' : 'false' }}"
        data-item-count="{{ count($links) }}"
        @if (!empty($quickLinksRootStyle ?? '')) style="{{ $quickLinksRootStyle }}" @endif>
        <h2 id="{{ $navId }}" class="screen-reader-text">
            {{ ($postTitle ?? '') !== '' ? $postTitle : __('Quick links', 'modularity-quick-links') }}
        </h2>
        <ul class="modularity-quick-links__grid">
            @foreach ($links as $linkItem)
                <li
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
                        'element' => 'h3',
                        'variant' => 'h4',
                        'classList' => ['modularity-quick-links__title', 'u-margin--0']
                    ])
                        @if (!empty($linkItem['link']))
                            <a href="{{ $linkItem['link'] }}" class="modularity-quick-links__link"
                                @if (!empty($linkItem['target'])) target="{{ $linkItem['target'] }}" @endif
                                @if (($linkItem['target'] ?? '') === '_blank') rel="noopener noreferrer" @endif><span
                                    class="modularity-quick-links__link-label">{{ $linkItem['title'] }}</span></a>
                        @else
                            {{ $linkItem['title'] }}
                        @endif
                    @endtypography

                    @if ($useShortDescription && !empty($linkItem['description']))
                        <p class="modularity-quick-links__description">
                            {{ $linkItem['description'] }}
                        </p>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
@endif
