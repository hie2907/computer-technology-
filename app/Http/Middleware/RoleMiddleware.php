<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
   public function handle(Request $request, Closure $next, ...$roles)
{
    $user = Auth::guard('admin')->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }
    // Lấy vai trò của người dùng từ cơ sở dữ liệu
    $userRole = Role::where('roleId', $user->roleId)->first();

    // Kiểm tra xem vai trò người dùng có nằm trong danh sách vai trò được phép không
    if (!$userRole || !in_array($userRole->roleName, $roles)) {
        return response()->json(['error' => 'Forbidden'], 403);
    }
    return $next($request);
}

}
