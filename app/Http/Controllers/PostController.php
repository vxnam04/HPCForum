<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index() {
    
    $postbaidang = Post::all();  // Hoặc câu truy vấn phù hợp để lấy dữ liệu
        
    return view('blog\postbaidang', compact('postbaidang'));
    }
    public function index1() {
    
        $posts = Post::all();  // Hoặc câu truy vấn phù hợp để lấy dữ liệu
            
        return view('admin-dashboard', compact('posts'));
        }
   public function search(Request $request)
{
    $query = $request->input('query');
    $posts = Post::where('tieuDe', 'like', "%{$query}%")->get();

    return view('Search', compact('posts', 'query'));
}
    // Hiển thị form tạo bài viết
    public function create()
    {
        return view('posts.create');
    }

    // Lưu bài viết mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Kiểm tra nếu người dùng không phải giảng viên
        if (auth()->user()->userType != 'GV') {
            return redirect()->route('baidang')->with('error', 'Chỉ giảng viên mới có thể tạo bài viết!');
        }
    
        $validated = $request->validate([
            'tieuDe' => 'required|max:255',
            'noiDung' => 'required',
        ]);
    
        $post = new Post();
        $post->tieuDe = $validated['tieuDe'];
        $post->noiDung = $validated['noiDung'];
        $post->ngayDang = now();
        $post->soLike = 0;
        $post->soBinhLuan = 0;
        $post->trangThaiDuyet = 0; // Chưa duyệt
        $post->userID = auth()->id();
        $post->save();
    
        return redirect()->route('baidang')->with('success', 'Bài viết đã được tạo thành công!');
    }
    // xoa bai viet
    public function destroy($baiVietID)
{
    $post = Post::find($baiVietID);
    if ($post) {
        $post->delete();
        return response()->json(['message' => 'Xóa bài viết thành công.'], 200);
    } else {
        return response()->json(['message' => 'Bài viết không tồn tại.'], 404);
    }
}
// tim kiem bai viet trong admin
public function searchadmin(Request $request)
{
    $query = $request->input('query');
    $posts = Post::where('tieuDe', 'like', "%{$query}%")->get();

    return view('SearchAdmin', compact('posts', 'query'));
}
public function show($baiVietID)
{
    $post = Post::findOrFail($baiVietID); // Lấy bài viết theo ID
    return view('postshow', compact('post')); // Trả về view chi tiết bài viết
}
// nut like
public function likePost($baiVietID)
{
    $post = Post::findOrFail($baiVietID);
    
    // Tăng số lượng like
    $post->soLike += 1;
    $post->save();

    return response()->json([
        'success' => true,
        'newLikeCount' => $post->soLike,
    ]);
}
public function showComments($baiVietID)
{
    $post = Post::findOrFail($baiVietID);
    $comments = Comment::where('baiVietID', $baiVietID)->get();

    return response()->json([
        'post' => [
            'tieuDe' => $post->tieuDe,
            'noiDung' => $post->noiDung,
        ],
        'comments' => $comments->map(function ($comment) {
            return [
                'noiDung' => $comment->noiDung,
                'ngayDang' => \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y'),
            ];
        })
    ]);
}

public function storeComment(Request $request, $baiVietID)
{
    // Validate dữ liệu
    $validatedData = $request->validate([
        'noiDung' => 'required|string|max:1000',
    ]);

    // Tạo mới bình luận
    $comment = new Comment();
    $comment->baiVietID = $baiVietID;
    $comment->noiDung = $validatedData['noiDung'];
    $comment->ngayDang = now();
    $comment->user_id = Auth::id(); // Nếu cần liên kết với người dùng
    $comment->save();

    // Lấy lại danh sách bình luận
    $comments = Comment::where('baiVietID', $baiVietID)->get();

    return response()->json([
        'success' => true,
        'comments' => $comments,
    ]);
}



}

