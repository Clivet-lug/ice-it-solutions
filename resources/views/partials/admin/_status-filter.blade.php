<div>
    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        <option value="">All Status</option>
        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
