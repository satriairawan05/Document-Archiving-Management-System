<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-2">
                <label for="type">Type <span class="text-danger">*</span> </label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                    placeholder="Enter Letter Type Here ..." value="{{ old('type', $letterType->type ?? '') }}"
                    name="type">
                @error('type')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label for="code">Code <span class="text-danger">*</span> </label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                    placeholder="Enter Letter Code Here ..." value="{{ old('code', $letterType->code ?? '') }}"
                    name="code">
                @error('code')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        {{-- <div class="row mb-3">
            <div class="col-2">
                <label for="number">Number <span class="text-danger">*</span> </label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number"
                    placeholder="Enter Letter Number Here ..." value="{{ old('number', $letterType->number ?? '') }}"
                    name="number">
                @error('number')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ $cancelRoute }}" class="btn btn-sm btn-secondary mx-2"><i class="fa fa-reply-all"></i></a>
                <button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">{{ $submitButton }}</button>
            </div>
        </div>
    </div>
</form>
