@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $lead->name ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $lead->email ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $lead->phone ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Company</label>
    <input type="text" name="company" value="{{ old('company', $lead->company ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Source</label>
    <select name="source" class="form-control" required>
        @foreach(['website', 'call', 'referral'] as $source)
            <option value="{{ $source }}" {{ old('source', $lead->source ?? '') === $source ? 'selected' : '' }}>
                {{ ucfirst($source) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        @foreach(['new', 'contacted', 'qualified', 'converted', 'lost'] as $status)
            <option value="{{ $status }}" {{ old('status', $lead->status ?? 'new') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Expected Value</label>
    <input type="number" step="0.01" name="expected_value" value="{{ old('expected_value', $lead->expected_value ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Assign To</label>
    <select name="user_id" class="form-control" required>
        @foreach($salesUsers as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $lead->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>