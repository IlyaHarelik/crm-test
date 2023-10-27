<form action="{{ route('language.switch') }}" method="POST" class="inline=block">
    @csrf
    <select name="language" onchange="this.form.submit()" class="p-2 w-36 rounded bg-gray-100 text-gray-800">
        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
        <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>Русский</option>
    </select>
</form>
