<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="{{ $icon }}"></i>
        </span>
        <span class="menu-title">{{ $name }}</span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion" kt-hidden-height="117" style="display: none; overflow: hidden;">
        {{ $slot }}
    </div>
</div>