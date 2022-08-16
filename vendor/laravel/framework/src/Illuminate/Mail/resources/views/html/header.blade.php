<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'SIEFCO')
<img src="../resources/views/Asset/logo.png" class="logo" alt="SIEFCO LOGO">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
