<div class="mb-6">
  <x-form.input type="text" field="name" title="Nama User" :value="$user->name" required oninput="removeValidationError(this)" />
</div>
<div class="mb-6">
  <x-form.select field="jk" title="Jenis Kelamin" class="select2" :value="$user->jk" :option="\App\Enums\User::jk()" data-minimum-results-for-search="Infinity" onchange="removeValidationError(this)" required />
</div>
<div class="mb-6">
  <x-form.select field="role" title="Role" class="select2" :value="$user->role" :option="\App\Enums\User::role()" data-minimum-results-for-search="Infinity" onchange="removeValidationError(this)" required />
</div>
<div class="mb-6">
  <x-form.textarea field="alamat" title="Alamat" :value="$user->alamat" oninput="removeValidationError(this)" />
</div>
<div class="mb-6">
  <x-form.input type="email" field="email" title="Email" :value="$user->email" required oninput="removeValidationError(this)" required />
</div>
<div class="mb-6">
  @if ($action == 'create')
    <x-form.input type="password" field="password" title="Password" oninput="removeValidationError(this)" required />
  @else
    <x-form.input type="password" field="password" title="Password" oninput="removeValidationError(this)" />
  @endif
</div>
