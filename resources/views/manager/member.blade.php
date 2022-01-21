<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member | {{ $member->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>

<body>
    <div class="registration-form">
        <form action="{{ route('manager.members.update', $member->id) }}" method="post" autocomplete="off">
            @csrf
            @method("PUT")

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control item" name="name" id="name" placeholder="Name" value="{{ $member->name }}">
                @if ($errors->has('name'))
                    @error('name') 
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>

            <div class="form-group">
                <input type="text" class="form-control item" name="personnel_code" id="personnel_code" placeholder="Personnel Code" value="{{ $member->personnel_code }}">
                @if ($errors->has('personnel_code'))
                    @error('personnel_code')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            
            
            <div class="form-group">
                <input type="password" class="form-control item" name="password" id="password" placeholder="Password" ">
                @if ($errors->has('password'))
                    @error('password')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="cpassword" id="cpassword" placeholder="Confirm Password" ">
                @if ($errors->has('cpassword'))
                    @error('cpassword')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>

            
            <div class="form-group">
                <label for="is_blocked">Status: </label>
                <label class="switch" >
                    <input type="checkbox" name="status" id="status" value="{{ $member->is_blocked }}" {{ $member->is_blocked == 1 ? '' : 'checked' }}>
                    <span class="slider round"></span>
                </label>
                @if ($errors->has('status'))
                    @error('status')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Update</button>
            </div>
        </form>
    </div>
    <div class="registration-form"">
        <form action="{{ route('manager.members.destroy', $member->id) }}" method="post">
                @csrf
                @method("DELETE")
                
                <div class="form-group">
                    <button type="submit" class="btn btn-block create-account">Delete</button>
                </div>

                @if ($errors->has('deleteError'))
                    @error('deleteError')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>
