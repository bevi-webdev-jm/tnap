<div>
    @if(!empty($msg))
        <div class="alert alert-success">
            {{$msg}}
        </div>
    @endif

    <form class="form-horizontal" wire:submit.prevent="saveSettings">
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm{{$errors->has('name') ? ' is-invalid' : ''}}" placeholder="Name" wire:model="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control form-control-sm{{$errors->has('email') ? ' is-invalid' : ''}}" placeholder="Email" wire:model="email">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
        </div>
    </form>
</div>
