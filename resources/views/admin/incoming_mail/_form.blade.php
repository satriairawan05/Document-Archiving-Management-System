<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;" enctype="multipart/form-data">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-12">
                <label for="subject">Subject <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject"
                    placeholder="Enter Letter Subject Here ..." value="{{ old('subject', $mail->subject ?? '') }}"
                    name="subject">
                @error('subject')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="from">From <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('from') is-invalid @enderror" id="from"
                    placeholder="Enter Letter From Here ..." value="{{ old('from', $mail->from ?? '') }}"
                    name="from">
                @error('from')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="sender">Sender <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('sender') is-invalid @enderror" id="sender"
                    placeholder="Enter Letter Sender Here ..." value="{{ old('sender', $mail->sender ?? '') }}"
                    name="sender">
                @error('sender')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="col-6">
                <label for="receipint">Receipint <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('receipint') is-invalid @enderror" id="receipint"
                    placeholder="Enter Letter Receipint Here ..." value="{{ old('receipint', $mail->receipint ?? '') }}"
                    name="receipint">
                @error('receipint')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="document">Document <span class="text-danger">*</span> </label>
                <input type="file" name="document" id="document" class="form-control form-control-file @error('receipint') is-invalid @enderror" id="receipint"
                    placeholder="Enter Letter File Here ..." value="{{ old('document') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ $cancelRoute }}" class="btn btn-sm btn-secondary mx-2"><i class="fa fa-reply-all"></i></a>
                <button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">{{ $submitButton }}</button>
            </div>
        </div>
    </div>
</form>
