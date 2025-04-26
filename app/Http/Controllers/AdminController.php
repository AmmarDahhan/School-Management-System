<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.pages.auth.login'); // تغيير مسار العرض حسب احتياجاتك
    //     if(view()->exists($id)){
    //         return view($id);
    //     }
    //     else
    //     {
    //         return view('404');
    //     }

    //  //   return view($id);
    }
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // التحقق من حالة المستخدم
            if (!$user) {
                Auth::logout(); // تسجيل الخروج للمستخدم
                return back()->withErrors([
                    'email' => 'حسابك غير مفعل، يرجى التواصل مع الإدارة.',
                ]);
            }

            // إذا كان المستخدم مفعل، إعادة إنشاء الجلسة
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // إذا كانت بيانات الدخول غير صحيحة
        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ]);
    }
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
