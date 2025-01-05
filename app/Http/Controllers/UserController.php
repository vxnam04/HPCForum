<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        $user = Auth::user();

        // Truyền thông tin user vào view
        return view('user-dashboard', compact('user'));
    }
    public function index1() {
        // Truy vấn danh sách bài viết
        $posts = Post::orderBy('ngayDang', 'desc')->take(5)->get();
        return view('user-dashboard', compact('posts'));
    }
    public function index2()
    {
        $users = User::all(); // Lấy tất cả người dùng
        return view('usertrongadmin', compact('users')); // Trả về view với danh sách người dùng
    }
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json(['message' => 'Tài khoản đã được xóa thành công.'], 200);
}
public function editRoles($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all(); // Danh sách quyền từ bảng roles (nếu có)
    return view('adminroles', compact('user', 'roles'));
}
public function updateRoles(Request $request, $id)
{
    $user = User::findOrFail($id);
    $roles = $request->input('roles', []); // Lấy danh sách quyền từ form
    $user->roles()->sync($roles); // Cập nhật quyền
    return redirect()->route('/users/{id}/roles')->with('success', 'Cập nhật quyền thành công.');
}

}
