@php $styleCss = 'style'; @endphp
<tr>
    <td class="header">
        <a href="{{ $url }}" {{ $styleCss }}="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ getLogoUrl() }}" class="logo object-fit-cover"
                     alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
