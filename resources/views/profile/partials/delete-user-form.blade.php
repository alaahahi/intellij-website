<section>
    <p class="text-muted mb-4">عندما يتم حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل دائم. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.</p>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        حذف الحساب
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">هل أنت متأكد من رغبتك في حذف حسابك؟</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <p>بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل دائم. يرجى إدخال كلمة المرور لتأكيد رغبتك في حذف حسابك نهائياً.</p>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" 
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="أدخل كلمة المرور">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">حذف الحساب</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
                deleteModal.show();
            });
        </script>
    @endif
</section>
