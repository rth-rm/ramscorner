<div>
    <select wire:model="selectedOption">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <!-- Add more options as needed -->
    </select>

    <table>
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <!-- Add more headers if needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['column1'] }}</td>
                    <td>{{ $item['column2'] }}</td>
                    <!-- Add more cells if needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
