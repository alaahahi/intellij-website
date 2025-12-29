<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * حفظ طلب الاتصال
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'project_type' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ContactRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'project_type' => $request->project_type,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        return back()->with('success', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
    }

    /**
     * عرض جميع الطلبات
     */
    public function index(Request $request)
    {
        $query = ContactRequest::query()->orderBy('created_at', 'desc');

        // فلترة حسب الحالة
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // البحث
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15);

        return view('admin.contact-requests.index', compact('requests'));
    }

    /**
     * عرض تفاصيل الطلب
     */
    public function show(ContactRequest $contactRequest)
    {
        // تحديث الحالة إلى "مقروء" عند فتح الطلب
        if ($contactRequest->status === 'new') {
            $contactRequest->update(['status' => 'read']);
        }

        return view('admin.contact-requests.show', compact('contactRequest'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function updateStatus(Request $request, ContactRequest $contactRequest)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,archived',
        ]);

        $contactRequest->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    /**
     * حذف الطلب
     */
    public function destroy(ContactRequest $contactRequest)
    {
        $contactRequest->delete();

        return redirect()->route('admin.contact-requests.index')
            ->with('success', 'تم حذف الطلب بنجاح.');
    }
}
