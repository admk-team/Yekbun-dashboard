<form id="editForm{{ $user->id }}" action="{{ route('settings.team.members.update', $user->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="showEditFormModal{{ $user->id }}" value="1">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="inputName{{ $user->id }}">Name</label>
                    <input type="text" id="inputName{{ $user->id }}" name="name" class="form-control" value="{{ old('name')?? $user->name }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="inputEmail{{ $user->id }}">Email</label>
                    <input type="text" id="inputEmail{{ $user->id }}" name="email" class="form-control" value="{{ old('email')?? $user->email }}">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="imageInput{{ $user->id }}">Profile Image</label>
                    <input type="file" name="image" id="imageInput{{ $user->id }}" class="form-control">
                </div>
                <div class="col-md-12">
                    <label for="rolesInput{{ $user->id }}" class="form-label">Roles</label>
                    <input id="rolesInput{{ $user->id }}" name="roles" class="form-control" value="{{ $user->roles? rtrim($user->roles->reduce(fn($c, $i)=>$c.=$i->name.', '), ', '): '' }}" />
                    @error('roles')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="imageInput{{ $user->id }}">Status</label>
                    <select class="form-control" name="status" id="imageInput{{ $user->id }}">
                        <option value="1" {{ $user->status? 'selected': '' }}>Active</option>
                        <option value="0" {{ !$user->status? 'selected': '' }}>Disabled</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    window.addEventListener('load', function () {
        const TagifyRolesListEl = document.querySelector('#rolesInput{{ $user->id }}');

        let TagifyRolesLIst = new Tagify(TagifyRolesListEl, {
            tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
            enforceWhitelist: true,
            skipInvalid: true, // do not remporarily add invalid tags
            dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'users-list',
            searchKeys: ['name', 'email'] // very important to set by which keys to search for suggesttions when typing
            },
            templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate
            },
            whitelist: rolesList
        });
    })
</script>