<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                @if(!empty($profile_pic))
                    <img class="img-fluid img-circle profile-img"
                        src="{{$profile_pic->temporaryUrl()}}"
                        alt="User profile picture">
                @else
                    <img class="img-fluid img-circle profile-img"
                        src="{{$user->adminlte_image()}}"
                        alt="User profile picture">
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="profile_pic">Profile Picture</label>
                <input type="file" class="form-control form-control-sm" wire:model.live="profile_pic">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary btn-xs" wire:click.prevent="changeProfile">
                <i class="fa fa-save fa-sm"></i>
                SAVE
            </button>
        </div>
    </div>
</div>
