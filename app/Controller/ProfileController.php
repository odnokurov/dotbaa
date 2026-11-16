<?php

namespace Controller;

use Model\User;
use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Src\Validator\Validator;

class ProfileController
{
    public function profile(Request $request): string
    {
        $user = app()->auth->user();
        return (string) new View('site.profile_user', ['user' => $user]);
    }

    public function profile_edit(Request $request): string
    {
        $currentUser = app()->auth->user();

        if (!$currentUser) {
            app()->route->redirect('/login');
            return '';
        }

        return (string) new View('site.profile_edit', ['user' => $currentUser]);
    }

    public function profile_update(Request $request): string
    {
        $currentUser = app()->auth->user();

        if (!$currentUser) {
            app()->route->redirect('/login');
            return '';
        }

        $validator = new Validator($request->all(), [
            'surname' => ['required', 'alpha', 'min_length:2', 'max_length:100'],
            'name' => ['required', 'alpha', 'min_length:2', 'max_length:100'],
        ], [
            'required' => 'Поле :field обязательно',
            'alpha' => 'Поле :field должно содержать только буквы',
            'min_length' => 'Поле :field должно содержать минимум :min символов',
            'max_length' => 'Поле :field не должно превышать :max символов'
        ]);

        if ($validator->fails()) {
            return (string) new View('site.profile_edit', [
                'message' => implode('; ', array_map(function ($errors) {
                    return implode(', ', $errors);
                }, $validator->errors())),
                'user' => $currentUser
            ]);
        }

        $data = $request->all();
        unset($data['avatar']);

        $user = User::find($currentUser->user_id);

        if ($user) {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['avatar'];

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if (in_array($extension, $allowedExtensions, true)) {
                    $fileName = 'avatar_' . $user->user_id . '_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $extension;

                    $uploadDir = dirname(__DIR__, 2) . '/public/uploads/avatars/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $uploadFile = $uploadDir . $fileName;

                    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                        if (!empty($user->avatar)) {
                            $old = dirname(__DIR__, 2) . '/public' . $user->avatar;
                            if (is_file($old)) {
                                unlink($old);
                            }
                        }
                        $data['avatar'] = '/uploads/avatars/' . $fileName;
                    }
                } else {
                    return (string) new View('site.profile_edit', [
                        'message' => 'Недопустимый формат файла. Разрешены: jpg, jpeg, png, gif, webp',
                        'user' => $user
                    ]);
                }
            }

            $user->update($data);
            app()->route->redirect('/profile/user');
            return '';
        }

        app()->route->redirect('/profile/user');
        return '';
    }

    public function search(Request $request): string
    {
        $query = $request->get('query') ?? '';

        $users = User::where('role', '!=', '')
            ->when($query, function ($q) use ($query) {
                $q->where('surname', 'like', "%$query%")
                    ->orWhere('name', 'like', "%$query%")
                    ->orWhere('login', 'like', "%$query%");
            })
            ->orderBy('surname')
            ->get();

        return (string) new View('site.profile_search', [
            'users' => $users,
            'query' => $query
        ]);
    }
}