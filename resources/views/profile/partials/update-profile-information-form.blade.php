<section>
    <p class="text-muted mb-4">قم بتحديث معلومات الملف الشخصي وعنوان البريد الإلكتروني.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email', $user->email) }}" 
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    <p class="mb-2">عنوان بريدك الإلكتروني غير مفعّل.</p>
                    <button form="send-verification" class="btn btn-sm btn-link p-0">
                        اضغط هنا لإعادة إرسال رسالة التفعيل.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 mb-0 text-success">
                            تم إرسال رابط التفعيل الجديد إلى بريدك الإلكتروني.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">حفظ</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0">تم الحفظ بنجاح.</p>
            @endif
        </div>
    </form>
</section>
