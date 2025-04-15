<div class="btn-group">
  <x-form.button href="{{ route('user.show', $user->id) }}" class="btn-sm btn-info">
    <x-partials.icon class="bx-show" />
  </x-form.button>
  <x-form.button href="{{ route('user.edit', $user->id) }}" class="btn-sm btn-warning btn-edit">
    <x-partials.icon class="bx-pencil" />
  </x-form.button>
  <x-form.button class="btn-sm btn-danger btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
    <x-partials.icon class="bx-trash" />
  </x-form.button>
</div>
