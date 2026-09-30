<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Equipment - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin-sidebar.css">
    <link rel="stylesheet" href="/css/admin-equipment.css?v={{ filemtime(public_path('css/admin-equipment.css')) }}">
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar')

        <main class="main-content admin-equipment-main">
            <header class="admin-equipment-header">
                <h1>Equipment</h1>
            </header>

            @if (session('success'))
                <div class="admin-equipment-alert" role="status">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="admin-equipment-alert admin-equipment-alert-error" role="alert">{{ $errors->first() }}</div>
            @endif

            <form class="admin-equipment-form" method="POST" action="{{ route('admin.equipment.update') }}" id="equipmentSettingsForm">
                @csrf
                @method('PUT')

                <section class="admin-equipment-editor" aria-label="Equipment settings">
                    <div class="admin-equipment-editor-title">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 17h2l2-6h8l3 4h3v4h-2a2 2 0 0 1-4 0h-5a2 2 0 0 1-4 0H3zm4-6 1-4h6l1 4M9 7V5h5v2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="7" cy="19" r="1.5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17" cy="19" r="1.5" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        <h2>Equipment Settings</h2>
                    </div>

                    <div class="admin-equipment-table-wrap">
                        <div class="admin-equipment-row admin-equipment-row-heading" aria-hidden="true">
                            <span>Equipment</span>
                            <span>Quantity</span>
                            <span>Hours</span>
                            <span>Price (₱/Hour)</span>
                            <span>Action</span>
                        </div>

                        @forelse ($equipmentItems as $index => $equipment)
                            <div class="admin-equipment-row" data-equipment-row>
                                <div class="admin-equipment-identity">
                                    <img src="{{ asset('images/' . $equipment->image) }}" alt="{{ $equipment->equipment_name }}">
                                    <div data-equipment-name="{{ $equipment->equipment_name }}" data-available="{{ $equipment->availability['available'] }}">
                                        <strong>{{ $equipment->equipment_name }}</strong>
                                    </div>
                                </div>

                                <input type="hidden" name="equipment_items[{{ $index }}][id]" value="{{ $equipment->id }}">
                                <input type="hidden" name="equipment_items[{{ $index }}][equipment_name]" value="{{ $equipment->equipment_name }}">
                                <label class="admin-equipment-field" aria-label="{{ $equipment->equipment_name }} quantity">
                                    <span class="admin-equipment-mobile-label">Quantity</span>
                                    <input type="number" name="equipment_items[{{ $index }}][total_quantity]" min="0" max="9999" step="1" value="{{ old("equipment_items.{$index}.total_quantity", $equipment->total_quantity) }}" required>
                                </label>
                                <label class="admin-equipment-field" aria-label="{{ $equipment->equipment_name }} default hours">
                                    <span class="admin-equipment-mobile-label">Hours</span>
                                    <input type="number" name="equipment_items[{{ $index }}][default_hours]" min="0.25" max="24" step="0.25" value="{{ old("equipment_items.{$index}.default_hours", $equipment->default_hours) }}" required>
                                </label>
                                <label class="admin-equipment-field admin-equipment-price" aria-label="{{ $equipment->equipment_name }} hourly rate">
                                    <span class="admin-equipment-mobile-label">Price per hour</span>
                                    <span class="admin-equipment-currency">₱</span>
                                    <input type="number" name="equipment_items[{{ $index }}][hourly_rate]" min="0" max="9999999" step="0.01" value="{{ old("equipment_items.{$index}.hourly_rate", $equipment->hourly_rate) }}" required>
                                    <span class="admin-equipment-per-hour">/hour</span>
                                </label>
                                <button class="admin-equipment-reset admin-equipment-remove" type="button" data-row-reset title="Reset this row" aria-label="Reset {{ $equipment->equipment_name }} row">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </div>
                        @empty
                            <p class="admin-equipment-empty">No equipment has been registered.</p>
                        @endforelse
                    </div>

                    <div class="admin-equipment-add-wrap">
                        <button type="button" class="admin-equipment-add" data-add-equipment>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14m-7-7h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            Add Another Equipment
                        </button>
                    </div>

                    <template id="newEquipmentRowTemplate">
                        <div class="admin-equipment-row admin-equipment-row-new" data-equipment-row>
                            <div class="admin-equipment-identity">
                                <img src="{{ asset('images/tractor.png') }}" alt="New equipment">
                                <label class="admin-equipment-new-name">
                                    <span>Equipment name</span>
                                    <input type="text" name="equipment_items[__INDEX__][equipment_name]" maxlength="255" placeholder="New equipment name" required>
                                </label>
                            </div>
                            <input type="hidden" name="equipment_items[__INDEX__][id]" value="">
                            <label class="admin-equipment-field" aria-label="New equipment quantity">
                                <span class="admin-equipment-mobile-label">Quantity</span>
                                <input type="number" name="equipment_items[__INDEX__][total_quantity]" min="0" max="9999" step="1" value="1" required>
                            </label>
                            <label class="admin-equipment-field" aria-label="New equipment default hours">
                                <span class="admin-equipment-mobile-label">Hours</span>
                                <input type="number" name="equipment_items[__INDEX__][default_hours]" min="0.25" max="24" step="0.25" value="1" required>
                            </label>
                            <label class="admin-equipment-field admin-equipment-price" aria-label="New equipment hourly rate">
                                <span class="admin-equipment-mobile-label">Price per hour</span>
                                <span class="admin-equipment-currency">₱</span>
                                <input type="number" name="equipment_items[__INDEX__][hourly_rate]" min="0" max="9999999" step="0.01" value="0" required>
                                <span class="admin-equipment-per-hour">/hour</span>
                            </label>
                            <button class="admin-equipment-reset admin-equipment-remove" type="button" data-row-remove title="Remove new row" aria-label="Remove new equipment row">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    </template>

                    <div class="admin-equipment-footer">
                        <button type="reset" class="admin-equipment-cancel">Cancel</button>
                        <button type="submit" class="admin-equipment-save">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 3h12l4 4v14H3V3zm3 0v6h8V3m-8 18v-8h10v8" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                            Save Settings
                        </button>
                    </div>
                </section>
            </form>
        </main>
    </div>

    <script>
        let newEquipmentRowCount = 0;
        const equipmentRows = document.querySelector('.admin-equipment-table-wrap');
        const newEquipmentRowTemplate = document.getElementById('newEquipmentRowTemplate');

        document.addEventListener('click', (event) => {
            const addButton = event.target.closest('[data-add-equipment]');
            if (addButton) {
                const index = `new_${++newEquipmentRowCount}`;
                const rowMarkup = newEquipmentRowTemplate.innerHTML.replaceAll('__INDEX__', index);
                equipmentRows.insertAdjacentHTML('beforeend', rowMarkup);
                equipmentRows.lastElementChild.querySelector('input[type="text"]').focus();
                return;
            }

            const removeButton = event.target.closest('[data-row-remove]');
            if (removeButton) {
                removeButton.closest('[data-equipment-row]').remove();
                return;
            }

            const resetButton = event.target.closest('[data-row-reset]');
            if (resetButton) {
                const row = resetButton.closest('[data-equipment-row]');
                row.querySelectorAll('input[type="number"]').forEach((input) => {
                    input.value = input.defaultValue;
                });
            }
        });
    </script>
</body>
</html>